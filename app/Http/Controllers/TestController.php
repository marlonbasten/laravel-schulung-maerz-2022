<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(string $name, int $age = null)
    {
        return view('test', compact('name', 'age'));
    }

    public function test2()
    {
        $users = ['Nutzer1', 'Nutzer2', 'Nutzer3', 'Nutzer4'];
        $age = 20;

        return view('test2', compact('users', 'age'));
    }
}
