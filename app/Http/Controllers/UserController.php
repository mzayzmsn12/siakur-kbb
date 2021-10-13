<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\School;
use Auth;


class UserController extends Controller
{

  function show()
  {
    $identity = DB::table('users')
             ->join('schools', function($join)
             {
                 $join->on('users.npsn', '=', 'schools.npsn')
                      ->where('users.is_admin', '=', 0);
             })->get(['users.name','users.email','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos','schools.jml_rombel','schools.siswaT','schools.jml_rk','schools.akreditasi']);

      // $data=Test::all();
      return view('layouts.admin.user', compact('identity'));
      // dd($identity);
  }

  // public function index()
  // {
  //     $users= User::get();
  //     $data=Test::all();
  //     return view('layouts.admin.user',['users'=>$data]);
  // }
}
