<?php

namespace App\Http\Controllers;

use App\Models\Costcenter;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CostcenterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function allcostcenters(){
        // $data = Costcenter::all(); <- tas atgriezīs visus tabulas ierakstus
        // $data = Costcenter::latest()->get(); <- arī atgriezīs visu, bet jaunākie pievienotie būs tabulas augšā
        $data = Costcenter::latest()->paginate(10);
        return view('costcenters.index', compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function addcostcenter(Request $request){
        $this->authorize('isAdmin');
        // validācijas kļūda parādās costcenters/index.blade.php skatā
        // uniqe:costcenters nozīmē unikāls ieraksts costcenters tabulā
        $request->validate([
            'cc_number' => ['required', 'unique:costcenters', 'max:10'],
            'descrption'=> ['nullable|text'],
        ],
    [
        'cc_number.required' => 'Laukam jābūt aizpildītam', // šīs ir error message
        'cc_number.max' => 'Maksimālais ievadāmo zīmju skaits ir 10',
    ]);
    
    //Costcenter::create($request->all());
    // eloquent variants datu pievienošanai
    Costcenter::insert([
        'cc_number'=>$request->cc_number,   //pirmais cc_number ir index.blade formas input lauks, request ir mainīgais kura tas tiek saglabāts un padots uz db`zes tabulu
        'description'=>$request->description,
        'created_at'=>Carbon::now()
    ]);

        return redirect()->back()->with('success', 'Izmaksu centrs pievienots');

    }

    public function editcostcenter($id){
        $this->authorize('isAdmin');
        $data = Costcenter::find($id);
        return view('costcenters.edit', compact('data'));
    }
    
    // $request nāk no edit.blade.php formas input lauka, tas tiek saglabāts $data mainīgajā
    public function updatecostcenter(Request $request, $id){
        $this->authorize('isAdmin');
        //$data tiek izsaukts no edit.blade.php skata formas action lauka
        //formā esošo ierakstu (id) Costcenter modelis meklē datubāzē
        //un aizstāj ar $request mainīgajā labāto lietotāja no jauna
        //ierakstīto vērtību, kuru funkcija update ieraksta datubāzē
        //cc_number kreisajā pusē ir edit.blade formas input lauka nosaukums,
        //labajā pusē db`zes tabulas lauka nosaukums
        $data = Costcenter::find($id)->update([
            'cc_number'=>$request->cc_number,
            'description'=>$request->description,
        ]);

        // route('costcenters.index') ir routa name no web.php
        return redirect()->route('costcenters.index')->with('success', 'Izmaksu centrs izlabots');
    }

    public function deletecostcenter($id){
        $this->authorize('isAdmin');
        Costcenter::find($id)->delete();
           
           return Redirect()->back()->with('success', 'Izmaksu centrs dzēsts');

    }

    public function search(Request $request){
        // Lietotāja ierakstītā frāze tiek iegūta no formas input lauka,
        // kurš tiek saglabāts $search mainīgajā
        $search = $request->input('search');
    
        // sql vaicājums meklē frāzi Costcenter tabulas cc_number un description kolonās
        $cc = Costcenter::query()
            ->where('cc_number', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();
    
        // meklēšanas rezultātu atgriešanas skats
        return view('costcenters.search', compact('cc'));
    }
}
