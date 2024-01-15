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
                        <label>Masukan Nilai Kontrak Project</label>
                        <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" class="form-control" placeholder="Enter ...">
                        <input type="text" name="nilai_project" value="<?=$dataresult->nilai_project?>" class="form-control" placeholder="Enter ...">
                        <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Status Project</label>
                        <select name="project_status" class="custom-select">
                            <option value="<?=$dataresult->project_status?>"><?=$dataresult->project_status?></option>
                            <?php
                            foreach ($datajob as $key => $value) {
                                # code...
                                echo "<option value=\"".$value['job_name']."\">".$value['job_name']."</option>";
                            }
                            ?>
                    
                        </select>
                        
                      </div>
                    </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>

</div>