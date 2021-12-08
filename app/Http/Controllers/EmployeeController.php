<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class EmployeeController extends Controller
{
    //aizsardzībai
    public function __construct(){
        $this->middleware('auth');
    }

    //visi sistēmas lietotāji
    public function showEmployees(){
        $employee = User::all();
        return view('employees.index', compact('employee'));
      }

      public function createPDF() {
        // retreive all records from db
        $data = User::all();
  
        // share data to view
        view()->share('employee',$data);
        $pdf = PDF::loadView('employees.pdf', $data)->setOptions(['defaultFont' => 'sans-serif']);
  
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
      }

      public function editemployee($id){
        $this->authorize('isAdmin');
        $data = User::find($id);
        return view('employees.edit', compact('data'));
    }
    
    public function updateemployee(Request $request, $id){
        $this->authorize('isAdmin');
        
        $data = User::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'position'=>$request->position,
        ]);

        return redirect()->route('employees.index')->with('success', 'Ieraksts labots');
    }

    public function deleteemployee($id){
        $this->authorize('isAdmin');
        User::find($id)->delete();
           
           return Redirect()->back()->with('success', 'Lietotājs dzēsts');
    }
}
