
<table id="example1" class="table table-bordered table-hover">
<form method="post">
                      <thead>
                    <tr>
                      <th>NO</th>
                      <th>PROJECT CODE</th>
                      <th>PROJECT NAME</th>
                      <th>PROJECT STATUS</th>
                      <th>Nilai Boq</th>
                      <th>MODE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($project as $key => $value) { 
                    ?>
                    <tr class="odd">
                      <td class="sorting_1 dtr-control">
                      <input type="checkbox" name="bagi[<?=$key?>]" value="<?=$value["project_id"]?>" />
                      </td>
                      <td><?=$value["project_code"]?></td>
                      <td><?=$value["project_name"]?></td>
                      <td><?=$value["status_paid"]?></td>
                      <td><?=$value["project_done"]?></td>
                      <td><?=rupiah($value["nilai_project"] - $value["nilai_project_paid"])?></td>
                    </tr>
                      <?php
                        }
                        ?>
        <tr>
            <td colspan="4"></td>
            <td colspan="1"><input type="submit" class="btn btn-success" value="submit"></td>
        </tr>
                        
 </form>
                        </table>
