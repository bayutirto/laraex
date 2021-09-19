<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
    }

    public function findAll(Request $request)
    {
        $data = $this->user->findAll();
        return response()->json(['data' => $data]);
    }
}
