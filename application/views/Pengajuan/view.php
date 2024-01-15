<div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">TABLE <?=$titlepage?></h3> -->
                <a class="btn btn-danger" href="<?=base_url("pengajuan/add/".$dataresult->project_id)?>">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr> 
                      <th>akunbank_pengajuanCode</th>
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
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=$value["transaksiDate"]?></td>
                      <td><?=rupiah($value["nilai_material"])?></td>
                      <td><?=rupiah($value["nilai_jasa"])?></td>
                      <td><?=rupiah($value["transaksiJumlah"])?></td>
                      <td><?=$value["statusTransaksi"]?><a target="_BLANK" href="<?=base_url('pembayaran/'.$value['upload_file'])?>"> <i class="fa fa-download"></i></a> </td>
                      <td><a onclick="hapus('<?=base_url('pengajuan/delete/'.$value['akunbank_pengajuanCode'])?>')" class="btn btn-success"><i class="fas fa-trash"></i></a></td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                      <th>akunbank_pengajuanCode</th>
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