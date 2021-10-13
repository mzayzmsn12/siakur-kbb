<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jenis_usulan',
        'kebutuhan',
        'upload_foto',
        'upload_proposal',
        'persentase',
        'status_usulan',
        'status_pekerjaan',
        'upload_foto',
        'penjelasan'
    ];

    protected $hidden = [
        'status_usulan',
        'status_pekerjaan',
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }

    // public function getStatus(){
    //   $proposal_status = [];
    //   $proposal_status[] = $this->status_usulan == 2 ? 'Ditolak' : null;
    //   $proposal_status[] = $this->status_usulan == 1 ? 'Diterima' : null;
    //   $proposal_status[] = $this->status_usulan == 0 ? 'Dalam Antrian' : null;
    //   $proposal_status = array_filter($proposal_status);
    //
    //   return implode(',', $proposal_status);
    // }
}
