<div class="row">
                            <div class="col-md-6">
                                <!-- DATE PICKER -->
                                <div class="panel">
                                    <div class="panel-heading">
        <?php echo anchor(site_url('tingkat/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>          
                                    </div>
                                    <div class="panel-body">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="fa fa-info-circle"></i> Daftar Tingkat
                                        </div>
                                          <div class="panel-group">
                                            <?php foreach ($tingkat_data as $tingkat) { ?>
                                                <div class="input-group" style="margin-bottom: 5px">
                                                    <input readonly="" class="form-control" type="text" value="<?php echo $tingkat->nama_tingkat ?>" >
                                                    <span class="input-group-btn">
                                                        <?php 
                echo anchor(site_url('tingkat/update/'.$tingkat->tingkat_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary"'); 
                echo '  '; 
                echo anchor(site_url('tingkat/delete/'.$tingkat->tingkat_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','onclick="return confirm('."'Yakin Hapus Data ?'".')" class="btn btn-danger" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
                                                    </span>
                                                </div>
                                            <?php } ?>                                          
                                          </div>
                                        </div>
                                </div>
                                <!-- END DATE PICKER -->
                            </div>
                            <div class="col-md-6">
                                <!-- COLOR PICKER -->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <?php echo anchor(site_url('kelas/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>    
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel-group">
                                            <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true" >×</span>
                                            </button>
                                            <i class="fa fa-info-circle"></i> Daftar Kelas, Klik tingkat untuk lihat detail kelas.
                                        </div>

                                        <?php foreach ($tingkat_data as $tingkat) { ?>
                                            <div class="panel panel-default">
                                              <div class="panel-heading">
                                                <h4 class="panel-title">
                                                  <a data-toggle="collapse" href="#collapse<?php echo $tingkat->tingkat_id ?>"><?php echo $tingkat->nama_tingkat ?></a>
                                                </h4>
                                              </div>
                                              <div id="collapse<?php echo $tingkat->tingkat_id ?>" class="panel-collapse collapse">

                                                <?php
                                                $queryData = "SELECT * from kelas where tingkat_id='$tingkat->tingkat_id'";
                                                $data = $this->db->query($queryData)->result();  ?>

                                                <?php foreach ($data as $d) : ?>
                                                    <div class="input-group" style="margin-bottom: 5px; margin-left: 20px; margin-right: 20px">
                                                        <input readonly="" class="form-control" type="text" value="<?= $d->nama_kelas ?>" >
                                                        <span class="input-group-btn">
                                                            <?php 
                echo anchor(site_url('kelas/update/'.$d->kelas_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary"'); 
                echo '  '; 
                echo anchor(site_url('kelas/delete/'.$d->kelas_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','onclick="return confirm('."'Yakin Hapus Data ?'".')" class="btn btn-danger" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
                                                        </span>
                                                    </div>
                                                <?php endforeach ?>
                                              </div>
                                            </div>
                                        <?php } ?> 
                                          </div>
                                    </div>
                                </div>
                                <!-- END COLOR PICKER -->
                            </div>
                        </div>
