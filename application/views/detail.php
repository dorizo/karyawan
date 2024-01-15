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
    if($datastatusnext){
    ?>
    <div class="alert alert-success">
                Step Anda Sekarang Berada di <b><?php print_r($datastatus->job_name)?></b> <br /> <br />
                <?php 
                if($datastatus->job_day == 2){ 
                    if($this->session->userdata("akses") == "KEUANGAN"){
                     
                    ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Rubah ke Step  <?=$datastatusnext->job_name?></button>  
                <?php   
                    }else{

                        echo "PROSES BERADA DI KEUANGAN"; 
                    } 
                }elseif($datastatus->job_day > 11){ 
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
    <?php } ?>

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
</script>