<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite, Auth;
use App\Models\{User, Comment, Bid, Product, Order};
use Hash, File;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
class UserController extends Controller
{
    private $include;
    public function __construct()
    {
        $this->include = [
            'index' => ['heading' => 'Dashboard', 'include' => 'user.include.dashboard'],
            'settings' => ['heading' => 'Account Settings', 'include' => 'user.include.settings'],
        ];
    }
    private function returnView($page, $extra = [])
    {
        return view('user.app', $page + $extra);
    }
    public function settings()
    {
        return  $this->returnView($this->include[__FUNCTION__]);
    }
    public function index()
    {
        return $this->returnView($this->include[__FUNCTION__]);
    }

    public function wishlist()
    {
        $wishlist = Product::whereHas('wishlist', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->get();
        return view('user.include.wishlist',compact('wishlist'));
    }

    public function orderHistory()
    {
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.include.order_history',compact('order'));
    }

    public function generateInvoice($id)
    {
        $order = Order::find($id);
        $customer = new Buyer([
            'name'          => $order->name,
            'custom_fields' => [
            'email' => $order->email,
            'phone' => $order->phone,
            'address' => $order->address
            ],
            ]);
            
            $item = [];
            foreach($order->products as $items){
            $item = (new InvoiceItem())->title($items->name)->pricePerUnit($order->amount);
            }            
            $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(0)
            ->shipping(0)
            ->currencyCode('usd')
            ->currencySymbol('$')
            ->addItem($item);
            
            return $invoice->stream();
    }

    public function accountUpdate(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = [
            'password' => Hash::make($request->input('password'))
        ];
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/faq')) or File::makeDirectory(public_path('uploads/faq'), 0777, true, true);

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/faq'), $fileName);
            $data['image'] = 'uploads/faq/' . $fileName;
        }
        Auth::user()->update($data);
        return redirect('/user/dashboard')->with('success', 'Account Settting Update');
    }

    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/user/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt('@Admin!23#')
                ]);

                Auth::login($newUser);

                return redirect('/user/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {


        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/user/dashboard');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,
                    'role' => 2,
                    'google_id' => $user->id,
                    'password' => bcrypt('@Admin!23#')


                ]);

                Auth::login($newUser);

                return redirect('/user/dashboard');
            }
        } catch (Exception $e) {

            return redirect('dashboard');
        }
    }




    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 2) {
                return redirect()->route('user.dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['msg' => 'Email and Password are wrong']);
        }
    }
}
