<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Journey;
use App\Models\Costcenter;
use Illuminate\Http\Request;
use App\Models\Travelitinerary;
use Illuminate\Support\Facades\Auth;

class JourneyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function alljourneys(){
        // $data = Costcenter::all(); <- tas atgriezīs visus tabulas ierakstus
        // $data = Costcenter::latest()->get(); <- arī atgriezīs visu, bet jaunākie pievienotie būs tabulas augšā
        $travelitinerary = Travelitinerary::all();
        $data = Journey::latest()->paginate(10);
        return view('journeys.index', compact('data'))
        ->with('travelitinerary', $travelitinerary)
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function addjourneys(Request $request){
        //$this->authorize('isAdmin');
        // validācijas kļūda parādās costcenters/index.blade.php skatā
        // uniqe:costcenters nozīmē unikāls ieraksts costcenters tabulā
        
        $validated = $request->validate([
            'ti_nr_id' => 'required',
            'date'=> 'required|date',
            'position_start'=>'required|string',
            'position_end'=>'required|string',
            'trip_target'=>'nullable|string',
            'distance_km'=>'required|numeric|gt:0',
            'type_private'=>'nullable',
            'type_business'=>'nullable',
            'cc_number_id'=>'nullable',
        ],
        [
            'ti_nr_id.required' => 'Laukam jābūt aizpildītam', // šīs ir error message
            'date.required' => 'Laukam jābūt aizpildītam',
            'date.date' => 'Jāievada DATUMS',
            'position_start.required'=> 'Laukam jābūt aizpildītam',
            'position_end.required'=> 'Laukam jābūt aizpildītam',
            'distance_km.required'=> 'Laukam jābūt aizpildītam',
            'distance_km.numeric'=> 'Ievadi SKAITLI',
            'distance_km.gt:0'=> 'Ievadi pozitīvu SKAITLI',
        ]);
    
        //Costcenter::create($request->all());
        // eloquent variants datu pievienošanai
        Journey::insert([
            'ti_nr_id'=>$request->ti_nr_id,   //pirmais cc_number ir index.blade formas input lauks, request ir mainīgais kura tas tiek saglabāts un padots uz db`zes tabulu
            'date'=>$request->date,
            'position_start'=>$request->position_start,
            'position_end'=>$request->position_end,
            'trip_target'=>$request->trip_target,
            'distance_km'=>$request->distance_km,
            'type_private'=>$request->type_private,
            'type_business'=>$request->type_business,
            'cc_number_id'=>$request->cc_number_id,
            'created_at'=>Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Brauciens pievienots');

    }

    public function deletejourney($id){
        //$this->authorize('isAdmin');
        Journey::find($id)->delete();
           
           return Redirect()->back()->with('success', 'Ieraksts dzēsts');

    }


}
