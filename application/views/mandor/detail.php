<!-- <div class="col-lg-12">
        <div class="card card-primary">
            <form method="post">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">role</label>
                <input type="hidden" name="roleCode" value="<?=$dataresult->roleCode?>" id="inputName" class="form-control">
                <input type="text" name="role" value="<?=$dataresult->role?>" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select name="status" id="inputStatus" class="form-control custom-select">
                  <option selected disabled>Select one</option>
                
                  <option value="Private" <?=$dataresult->status=="Private"?"selected":""?>>Private</option>
                  <option  value="Public" <?=$dataresult->status=="Public"?"selected":""?>>Public</option>
                </select>
              </div>
              
             
            </div>
           
            <div class="card-footer">
            <a href="<?=base_url("master/user")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Edit" class="btn btn-success float-right">
            </div>
            </form>
       </div> -->
          <!-- /.card -->
<div class="col-lg-12">
        <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title">Role</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <form action="<?php echo base_url() ?>mandor/add_detail" method="post" role="form" enctype="multipart/form-data">
              
                <div class="form-group">
                  <label>PROJECT CODE <?= $user->project_code ?></label>
                  <input type="hidden" name="project_id" value="<?= $user->project_id ?>">
                  <select class="permission select2bs4" multiple="multiple" data-placeholder="Select a role" name="karyawanCode" style="width: 100%;" required="required">
                    <?php
                    if(!empty($permission)){
                      foreach($permission as $value){
                        echo "<option value='$value->karyawanCode' select>$value->karyawanNama</option>";
                      }}
                      ?>
                  </select>
                  <button type="submit" class="btn btn-primary mt-1">
                    <i class="fas fa-plus"></i> Add data 
                  </button>
                </div>


            </form>
            

        </div>
        <div class="card-body" >
         <?php foreach($datadetail as $value){ ?>
         <a href="<?php echo base_url() ?>mandor/delete_detail/<?= $value->karyawan_projectCode; ?>">
          <button type="button" class="btn btn-secondary mb-1" >
            <i class="fas fa-times-circle"></i> <?= $value->karyawanNama ?>  
          </button>
          </a>
          <?php } ?>


         
            <!-- div class="col-lg-6">
              <div >
                
                <button type="reset" class="btn btn-warning col cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>Cancel upload</span>
                </button>
              </div>
            </div> -->
          
        </div>
</div>
</div>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2(
    {
       
                });


      

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
  
</script>

