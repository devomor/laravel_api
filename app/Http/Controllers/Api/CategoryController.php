<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::latest()->get();
  
    // return (new CategoryResource($categories));
    return new SuccessResource([
        'message' => 'All Category',
        'data'=> $categories
    ]);
    }


    public function store(CategoryStoreRequest $request)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['name']);
        $Category = Category::create($formData);
        return (new SuccessResource(['message' => 'Successfully Categories Created',]))->response()->setStatusCode(201);
    }


    public function show(Category $category)
    {
        $formatDate['data'] = new CategoryResource($category);
        return new SuccessResource([
            'data'=> $formatDate
        ]);

    }
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $formData = $request->validated();
        $formData['slug'] = Str::slug($formData['name']);
        $category ->update($formData);
        return (new SuccessResource(['message' => 'Successfully Categories update',]))->response()->setStatusCode(201);
    }


    public function destroy(Category $category)
    {
        $category ->delete();
        return (new SuccessResource(['message' => 'Successfully Categories Deleted',]))->response()->setStatusCode(201);
    }
}
