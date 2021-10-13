<div class="container-fluid py-4">
  <div class="row mt-4">
    <div class="col-12">

      @if(session('status'))
        <div class="alert alert-primary" style="color:white">
            {{session('status')}}
        </div>
      @endif

      <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Data Usulan Bantuan</h5>
        <p class="text-sm mb-2">
          Berisikan data usulan yang dikirimkan oleh sekolah, baik diterima atau pun tidak.

</button>
        </p>
        <div class="col-md-12">
          <a type="button" href="{{ url('usulan/upload') }}" style="float:right" class="btn btn-icon btn-3 btn-primary">
          	<span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
            <span class="btn-inner--text">Tambah Usulan</span>
          </a>

        </div>
      </div>

  <div class="table-responsive">
    <table class="table table-flush" id="datatable-basic">

      <thead class="thead-light">
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ID</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Jenis Bantuan</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Kebutuhan</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Anggaran</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File Foto</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File Proposal</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Persentase</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Pengajuan</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>

          <!-- <th class="text-secondary opacity-7"></th> -->
        </tr>
      </thead>
      <tbody>

        @php $no = 1; @endphp

        @foreach($proposals as $row)
        <tr>
        <td class="align-middle text-center text-sm">{{$no++}}</td>
        <td class="align-middle text-center text-sm">{{$row->jenis_bantuan}}</td>
        <td class="align-middle text-center text-sm">{{$row->kebutuhan}} {{$row->satuan}}</td>
        <td class="align-middle text-center text-sm">Rp. {{number_format($row->anggaran,0, ',' , '.')}}</td>
        <td class="align-middle text-center text-sm">

          <a href="" data-bs-toggle="modal" data-bs-target="#modalFoto{{$row->id}}" rel="noopener noreferrer">Lihat Foto</a>
          <div class="col-md-4">

            <!-- Modal -->
            <div class="modal fade" id="modalFoto{{$row->id}}" role="dialog" aria-labelledby="exampleModalMessage2Title" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">{{$row->jenis_bantuan}}</h5>
                  </div>
                  <div class="modal-body">
                    <iframe src="{{ url('storage/'. $row->upload_foto) }}" width="1000px" height="500px" rel="noopener noreferrer"></iframe>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

        </td>
        <!-- {{ asset('storage/'. $row->upload_foto) }} -->
        <td class="align-middle text-center text-sm">
          <!-- <a href="{{ asset('storage/'. $row->upload_proposal) }}" target="_blank" rel="noopener noreferrer">Lihat Dokumen</a> -->

          <a href="" data-bs-toggle="modal" data-bs-target="#modalProposal{{$row->id}}" rel="noopener noreferrer">Lihat Dokumen</a>
          <div class="col-md-4">

            <!-- Modal -->
            <div class="modal fade" id="modalProposal{{$row->id}}" role="dialog" aria-labelledby="exampleModalMessage2Title" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">{{$row->jenis_bantuan}}</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="false">×</span>
                    </button> -->
                  </div>
                  <div class="modal-body">
                    <iframe src="{{ url('storage/'. $row->upload_proposal) }}" width="1000px" height="500px" rel="noopener noreferrer"></iframe>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </td>

        <td class="align-middle text-center text-sm">{{$row->persentase}} %</td>
        <td class="align-middle text-center text-sm">{{date('d F Y', strtotime($row->created_at))}}</td>
        <td class="align-middle text-center text-sm">
          @if($row->status_usulan == 0)
            <span class="badge badge-sm bg-gradient-dark">Dalam Antrian</button>
          @elseif($row->status_pekerjaan == 1 && $row->status_usulan == 1 )
            <span class="badge badge-sm bg-gradient-info">Berlangsung</span>
          @elseif($row->status_usulan == 2)
            <button type="button" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="right" title="{{$row->keterangan}}">Ditolak</span>

          @elseif($row->status_usulan == 1)
            <span class="badge badge-sm bg-gradient-success">Diterima</span>
          @endif
        </td>
        <td>
          <!-- <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="Tooltip on left"> -->
        </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Modal Update Barang-->


  </div>
</div>
</div>
</div>

</div>
