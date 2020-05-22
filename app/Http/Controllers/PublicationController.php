<?php

namespace App\Http\Controllers;

use App\Category;
use App\Favorite;
use App\Publication;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublicationController extends Controller
{
    function categoryById($id)
    {
        try {
            $category = Category::findOrFail($id);

            $data = Publication::where('category_id', $id)->get()->toArray();

            $data = array_map(function($item) {
                return [
                    'id' => $item['id'],
                    'header' => $item['header'],
                    'description' => $item['description'],
                    'text' => $item['text'],
                    'image' => asset($item['image']),
                    'category_id' => $item['category_id']
                ];
            }, $data);

            return response()->json([
                'data' => $data
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
                ->where('id', $publicationId)->first()->toArray();
            $publication = [
                    'id' => $publication['id'],
                    'header' => $publication['header'],
                    'description' => $publication['description'],
                    'text' => $publication['text'],
                    'image' => asset($publication['image']),
                    'category_id' => $publication['category_id']
                ];


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
            $squashArray = function (array $total, array $current) {

                $existsFilter = function ($item) use ($current) {
                    return $item['name'] === $current['name'];
                };

                $notExistsFilter = function ($item) use ($current) {
                    return $item['name'] !== $current['name'];
                };

                $increase = function ($exists, $current) {
                    array_push($exists['publications'], [
                            'header' => $current['header'],
                            'description' => $current['desc'],
                            'text' => $current['text'],
                            'image' => asset($current['pub_img'])
                        ]
                    );

                    return [
                        'name' => $current['name'],
                        'image' => asset($current['image']),
                        'publications' => $exists['publications']
                    ];
                };

                $create = function ($current) {
                    return [
                        'name' => $current['name'],
                        'image' => asset($current['image']),
                        'publications' => [0 => [
                            'header' => $current['header'],
                            'description' => $current['desc'],
                            'text' => $current['text'],
                            'image' => asset($current['pub_img'])
                        ]
                        ]
                    ];
                };

                if ($exists = $this->first(array_filter($total, $existsFilter))) {
                    return array_merge(array_filter($total, $notExistsFilter), [$increase($exists, $current)]);
                } else {
                    return array_merge($total, [$create($current)]);
                }

            };

            $favorites = Favorite::select([
                'categories.name',
                'categories.image',
                'header',
                'description as desc',
                'text',
                'publications.image as pub_img'
            ])
                ->join('publications', 'publications.id', 'publication_id')
                ->join('categories', 'categories.id', 'category_id')
                ->where('user_id', \Auth::id())
                ->get()
                ->toArray();

            $favorites = $this->reduce($squashArray, $favorites, []);

            return response()->json([
                'data' => $favorites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    private function reduce(callable $func, array $array, $initial = null)
    {
        return array_reduce($array, $func, $initial);
    }

    private function first($array)
    {
        return reset($array);
    }

}
