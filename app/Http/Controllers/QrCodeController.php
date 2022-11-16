<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
      return view('qrcode');
    }

    public function getQR(){

        $random_number="12345"."-".rand(1000000000,9999999999);
        $myQR=QrCode::size(300)->generate($random_number);

        return $myQR;
    }
}
