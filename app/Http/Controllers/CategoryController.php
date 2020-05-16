<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    function categories()
    {
        try {
            return response()->json(['data' => Category::all()], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

    }

    function getImage() {
        return asset('storage/images/1.jpg');
    }
}
