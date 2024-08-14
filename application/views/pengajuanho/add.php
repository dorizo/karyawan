<div class="col-lg-12">
        <div class="card card-primary">
            <form method="post"  enctype="multipart/form-data">
            <div class="card-header">
              <h3 class="card-title">General</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              
          <?php print_r($error);?>
              <div class="form-group">
                <label for="inputName">Tanggal</label>
                <input type="date" name="tanggal" id="inputName" class="form-control">
              </div>
             
              <div class="form-group">
                <label for="inputName">Kategori</label>
                <select name="kategori" class="form-control select2">
                            <option value="">Pilih</option>
                            <option value="Oprasional">Oprasional</option>
                            <option value="Capex">Capex</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="inputName">Witel</label>
                <select name="witel_id" class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($witel as $key => $value) {
                              echo "<option value='".$value["witelhoID"]."'>".$value["witelhoName"]."</option>";
                              }
                            ?>
                </select>
              </div>
              
              <div class="form-group">
                <label for="inputName">STO</label>
                <select  name="stoCode" class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($sto as $key => $value) {
                              echo "<option value='".$value["stoCode"]."'>".$value["stoName"]."</option>";
                              }
                            ?>
                </select>
              </div>
              <div class="form-group">
                <label for="inputName">Pekerjaan</label>
                <select  name="pekerjaanCode" class="form-control select2">
                            <option value="">Pilih</option>
                            <?php
                              foreach ($Pekerjaan as $key => $value) {
                              echo "<option value='".$value["pekerjaanCode"]."'>".$value["pekerjaanName"]."</option>";
                              }
                            ?>
                </select>
              </div>
              
             
              <div class="form-group">
                <label for="inputName">Keterangan</label>
                <input type="text" name="keterangan" id="inputName" class="form-control">
              </div>
            
            
            <div class="form-group">
                <label for="inputName">kredit</label>
                <input type="tel" name="kredit" id="kredit" value="0" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="inputName">Dikirim Oleh</label>
                <input type="text" name="diterimaoleh" id="inputName" class="form-control" readonly value="<?=$this->session->userdata("karyawanNama")?>" >
              </div>
              <div class="form-group">
                <label for="inputName">bukti</label>
                <input type="file" name="bukti" id="bukti" class="form-control">
              </div>
             
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("pengajuanho")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
      
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  });
    var tanpa_rupiah2 = document.getElementById('kredit');
    tanpa_rupiah2.addEventListener('keyup', function(e)
    {
        tanpa_rupiah2.value = formatRupiah(this.value);
    });
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
  </script>