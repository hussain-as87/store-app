<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['store']]);
        $this->middleware('permission:category-edit', ['only' => ['update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $category = Category::with('products', 'subcategories', 'user')->paginate(10);
        if ($category) {
            return new JsonResponse([
                'status' => '201',
                'message' => $category
            ]);
        } else {
            return new JsonResponse([
                'status' => '404',
                'message' => __('not found !')
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'name' => 'required',
            'show' => 'required|max:1|min:1'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'show' => $request->show
        ]);
        if ($category) {
            return new JsonResponse([
                'status' => '201',
                'message' => $category
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => __('failed created !')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $user = \auth()->user()->currentAccessToken()->tokenable->id;
        $category = Category::with('products', 'subcategories', 'user')->where('id', $request->id)->first();
        if ($category) {
            return new JsonResponse([
                'status' => '201',
                'message' => $category
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => __('not found !')
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $user = \auth()->user()->currentAccessToken()->tokenable->id;
        $request->validate([
            'name' => 'required',
            'show' => 'required|max:1|min:1'
        ]);
        $category = Category::where('id', $request->id)->first();
        $category->update([
            'name' => $request->name,
            'show' => $request->show
        ]);
        if ($category) {
            return new JsonResponse([
                'status' => '201',
                'message' => $category
            ]);
        } else {
            return new JsonResponse([
                'status' => '500',
                'message' => __('failed updated !')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $user = auth()->user()->currentAccessToken()->tokenable->id;
        $category = Category::where('id', $request->id)->first()->delete();
        if (!$category) {
            return new JsonResponse([
                'status' => '401',
                'message' => 'failed deleted !'
            ]);
        }
        return new JsonResponse([
            'status' => '201',
            'message' => __('category is deleted !')
        ]);
    }
}
