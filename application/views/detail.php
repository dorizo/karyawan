
<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Project Detail </h3><br />
            <small>upload ini di gunakan untuk evident tanpa designator</small>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive">
            <form action="<?=base_url("statusproject/adddetail")?>"  method="POST" enctype="multipart/form-data">
         
            <hr />
            Detail Data <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)
            <?php echo $error;?>
            <?php
            foreach ($designatorconfig as $key => $value) {
                 ?>
                <div class="card alert-primary">
                    <div class="card-header">
                    <a style="color:#FFF" href="<?=base_url("statusproject/detail/".$dataresult->project_id)?>"><i class="fas fa-arrow-left"></i> Kembali Ke Upload Project</a>
                    </div>
                    <div class="card-header">
                    ANDA BERADA DI FORM UPLOAD UNTUK DESIGNATOR : <?php print_r($value["designator_code"])?> / <?=$value["designator_desc"]?>
                    <input type="hidden" class="form-control" name="id_project_khs_v2_detail" value="<?=$value["id_project_khs_v2_detail"]?>" /><hr />
                    </div> 
                </div>
                <hr />
            <?php
            }
            ?>
            <input type="hidden" class="form-control" name="project_id" value="<?=$dataresult->project_id?>" /><hr />
            <label>PROJECT STATUS</label>
            <input type="text" class="form-control" name="project_status" value="<?=$dataresult->project_status?>" readonly /><hr />
            <label>KETERANGAN EVIDENT</label>
            <input type="text" class="form-control" name="ket_upload"  /><hr />
           
            <input type="file" class="form-control" name="filedata"  id="filedata" /><hr />
            
            <button class="btn btn-primary mx-3" id="btnFetch" type="submit"  onclick="javascript=this.disabled = true; form.submit();">
            <i class="fas fa-spinner fa-spin" style="display:none;"></i>
            <span class="btn-text">Upload</span>
            </button>
            </form>
        </div>
    </div>
    
<!-- step untuk meruha mulai -->
    <div class="alert alert-success">
    <?php
        if($this->session->userdata("akses") != "waspang"){
        if($datastatus){
        $msd = $this->db->query("select * from karyawan_approve where status_day= ".$datastatus->job_day)->row();
        }
    if($datastatusnext){
    ?>
                Step Anda Sekarang Berada di <b><?php print_r($datastatus->job_name)?></b> <br /> <br />
                <div class="alert alert-danger">MEMERLUKAN APPROVEL <b><?= $msd->approval?></b> UNTUK LANJUT STEP BERIKUTNYA</div>
                <?php 
                 if($this->session->userdata("akses") == $msd->approval){ ?>
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  
                    
                    Rubah ke Step  <?=$datastatusnext->job_name?></button>
             
                
     <?php }
    }else{?>
        <div class="alert alert-success">
                Step sudah <b><?php print_r($datastatus->job_name)?></b> <br />

            </div>
    <?php } }
    ?>
     
     </div>

     <!-- stap untuk mruhah selesai -->

    
    <div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">File</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Designator</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Perancangan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Pengajuan</a>
        </li>
       
    </ul>
    </div>
    <div class="card-body">
    <div class="tab-content" id="custom-tabs-one-tabContent">
        <div class="tab-pane fade active show" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
            <div class="col-12">
                    <h4>Upload List</h4>
                    <ul class="timeline">
                        <?php foreach ($upload_list as $key => $value) {
                            # code...
                        ?>
                        <li>
                            <a href="#" class="float-right"><?=$value->log_date?></a>
                            <div class="col-12" width="100%">
                                <div class="col-4"><?=$value->project_status?></div><hr />
                                <div class="col-4"><?=$value->ket_upload?></div>
                                <div class="col-4"><a target="_blank" href="<?="https://storage.googleapis.com/ciptateknologimuda/uploads/".$value->filedata?>" >download</a> </div>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                        
                    </ul>
            </div>
        </div>
        <div class="tab-pane fade" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
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

        </div>
    <div class="tab-pane fade " id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
    <div class="card">
                        <div class="card-header"> Perancangan <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)</div>
                        <div class="card-body">
                        <?php
                            $dataperancangan = $this->db->query("select * from projectperancangan where project_id=$id")->result_array();
                                ?>
                                    <?php if($this->session->userdata("akses") == "PM"){ ?>
                                        <a class="btn btn-danger" href="<?=base_url("perancangan/add/".$dataresult->project_id)?>">Tambah Perancangan </a>
                                    <?php } ?>
                                    <hr />
                                    <?php
                                    foreach ($dataperancangan as $key => $value) { ?>
                                     <div class="card">
                                        <div class="card-body">
                                            <b><?=$value["keterangan"]?></b> <br />

                                            <div class="float-left"><?=rupiah($value["nilai"])?></div>
                                            <div class="float-right"> <?=tanggalindo($value["tanggal"])?></div><br />
                                            <a href="<?=base_url("perancangan/hapus/".$value["project_id"]."/".$value["projectPerancanganCode"])?>">Hapus</a>
                                        </div>
                                     </div>
                                   <?php
                                    }
                                    ?>
                        </div>
    </div>
    

  </div>
    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
   
    <!-- pengajuan mulau? -->
    
                    <?php
                    if($this->session->userdata("akses") == "PM" or $this->session->userdata("akses") == "admin"){
                    
                    ?>
                    <div class="card">
                        <div class="card-header"> List Pengajuan <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)</div>
                        <div class="card-body">
                        <?php
                            $dataxx = $this->Akunbank_pengajuan_model->view($id);
                                ?>
                                    <?php if($this->session->userdata("akses") == "PM"){ ?>
                                        <a class="btn btn-danger" href="<?=base_url("pengajuan/add/".$dataresult->project_id)?>">Tambah Pengajuan </a>
                                    <?php } ?>
                                        <small>fungsi ini untuk pengajuan ke keuangan </small>
                                    <hr />
                            
                        <div class="timeline">
                <!-- Timeline time label -->
                <?php
                                    foreach ($dataxx as $key => $value) { 
                                    ?>
                                
                                
                <div>
                            <!-- Before each timeline item corresponds to one icon on the left scale -->
                                <i class="fas fa-envelope bg-blue"></i>
                                <!-- Timeline item -->
                                <div class="timeline-item">
                                <!-- Time -->
                                <span class="time"><i class="fas fa-clock"></i> <?=$value["transaksiDate"]?></span>
                                <!-- Header. Optional -->
                                <h3 class="timeline-header"></h3>
                                <!-- Body -->
                                <div class="timeline-body">
                                    <?=$value["transaksiNote"]?>
                                    <hr />
                                    Nilai Material : <?=rupiah($value["nilai_material"])?><hr />
                                    Nilai Jasa : <?=rupiah($value["nilai_jasa"])?><hr />
                                    Total Pengajuan : <?=rupiah($value["transaksiJumlah"])?><hr />
                                    Total Pengajuan : <?=$value["statusTransaksi"]?><hr />
                                    <a target="_BLANK" href="<?='https://keuangan.ciptateknologimuda.com/pembayaran/'.$value['upload_file']?>"> <i class="fa fa-download"></i></a>
                                
                                
                                </div>
                                <!-- Placement of additional controls. Optional -->
                                <div class="timeline-footer">
                                    <?php if($value["statusTransaksi"]=="PENDING"){ ?>
                                    <a onclick="hapus('<?=base_url('pengajuan/delete/'.$value['akunbank_pengajuanCode'])?>')" class="btn btn-danger btn-sm">Hapus</a>
                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                            <?php
                                    }
                                ?>
                            </div>
                        
                            
                                

                                
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                    <!-- pengajuan selesai -->
    </div>
  
    </div>
    </div>

    </div>



        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="alert alert-danger">
                    Periksa Kembali Proses Anda
                </div>
                Apakah Anda Yakin Merubah Ke step <?=$datastatusnext->job_name?>
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?=base_url("statusproject/submitprogress")?>">
                    <input type="hidden" name="project_id" value="<?=$dataresult->project_id?>" />  
                    <input type="hidden" name="project_status" value="<?=$datastatusnext->job_name?>" />  
                    <a type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</a>
                    <input type="submit" class="btn btn-primary" value="IYA">
                    </form>
                </div>
                </div>
            </div>
            </div>
    

            <?php
    if($dataresult->project_status=="SURVEY & SITAC"){ 
        
    if($this->session->userdata("akses") == "waspang"){
        $q = $this->db->query("select * from project_sitax where project_id=".$dataresult->project_id)->row();
       
        ?>
    <div class="card">
            <div class="card-body table-responsive">
                <hr />
                INPUT SURVEY DAN SITAC <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)<br/>
                <small>survey dan sitac di input jika ada sitac jika tidak tidak perlu di input </small>
                <form action="<?=base_url("statusproject/addsitac")?>"  method="POST" enctype="multipart/form-data">
         
                    <hr />
                    Detail Data <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)
                    <?php echo $error;?>
                    <input type="hidden" class="form-control" name="sitax_id" value="<?=$q?$q->sitax_id:""?>" /><hr />
                    
                    <input type="hidden" class="form-control" name="project_id" value="<?=$dataresult->project_id?>" /><hr />
                    KETERANGAN SITAC
                    <input type="text" class="form-control " name="sitax_list"  value="<?=$q?$q->sitax_list:""?>" /><hr />
                    SITAC AKTUAL/REAL
                    <input type="text" class="form-control number-separator" name="sitax_total" value="<?=$q?$q->sitax_total:""?>" /><hr />
                    SITAC PENAGIHAN
                    <input type="text" class="form-control number-separator" name="sitax_penagihan" value="<?=$q?$q->sitax_penagihan:""?>" /><hr />
                    
                    <button class="btn btn-primary mx-3" id="btnFetch" type="submit"  onclick="javascript=this.disabled = true; form.submit();">
                    <i class="fas fa-spinner fa-spin" style="display:none;"></i>
                    <span class="btn-text">Request</span>
                    </button>
                    </form>
                
                </form>
            </div>
    </div>
    

    
    <?php
    }
}
    ?>

<div class="">
    <?php if($this->session->userdata("akses") == "PM"){ 
$qq = $this->db->query("select * from project_sitax where project_id=".$dataresult->project_id)->result();

foreach ($qq as $key => $value) {
?>
<h4>NILAI SITAC</h4>
<table class="table">
    <th>Ket</th><th>Nilai Pembayaran</th><th>Nilai Penagihan</th></tr>
    <tr>
        <td><?=$value->sitax_list?></td>
        <td><?=rupiah($value->sitax_total);?></td>
        <td><?=rupiah($value->sitax_penagihan);?></td>
    </tr>

</table>
<a class="btn btn-success form-control" href="<?=base_url("pengajuan/sitax/".$dataresult->project_id."/".$value->sitax_id)?>">Pengajuan keuangan</a>
<hr />

<?php
}
    }
 
?>
	<div class="row card">
		<div class="col-12">
			<h4>LOG LIST</h4>
			<ul class="timeline">
                <?php foreach ($log_project as $key => $value) {
                    # code...
                ?>
				<li>
					<a href="#" class="float-right"><?=$value->log_date?></a>
					<div class="col-12" width="100%"><?=$value->log_name?></div>
				</li>
                <?php
                }
                ?>
				
			</ul>
		</div>
        
	</div>
</div>

</div>

<style>
    ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 30px 0;
    padding-left: 50px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
    </style>


<script>

    $(document).ready(function() {
    $("#btnFetch").click(function() {
      $(this).html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
      );
      
    });
});
function hapus($a){
    Swal.fire({
        title: 'Apakah kamu Yakin?',
        text: "Data Akan Di hapus Permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        window.location.href= $a;
        }
    })
}
      
</script>