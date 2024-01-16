<div class="col-lg-12">
<div class="card p-2">
              
              <div class="card-body table-responsive p-0">
                  <div class="alert clearfix text-right">
                    <a href="<?=base_url("mandor/add");?>" class="btn btn-success"><i class="fa fa-plus"></i>TAMBAH</a>
                  </div>
                <table id="example" class="table table-striped table-valign-middle" style="font-size:12px">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>UserCode</th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th>POSISI</th>
                    <th width=50px>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                //    print_r($value);
                    ?>
                    <tr>
                        <td><?php print_r($value["karyawanNip"]); ?></td>
                        <td><?php print_r($value["userCode"]); ?></td>
                        <td><?php print_r($value["karyawanNama"]); ?></td>
                        <td><?php print_r($value["username"])?></td>
                        <td><?php print_r($value["akses"])?></td>
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default">Action</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                           
                              <a class="dropdown-item" href="<?=base_url("mandor/edit/".$value["karyawanCode"]);?>">EDIT</a>
                              <a class="dropdown-item" onclick="hapus('<?=base_url("mandor/delete/".$value['karyawanCode']);?>')">DELETE</a>
                            </div>
                          </div>
                        </td>
                    </tr>
                    </tr>

                    <?php
                         # code...
                        }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
</div>