<div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <?php
                    $vendornilai = (($dataresult->nilai_project * $dataresult->sharing_vendor)/100);
                    $maintransaksi = $this->db->query('SELECT COALESCE(sum(a.transaksiJumlah),0) as nilai FROM `akunbank_transaksi` a join akunbank_pengajuan b ON a.akunbank_pengajuanCode= b.akunbank_pengajuanCode AND b.statusTransaksi="APPROVE"  where a.project_id='.$dataresult->project_id)->row();
                    // print_r();
                    $kekuranganvendor = $vendornilai - $maintransaksi->nilai;
                    ?>
                      NILAI PROJECT: <?=rupiah($dataresult->nilai_project)?> <br />
                      NILAI VENDOR: <?=rupiah($vendornilai)?> <br />
                      SISA PEMBAYARAN : <?=rupiah($kekuranganvendor)?> <br />
                      PERSENTASE VENDOR : <?php 
                      if($kekuranganvendor != $vendornilai ){
                        echo (($kekuranganvendor / $vendornilai) * 100).'%';
                      // echo (100-($vendornilai - $maintransaksi->nilai)/$maintransaksi->nilai);
                      }else{
                        echo 100;
                      }
                     
                      ?>
                      <div class="form-group">
                        <label>PERSENTASE PEMBAYARAN KE VENDOR</label>    
                        <input type="text" name="perhitungan" class="form-control" placeholder="">
                      </div>

                  </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Termin</label>
                        <input type="hidden" name="project_id"  value="<?=$project_id?>" class="form-control" placeholder="">
                        <input type="text" name="keterangan" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>Tanggal</label>
                      <input type="date" name="tanggal" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>Jumlah Pengajuan</label>
                        <input type="text" name="nilai" class="form-control number-separator" placeholder="">
                     </div>
                    
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>

<script>
  $( document ).ready(function() {
    $("input[name='perhitungan']").on("input", function(e){
      var nilai = <?=$vendornilai?>;
      var nilaitotal = ((nilai * $(this).val())/100);
        console.log(nilaitotal);
        $("input[name='nilai']").val(nilaitotal);
    });

     $('input.nilai_material').on('input',function(e){
    // alert('Changed!')
    var vv = Number($("input[name='nilai_material']").val().replace(/,/g, '')) + Number($("input[name='nilai_jasa']").val().replace(/,/g, ''));
      
      $("input[name='nilai']").val(vv);
    });
     $('input.nilai_jasa').on('input',function(e){
    // alert('Changed!')
      var vv = Number($("input[name='nilai_material']").val().replace(/,/g, '')) + Number($("input[name='nilai_jasa']").val().replace(/,/g, ''));
      
      $("input[name='nilai']").val(vv);
    });
});

</script>