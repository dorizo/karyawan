

<div class="card card-primary col-12">
              <div class="card-header">
                <h3 class="card-title">FORM</h3>
                <?=$absen?>
              </div>
              <div class="card-body">
              <form method="post" action="<?=base_url("home/addabsen")?>">
                  <div class="form-group">
                    <input type="hidden" name="mappingCode" class="form-control" value="<?=$this->session->userdata("karyawanCode")?>">
                    <input type="file" name="image"  accept="image/*;capture=camera">
                    <input type="hidden" name="posisi" value="<?=$absen >= 1?"CHECK OUT":"CHECK IN";?>" />
                  </div>
                  <div class="form-group">

                  <button type="submit" class="btn btn-primary"><?=$absen >= 1?"CHECK OUT":"CHECK IN";?></button>
                  </div>
              </form>
              </div>
              <hr />
<?php if($this->session->userdata("akses") != "PM"){ ?>
  <div class="alert alert-danger">ANDA TIDAK MEMPUNYAI AKSES UNTUK INPUT PROJECT</div>
<?php }else{?>


              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Code</label>
                    <input type="hidden" name="vendorCode" class="form-control" value="<?=$this->session->userdata("karyawanCode")?>">
                    <input type="text" name="project_code" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Project Name</label>
                    <input type="text" name="project_name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Mulai</label>
                    <input type="date" name="project_start" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estimasi Selesai</label>
                    <input type="date" name="project_done" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kategori Project</label>  
                        <select name="cat_id" class="custom-select">
                        <?php
                            foreach ($kategori as $key => $value) {
                                echo "<option value=\"".$value['cat_id']."\">".$value["cat_name"]."</option>";
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
                                  $noted = $value['witel_id'] == $dataresult->witel_id ? ' selected="selected"' : '';
                                  echo "<option value=\"".$value['witel_id']."\" ".$noted.">".$value['witel_name']."</option>";
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