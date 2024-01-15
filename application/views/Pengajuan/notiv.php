<div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr> 
                      <th>akunbank_pengajuanCode</th>
                      <th>Project Code</th>
                      <th>PENGAJUAN NOTE</th>
                      <th>TANGGAL PENGAJUAN</th>
                      <th>NILAI MATERIAL</th>
                      <th>NILAI JASA</th>
                      <th>JUMLAH TRANSAKSI</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($datatable as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["akunbank_pengajuanCode"]?></td>
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=$value["transaksiDate"]?></td>
                      <td><?=rupiah($value["nilai_material"])?></td>
                      <td><?=rupiah($value["nilai_jasa"])?></td>
                      <td><?=rupiah($value["transaksiJumlah"])?></td>
                     
                      <td><?=$value["statusTransaksi"]?><a target="_BLANK" href="<?=base_url('pembayaran/'.$value['upload_file'])?>"> <i class="fa fa-download"></i></a> </td>
                      <td width="120px">
                      <a target="_BLANK" href="<?=base_url("/project/detail/".$value["project_id"])?>" class="btn btn-success"><i class="fas fa-search"></i></a>
                      <a href="<?=$value["pengajuanstatusCode"]==1?base_url("/transaksi/add/".$value["project_id"]."/".$value["akunbank_pengajuanCode"]):base_url("/biayalain/add/".$value["akunbank_pengajuanCode"])?>" class="btn btn-success"><i class="fas fa-arrow-right"></i></a>
                      </td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                    <th>akunbank_pengajuanCode</th>
                      <th>Project Code</th>
                      <th>PENGAJUAN NOTE</th>
                      <th>TANGGAL PENGAJUAN</th>
                      <th>NILAI MATERIAL</th>
                      <th>NILAI JASA</th>
                      <th>JUMLAH TRANSAKSI</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>