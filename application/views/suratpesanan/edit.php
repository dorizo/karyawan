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
                        <label>VENDOR CODE</label>
                      <input type="text" name="vendorID" class="form-control" placeholder="" value="<?=$dataresult->vendorID?>">
                      </div>
                      
                      <div class="form-group">
                        <label>NIK</label>
                        <input type="hidden" name="vendorCode" class="form-control" value="<?=$dataresult->vendorCode?>">
                        <input type="text" name="vendorNIK" class="form-control" value="<?=$dataresult->vendorNIK?>">
                      </div>
                      
                      <div class="form-group">
                        <label>Name</label>
                      <input type="text" name="vendorName" class="form-control" placeholder=""  value="<?=$dataresult->vendorName?>">
                      </div>
                      
                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="vendorAlamat" class="form-control" placeholder=""  value="<?=$dataresult->vendorAlamat?>">
                      </div>
                      
                      <div class="form-group">
                        <label>phone</label>
                        <input type="text" name="vendorPhone" class="form-control" placeholder=""  value="<?=$dataresult->vendorPhone?>">
                      </div>
                      
                      <div class="form-group">
                        <label>email</label>
                        <input type="text" name="vendorEmail" class="form-control" placeholder=""  value="<?=$dataresult->vendorEmail?>">
                      </div>
                      <div class="form-group">
                        <label>username</label>
                        <input type="text" name="username" class="form-control" placeholder=""  value="<?=$dataresult->username?>">
                      </div>
                      <div class="form-group">
                        <label>pasword</label>
                        <input type="password" name="password" class="form-control" placeholder=""  value="<?=$dataresult->password?>">
                      </div>
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>