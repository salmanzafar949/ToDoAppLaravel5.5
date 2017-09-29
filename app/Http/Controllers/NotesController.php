<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotesController extends Controller
{
    //function to create nnew notes
    public function create(Request $r)
    {
        return $r->all();
    }
    
}
