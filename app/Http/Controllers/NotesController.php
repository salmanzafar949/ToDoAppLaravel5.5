<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
class NotesController extends Controller
{
    //function return view
    public function index()
    {
        //Now returning all the data to the view
        $Notes = Note::all();
        return view('ToDo', compact('Notes'));
    }
    
    //function to create nnew notes
    public function create(Request $r)
    {
        $note = new note;
        $note->note = $r->text;
        $note->save();
        return 'Done';

    }
    
}
