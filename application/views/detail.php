<div class="col-lg-12">
    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title">Project Detail </h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive">
            <form action="<?=base_url("statusproject/adddetail")?>" method="post">
         
            <hr />
            Detail Data <br />(<?=$dataresult->project_code?> / <?=$dataresult->project_name?>)
            <input type="hidden" class="form-control" name="project_id" value="<?=$dataresult->project_id?>" /><hr />
            <input type="text" class="form-control" name="project_status" value="<?=$dataresult->project_status?>" /><hr />
            <input type="file" class="form-control" name="filedata" /><hr />
            <input type="submit" value="Upload" class="btn btn-success" />
            </form>
        </div>
    </div>
    <div class="alert alert-success">
                Step Anda Sekarang Berada di <b><?php print_r($datastatus->job_name)?></b> <br /> <br />
                <a class="btn btn-danger">Rubah ke Step  <?=$datastatusnext->job_name?></a>
            </div>
</div>