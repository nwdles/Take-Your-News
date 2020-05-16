<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/** @mixin \Eloquent */
class Category extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'image'
    ];
    public function publication()
    {
        return $this->hasMany(Publication::class, 'category_id', 'id');
    }
}
