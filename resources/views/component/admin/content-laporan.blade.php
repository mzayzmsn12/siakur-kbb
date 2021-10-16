<div class="container-fluid py-4">
  <div class="row mt-4">
    <div class="col-12">

      @if(session('status'))
        <div class="alert alert-success" style="color:white">
            {{session('status')}}
        </div>
      @endif

      <div class="card">

  <div class="table-responsive">
    <table class="table table-flush" id="datatable-basic">

      <thead class="thead-light">
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ID</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Sekolah</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jenis Bantuan</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Kebutuhan</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Anggaran</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Developer</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No. BAST</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Laporan</th>
          <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Pengajuan</th> -->
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
          <!-- <th class="text-secondary opacity-7"></th> -->
        </tr>
      </thead>
      <tbody>

        @php $no = 1; @endphp

        @foreach($laporan_admin as $row)
        <tr>
          <td class="align-middle text-center text-sm">{{$no++}}</td>
          <td class="align-middle text-center text-sm">{{$row->nama_sekolah}}</td>
          <td class="align-middle text-center text-sm">{{$row->jenis_bantuan}}</td>
          <td class="align-middle text-center text-sm">{{$row->kebutuhan}} {{$row->satuan}}</td>
          <td class="align-middle text-center text-sm">Rp. {{number_format($row->anggaran,0, ',' , '.')}}</td>
          <td class="align-middle text-center text-sm">{{$row->developer}}</td>
          <td class="align-middle text-center text-sm">{{$row->no_bast}}</td>
          <td class="align-middle text-center text-sm">
            <a href="" data-bs-toggle="modal" data-bs-target="#modalLaporan{{$row->id}}" rel="noopener noreferrer">Lihat Dokumen</a>
            <div class="col-md-4">

              <!-- Modal -->
              <div class="modal fade" id="modalLaporan{{$row->id}}" role="dialog" aria-labelledby="exampleModalMessage2Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel2">{{$row->jenis_bantuan}}</h5>
                    </div>
                    <div class="modal-body">
                      <iframe src="{{ url('storage/'. $row->upload_laporan) }}" width="1000px" height="500px" rel="noopener noreferrer"></iframe>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td class="align-middle text-center text-sm">

            @if($row->status_usulan == 2)
              <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
              @elseif($row->status_pekerjaan == 2 && $row->status_usulan == 1 )
                <span class="badge badge-sm bg-gradient-success">Selesai</span>
            @elseif($row->status_usulan == 1)
              <button type="button" class="btn bg-gradient-dark btn-sm launch-modal" data-bs-toggle="modal" data-bs-target="#modalProposal{{$row->id}}" rel="noopener noreferrer">Mulai Pekerjaan</button>

            @endif
          </td>
        </tr>
        <div class="col-md-4 align-middle text-center">
          
        @endforeach
      </tbody>
    </table>

    <!-- Modal Update Barang-->


  </div>
</div>
</div>
</div>

</div>
</div>
