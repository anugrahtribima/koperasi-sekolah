<?php

namespace App\Http\Controllers\Types;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;

class TypeController extends Controller
{
    //
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }
}
