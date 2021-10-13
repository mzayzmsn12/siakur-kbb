<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proposal;
use App\Models\ProposalType;
use App\Models\User;
use Auth;
use Alert;

class UsulanController extends Controller
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
    public function usulan()
    {


        // $user_id = Auth::user()->id;
        // $data=ProposalType::join('proposals','proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')->join('users','users.id', '=', 'proposals.user_id')->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan']);
        //
        //
        //  $proposals = DB::table('proposals','proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')->join('proposals','proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')->where('user_id','=',$user_id)->orderBy('id','desc')->get();

         $proposals = DB::table('proposals')
                  ->join('proposal_types', function($join)
                  {
                      $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                           ->where('proposals.user_id', '=', Auth::user()->id);
                  })
                  ->join('users', function($join){
                      $join->on('users.id', '=', 'proposals.user_id');
                  })
                  ->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan','proposals.created_at','proposals.upload_proposal','proposals.upload_foto','proposals.keterangan','proposals.status_pekerjaan']);

        // $data=Test::all();
          return view('layouts.normal.usulan', compact('proposals'));
          // dd($proposals);

    }



    public function formUsulan(Request $request){


      $proposal_types= ProposalType::all();
      return view('layouts.normal.tambahusulan', compact('proposal_types'));


      // $validator = \Validator::make($request->all(),[
      //   'jenis' => ['required'],
      //   'kebutuhan' => ['required'],
      //   'anggaran' => ['required'],
      //   'upload_foto' => ['required'],
      //   'upload_proposal' => ['required'],
      //   'persentase' => ['required'],
      // ],[
      //   'jenis.required'=>'Jenis Usulan Harap Diisi',
      //   'kebutuhan.required'=>'Harap Diisi Kuantitasnya',
      //   'anggaran.required'=>'Harap Diisi Kebutuhan Anggarannya',
      //   'upload_foto.image'=>'Upload Hanya file Foto',
      //   'jenis.required.document'=>'Hanya diisi pdf',
      //   'persentase.number'=>'Jenis Usulan Harap Diisi',
      // ]);

      // if ($validator->passes())
      //   {
      //       return response()->json(['code'=>0, 'error'=>$validator->errors()->toArray()]);
      //   }else {
      //     $path = 'files/';
      //     $file = $request->file('proposal');
      //     $file_name = $file->getClientOriginalName();
      //     $file_size = $file->getSize();
      //
      //     $upload = $file->storeAs($path, $file_name, $file_size);
      //
      //     if ($upload) {
      //       return response()->json(['code'=>1,'msg'=>'Usulan Dikirimkan']);
      //     }
      //   }
      }

      // Mendapatkan Nama File

      // // Mendapatkan Extension File
      // $extension = $file->getClientOriginalExtension();
      // // Mendapatkan Ukuran File
      //
      // // Proses Upload File
      // $destinationPath = 'uploads';
      // $file->move($destinationPath,$file->getClientOriginalName());


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function formUsulanProcess(Request $request){

        $request->validate([
            'jenis' => 'required',
            'kebutuhan' => 'required|integer|min:1',
            'fileproposal' => 'required|file|mimes:pdf|max:2048',
            'filephoto' => 'required|file|mimes:jpg,jpeg,png|max:1024',
            'anggaran' => 'required|integer|min:1',
            'persentase' => 'required|integer|max:100',
            'penjelasan' => 'required|max:300'

            ]);

        //name&directory setting for photo
        $fileNamePhoto = time().'_'.$request->filephoto->getClientOriginalName();
        $filePathPhoto = $request->file('filephoto')->storeAs(Auth::user()->id.'/img/', $fileNamePhoto, 'public');

        //name&directory setting for proposal
        $fileName = time().'_'.$request->fileproposal->getClientOriginalName();
        $filePathProposal = $request->file('fileproposal')->storeAs(Auth::user()->id.'/document/', $fileName, 'public');

        //initiating
       $proposal = new Proposal;

       $proposal->user_id = Auth::user()->id;
       $proposal->id_jenis_usulan = $request->jenis;
       $proposal->kebutuhan = $request->kebutuhan;
       $proposal->anggaran = $request->anggaran;
       $proposal->upload_foto = $filePathPhoto;
       $proposal->upload_proposal = $filePathProposal;
       $proposal->persentase = $request->persentase;
       $proposal->penjelasan = $request->penjelasan;


       // $nf->move(public_path().'/img', $fileName);
       $proposal->save();

       // ddd($request);
       return redirect('usulan')->with('status', 'Usulan berhasil dikirim !');
     }

    public function adminUsulan()
    {
      $usulanbantuan = DB::table('proposals')
                      ->join('proposal_types', function($join)
                      {
                          $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                               ->where('proposals.status_usulan','=',0);
                      })
                      ->join('users', function($join){
                          $join->on('users.id', '=', 'proposals.user_id');
                      })
                      ->join('schools', function($join){
                          $join->on('schools.npsn', '=', 'users.npsn');
                      })
                      ->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan','proposals.created_at','proposals.upload_proposal','proposals.upload_foto','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos','proposals.penjelasan','users.email','schools.siswaT','schools.jml_rombel','schools.siswaT','schools.jml_rk']);

        return view('layouts.admin.usulan', compact('usulanbantuan'));
        // return view('layouts.admin.usulan');
    }

    public function prosesUsulan(Request $request, $id)
    {
      if($request->isMethod('post')){

        $usulanbantuan = DB::table('proposals')
                        ->where('id', $id)
                        ->update(['status_usulan' => 1]);

          // return view('layouts.admin.usulan', compact('usulanbantuan'));
          return redirect('admin/usulan')->with('status', 'Usulan berhasil diterima !');
          // ddd($usulanbantuan);
      }
    }

    public function kerjakanUsulan(Request $request, $id)
    {
      if($request->isMethod('post')){

        $usulanbantuan = DB::table('proposals')
                        ->where('id', $id)
                        ->where('proposals.status_usulan','=',1)
                        ->update([
                          'status_pekerjaan' => 1,
                          'developer' => $request->input('developer')
                        ]);

          // return view('layouts.admin.usulan', compact('usulanbantuan'));
          return redirect('admin/status')->with('status', 'Pekerjaan Berhasil Dimulai. Tetap Perhatikan Protokol Kesehatan dan Keselamatan di tempat kerja!');
          // ddd($usulanbantuan);
      }
    }

    public function tolakUsulan(Request $request, $id)
    {
      if($request->isMethod('post')){

        $usulanbantuan = DB::table('proposals')
                        ->where('id', $id)
                        ->update([
                          'status_usulan' => 2,
                          'keterangan' => $request->input('alasan')
                        ]);

          // return view('layouts.admin.usulan', compact('usulanbantuan'));
          return redirect('admin/usulan')->with('status', 'Usulan sudah ditolak !');
          // ddd($usulanbantuan);
      }
    }

    public function statusUsulan()
    {
      $usulanbantuan = DB::table('proposals')
                      ->join('proposal_types', function($join)
                      {
                          $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                               ->where('proposals.status_usulan','!=',0);
                      })
                      ->join('users', function($join){
                          $join->on('users.id', '=', 'proposals.user_id');
                      })
                      ->join('schools', function($join){
                          $join->on('schools.npsn', '=', 'users.npsn');
                      })
                      ->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan','proposals.status_pekerjaan','proposals.created_at','proposals.upload_proposal','proposals.upload_foto','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos','proposals.penjelasan','users.email','schools.siswaT','schools.jml_rombel','schools.siswaT','schools.jml_rk']);

        return view('layouts.admin.status', compact('usulanbantuan'));
        // return view('layouts.admin.usulan');
        // ddd($usulanbantuan);
    }
}
