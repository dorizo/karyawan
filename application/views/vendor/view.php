<div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">TABLE <?=$titlepage?></h3> -->
                <a class="btn btn-danger" href="<?=base_url("vendor/add")?>">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th> CODE</th>
                      <th> Name</th>
                      <th> ADDRESS</th>
                      <th> NIK</th>
                      <th>PHONE</th>
                      <th>EMAIL</th>
                      <th>USERNAME</th>
                      <th>MODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["vendorCode"]?></td>
                      <td><?=$value["vendorName"]?></td>
                      <td><?=$value["vendorAlamat"]?></td>
                      <td><?=$value["vendorNIK"]?></td>
                      <td><?=$value["vendorPhone"]?></td>
                      <td><?=$value["vendorEmail"]?></td>
                      <td><?=$value["username"]?></td>
                      <td width=120px>
                        <a href="<?=base_url("vendor/delete/".$value["vendorCode"])?>" class="btn btn-success"><i class="fas fa-trash"></i></a>
                        <a href="<?=base_url("vendor/edit/".$value["vendorCode"])?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
                      </td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                      <th> CODE</th>
                      <th> Name</th>
                      <th> ADDRESS</th>
                      <th> NIK</th>
                      <th>PHONE</th>
                      <th>EMAIL</th>
                      <th>USERNAME</th>
                      <th>MODE</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>