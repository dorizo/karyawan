<div class="col-12">
    <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">FORM INPUT</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
<table id="example1" class="table table-bordered table-hover">
<form method="post" action="<?=base_url("suratpesanan/finalpost")?>">
                      <thead>
                    <tr>
                      <th>NO</th>
                      <th>NILAI PROJECT</th>
                      <th>NILAI INPUTAN</th>
                      <th>HASIL PERSENTASE</th>
                      <th>PECAHAN PERSENTASE</th>
                    </tr>
                  </thead>
               
                  <tbody>
                    <?php
                    foreach ($result as $key => $value) {
                        # code...
                        $pembagi= round(($value["nilai_project"] / $param->total)*100 , 2);
                        ?>
                            <tr class="odd">
                            <td><?=$value["project_code"]?></td>
                            <td><?=rupiah($value["nilai_project"])?></td>
                            <td><?=rupiah($nilaibagi->biayalain)?>/<?=$pembagi?></td>
                            <td><?=$pembagi?></td>
                            <td><?=rupiah((($nilaibagi->biayalain*$pembagi)/100))?>
                            <input type="hidden" name="project_id[<?=$key?>]" value="<?=$value["project_id"]?>" />
                            <input type="hidden" name="persentase[<?=$key?>]" value="<?=$pembagi?>" />
                            <input type="hidden" name="nilaibiaya[<?=$key?>]" value="<?=(($nilaibagi->biayalain*$pembagi)/100)?>"/>
                            </td>
                            </tr>
                        <?php

                    }
                    ?>
                    <tr>
                        <td colspan="2">
                        <input type="hidden" name="biayalainCode" value="<?=$nilaibagi->biayalainCode?>" class="form-control" />
                        <input type="date" name="tanggal_transaksi" class="form-control" />
                        </td>
                        <td>

                        </td>
                        <td>
                            
                    <input type="submit" class="btn btn-success" value="SIMPAN" />
                            <td>
                    </tr>
                    </tbody>
                </form>
                </table>
                </div>
    </div>
</div>