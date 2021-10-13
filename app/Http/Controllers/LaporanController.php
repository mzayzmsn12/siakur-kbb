<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function laporan()
    {
      $laporan = DB::table('proposals')
               ->join('proposal_types', function($join)
               {
                   $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                        ->where('proposals.user_id', '=', Auth::user()->id)
                        ->where('proposals.status_usulan','=',1)
                        ->where('proposals.status_pekerjaan','=',1);
                        })
                        ->join('users', function($join){
                            $join->on('users.id', '=', 'proposals.user_id');
                        })
                        ->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan','proposals.created_at','proposals.upload_proposal','proposals.upload_foto','proposals.keterangan','proposals.status_pekerjaan','proposals.developer']);

        return view('layouts.normal.laporan', compact('laporan'));
        // dd($laporan);
    }

    public function kirimLaporan(Request $request, $id)
    {
      if($request->isMethod('post')){

        $usulanbantuan = DB::table('proposals')
                        ->where('id', $id)
                        ->where('proposals.user_id', '=', Auth::user()->id)
                        ->update([
                          'status_pekerjaan' => 2,
                          'no_bast' => $request->input('no_bast')
                        ]);

          // return view('layouts.admin.usulan', compact('usulanbantuan'));
          return redirect('laporan')->with('status', 'Pekerjaan sudah selesai. Terimakasih!');
          // ddd($usulanbantuan);
      }
    }

    public function laporanAdmin()
    {
      $laporan_admin = DB::table('proposals')
                      ->join('proposal_types', function($join)
                      {
                          $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                               ->where('proposals.status_usulan','!=',0)
                               ->where('proposals.status_pekerjaan','=',2);
                      })
                      ->join('users', function($join){
                          $join->on('users.id', '=', 'proposals.user_id');
                      })
                      ->join('schools', function($join){
                          $join->on('schools.npsn', '=', 'users.npsn');
                      })
                      ->get();

        return view('layouts.admin.laporan', compact('laporan_admin'));
        // return view('layouts.admin.usulan');
        // dd($laporan_admin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
