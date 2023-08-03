<div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">TABLE <?=$titlepage?></h3> -->
                <a class="btn btn-danger" href="<?=base_url("transaksi/add/".$dataresult->project_id)?>">Tambah</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>akunbank_transaksiCode</th>
                      <th>transaksiNote</th>
                      <th>transaksiDate</th>
                      <th>transaksiJumlah</th>
                      <th>akunBankCode</th>
                      <th>statusTransaksi</th>
                      <th>MODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($datatable as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control"><?=$value["akunbank_transaksiCode"]?></td>
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=$value["transaksiDate"]?></td>
                      <td><?=rupiah($value["transaksiJumlah"])?></td>
                      <td><?=$value["akunBankCode"]?></td>
                      <td><?=$value["statusTransaksi"]?></td>
                      <td><a href="<?=base_url("transaksi/delete/".$value["akunbank_transaksiCode"])?>" class="btn btn-success"><i class="fas fa-trash"></i></a></td>
                    </tr>
                  <?php
                     }
                  ?>

                </tbody>
                 <tfoot>
                    <tr>
                      <th>akunbankCode</th>
                      <th>total_akunbank</th>
                      <th>taggal_peminjaman</th>
                      <th>saldo_sekarang</th>
                      <th>bungabank</th>
                      <th>bungapartner</th>
                      <th>MODE</th>
                    </tr>
                 </tfoot>
                </table>
               </div>
              <!-- /.card-body -->
            </div>
          </div>