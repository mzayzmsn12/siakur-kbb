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
          <!-- <td class="align-middle text-center text-sm">{{date('d F Y', strtotime($row->created_at))}}</td> -->
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
          <!-- Modal -->
          <div class="modal fade" data-keyboard="false" id="modalProposal{{$row->id}}" role="dialog" aria-labelledby="exampleModalMessage2Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel2">Pengajuan Bantuan {{$row->jenis_bantuan}}</h5>
                </div>
                <div class="modal-body">
                  <div class="card">
                    <div class="card-header d-flex pb-0 p-3">
                      <div class="nav-wrapper position-relative ms-auto w-50">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" data-bs-target="#foto{{$row->id}}" href="#foto" role="tab" aria-controls="foto" aria-selected="true">
                              Foto
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" data-bs-target="#proposal{{$row->id}}" href="#proposal" role="tab" aria-controls="proposal" aria-selected="false">
                              Proposal
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#dataSekolah{{$row->id}}" role="tab" aria-controls="dataSekolah" aria-selected="false">
                              Data Sekolah
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-body p-3 mt-2">
                      <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show position-relative active border-radius-lg" id="foto{{$row->id}}" role="tabpanel" aria-labelledby="foto">
                          <img src="{{ url('storage/'. $row->upload_foto) }}" width="1000px" height="500px" rel="noopener noreferrer"></img>

                        </div>
                        <div class="tab-pane fade position-relative border-radius-lg" id="proposal{{$row->id}}" role="tabpanel" aria-labelledby="proposal" >

                          <iframe src="{{ url('storage/'. $row->upload_proposal) }}" width="1000px" height="500px" rel="noopener noreferrer"></iframe>
                        </div>

                        <div class="tab-pane fade position-relative height-350 border-radius-lg" id="dataSekolah{{$row->id}}" role="tabpanel" aria-labelledby="dataSekolah" >
                          <div class="col-12 ">
                            <div class=>
                              <div class=>

                                  <div class="alert alert-dark" style="color:white">
                                      {{$row->penjelasan}}
                                  </div>
                                <hr class="horizontal gray-light my-4">
                                <ul class="list-group">
                                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama Sekolah :</strong> {{$row->nama_sekolah}}</li>
                                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat : </strong> {{$row->alamat}} {{$row->desa}}, Kecamatan {{$row->kecamatan}} {{$row->kodepos}}</li>
                                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email : </strong>{{$row->email}}</li>
                                  <li class="list-group-item border-0 ps-0 pb-0">
                                    <strong class="text-dark text-sm">Data Sekolah :</strong> &nbsp;
                                    <div class="container mt-4 mb-4">
                                      <div class="row">
                                        <div class="col-sm">
                                          Jumlah Siswa : <span class="badge badge-pill badge-md bg-gradient-dark">{{$row->siswaT}}</span>
                                        </div>
                                        <div class="col-sm">
                                          Jumlah Rombel : <span class="badge badge-pill badge-md bg-gradient-dark">{{$row->jml_rombel}}</span>
                                        </div>
                                        <div class="col-sm">
                                         Jumlah Ruang Kelas : <span class="badge badge-pill badge-md bg-gradient-dark">{{$row->jml_rk}}</span>
                                        </div>
                                      </div>
                                      </div>

                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn bg-gradient-info " data-bs-toggle="modal" data-bs-target="#alasan{{$row->id}}">Mulai</button>
                  <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                  <!-- Modal -->
                  <form action="{{url('admin/usulan/kerjakan/'.$row->id)}}" id="form" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="modal fade" id="alasan{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Data Developer</h5>
                        </div>
                        <div class="modal-body">
                              <input type="text" class="form-control" name="developer" id="developer" placeholder="Masukan nama developer (jika menggunakan pihak ke-3)">

                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn bg-gradient-info btn-sm">Mulai</button>
                          <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>

                  <!-- <button type="button" class="btn bg-gradient-secondary" >Tutup</button> -->
                </div>
              </div>
            </div>
          </div>

        </div>
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
