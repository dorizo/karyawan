
                        <table id="example1" class="table table-bordered table-hover">
                                              <thead>
                                            <tr>
                                              <th>NO</th>
                                              <th>PROJECT CODE</th>
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
                                                <?=$key+1?>
                                              <!-- <input type="checkbox" name="bagi[<?=$key?>]" value="<?=$value["project_id"]?>" /> -->
                                              </td>
                                              <td><?=$value["project_code"]?></td>
                                              <td><?=$value["project_status"]?></td>
                                              <td><?=$value["project_done"]?></td>
                                              <td><?=rupiah($value["nilai_project"])?></td>
                                            </tr>
                                              <?php
                                                }
                                                ?>
                                            </tbody>
                        </table>
                        <div class="row col-12">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                OUTSTANDING SURAT PESANAN
                                <a href="<?=base_url("suratpesanan/addoutstanding/".$id)?>" class="btn btn-success float-right">Tambah</a>
                              </div>
                              <div class="card-body">
                              <table id="example1" class="table table-bordered table-hover">
                                              <thead>
                                            <tr>
                                              <th>NO</th>
                                              <th>PROJECT CODE</th>
                                              <th>PROJECT STATUS</th>
                                              <th>Nilai Boq</th>
                                              <th>MODE</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                <?php foreach ($outstanding as $key => $value) {  ?>
                                  
                                  <tr class="odd">
                                              <td class="sorting_1 dtr-control">
                                                <?=$key+1?>
                                              <!-- <input type="checkbox" name="bagi[<?=$key?>]" value="<?=$value["project_id"]?>" /> -->
                                              </td>
                                              <td><?=$value["project_code"]?></td>
                                              <td><?=$value["project_status"]?></td>
                                              <td><?=$value["project_done"]?></td>
                                              <td><?=rupiah($value["nilai_project"])?></td>
                                            </tr>
                                <?php } ?>
                                      
                                      </tbody>
                              </table>
                                </div>
                            </div>
                          </div>
                        </div>
