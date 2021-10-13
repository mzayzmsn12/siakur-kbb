<div class="container-fluid py-4">
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
  <div class="card-header">
    <h5 class="mb-0">Datatable Simple</h5>
    <p class="text-sm mb-0">
      A lightweight, extendable, dependency-free javascript HTML table plugin.
    </p>
  </div>
  <div class="table-responsive">
    <table class="table table-flush" id="datatable-basic">
      <thead class="thead-light">
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">NPSN</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Status</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Desa</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kecamatan</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Pos</th>
          <!-- <th class="text-secondary opacity-7"></th> -->
        </tr>
      </thead>
      <tbody>
        @foreach($schools as $row)
        <tr>
        <td class="align-middle text-center text-sm">{{$row['npsn']}}</td>
        <td class="align-middle text-center text-sm">{{$row['nama_sekolah']}}</td>
        <td class="align-middle text-center text-sm">{{$row['status']}}</td>
        <td class="align-middle text-center text-sm">{{$row['alamat']}}</td>
        <td class="align-middle text-center text-sm">{{$row['desa']}}</td>
        <td class="align-middle text-center text-sm">{{$row['kecamatan']}}</td>
        <td class="align-middle text-center text-sm">{{$row['kodepos']}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>

</div>
