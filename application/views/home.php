<div class="col-lg-12">
<div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">LIST Project </h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                  <form class="form p-2">
                  <div class="form-group">
                    <label for="exampleInputEmail1">CODE CENTER</label>
                    <input type="text" name="cari" value="<?=$this->input->get("cari")?>" class="form-control" aria-describedby="emailHelp" placeholder="INPUTKAN COST CENTER DISINI">
                    
        <?php if($this->session->userdata("akses") == "OWNER"){ ?>
          <input type="radio" <?=$this->input->get("project_status")=="pending"?"checked":""?> name="project_status" value="pending"> Pending
          <input type="radio" <?=$this->input->get("project_status")=="return"?"checked":""?> name="project_status" value="return"> return
          <input type="radio" <?=$this->input->get("project_status")=="reject"?"checked":""?> name="project_status" value="reject"> reject
          
           <?php } ?>
                  </div>
                    <input type="submit" value="cari" class="btn btn-primary">
                  </form>
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <!-- <th>Estimasi Project Selesai</th>
                    <th>Real Project</th>
                    <th>Nilai Project</th>
                    <th>Project Status</th>
                    <th>User</th>
                    <th>Detail</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($dataresult as $key => $value) {
                      $now = time(); // or your date as well
                      $your_date = strtotime($value["project_done"]);
                      $datediff = $your_date - $now;
                    ?>
                  <tr>
                    <td style="padding: 1px;">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                      <b><?=$value["project_code"]?> <br /></b><hr />
                        <?php 
                        $ss = substr_count($value["project_name"] , " ");
                        if($ss == 0){
                          echo substr( $value["project_name"] , 0 , 30);
                        }else{
                          echo $value["project_name"];
                        }
                        ?>
                      </div>
                      <div class="card-body box-profile">
                        <b>Project <?=$value["parentcatName"]?></b><hr />
                        KATEGORI : <?=$value["cat_name"]?><hr />
                        WITEL : <?=$value["witel_name"]?><hr />
                        
                        Status : <?=$value["project_status"]?><hr />
                        <!-- Estimasi Mulai : <?=tanggalindo($value["project_start"])?><hr /> -->
                        Estimasi Selesai : <?=tanggalindo($value["project_done"])?><hr />
                        Estimasi Hari : <?=$value["project_paid"]?"Project Selesai":round($datediff / (60 * 60 * 24))." hari";?> <hr />
                       
        <?php if($this->session->userdata("akses") == "OWNER" or $this->session->userdata("akses") == "PM"){ ?>

          Nilai Project : <?=rupiah($value["nilai_project"])?><br />
                       Persentase API : <?=rupiah($value["sharing_owner"]);?>% <br />
                       Persentase Vendor : <?=rupiah($value["sharing_vendor"]);?>% <br />
                       Bunga Berjalan : <?=rupiah($value["totalbungaseluruh"]);?> <br />
                       Pembayaran Vendor :  <?=rupiah($value["paymentvendor"]);?>
                      <?php 
                      $dddd = $this->db->query("select catatan_direksi ,project_status from catatandireksi where project_id=".$value["project_id"])->result_array();
                      foreach ($dddd as $keyee => $valueee) { ?>
                      <div class="alert alert-danger"><?=$valueee["catatan_direksi"]?> (<?=$valueee["project_status"]?>)</div>
                        <?php
                      }
                      ?>

          <?php
          $dev = "gagal";
         
          if($value["project_status"] == "reject"){
            $dev  = "berhasil";
          }
          if($value["project_status"] == "pending"){
            $dev  = "berhasil";
          }
          
          if($value["project_status"] == "Pending"){
            $dev  = "berhasil";
          }
          
          if($value["project_status"] == "return"){
            $dev  = "berhasil";
          }
        if($dev == "berhasil"){
   
            ?>
          

                       <?php if($this->session->userdata("akses") == "OWNER"){ ?>
                        <hr />
                        <form action="<?=base_url("project/approve/".$value['project_id'])?>" method="post">
                          <textarea name="catatan_direksi" class="form-control"></textarea><br />
                          <select name="project_status"  class="form-control">
                          <option value="pending">pending</option>
                            <option value="return">return</option>
                            <option value="approve">approve</option>
                            <option value="reject">reject</option>
                          </select><br />
                          <button class="btn btn-success">Kirim</button>                      
                        </form>
                        
                        
                       <?php } }?>
                      
                       <?php } ?>
                       
                      </div>
                      <div class="card-footer">
                      <a class="btn btn-success mt-2" href="<?=base_url("statusproject/detail/".$value['project_id'])?>">Input Status</a>
                       
                       <?php if($this->session->userdata("akses") == "PM"){  ?>
                         <a class="btn btn-success mt-2" href="<?=base_url("project/setting/".$value['project_id'])?>">Setting Project</a>
                        <a class="btn btn-success mt-2" href="<?=base_url("mandor/sematkan/".$value['project_id'])?>">Setting Waspang & Admin</a>
                        <?php } ?>
                      
                      </div>
                    </div>
                    </td>
                  
                  <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
</div>