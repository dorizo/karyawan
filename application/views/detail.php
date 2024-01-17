<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Project Detail </h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive">
            <form action="<?=base_url("statusproject/adddetail")?>"  method="POST" enctype="multipart/form-data">
         
            <hr />
            Detail Data <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)
            <?php echo $error;?>
            <input type="hidden" class="form-control" name="project_id" value="<?=$dataresult->project_id?>" /><hr />
            <label>PROJECT STATUS</label>
            <input type="text" class="form-control" name="project_status" value="<?=$dataresult->project_status?>" /><hr />
            <label>KETERANGAN EVIDENT</label>
            <input type="text" class="form-control" name="ket_upload"  /><hr />
           
            <input type="file" class="form-control" name="filedata" /><hr />
            
            <button class="btn btn-primary mx-3" id="btnFetch" type="submit"  onclick="javascript=this.disabled = true; form.submit();">
            <i class="fas fa-spinner fa-spin" style="display:none;"></i>
            <span class="btn-text">Upload</span>
            </button>
            </form>
        </div>
    </div>
    <?php
    if($dataresult->project_status=="SURVEY & SITAC"){ 
        $q = $this->db->query("select * from project_sitax where project_id=".$dataresult->project_id)->row();
        print_r($q);
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
                    Sitac Desc
                    <input type="text" class="form-control " name="sitax_list"  value="<?=$q?$q->sitax_list:""?>" /><hr />
                    Sitac pembayaran
                    <input type="text" class="form-control number-separator" name="sitax_total" value="<?=$q?$q->sitax_total:""?>" /><hr />
                    Sitac Penagihan
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
    ?>

    <?php
    if($this->session->userdata("akses") != "waspang"){
    if($datastatusnext){
    ?>
    <div class="alert alert-success">
                Step Anda Sekarang Berada di <b><?php print_r($datastatus->job_name)?></b> <br /> <br />
                <?php 
                 if($this->session->userdata("akses") == "PM"){ ?>
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Rubah ke Step  <?=$datastatusnext->job_name?></button>
             
                 <?php
                 }

                if($datastatus->job_day == 2){ 
                    if($this->session->userdata("akses") == "KEUANGAN"){
                     
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Rubah ke Step  <?=$datastatusnext->job_name?></button>  
                <?php   
                    }else{

                        echo "PROSES BERADA DI KEUANGAN"; 
                    } 
                }elseif($datastatus->job_day > 12){ 
                    if($this->session->userdata("akses") == "admin"){
                     
               
                    ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Rubah ke Step  <?=$datastatusnext->job_name?></button>
                <?php  }else{ echo "Proses Berada Di adminstrasi";} } ?>
            </div>
     <?php }else{?>
        <div class="alert alert-success">
                Step sudah <b><?php print_r($datastatus->job_name)?></b> <br /> <br />

            </div>
    <?php } }
    ?>

<!-- designator mulai -->
    <div class="card">
        <div class="card-header"> Designator <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)</div>
        <div class="card-body">
            
        <?php if($this->session->userdata("akses") == "PM"){ ?>
        <a class="btn btn-danger" href="<?=base_url("designator/add/".$dataresult->project_id)?>">Tambah Designator </a><br />
                    <small>Designator fungsi  </small>
                    <?php } ?>
                    <hr />
                    <?php
            foreach ($designatorlist as $key => $value) { ?>
            <div class="card">
               <div class="card-body">
                <h5 class="card-title"><?=$value["designator_code"]?></h5>
                <p class="card-text"><?=$value["designator_desc"]?></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"> <b>JUMLAH DESIGNATOR = </b> <?=$value["jumlah_designator"]?> <?=$value["satuan"]?></li>
              </ul>
              <div class="card-body">
                <!-- <a href="#" class="card-link">Edit</a> -->
              </div>
            </div>
             <?php
            }
            ?>
        </div>
     </div>

<!-- designator selesai -->
    <?php
    if($this->session->userdata("akses") == "PM"){
       
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
    
<div class="">
    <?php
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
<a class="btn btn-success form-control">Pengajuan keuangan</a>
<hr />

<?php
}
 
?>
	<div class="row">
		<div class="col-6">
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
        <div class="col-6">
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
                        <div class="col-4"><a target="_blank" href="<?=base_url("uploads/".$value->filedata)?>" >download</a> </div>
                    </div>
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