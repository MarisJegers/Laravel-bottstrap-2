<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    //

    public function index()
    {
        //
        $test = Test::orderBy('id', 'desc')->first();
        return view('tests.create')->with('test',$test);
    }

    
    public function create()
    {
        $test = Test::orderBy('id', 'desc')->first();
        return view('tests.create')->with('test',$test);
    }

    
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'tname' => 'required|max:30',
            'tage' => 'required',
            'tplace' => 'required',
            'tzip' => 'required',
            'tdate' => 'required',
        ]);
        $create = Test::create($validatedData);
   
        return redirect('/tests/create')->with('success', 'Pievienots');
    }
}
