<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proposal;
use App\Models\ProposalType;
use App\Models\User;
use App\Models\School;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $dashboard = DB::table('proposal_types')
               ->join('proposals', function($join)
               {
                   $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                        ->where('proposals.user_id', '=', Auth::user()->id);
               })
               ->join('users', function($join){
                   $join->on('users.id', '=', 'proposals.user_id');
               })
               ->join('schools', function($join){
                   $join->on('schools.npsn', '=', 'users.npsn');
               })
               ->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan','proposals.created_at','proposals.upload_proposal','proposals.upload_foto','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos']);

       $usulan = DB::table('proposals')
             ->select(DB::raw('count(*) as jml_usulan, user_id'))
             ->where('proposals.user_id', '=', Auth::user()->id)
             ->groupBy('user_id')
             ->get();

       $identity = DB::table('users')
                ->join('schools', function($join)
                {
                    $join->on('users.npsn', '=', 'schools.npsn')
                         ->where('users.id', '=', Auth::user()->id);
                })->get(['users.name','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos','schools.jml_rombel','schools.siswaT','schools.jml_rk','schools.akreditasi']);

     // $data=Test::all();
        // return view('layouts.normal.usulan', compact('proposals'));
        return view('layouts.normal.home', compact('dashboard','identity','usulan'));
        // dd($dashboard);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {

      $dashboard = DB::table('proposal_types')
               ->join('proposals', function($join)
               {
                   $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan');
               })
               ->join('users', function($join){
                   $join->on('users.id', '=', 'proposals.user_id');
               })
               ->join('schools', function($join){
                   $join->on('schools.npsn', '=', 'users.npsn');
               })->latest('proposals.created_at')->first();

       // Melihat jumlah pagu usulan yang diterima
       $paguDiterima = DB::table('proposals')
               ->select(DB::raw('SUM(anggaran) as paguMasuk'))
               ->where('status_usulan','=',1)
               ->get();

       // Melihat jumlah pagu usulan yang diterima
       $paguBekerja = DB::table('proposals')
               ->select(DB::raw('SUM(anggaran) as paguBekerja'))
               ->where('status_usulan','=',1)
               ->where('status_pekerjaan','=',1)
               ->get();

      // Melihat jumlah usulan yang sedang dikerjakan
       $prosesKerja = DB::table('proposals')
             ->select(DB::raw('count(*) as jml_bekerja'))
             ->where('status_usulan','=',1)
             ->where('status_pekerjaan','=',1)
             ->get();

       // Melihat jumlah usulan yang sudah selesai
        $selesaiKerja = DB::table('proposals')
              ->select(DB::raw('count(*) as kerjaSelesai'))
              ->where('status_usulan','=',1)
              ->where('status_pekerjaan','=',2)
              ->get();

      // Melihat jumlah usulan yang masuk seluruhnya
       $usulanMasuk = DB::table('proposals')
               ->select(DB::raw('count(*) as jml_usulanmasuk'))
               ->get();

       // Melihat jumlah kelas
       $kelas = DB::table('schools')
             ->select(DB::raw('SUM(jml_rk) as jml_kelas'))
             ->get();

       // Melihat jumlah rombel
       $rombel = DB::table('schools')
             ->select(DB::raw('SUM(jml_rombel) as jml_rombel'))
             ->get();
       // Melihat jumlah siswa
       $siswa = DB::table('schools')
             ->select(DB::raw('SUM(siswaT) as jml_siswa'))
             ->get();
       // Melihat jumlah sekolah
       $sekolah = DB::table('schools')
             ->select(DB::raw('count(*) as jml_sekolah'))
             ->get();

       $identity = DB::table('users')
                ->join('schools', function($join)
                {
                    $join->on('users.npsn', '=', 'schools.npsn')
                         ->where('users.id', '=', Auth::user()->id);
                })->get(['users.name','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos','schools.jml_rombel','schools.siswaT','schools.jml_rk','schools.akreditasi']);

     // $data=Test::all();
        // return view('layouts.normal.usulan', compact('proposals'));
        return view('layouts.admin.admin-home', compact('usulanMasuk','selesaiKerja','prosesKerja','paguBekerja','paguDiterima','dashboard','identity','sekolah','kelas','rombel','siswa',));
        // dd($usulanMasuk);
        // return view('layouts.admin.admin-home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

}
