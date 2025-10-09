<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{

     public function removeColumns($columns, $columsToBeRemove)
    {
        foreach ($columsToBeRemove as $value) {
            if (($key = array_search($value, $columns)) !== false) {
                unset($columns[$key]);
            }
        }
        return $columns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = new Partner();

        if($search != null){
            $query = Partner::query();

            $table = $data->getTable();

            $columns = $this->removeColumns(Schema::getColumnListing($table), ['created_at', 'updated_at', 'image', 'id']);

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }
            $data = $query->orderBy('name')->paginate(12);

            if($request->onChange == true)
            {
                return response()->json(['status' => true, 'data' => $data,'lastPage' => $data->lastPage()]);
            }

        }
        else{
            $data = $data->paginate(12);
            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        }


        return view('admin.partners.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = null;
        return view('admin.partners.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'logo' => 'required'
		]);
        $request->request->remove('_token');
        $data = $request->input();
        if ($request->hasFile('logo')) {
            File::isDirectory(public_path('uploads/partner')) or File::makeDirectory(public_path('uploads/partner'), 0777, true, true);

            $fileName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/partner'), $fileName);
            $data['logo'] = 'uploads/partner/'.$fileName;
        }
        Partner::create($data);

        return redirect('admin/partners')->with('success', 'Partner added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Partner::findOrFail($id);

        return view('admin.partners.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Partner $partner)
    {
        $this->validate($request, [
			'name' => 'required',
			'logo' => 'required'
		]);
        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();
        if ($request->hasFile('logo')) {
            File::isDirectory(public_path('uploads/partner')) or File::makeDirectory(public_path('uploads/partner'), 0777, true, true);
            if (File::exists(public_path($partner->logo))) {
                File::delete(public_path($partner->logo));
            }
            $fileName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/partner'), $fileName);
            $data['logo'] = 'uploads/partner/'.$fileName;
        }
        $partner->update($data);
        return redirect()->back()->with('success', 'Partner Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Partner $partner)
    {

        $status = $partner->status;
        if($status == 0){
            $partner->status = 1;
            $message = 'Deactive';
        }else{
            $partner->status = 0;
            $message = 'Active';
        }
        $partner->save();

        return redirect()->back()->with('success', 'Partner '.$message);

    }
}
