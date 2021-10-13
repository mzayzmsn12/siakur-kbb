

<div class="container-fluid py-4">
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
  <div class="card-header">
    <h5 class="mb-0">Data User</h5>
  </div>
  <div class="table-responsive">
    <table class="table table-flush" id="datatable-basic">
      <thead class="thead-light">
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">ID</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Sekolah</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Nama</th>
          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
          <th class="text-secondary opacity-7"></th>
        </tr>
      </thead>
      <tbody>
        @php $no = 1; @endphp

        @foreach($identity as $row)
        <tr>
        <td class="align-middle text-center text-sm">{{$no++}}</td>
        <td class="align-middle text-center text-sm">{{$row->nama_sekolah}}</td>
        <td class="align-middle text-center text-sm">{{$row->name}}</td>
        <td class="align-middle text-center text-sm">{{$row->email}}</td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
</div>

</div>
