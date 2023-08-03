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
                        <label>transaksiNote</label>
                        <input type="text" name="transaksiNote" class="form-control" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>transaksiDate</label>
                      <input type="date" name="transaksiDate" class="form-control" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>transaksiJumlah</label>
                      <input type="text" name="transaksiJumlah" class="form-control number-separator" placeholder="">
                      </div>
                      
                      <div class="form-group">
                        <label>akunBankCode</label>    
                        <select name="akunBankCode" class="custom-select">
                        <?php
                            foreach ($akunbank as $key => $value) {
                                echo "<option value=\"".$value['akunbankCode']."\">".$value["akunbankCode"]."(".$value['saldo_sekarang'].")</option>";
                            }
                            ?>
                    
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label>statusTransaksi</label>
                        
                        <select name="statusTransaksi" class="custom-select">
                          <option value="DB">DEBIT</option>
                          <option value="CR">CREDIT</option>
                        </select>
                      </div>
                      
                        <input type="hidden" name="project_id" class="form-control" value="<?=$project_id?>">
                    
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>