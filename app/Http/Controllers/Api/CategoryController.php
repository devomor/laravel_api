<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
       return response()->json([
        'success'=> true,
        'message'=>'Successfully categories retrieved ',
        'data' => $categories,
       ]);
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $validator->errors()
            ], 400);
        }
        $formData = $validator->validated();
        $formData['slug'] = Str::slug($formData['name']);
        $Category = Category::create($formData);
        return response()->json([
            'success' => true,
            'message' => 'Successfully Categories Created',
            'data' => $Category,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         $category =Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not Found!',
                'errors' => [],
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'Successful',
            'data' => $category,
        ]);

    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       

        $category =Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not Found!',
                'errors' => [],
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories,name,'.$category->id,
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $validator->errors()
            ], 400);
        }
        $formData = $validator->validated();
        $formData['slug'] = Str::slug($formData['name']);
        $category ->update($formData);
        return response()->json([
            'success' => true,
            'message' => 'Successful',
            'data' => $category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
