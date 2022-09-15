<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Exports\TestsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;


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

    //metode datu eksportēšanai xlsx failā
    public function export() 
    {
       return Excel::download(new TestsExport, 'tests.xlsx');
    }

    
    // tests/index.blade skatā ir poga sūtīt. 
    // Uz to klikšķinot atvērs html formu, no kuras uz kontrolieri tiks padota adresāta e-pasta adrese
    public function getemail()
    {
               
        return view('tests.mail');
    }

   
    // metode eksportētā faila sūtīšanai - nedarbojas
    public function sendAttach(Request $request)
    {
       
        $filename = "tests.xlsx";
        $attachment = Excel::raw(new TestsExport(), \Maatwebsite\Excel\Excel::XLSX);
        //$attachment = Excel::raw(new TestsExport(), BaseExcel::XLSX);
       //$attachment  = Excel::raw(new TestsExport, \Maatwebsite\Excel\Excel::XLSX);
        //$attachment = Excel::store(new TestsExport, 'tests.xlsx');
        //$attachment  =Excel::store(new TestsExport, 'tests.xlsx');
        $this->validate($request, [
                        'sendto' => 'required|email',
                ]);
        
        $sendto = $request->input('sendto');
        //Mail::to($sendto)->send(new TestEmail($sendto))->attach($attachment,  $filename);
        Mail::to($sendto)->send(new TestEmail($sendto));
        if (Mail::failures() != 0) {
            return "Email has been sent successfully.";
        }
        return "Oops! There was some error sending the email.";

        //

        //Mail::send('emails.myTestMail', $data, function($message)use($data, $files) {
          //  $message->to($data["email"], $data["email"])
            //        ->subject($data["title"]);
 
            //foreach ($files as $file){
              //  $message->attach($file);
            //}
            
        //});
    }


    public function sendAttachm(Request $request)
    {
       
        $filename = "tests.xlsx";
        //$attachment = Excel::download(new TestsExport, 'tests.xlsx'); // ar šo ir kļūda Unable to open file for reading [HTTP/1.0 200 OK Cache-Control: public Content-Disposition: attachment; filename=tests.xlsx Date: Tue, 13 Sep 2022 10:10:02 GMT Last-Modified: Tue, 13 Sep 2022 10:10:01 GMT ]
        $attachment = Excel::store(new TestsExport, 'tests.xlsx'); //dod kļūdu Unable to open file for reading [1], bet fails tiek izveidots
        //$attachment = Excel::raw(new TestsExport(), BaseExcel::XLSX);
       //$attachment  = Excel::raw(new TestsExport, \Maatwebsite\Excel\Excel::XLSX);
        //$attachment = Excel::store(new TestsExport, 'tests.xlsx');
        //$attachment  =Excel::store(new TestsExport, 'tests.xlsx');
        $input = $request->validate([
            'sendto' => 'required',
        ]);
        $file = public_path('tests.xlsx'); //ar [] deva kļūdu basename(): Argument #1 ($path) must be of type string, array given
        //ja nav pilns ceļš dod šo kļūdu: Unable to open file for reading [C:\xampp\htdocs\laravel-bootstrap-2\public\tests.xlsx]
        //\Mail::to('to@example.com')->send(new SendMail($attachment));
        //$sendto = $request->input('sendto');
        //Mail::to($sendto)->send(new TestEmail($sendto))->attach($attachment,  $filename);
        //$data["email"] = $input['sendto'];
        $data["title"] = "testa mail v3";
        $data["body"] = "This is test mail with attachment";
        Mail::send('mail-template', $data, function($message)use($data, $file, $input) {
            $message->to($input['sendto'])  //dod kļūdu Undefined variable $sendto (View: C:\xampp\htdocs\laravel-bootstrap-2\resources\views\mail-template.blade.php)
                    ->subject($data["title"])->attach($file);
                     
        });

        //echo "Mail send successfully !!"; //šis izdrukājas pēc visas metodes izpildes
        return redirect()->route('tests.index')->with('success', 'Epasts ar pielikumu aizsūtīts');


        //\Mail::to($input['sendto'])->send(new TestEmail($attachment));
        //if (Mail::failures() != 0) {
          //  return "Email has been sent successfully.";
        //}
        //return "Oops! There was some error sending the email.";

        //

        //Mail::send('emails.myTestMail', $data, function($message)use($data, $files) {
          //  $message->to($data["email"], $data["email"])
            //        ->subject($data["title"]);
 
            //foreach ($files as $file){
              //  $message->attach($file);
            //}
            
        //});
    }

    //metode satura eksportēšanai no db`zes un saglabāšanai uz servera diska ekseļa formātā
    public function storeExcel() 
    {
        // Store on default disk
        Excel::store(new TestsExport, 'tests.xlsx');
    }

}
