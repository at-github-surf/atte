<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getLogin()
    {
        return view('login');
    }

    public function getMembers(){
        $members = user::paginate(5);
        return view('members/index', ['members' => $members,]);
    }
}
