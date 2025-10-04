<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
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
        $data = new Faq();

        if($search != null){
            $query = Faq::query();

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


        return view('admin.faqs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = null;
        return view('admin.faqs.create', compact('data'));
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
			'question' => 'required',
			'answer' => 'required'
		]);
        $request->request->remove('_token');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/faq')) or File::makeDirectory(public_path('uploads/faq'), 0777, true, true);

            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/faq'), $fileName);
            $data['image'] = 'uploads/faq/'.$fileName;
        }
        Faq::create($data);

        return redirect('admin/admin/faqs')->with('success', 'Faq added!');
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
        $data = Faq::findOrFail($id);

        return view('admin.faqs.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Faq $faq)
    {
        $this->validate($request, [
			'question' => 'required',
			'answer' => 'required'
		]);
        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/faq')) or File::makeDirectory(public_path('uploads/faq'), 0777, true, true);
            if (File::exists(public_path($faq->image))) {
                File::delete(public_path($faq->image));
            }
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/faq'), $fileName);
            $data['image'] = 'uploads/faq/'.$fileName;
        }
        $faq->update($data);
        return redirect()->back()->with('success', 'Faq Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Faq $faq)
    {

        $status = $faq->status;
        if($status == 0){
            $faq->status = 1;
            $message = 'Deactive';
        }else{
            $faq->status = 0;
            $message = 'Active';
        }
        $faq->save();

        return redirect()->back()->with('success', 'Faq '.$message);

    }
}
