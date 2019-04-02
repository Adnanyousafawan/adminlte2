<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{

  public function store(Request $request)
    {
        $request->validate([
            'proj_title' => 'required',
            'proj_location' => 'required'
            'proj_city' => 'required'

        ]);

        $projects = new Project([
            'proj_title' => $request->get('proj_title'),
            'proj_location' => $request->get('proj_location')
            'proj_area' => $request->get('proj_area'),
            'proj_city' => $request->get('proj_city')
        ]);

        $projects->save();

        return redirect('/home')->with('success', 'New book record has been added');
    }

}

