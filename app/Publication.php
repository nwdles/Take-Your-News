<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/** @mixin \Eloquent */
class Publication extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'header', 'description', 'text', 'image', 'category_id'
    ];

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'publication_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
