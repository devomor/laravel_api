<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return response()->json([
            'status'=> 200,
            'message' => 'Welcome to Laravel Api'
        ]);
    }
    public function store(Request $request){
        return response() ->json([
            'form_request' => $request->all(),
        ]);

    }
}
