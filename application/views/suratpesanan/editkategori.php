<div class="col-12">
<div class="card card-warning">
<div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post">
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <input type="hidden" name="suratpesananCode" value="<?=$suratpesananCode?>" />
                     
                        <div class="form-group">
                          <label>Status Project</label>
                          <select name="project_status" class="custom-select">
                            <?php
                            foreach ($datajob as $key => $value) {
                              if($value["job_name"] !="PAID"){
                            ?>
                              <option value="<?=$value["job_name"]?>"><?=$value["job_name"]?></option>
                              <?php
                              };
                             
                          }
                              ?>
                          </select>
                          
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                   
                </form>
              </div>
            </div>

</div>
<div style="overflow-x:auto;">
<table id="example" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>NO CODE</th>
                      <th>Witel</th>
                      <th>NAMA SURAT PESANAN</th>
                      <th>NILAI SURAT PESANAN</th>
                      <th>Nilai Paid Project</th>
                      <th>STATUS PROJECT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $totalpaid = 0;
                    $totalBoq = 0;
                    foreach ($dataresult as $key => $value) { 
                      $totalpaid=$totalpaid + $value["nilai_project_paid"];
                      $totalBoq=$totalBoq + $value["nilai_project"];
                    ?>
                    <tr class="odd">
                      <td><?=$value["witel"]?></td>
                      <td><?php print_r($value["project_code"])?></td>
                      <td><?=$value["project_status"]?></td>
                      <td><?=rupiah($value["nilai_project"])?></td>
                      <td><?=rupiah($value["nilai_project_paid"])?></td>
                      
                      <td>
                        <?=$value["project_status"]?>
                        <?php if ($value["project_status"]=="Cash_Bank") {
                          echo "<button onclick='rubah(\"".$value["project_id"]."\",\"".$value["nilai_project_paid"]."\")'><i class='fa fa-edit'></i>Set Real Project</button>";
                        }
                        ?>
                      </td>
                    </td>

                    <?php } ?>

                    </body>
                    </table></div>
                    <div class="row alert alert-success">
                      <div class="h5 col-4">TOTAL PAID PROJECT</div>
                      <div class="h5 col-8"> <?=rupiah($totalpaid)?></div>
                      <div class="h5 col-4">TOTAL BOQ PROJECT</div>
                      <div class="h5 col-8"><?=rupiah($totalBoq)?></div>
                    </div>
                   
                    
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?=base_url("suratpesanan/submitnilaiproject")?>">
        <input id="project_id" class="form-control" name="project_id" type="text" value="" readonly>
        <span>Input nilai real project</span>
        <input id="nilai_project_paid"  class="form-control" name="nilai_project_paid" type="text" value="" ><br />
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


<script>
function rubah(kodep , nilai){
  $('#exampleModal').modal();
  $("#project_id").val(kodep);
  $("#nilai_project_paid").val(nilai);
  console.log(kodep,nilai)
}
var tanpa_rupiah = document.getElementById('nilai_project_paid');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
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