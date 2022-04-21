<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLangController extends Controller
{
 public function changeLangToVN(){
     session(['lang' => 'vi']);
 }
    public function changeLangToEN(){
        session(['lang' => 'en']);
    }
}
