<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{
    public function __construct()
    {
        /* $this->authorizeResource(Product::class, 'product'); */
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        $this->middleware('permission:category-trash', ['only' => ['trash', 'restore', 'forceDelete']]);
    }
    public function index(Category $category)
    {
        $categories = Category::withCount('products', 'subcategories')->orderByDesc('id')->paginate(5);
        return view('admin.category.index', compact('category', 'categories'));
    }

    public function show(Category $category)
    {
        $subcategories = SubCategory::where('category_id', $category->id)->orderByDesc('id')->paginate(5);
        $products = Product::where('category_id', $category->id)->orderByDesc('id')->paginate(5);
        return view('admin.category.show', compact('category', 'subcategories', 'products'));
    }

    public function create(Category $category)
    {
        /*, Gate::authorize('category.create',$category);*/
        return view('admin.category.create', compact('category'));
    }

    public function store(Request $request)
    {

        $this->getValidate($request);
        $category = Category::create([
            'name' => $request->name,
            'show' => $request->show
        ]);
        toast()->success('Successfully', 'done');
        if ($category) {
            toast('Successfully', 'success');
            return redirect()->back();
        } else {
            toast('Error!!', 'error');
            return redirect()->back();
        }
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {

        $this->getValidate($request);

        $category->update([
            'name' => $request->name,
            'show' => $request->show
        ]);
        if ($category) {
            toast('Successfully', 'success');
            return redirect()->route('categories.index');
        } else {
            toast('Error!!', 'error');
            return redirect()->route('categories.index');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        toast('Delete!', 'error');
        return redirect()->back();
    }

    protected function getValidate(Request $request)
    {
        return $validtor = $request->validate([
            'name.*' => 'required|max:200',
            'show' => 'required|max:1'
        ]/*,[
            'name.required'=>'the name valid',
            'show.required'=>'the show valid'
        ]*/);
        if ($validtor->fails()) {
            return redirect()->route('categories.index')
                ->withErrors($valid)
                ->withInput();
        }
    }

    public function trash(Category $category)
    {
        $categories = Category::withCount('products', 'subcategories')->onlyTrashed()->orderByDesc('id')->paginate(5);
        return view('admin.category.trash', compact('category', 'categories'));
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id)->restore();
        toast(__('restore : ') . $id, 'success');
        return redirect()->route('categories.index');
    }


    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id)->forceDelete();
        toast(__('deleted !'), 'error');
        return redirect()->back();
    }


    public function search(Request $request, Category $category)
    {
        $request->validate([
            'search' => 'required'
        ]);


        $categories = Category::search($request->search)->paginate(10);

        if (count($categories) > 0) {
            return view('admin.category.search', compact('category', 'categories'));
        } else {
            return view('admin.category.search', compact('category', 'categories'));
            toast('NO RESULT !', 'error');
        }
    }
}
