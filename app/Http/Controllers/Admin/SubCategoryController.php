<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    /* public function __construct()
    {
    $this->authorizeResource(SubCategory::class,'subcategory');
    }
 */
    public function create(SubCategory $subcategory)
    {
        $category = Category::all();
        return view('admin.subcategory.create', compact('category', 'subcategory'));
    }

    public function store(Request $request)
    {
        $this->getValidate($request);
        $subcategory = SubCategory::create([
            'name' => $request->name,
            'show' => $request->show,
            'category_id' => $request->category_id
        ]);
        toast()->success('Successfully');
        if ($subcategory) {
            toast('Successfully', 'success');
            return redirect()->back();
        } else {
            toast('Error!!', 'error');
            return redirect()->back();
        }

    }

    public function edit(SubCategory $subcategory)
    {
        $category = Category::all();
        return view('admin.subcategory.edit', compact('category', 'subcategory'));
    }

    public function update(SubCategory $subcategory,Request $request)
    {
        $this->getValidate($request);
        $subcategory->update([
            'name' => $request->name,
            'show' => $request->show,
            'category_id' => $request->category_id
        ]);
        if ($subcategory) {
            toast('Successfully', 'success');
            return redirect()->back();
        } else {
            toast('Error!!', 'error');
            return redirect()->back();
        }
    }

    public function destroy(SubCategory $subcategory)
    {
        $subcategory->delete();
        toast('Delete!', 'error');
        return redirect()->back();
    }
    public function trash(SubCategory $subcategory)
    {
        $subcategories = SubCategory::onlyTrashed()->orderByDesc('id')->paginate(5);
        return view('admin.subcategory.trash', compact('subcategory', 'subcategories'));
    }

    public function restore($id)
    {
        $subcategories = SubCategory::withTrashed()->findOrFail($id)->restore();
        toast(__('restore : ') . $id, 'success');
        return redirect()->back();
    }


    public function forceDelete($id)
    {
        $subcategories = SubCategory::withTrashed()->findOrFail($id)->forceDelete();
        toast(__('deleted !'), 'error');
        return redirect()->back();

    }

    protected function getValidate(Request $request)
    {
        return $valid = $request->validate([
            'name.*' => 'required|max:200',
            'show' => 'required|max:1',
            'category_id' => 'required'
        ]/*,[
            'name.required'=>'the name valid',
            'show.required'=>'the show valid'
        ]*/);
        if ($valid->fails()) {
            return redirect()->route('subcategories.index')
                ->withErrors($valid)
                ->withInput();
        }
    }
}
