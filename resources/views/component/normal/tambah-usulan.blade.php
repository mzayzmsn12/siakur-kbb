<div class="card card-plain">
  <div class="card-header pb-0 text-left">
    <h3 class="font-weight-bolder text-info text-gradient">Formulir Pengajuan Bantuan</h3>
    <p class="mb-0">Isi data dengan memperhatikan keterangan pada formulir</p>
  </div>
  <div class="card-body">
    <form action="{{url('usulan')}}" id="form" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label for="selectJenis" class="form-control-label">Jenis Bantuan</label>
          <!-- <input class="form-control" id="choices-tags" data-color="dark" type="text" value="vuejs, angular, react, laravel" placeholder="Enter something" /> -->
          <select class="form-control" name="jenis" id="choices-button" placeholder="Pilih Jenis Bantuan" onchange="showChange()">
            @foreach($proposal_types as $row)
            <option value="{{$row['id_jenis_usulan']}}">{{$row['jenis_bantuan']}}</option>
            @endforeach
          </select>
          @error('jenis')
          <div class="invalid-feedback">
            {{ $message}}
          </div>
          @enderror
      </div>
      <div class="form-group">
          <label for="example-search-input" class="form-control-label">Kebutuhan</label>
          <div class="input-group">
            <input type="number" name="kebutuhan" class="form-control @error('kebutuhan') is-invalid @enderror" value="{{ old('kebutuhan') }}" placeholder="Masukan quantitas kebutuhan">
            <span class="input-group-text" id="jenisSatuan"></span>
            @error('anggaran')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
            <script>
              function showChange(){
                // var jenisUsulan = document.getElementById("choices-button").value;
                // document.getElementById("jenisSatuan").innerText = jenisUsulan;
                  var jenisSatuan;
                  var jenisDipilih = document.getElementById("choices-button").value;
                  if(jenisDipilih == '12' || jenisDipilih == '13'){
                      jenisSatuan = "Unit";

                  }else if(jenisDipilih == '4' || jenisDipilih == '5'){
                      jenisSatuan = "Lokal";

                  }else if(jenisDipilih == '10' || jenisDipilih == '11'){
                      jenisSatuan = "Ruangan";

                  }else if(jenisDipilih == '6'){
                      jenisSatuan = "Meter";

                  }else {
                      jenisSatuan = "M2";
                  }
                  document.getElementById("jenisSatuan").innerText = jenisSatuan;
              }

            </script>
          </div>
      </div>
      <div class="form-group">
          <label for="example-email-input" class="form-control-label">Kebutuhan Anggaran</label>
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1">Rp</span>
            <input type="number" class="form-control @error('anggaran') is-invalid @enderror" value="{{ old('anggaran') }}" placeholder="Masukan Nominal tanpa tanda . / ," name="anggaran" aria-describedby="basic-addon1">
            @error('anggaran')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
          </div>
      </div>
      <div class="form-group">
        <label for="example-search-input" class="form-control-label">Persentase Kerusakan</label>
        <div class="input-group">
          <input type="number" name="persentase" class="form-control  @error('persentase') is-invalid @enderror" value="{{ old('persentase') }}" placeholder="Masukan persentase kerusakan bangunan/peralatan">
          <span class="input-group-text">%</span>
          @error('persentase')
          <div class="invalid-feedback">
            {{ $message}}
          </div>
          @enderror
        </div>
      </div>
      <div class="form-group">
          <label for="example-url-input" class="form-control-label">File Photo</label>
          <div class="input-group">
            <input type="file" class="form-control @error('filephoto') is-invalid @enderror" id="filephoto" name="filephoto">
            @error('filephoto')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
          </div>
      </div>
      <div class="form-group">
          <label for="fileproposal" class="form-control-label">File Proposal</label>
          <div class="input-group">
            <input type="file" class="form-control @error('fileproposal') is-invalid @enderror" id="fileproposal" name="fileproposal">
            @error('fileproposal')
            <div class="invalid-feedback">
              {{ $message}}
            </div>
            @enderror
          </div>
      </div>
      <div class="form-group">
        <label for="penjelasan">Berikan Penjelasan</label>
        <div class="input-group">
          <textarea class="form-control @error('penjelasan') is-invalid @enderror" name="penjelasan" id="penjelasan" rows="3" placeholder="Jelaskan kenapa sekolah anda membutuhkan bantuan ini."></textarea>
          @error('penjelasan')
          <div class="invalid-feedback">
            {{ $message}}
          </div>
          @enderror
        </div>
      </div>

      <button type="submit" class="btn bg-gradient-dark btn-lg w-100 mt-3">Kirim Usulan</button>
  </form>
  </div>

  <!-- <script src="{{asset('jquery.min.js')}}"></script>
  <script>
    $(function(){

      $('#form').on('submit', function(e){
        e.preventDefault();
        alert('submit form');
      });
    })
  </script> -->
</div>
