<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MailController extends Controller
{
    public function send(Request $request){
        $data = $request->all();
        $subject = 'Message from visitor';
        $headers  = "Content-type: text/html; charset=utf8 \r\n";
        $headers .= "From: ".$data['sender_name']." <". $data['sender_email'] .">\r\n";
        if(!mail('contact@pyslar-dmitriy.pp.ua', $subject, $data['sender_message'], $headers))
            return Response::json('Oops', 503);
    }
}
