<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function hello()
    {
        return response()->json([
            'name' => 'endriu',
            'surname' => 'kaskija'
        ]);
    }
}
