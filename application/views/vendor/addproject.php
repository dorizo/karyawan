

<div class="card card-primary col-12">
                <?php if($absen < 2){?>
              <div class="card-header">
                <h3 class="card-title">FORM ABSENSI</h3>
              </div>
              <div class="card-body">
              <form method="POST" enctype="multipart/form-data" action="<?=base_url("home/addabsen")?>">
                  <div class="form-group">
                    <input type="hidden" name="mappingCode" class="form-control" value="<?=$this->session->userdata("karyawanCode")?>">
                    <input type="file" name="image"  accept="image/*;capture=camera">
                    <input type="hidden" name="posisi" value="<?=$absen >= 1?"CHECK OUT":"CHECK IN";?>" />
                  </div>
                  <div class="form-group">

                  <button type="submit"  id="btnFetch"  class="btn btn-primary"  onclick="javascript=this.disabled = true; form.submit();"><?=$absen >= 1?"CHECK OUT":"CHECK IN";?></button>
                  </div>
              </form>
              </div>
              <?php }else{
                echo "<h1>HARI INI ANDA SUDAH ABSENSI</h1>";
              } ?>
              <hr />
<?php if($this->session->userdata("akses") != "PM"){ ?>
  <div class="alert alert-danger">ANDA TIDAK MEMPUNYAI AKSES UNTUK INPUT PROJECT</div>
<?php }else{?>


              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
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
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Name</label>
                    <input type="text" name="project_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <input style="display:none" type="date" name="project_start" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Selesai</label>
                    <input type="date" name="project_done" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kategori </label>  
                        <select id="parentcatCode" class="custom-select">
                          <option>Pilih </option>
                        <?php
                            foreach ($parentkat as $key => $value) {
                                echo "<option value=\"".$value['parentcatCode']."\">".$value["parentcatName"]."</option>";
                            }
                            ?>
                    
                        </select>
                 </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Kategori Project</label>  
                        <select name="cat_id" class="custom-select">
                        <?php
                            foreach ($kategori as $key => $value) {
                                // echo "<option value=\"".$value['cat_id']."\">".$value["cat_name"]."</option>";
                            }
                            ?>
                    
                        </select>
                 </div>

                 <div class="form-group">
                          <label>witel</label>
                          <select name="witel_id" class="custom-select">
                              <option value="Pilih Vendor">Pilih witel</option>
                              <?php
                              foreach ($witelresult as $key => $value) {
                                  # code...
                                  echo "<option value=\"".$value['witel_id']."\" >".$value['witel_name']."</option>";
                              }
                              ?>
                      
                          </select>
                          
                        </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Mulai</label>
                    <input type="date" name="project_date" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Catatan</label>
                    <input type="text" name="project_note" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
<?php } ?>
            </div>

            

<script>

$(document).ready(function() {

  $("select[id='parentcatCode']").on("change" , function(){
  $.getJSON( "<?=base_url("home/datakategori")."/"?>"+$(this).val(), function( data ) {
 var html = "";
  data.forEach(element => {
    console.log(element);
    html += "<option value='"+element.cat_id+"'>"+element.cat_name+"</option>";
  });
  $("select[name='cat_id']").html(html);
  });

  });
$("input[name='project_date']").on("change" , function(){
  $("input[name='project_start']").val($(this).val());
})
$("#btnFetch").click(function() {
  $(this).html(
    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
  );
  
});
});
</script>