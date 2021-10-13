<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proposal;
use App\Models\ProposalType;
use App\Models\User;

class PekerjaanController extends Controller
{
  public function pekerjaanBerlangsung()
  {
    $pekerjaan = DB::table('proposals')
                    ->join('proposal_types', function($join)
                    {
                        $join->on('proposals.id_jenis_usulan', '=', 'proposal_types.id_jenis_usulan')
                             ->where('proposals.status_usulan','!=',0)
                             ->where('proposals.status_pekerjaan','=',1);
                    })
                    ->join('users', function($join){
                        $join->on('users.id', '=', 'proposals.user_id');
                    })
                    ->join('schools', function($join){
                        $join->on('schools.npsn', '=', 'users.npsn');
                    })
                    ->get(['proposals.id','proposal_types.jenis_bantuan','proposal_types.satuan','users.name','proposals.kebutuhan','proposals.anggaran','proposals.persentase','proposals.status_usulan','proposals.status_pekerjaan','proposals.created_at','proposals.upload_proposal','proposals.upload_foto','schools.nama_sekolah','schools.alamat','schools.desa','schools.kecamatan','schools.kodepos','proposals.penjelasan','users.email','schools.siswaT','schools.jml_rombel','schools.siswaT','schools.jml_rk','proposals.developer']);

      return view('layouts.admin.pekerjaan', compact('pekerjaan'));
      // return view('layouts.admin.usulan');
      // ddd($pekerjaan);
  }
}
