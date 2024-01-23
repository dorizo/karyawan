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
                      <div class="form-group">
                        <label>Masukan Nilai Kontrak BOQ</label>
                        <input type="text" name="nilai_boq" value="<?=$dataresult->nilai_boq?>" class="boq form-control number-separator" placeholder="Enter ...">
                        <label>Masukan Nilai SIUJK</label>
                        <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" class="form-control" placeholder="Enter ...">
                        <input type="text" name="nilai_project" value="<?=$dataresult->nilai_project?>" class="form-control number-separator" placeholder="Enter ...">
                        <label>Sharing Vendor (%)</label>
                        <input type="number" name="sharing_vendor" value="<?=$dataresult->sharing_vendor?>" class="form-control number-separator" placeholder="Enter ...">
                        <label>Sharing Owner (%)</label>
                        <input type="number" name="sharing_owner" value="<?=$dataresult->sharing_owner?>" class="form-control number-separator" placeholder="Enter ...">
                       
                        <div class="form-group">
                          <label>Vendor</label>
                          <select name="vendorCode" class="custom-select">
                              <option value="Pilih Vendor">Pilih Vendor</option>
                              <?php
                              foreach ($vendorresult as $key => $value) {
                                  # code...
                                  $noted = $value['vendorCode'] == $dataresult->vendorCode ? ' selected="selected"' : '';
                                  echo "<option value=\"".$value['vendorCode']."\" ".$noted.">".$value['vendorName']."</option>";
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

<script>
  $( document ).ready(function() {
     $('input.boq').on('input',function(e){
    // alert('Changed!')
      $("input[name='nilai_project']").val();
      var persentage = ($(this).val().replace(/,/g, '')*2)/100;
      $("input[name='nilai_project']").val($(this).val().replace(/,/g, '') - persentage);
    });
});

</script>