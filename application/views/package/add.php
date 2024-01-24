<div class="col-12">
<div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">FORM INPUT DESIGNATOR</h3><br />
                <small><?="Project : ".$dataresult->project_code."(".$dataresult->project_name.")"?> <?=$paket->package_name?></small>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                          <label>DESIGNATOR</label>    
                          <select name="designator_id" class="form-control select2">
                            <option>Pilih Designator</option>
                          <?php
                              foreach ($designator as $key => $value) { ?>
                                      <option value="<?=$value["designator_id"]?>" title="<?=$value["designator_desc"]?>"><?=$value["designator_code"]?></option>
                              <?php

                              }
                              ?>
                      
                          </select>
                      </div>
                      <div class="form-group">
                        <label>SATUAN DESIGNATOR</label>
                      <input type="hidden" name="project_id"   value="<?=$dataresult->project_id?>" >
                      <select class="form-control" name="satuan">
                        <option value="pcs">pcs</option>
                        <option value="core">core</option>
                        <option value="m3">m3</option>
                        <option value="meter">meter</option>
                        <option value="node">node</option>
                        <option value="set">set</option>
                        <option value="titik">titik</option>
                        <option value="track">track</option>
                        <option value="unit">unit</option>
                        <option value="lumpsump">lumpsump</option>
                      </select>
                      </div>
                      <div class="form-group">
                        <label>NILAI MATERIAL SATUAN</label>
                      <input type="text" name="material_price" readonly  class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>NILAI JASA SATUAN</label>
                      <input type="text" name="service_price" readonly  class="form-control number-separator" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>JUMLAH DESIGNATOR JASA</label>
                      <input type="text" value=0 name="jumlah_designator" class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>JUMLAH DESIGNATOR MATERIAL</label>
                      <input type="text" value=0 name="jumlah_designator_material" class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>TOTAL DESIGNATOR</label>
                      <input type="text" name="total_designator" readonly  class="form-control number-separator" placeholder="">
                      </div>
                      <div class="form-group">
                      <input type="submit" value="Simpan Designator"  class="form-control btn btn-success">
                      </div>
                    </div>
                </div>
            </form>
            <hr/>
            List DESIGNATOR 
            <hr />
            <?php
            foreach ($designatorlist as $key => $value) { ?>
            <div class="card">
               <div class="card-body">
                <h5 class="card-title"><?=$value["designator_code"]?></h5>
                <p class="card-text"><?=$value["designator_desc"]?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"> <b>JUMLAH DESIGNATOR JASA = </b> <?=$value["jumlah_designator"]?></li>
                <li class="list-group-item"> <b>JUMLAH DESIGNATOR MATERIAL = </b> <?=$value["jumlah_designator_material"]?></li>
                <li class="list-group-item"> <b>SERVICE TOTAL = </b> <?=rupiah(($value["service_price"]*$value["jumlah_designator"]))?></li>
                <li class="list-group-item"> <b>MATERIAL TOTAL =  </b><?=rupiah(($value["material_price"] *$value["jumlah_designator_material"] ))?></li>
                <li class="list-group-item"> <b>JUMLAH TOTAL  </b><?=rupiah($value["total_designator"])?></li>
              </ul>
              <div class="card-body">
                <!-- <a href="#" class="card-link">Edit</a> -->
                <a href="<?=base_url("designator/hapus/").$value["id_project_khs_v2_detail"]."/".$value["project_id"]?>" class="card-link">Hapus</a>
              </div>
            </div>
             <?php
            }
            ?>
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

  $("select[name='designator_id']").on( 'change' , function(a){
    console.log($(this).val());
    $.post("<?=base_url("designator/getnilaipaket")?>",
      {
        designator_id: $(this).val(),
        package_id: <?=$paket->package_id?>
      },
      function(data, status){
        // console.log(data);
        const obj = JSON.parse(data);
        if(obj){
          $("input[name='material_price']").val(obj.material_price);
          $("input[name='service_price']").val(obj.service_price);
      
        }else{
          
          $("input[name='material_price']").val(0);
          $("input[name='service_price']").val(0);
          Swal.fire({
            title: 'PEMBERITAHUAN',
            text: "DATA NILAI PAKET BELUM DI INPUT MOHON HUBUNGI ADMIN DAN SEBUTKAN CODE DESIGNATOR DAN PAKET BERAPA",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        })
        };
      });
  })
  });
  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
  </script>