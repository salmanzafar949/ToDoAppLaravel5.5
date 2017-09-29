<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    //function return view
    public function index()
    {
        return view('ToDo');
    }
    
    //function to create nnew notes
    public function create(Request $r)
    {
        return $r->all();
    }
    
}
