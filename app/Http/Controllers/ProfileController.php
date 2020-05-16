<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function getUserInfo() {
        try {
            return Auth::user();
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}
