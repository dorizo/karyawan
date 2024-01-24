<div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT DESIGNATOR</h3><br />
                <small><?="Project : ".$dataresult->project_code."(".$dataresult->project_name.")"?></small>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                          <label>DESIGNATOR</label>  <hr />  
                          <?php print_r($editresult->designator_code)?> <hr />
                          <?=$editresult->designator_desc?>
                      </div>
                      <div class="form-group">
                        <label>SATUAN DESIGNATOR</label>
                      <select class="form-control" name="satuan">
                        <option value="pcs" <?=$editresult->satuan=="pcs"?"selected":""?>>pcs</option>
                        <option value="core" <?=$editresult->satuan=="core"?"selected":""?>>core</option>
                        <option value="m3" <?=$editresult->satuan=="m3"?"selected":""?>>m3</option>
                        <option value="meter" <?=$editresult->satuan=="node"?"selected":""?>>node</option>
                        <option value="node" <?=$editresult->satuan=="node"?"selected":""?>>node</option>
                        <option value="set" <?=$editresult->satuan=="set"?"selected":""?>>set</option>
                        <option value="titik" <?=$editresult->satuan=="titik"?"selected":""?>>titik</option>
                        <option value="track" <?=$editresult->satuan=="track"?"selected":""?>>track</option>
                        <option value="unit" <?=$editresult->satuan=="unit"?"selected":""?>>unit</option>
                        <option value="lumpsump" <?=$editresult->satuan=="lumpsump"?"selected":""?>>lumpsump</option>
                      </select>
                      </div>
                      <div class="form-group">
                      <input type="text" name="designator_id" value="<?=$editresult->designator_id?>" readonly  class="form-control number-separator" placeholder="">
                      <input type="hidden" name="id_project_khs_v2_detail" value="<?=$editresult->id_project_khs_v2_detail?>" readonly  class="form-control number-separator" placeholder="">
                     
                        <label>NILAI MATERIAL SATUAN</label>
                      <input type="text" name="material_price" value="<?=$editresult->material_price?>" readonly  class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>NILAI JASA SATUAN</label>
                      <input type="text" name="service_price" value="<?=$editresult->service_price?>" readonly  class="form-control number-separator" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>JUMLAH DESIGNATOR JASA</label>
                      <input type="text" value="<?=$editresult->jumlah_designator?>" name="jumlah_designator" class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>JUMLAH DESIGNATOR MATERIAL</label>
                      <input type="text" value="<?=$editresult->jumlah_designator_material?>"  name="jumlah_designator_material" class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>TOTAL DESIGNATOR</label>
                      <input type="text" value="<?=$editresult->total_designator?>"  name="total_designator" readonly  class="form-control number-separator" placeholder="">
                      </div>
                      <div class="form-group">
                      <input type="submit" value="Simpan Designator"  class="form-control btn btn-success">
                      </div>
                    </div>
                </div>
            </form>
                </div>
            </div>
              
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
    templateResult: formatOption
  });
  function formatOption (option) {
    var $option = $(
      '<div><strong>' + option.text + '</strong></div><div>' + option.title + '</div>'
    );
    return $option;
  };
  $("input[name='jumlah_designator']").on( 'input' , function(a){
    var param0 = $("input[name='material_price']").val() *  parseFloat($("input[name='jumlah_designator_material']").val().replace(/,/g, ''));
    var param1 = $("input[name='service_price']").val() *  parseFloat($(this).val().replace(/,/g, ''));
    var total = param0 + param1;
    $("input[name='total_designator']").val(numberWithCommas(total)); 
    
  });
  $("input[name='jumlah_designator_material']").on( 'input' , function(a){
    var param0 = $("input[name='material_price']").val() *  parseFloat($(this).val().replace(/,/g, ''));
    var param1 = $("input[name='service_price']").val() *  parseFloat($("input[name='jumlah_designator']").val().replace(/,/g, ''));
    var total = param0 + param1;
    $("input[name='total_designator']").val(numberWithCommas(total)); 
    
  });
  
});
  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
  </script>