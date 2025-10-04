<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use File;

use App\Models\{
    Page,
    Section
};
use Illuminate\Http\Request;

class PageController extends Controller
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
        $data = new Page();

        if ($search != null) {
            $query = Page::query();

            $table = $data->getTable();

            $columns = $this->removeColumns(Schema::getColumnListing($table), ['created_at', 'updated_at', 'image', 'id']);

            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }
            $data = $query->orderBy('name')->paginate(12);

            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        } else {
            $data = $data->paginate(12);
            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        }


        return view('admin.page.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = null;
        return view('admin.page.create', compact('data'));
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
            'name' => 'required'
        ]);
        $request->request->remove('_token');
        $data = $request->input();
        if ($request->hasFile('page_image')) {
            $fileName = time().'.'.$request->page_image->extension();
            $request->page_image->move(public_path('uploads/page'), $fileName);
            $data['image'] = 'uploads/page/'.$fileName;
        }

        Page::create($data);

        return response()->json(['status'=>true,'message' => 'Data Successfully Updated']);
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

    public function sectionCreate(Request $request)
    {
        $section = Section::create($request->all());
        return response()->json(['status' => true, 'slug' => $section->slug]);
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
        $data = Page::findOrFail($id);

        return view('admin.page.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();
        if ($request->hasFile('page_image')) {
            if (File::exists(public_path($page->image))) {
                File::delete(public_path($page->image));
            }
            $fileName = time().'.'.$request->page_image->extension();
            $request->page_image->move(public_path('uploads/page'), $fileName);
            $data['image'] = 'uploads/page/'.$fileName;
        }
        
        if ($request->exists('section')) {
            foreach ($request->section as $key => $section) {
                $page->sections()->where('slug', $key)->first()->update(['value' => $section]);
            }
        }
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/page')) or File::makeDirectory(public_path('uploads/page'), 0777, true, true);
            foreach ($request->file('image') as $key => $image) {
                $section = $page->sections()->where('slug', $key)->first();
                if (File::exists(public_path($section->value))) {
                    File::delete(public_path($section->value));
                }
                $fileName = time() . '.' . $image->extension();
                $image->move(public_path('uploads/page'), $fileName);
                $section->update(['value' => 'uploads/page/' . $fileName]);
            }
        }
        $page->update($data);
        return response()->json(['status'=>true,'message' => 'Data Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Page $page)
    {

        $status = $page->status;
        if ($status == 0) {
            $page->status = 1;
            $message = 'Deactive';
        } else {
            $page->status = 0;
            $message = 'Active';
        }
        $page->save();

        return redirect()->back()->with('success', 'Page ' . $message);
    }
}