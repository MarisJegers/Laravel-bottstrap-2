<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Map;

class MapController extends Controller
{
    //no https://www.blogperk.com/en/build-leaflet-map-with-laravel-and-mysql-tutorial-with-source-code
    public function index()
    {
        $data = Map::latest()->paginate(10);
        $locations = [];     

        foreach (Map::All() as $address) {

            $locations[] = [
                     'location' => view('maps/map-tool-tip')->with(['address' => $address])->render(), 
                     'latitude' => $address->latitude, 
                     'longitude' => $address->longitude
            ];
        }

        return view('maps.index', compact('data'))->with([
                    'locations' => json_encode($locations)
        ]);
    }


    public function create()
    {
        $data = Map::latest()->paginate(10);
        return view('maps.create', compact('data'));
    }

    
    public function store(Request $request)
    {
        //$test = Test::orderBy('id', 'desc')->first();
        //$data = Test::latest()->paginate(10);
         $validatedData = $request->validate([
            'mname' => 'required|max:59',
            'maddress' => 'required|max:200',
            'latitude' => 'required',
            'longitude' => 'required',
            
        ]);
        $create = Map::create($validatedData);
   
        //return redirect('/tests/create')->with('success', 'Pievienots');
         return redirect()->back()->with('success', 'Koordinātas pievienotas');
    }

}
