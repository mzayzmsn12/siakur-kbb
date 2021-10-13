<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    //
    function show(){
      $data= School::all();
      // $data=Test::all();
      return view('layouts.admin.usulan',['schools'=>$data]);
    }

}
