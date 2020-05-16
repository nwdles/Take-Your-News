<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/** @mixin \Eloquent */
class Favorite extends Model
{
    protected $primaryKey = [
        'user_id', 'publication_id'
    ];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'publication_id'
    ];
}
