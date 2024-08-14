<style>
    .float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:65px;
	right:20px;
	background-color:#0C9;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
	z-index: 1;
}

.my-float{
	margin-top:22px;
}
</style>


<div class="container">
     <a href="<?=base_url("pengajuanho/add")?>" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
	<div class="card">
		<div class="card-body">
			<?php
				foreach ($result as $key => $value) { 
			?>
			<div class="card">
				<div class="card-body">
					<div class="alert alert-primary"><?=$value["tanggal"]?></div>
					<div class="alert alert-primary">
						<?=rupiah($value["kredit"])?><br />
						<?=$value["kategoriakutansi"]?>
					</div>
					<?=$value["keterangan"]?>
					
				</div>
				<div class="card-footer">
					<div class="row">
						<!-- <div class="col-4 text-center"><button class="btn btn-success"><i class="fa fa-camera"></i></button></div>
						<div class="col-4 text-center"><button class="btn btn-success"><i class="fa fa-camera"></i></button></div> -->
						<div class="col-12 text-center"><button class="btn btn-success">Detail <i class="fa fa-arrow-right"></i></button></div>
					</div>
				</div>
			</div>
					
			<?php
				}
			?>
		</div>
	</div>
</div>