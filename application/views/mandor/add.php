<div class="col-lg-12">
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
                <label for="inputName">NIP</label>
                <input type="text" name="karyawanNip" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">NIP</label>
                <input type="text" name="userCode" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">NAMA</label>
                <input type="text" name="karyawanNama" id="inputName" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">Username</label>
                <input type="text" name="username" id="inputName" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputName">Password</label>
                <input type="password" name="password" id="passowrd" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="inputName">akses</label>
                <select name="akses" id="akses" class="form-control">
                  <option value="PM">PM</option>
                  <option value="waspang">waspang</option>
                  <option value="admin">admin</option>
                  <option value="KEUANGAN">KEUANGAN</option>
                </select>
              </div>
              <!-- <div class="form-group">
                <label for="inputDescription">Project Description</label>
                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
              </div>
              <div class="form-group">
                <label for="inputClientCompany">Client Company</label>
                <input type="text" id="inputClientCompany" class="form-control">
              </div>
              <div class="form-group">
                <label for="inputProjectLeader">Project Leader</label>
                <input type="text" id="inputProjectLeader" class="form-control">
              </div> -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="<?=base_url("master/user")?>" class="btn btn-secondary">Cancel</a>
            <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
            </form>
       </div>
          <!-- /.card -->
      