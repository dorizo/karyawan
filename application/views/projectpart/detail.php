<div class="col-12">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects Detail</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                
              <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">NILAI BOQ</span>
                      <span class="info-box-number text-center text-muted mb-0"><?=rupiah($dataresult->nilai_boq)?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">NILAI SIUJK</span>
                      <span class="info-box-number text-center text-muted mb-0"><?=rupiah($dataresult->nilai_project)?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Pembayaran Ke Vendor</span>
                      <span class="info-box-number text-center text-muted mb-0">
                      <?php
                      echo rupiah($sumproject->transaksiJumlah);
                      ?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">project duration</span>
                      <span class="info-box-number text-center text-muted mb-0"><?=countday($dataresult->project_start ,$dataresult->project_paid);?> Hari</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Sharing Vendor</span>
                      <span class="info-box-number text-center text-muted mb-0">
                        
                      <?=rupiah(($dataresult->nilai_project * $dataresult->sharing_vendor)/100)?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Sharing Owner</span>
                      <span class="info-box-number text-center text-muted mb-0">
                        <?=rupiah(($dataresult->nilai_project * $dataresult->sharing_owner)/100)?>
                        
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Persentase Profit</span>
                      <span class="info-box-number text-center text-muted mb-0">
                        <?php
                      if(!$dataresult->paymentvendor){
                        $point=0;
                        }else{
                        $point = @(round((((($dataresult->nilai_project * $dataresult->sharing_owner)/100)/($dataresult->paymentvendor+$dataresult->totalbungaseluruh))*100),2));
                        }
                        ?>
                         <?=$point?>%
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <table class="table">
                  
                <head>
                    <tr>
                      <th>Transaksi Note</th>
                      <th>Tanggal Pembayaran Vendor</th>
                      <th>Jumlah Pembayaran </th>
                      <th>Jumlah Hari</th>
                      <th>Bunga Berjalan</th>
                    </tr>
                  </head>
                  <?php
                  $totalbunga = 0;
                  foreach ($transaksiproject as $key => $value) {
                    $totalbunga = $totalbunga + hitungbunga($value["transaksiDate"] ,$value["project_paid"] ,$value["transaksiJumlah"] );
                  ?>
                    <tr>
                      <td><?=$value["transaksiNote"]?></td>
                      <td><?=tanggalindo($value["transaksiDate"])?></td>
                      <td><?=rupiah($value["transaksiJumlah"])?></td>
                      <td><?=countday($value["transaksiDate"] ,$value["project_paid"]);?></td>
                      <td><?=rupiah(hitungbunga($value["transaksiDate"] ,$value["project_paid"] ,$value["transaksiJumlah"] ));?></td>
                    </tr>
                  <?php 
                   }
                  ?>
                  <tr>
                    <td colspan=4 ></td>
                    <td><?=rupiah($totalbunga)?></td>
                  </tr>

                </table>

                  <h4>Recent Activity</h4>
                  <?php
                  foreach ($logproject as $key => $value) {
                    # code...
                 
                  ?>
                    <div class="post">
                     <p>
                       <?=$value["log_name"]?>
                      </p>

                      <p>
                        <a href="#" class="link-black text-sm"><i class="fas fa-calendar-alt"></i>
                       <?=$value["log_date"]?>
                      </a>
                      </p>
                    </div>
                    <?php
                     }
                     ?>
                    
                </div>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas fa-history"></i> Log Project</h3>
              <p class="text-muted">
                <?=$dataresult->project_note?>
              </p>
              <br>
              <div class="text-muted">
                <p class="text-sm">PROJECT STATUS
                  <b class="d-block"><?=$dataresult->project_status?></b>
                </p>
                <p class="text-sm">Project Leader
                  <b class="d-block">Tony Chicken</b>
                </p>
              </div>

              <h5 class="mt-5 text-muted">Project files</h5>
              <ul class="list-unstyled">
               <?php
               
               foreach ($map as $key => $value)
               {
                if(is_array($value)){
                    foreach ($value as $key1 => $value1)
                    {

                         if(is_array($value1)){
                            foreach ($value1 as $key2 => $value2)
                            {
                                if(is_array($value2)){
                                    foreach ($value2 as $key3 => $value3)
                                    {
                                        if(is_array($value3)){
                                            foreach ($value3 as $key4 => $value4)
                                            {
                                                if(is_array($value4)){
                                                    foreach ($value4 as $key5 => $value5)
                                                    {
                                                        if(is_array($value5)){
                
                                                        }else{
                                                            echo $value5."<br />";
                                                        }
                                                    }
                                                }else{
                                                    echo $value4."<br />";
                                                }
                                            }

                                        }else{
                                            echo $value3."<br />";
                                        }
                                    }
                                }else{
                                    echo $value2."<br />";
                                }
                            } 
                        }else{
                            echo $value1."<br />";
                        }
                        
                      
                    } 
                }else{
                    echo $value."<br />";
                }
                 

                  
                }
              ?>
              
              </ul>
              <div class="text-center mt-5 mb-3">
                <a href="<?=base_url("project/download/".$dataresult->project_id);?>" class="btn btn-sm btn-primary">Download File</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</div>