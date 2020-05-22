<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    function categories()
    {
        $data = Category::all()->toArray();

        $data = array_map(function($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => asset($item['image'])
            ];
        }, $data);

        try {
            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

    }

    function getImage() {
        return asset('storage/images/1.jpg');
    }
}
