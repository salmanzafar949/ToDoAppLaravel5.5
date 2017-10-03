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


    // function to delete notes

    public function delete(Request $r, $id)
    {
        Note::where('id', $request->id)->delete();
       // return $request->all();
        return "Deleted";
        return $r->all();
    }

    public function update(request $request)
    {
        $note = Note::find($request->id);
        $note->Task = $request->value;
        $note->save();
        return "Update Successfully";
        return $request->all();
    }
    
}
