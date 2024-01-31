<!-- designator mulai -->
<div class="card">
        <div class="card-header"> Designator <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)</div>
        <div class="card-body">
            
        <?php if($this->session->userdata("akses") == "PM" or $this->session->userdata("akses") == "waspang"){ ?>
        <a class="btn btn-danger" href="<?=base_url("designator/add/".$dataresult->project_id)?>">Tambah Designator </a><br />
                    <small>Designator fungsi  </small>
                    <?php } ?>
                    <hr />
                    <?php
                    $total = 0;
            foreach ($designatorlist as $key => $value) {
                $total = $total +$value["total_designator"];
                ?>
            <div class="card">
               <div class="card-body">
                <h5 class="card-title"><?=$value["designator_code"]?></h5>
                <p class="card-text"><?=$value["designator_desc"]?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"> <b>VOLUME JASA = </b> <?=volume($value["jumlah_designator"])?></li>
                <li class="list-group-item"> <b>VOLUME MATERIAL = </b> <?=volume($value["jumlah_designator_material"])?> <?=$value["satuan"]?></li>
              </ul>
              <hr />
              LOG PERUBAHAN
              <hr />
              <?php
              $SS = $this->db->query("select * from datateknis_projectkhs_detail_log where id_project_khs_v2_detail = ".$value["id_project_khs_v2_detail"])->result_array();  
              foreach ($SS as $key => $value) {
              ?>
              <div class="alert alert-success">
                TANGGAL PERUBAHAN : <?=$value["tanggal"]?><br />
                PERUBAHAN SERVICE : <?=rupiah($value["service_price"])?><br />
                PERUBAHAN MATERIAL : <?=rupiah($value["material_price"])?><br />
                VOLUME JASA : <?=volume($value["jumlah_designator"])?><br />
                VOLUME MATERIAL : <?=volume($value["jumlah_designator_material"])?><br />
                TOTAL DESIGNATOR : <?=rupiah($value["total_designator"])?><br />
              </div>
              <?php } ?>
              <div class="card-body">
                <a href="<?=base_url("statusproject/detail/".$id."/".$value["id_project_khs_v2_detail"])?>" class="card-link btn btn-primary">Upload evident</a>
              </div>
            </div>
             <?php
            }
            ?>
        </div>
        <div class="card-footer">
        <b>TOTAL BOQ : <?=rupiah($total);?></b><br />
        <?php
        $siujk = (($total *2)/100);
         $totalsiuk = $total - $siujk;
        ?>
        <b>SIUJK :<?=rupiah($totalsiuk);?></b>
        <?php if($this->session->userdata("akses") == "PM"){
            $bayar = $this->db->query("select * from karyawan_project a  JOIN karyawan b ON b.karyawanCode=a.karyawanCode where project_id=".$dataresult->project_id)->result_array();
            $nilaiwaspang = 0;
            $nilaiadmin = 0;
            foreach ($bayar as $key => $value) {
            if($value["akses"]=="waspang"){
                $nilaiwaspang =  1;
            }
            if($value["akses"]=="admin"){
                $nilaiadmin = 1;
            }
            $allnilai =  $nilaiadmin + $nilaiwaspang;

               echo "<div class='alert alert-success'>".$value["akses"]." : ".$value["karyawanNama"]."</div>"; 
            //    print_r($value);
            }

            ?>
        <form method="post" action="<?=base_url("statusproject/generateboq")?>">
                      <!-- text input -->
                        <input type="hidden" name="nilai_boq" readonly value="<?=$total?>" class="boq form-control number-separator" placeholder="Enter ...">
                        <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" class="form-control" placeholder="Enter ...">
                        <input type="hidden" name="nilai_project" readonly value="<?=$totalsiuk?>" class="form-control number-separator" placeholder="Enter ...">
                       <?php if($allnilai == 2){?>
                        <button type="submit" class="btn btn-primary">GENERATE NILAI BOQ</button>
                       <?php }else{ ?>
                        <div class="alert alert-danger">HARAP DISPOSISI PROJECT INI KE WASPANG DAN ADMIN TERLEBIH DAHULU !!!!!!!!!!!!!!!!!!!!!!!!!</div>

                       <?php } ?>
                        
        </form>
        <?php 
        } 
        ?>


        </div>
       
     </div>

<!-- designator selesai -->