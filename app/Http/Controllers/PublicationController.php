<?php

namespace App\Http\Controllers;

use App\Category;
use App\Publication;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicationController extends Controller
{
    function categoryById($id)
    {
        try {
            $category = Category::findOrFail($id);

            return response()->json([
                'data' => Publication::where('category_id', $id)->get()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([], 400);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    function fullPublication($categoryId, $publicationId)
    {
        try {
            $category = Category::findOrFail($categoryId);
            $publication = Publication::where('category_id', $categoryId)
                ->where('id', $publicationId)->first();
            if ($publication) {
                return response()->json([
                    'data' => $publication
                ], 200);
            } else {
                return response()->json([], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json([], 400);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    function favoritesByUser()
    {
        try {
            $favorites = User::find(\Auth::id())->favorites;

            return response()->json([
                'data' => $favorites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
