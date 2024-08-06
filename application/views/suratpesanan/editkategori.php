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

<div class="card-body table-responsive p-0" >
<table class="table table-head-fixed text-nowrap">  
                  <thead>
                    <tr>
                      <th>NO CODE</th>
                      <th>project</th>
                      <th>project Name</th>
                      <th>Status</th>
                      <th>NILAI BOQ</th>
                      <th>Nilai Paid Project</th>
                      <th>Material</th>
                      <th>Performansi</th>
                      <th>Tanggal Cash&bank</th>
                      <th>Tanggal PAID</th>
                      <th>Mode</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $totalpaid = 0;
                    $totalBoq = 0;
                    $performansi = 0;
                    $material = 0;
                    foreach ($dataresult as $key => $value) { 
                      $totalpaid=$totalpaid + $value["nilai_project_paid"];
                      $totalBoq=$totalBoq + $value["nilai_boq"];
                      $performansi=$performansi + $value["performansi"];
                      $material=$material + $value["material"];
                    ?>
                    <tr class="odd">
                      <td><?=$value["witel"]?></td>
                      <td><?php print_r($value["project_code"])?></td>
                      <td><?php print_r($value["project_name"])?></td>
                      <td><?=$value["project_status"]?></td>
                      <td><?=rupiah($value["nilai_boq"])?></td>
                      <td><?=rupiah($value["nilai_project_paid"])?></td>
                      <td><?=rupiah($value["material"])?></td>
                      <td><?=rupiah($value["performansi"])?></td>
                      <td><?=$value["tanggal_cashbank"]?></td>
                      <td><?=$value["project_paid"]?></td>
                      
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
                    </table>
 </div>
                    <div class="row alert alert-success">
                      <div class="h5 col-4">TOTAL Performansi</div>
                      <div class="h5 col-8"> <?=rupiah($performansi)?></div>
                      <div class="h5 col-4">TOTAL Material</div>
                      <div class="h5 col-8"> <?=rupiah($material)?></div>
                      <div class="h5 col-4">TOTAL PAID PROJECT</div>
                      <div class="h5 col-8"> <?=rupiah($totalpaid)?></div>
                      <div class="row col-12 alert alert-warning">
                      <div class="h5 col-4">Total Bersih</div>
                      <div class="h5 col-8"> <?=rupiah($totalpaid - $performansi -$material)?></div>
                      </div>

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
        <span>Potongan Material </span>
        <input id="material"  class="form-control" name="material" type="text" value="" ><br />
        <span>Potongan performasi</span>
        <input class="form-control col-3" readonly name="performansi" type="text" value="5" ><small> 5% dari BOQ</small><br />
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
    
var material = document.getElementById('material');
material.addEventListener('keyup', function(e)
    {
        material.value = formatRupiah(this.value);
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