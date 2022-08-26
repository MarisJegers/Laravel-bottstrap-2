<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    //

    public function index()
    {
        $test = Test::orderBy('id', 'desc')->first();
        $data = Test::latest()->paginate(10);
        
        return view('tests.index', compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        //$test = Test::orderBy('id', 'desc')->first();
        //return view('tests.create')->with('test',$test);
    }

    
    public function create()
    {
        $test = Test::orderBy('id', 'desc')->first();
        return view('tests.create')->with('test',$test);
    }

    
    public function store(Request $request)
    {
        //$test = Test::orderBy('id', 'desc')->first();
        //$data = Test::latest()->paginate(10);
         $validatedData = $request->validate([
            'tname' => 'required|max:30',
            'tage' => 'required',
            'tplace' => 'required',
            'tzip' => 'required',
            'tdate' => 'required',
        ]);
        $create = Test::create($validatedData);
   
        //return redirect('/tests/create')->with('success', 'Pievienots');
         return redirect()->back()->with('success', 'Ieraksts pievienots');
    }


    public function edit($id){
        
        $test = Test::find($id);
        return view('tests.edit', compact('test'));
    }


    public function update(Request $request, $id){
        
        $validatedData = $request->validate([
            'tname' => 'required|max:30',
            'tage' => 'required',
            'tplace' => 'required',
            'tzip' => 'required',
            'tdate' => 'required',

        ]);
        Test::whereId($id)->update($validatedData);

        return redirect()->route('tests.index')->with('success', 'Ieraksts izlabots');
    }


    public function delete($id)
    {
        Test::find($id)->delete();
           
           return Redirect()->back()->with('success', 'Ieraksts dzēsts');
    }

}
