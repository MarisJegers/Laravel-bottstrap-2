<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Excel as BaseExcel;
use Maatwebsite\Excel\Facades\Excel;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

     public $sendto, $attachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attachment)
    {
        //$this->sendto = $sendto;
        //$this->filename = $filename;
        //$this->attachment = $attachment;
         $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        //$filename = "tests.xlsx";
        //$attachment = Excel::raw(new TestEmail($filename), BaseExcel::XLSX);
        //$subject = "Testa sūtījums";

        //return $this->from("noreply@kaskade.id.lv")
                    //->subject($subject)
                    //->view('mail-template')
                    //->text('mail-template')
                    //->attachData($attachment, $filename);

        $mail = $this->from('noreply@kaskade.id.lv')
        ->subject('test attachment v2')
        ->view('mail-template')
        ->text('mail-template')
        ->attach($this->attachment);

        return $mail;



        //return $this->from("noreply@kaskade.id.lv")->view('mail-template');
        //return $this->view('mail-template');

        //Šis strādāja ar pogu send un jauna blade loga atvēršanu, bet nosūtītais ekseļa fails ir tukšs
        //$filename = "tests.xlsx";
        //$attachment = Excel::raw(new TestEmail($filename), BaseExcel::XLSX);
        //$subject = "Testa sūtījums";

        //return $this->from("noreply@kaskade.id.lv")
          //          ->subject($subject)
          //          ->view('mail-template')
          //          ->text('mail-template')
          //          ->attachData($attachment, $filename);



    }
}
