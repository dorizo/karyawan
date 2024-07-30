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
                        <label>NO SURAT PESANAN</label>
                      <input type="text" name="NoSuratpesanan" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>Nama SURAT PESANAN</label>
                      <input type="text" name="NamaSuratpesanan" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>NILAI SURAT PESANAN</label>
                        <input type="text" name="nilaiSuratpesanan" class="form-control number-separator">
                      </div>
                      
                      <div class="form-group">
                        <label>TANGGAL SURAT PESANAN</label>
                        <input type="date" name="tanggalsp" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Witel Model</label>    
                        <select name="witel_id" class="custom-select">
                        <?php
                            foreach ($witel as $key => $value) {
                                echo "<option value=\"".$value['witel_id']."\">".$value["witel_name"]."(".$value['region_id'].")</option>";
                            }
                            ?>
                    
                        </select>
                      </div>
                      
                      <!-- <div class="form-group">
                        <label>Name</label>
                      <input type="text" name="vendorName" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="vendorAlamat" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>phone</label>
                        <input type="text" name="vendorPhone" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>email</label>
                        <input type="text" name="vendorEmail" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>username</label>
                        <input type="text" name="username" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>pasword</label>
                        <input type="password" name="password" class="form-control" placeholder="">
                      </div> -->
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>