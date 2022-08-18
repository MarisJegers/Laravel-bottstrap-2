<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Costcenter;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function allcars(){
        // $data = Costcenter::all(); <- tas atgriezīs visus tabulas ierakstus
        // $data = Costcenter::latest()->get(); <- arī atgriezīs visu, bet jaunākie pievienotie būs tabulas augšā
        $data = Car::latest()->paginate(10);
        return view('cars.index', compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function createcars(){
        //skatā ir jāielādē dati no costcenters tabulas
        $costcenter = Costcenter::all();
        return view('cars.create')->with('costcenter', $costcenter);
    }

    public function addcar(Request $request){
        $this->authorize('isAdmin');
       
        //dd($request->all());
       //if($request->hasFile('image')){
            //$image = $request->file('image');
           // $imagename = $image->getClientOriginalName();
           // $imagepath = $request->file('image')->store('public/image');
        //}
        // validācijas kļūda parādās costcenters/index.blade.php skatā
        // uniqe:costcenters nozīmē unikāls ieraksts costcenters tabulā
        $request->validate([
            'reg_nr' => ['required', 'unique:cars', 'max:10'],
            'make' => ['required', 'max:20'],
            'model' => ['nullable', 'max:20'],
            'fuel_type' => ['required', 'max:15'],
            'prod_year' => ['nullable','numeric', 'min:1980' ,'max:2030'],
            'fuel_cons_factory' => ['nullable','numeric'],
            'purchase_date' => ['nullable', 'date'],
            'descrption'=> ['nullable','text'],
             //'image' => ['required', 'mimes:jpg'],
        ],
    [
        'reg_nr.required' => 'Laukam jābūt aizpildītam', // šīs ir error message
        'reg_nr.max' => 'Maksimālais ievadāmo zīmju skaits ir 10',
        'make.required' => 'Laukam jābūt aizpildītam', // šīs ir error message
        'make.max' => 'Maksimālais ievadāmo zīmju skaits ir 20',
        'fuel_type.required' => 'Laukam jābūt aizpildītam', // šīs ir error message
        //'image.required' => 'Pievieno attēla failu',
    ]);
    
    $newImageName = time().'-'.$request->name.'.'.$request->photo->extension();
    $request->photo->move(public_path('image'), $newImageName);
    //dd($test);
    //Costcenter::create($request->all());
    // eloquent variants datu pievienošanai
    //Car::insert([
    $product = Car::create([
        'reg_nr'=>$request->reg_nr,   //pirmais cc_number ir index.blade formas input lauks, request ir mainīgais kura tas tiek saglabāts un padots uz db`zes tabulu
        'make'=>$request->make,
        'model'=>$request->model,
        'fuel_type'=>$request->fuel_type,
        'prod_year'=>$request->prod_year,
        'fuel_cons_factory'=>$request->fuel_cons_factory,
        'purchase_date'=>$request->purchase_date,
        'cc_number_id'=>$request->cc_number_id,
        'description'=>$request->description,
        'created_at'=>Carbon::now(),
        'imagename' => $newImageName,
        'imagepath' => $newImageName,
    ]);
            // if($request->hasFile('image'))
            // {
            //     $uploaded_photo = $request->file('image');
            //     $extension = $uploaded_photo->getClientOriginalExtension();
            //     $imagename = md5(time()). '.' .$extension;
            //     $imagepath =  public_path('image');
            //     $uploaded_photo->move($imagepath, $imagename);
            // }

            // $product->image = $imagename;
            // $product->save();//no https://www.tutsmake.com/laravel-8-image-upload-tutorial/

        return redirect()->back()->with('success', 'Transporta līdzeklis pievienots');

    }
    //atrod db`zē rediģējamo ierakstu
    //un to atgriež skatā cars/edit.blade.php
    public function editcar($id){
        $this->authorize('isAdmin');
        //$costcenter = Costcenter::all();
        $data = Car::find($id);
        $costcenter = Costcenter::all();
        return view('cars.edit', compact('data','costcenter'));
    }

    public function updatecar(Request $request, $id){
        $this->authorize('isAdmin');
        //$data tiek izsaukts no edit.blade.php skata formas action lauka
        //formā esošo ierakstu (id) Costcenter modelis meklē datubāzē
        //un aizstāj ar $request mainīgajā labāto lietotāja no jauna
        //ierakstīto vērtību, kuru funkcija update ieraksta datubāzē
        //cc_number kreisajā pusē ir edit.blade formas input lauka nosaukums,
        //labajā pusē db`zes tabulas lauka nosaukums
        $data = Car::find($id)->update([
            'reg_nr'=>$request->reg_nr,   //pirmais reg_nr ir edit.blade formas input lauks, request ir mainīgais kura tas tiek saglabāts un padots uz db`zes tabulu
            'make'=>$request->make,
            'model'=>$request->model,
            'fuel_type'=>$request->fuel_type,
            'prod_year'=>$request->prod_year,
            'fuel_cons_factory'=>$request->fuel_cons_factory,
            'purchase_date'=>$request->purchase_date,
            'cc_number_id'=>$request->cc_number_id,
            'description'=>$request->description,
        ]);

        // route('costcenters.index') ir routa name no web.php
        return redirect()->route('cars.index')->with('success', 'Transporta līdzekļa dati izlaboti');
    }

    public function deletecar($id){
        $this->authorize('isAdmin');
        Car::find($id)->delete();
           
           return Redirect()->back()->with('success', 'Ieraksts dzēsts');

    }

    public function search(Request $request){
        // Lietotāja ierakstītā frāze tiek iegūta no formas input lauka,
        // kurš tiek saglabāts $search mainīgajā
        $search = $request->input('search');
    
        // sql vaicājums meklē frāzi Costcenter tabulas cc_number un description kolonās
        $cc = Car::query()
            ->where('reg_nr', 'LIKE', "%{$search}%")
            ->orWhere('make', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%")
            ->get();
    
        // meklēšanas rezultātu atgriešanas skats
        return view('cars.search', compact('cc'));
    }





}








