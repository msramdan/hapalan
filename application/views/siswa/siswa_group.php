<div class="row">
                            <div class="col-md-12">
                                <a href="../../files/Format Import Siswa.xlsx"><i class="fa fa-file-pdf-o faa-pulse animated"></i> &nbsp;Download Format Import Siswa</a>

                                <!-- COLOR PICKER -->
                                <div class="panel">
                                    <div class="panel-heading">
                                        <?php echo anchor(site_url('siswa/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
        <?php echo anchor(site_url('siswa/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
        <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_add_new"> Import Data</a>  
              
                                    </div>
                                    <div class="panel-body">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <i class="fa fa-info-circle"></i> Klik tingkat untuk lihat detail Kelas dan siswa.
                                        </div>
                                        <div class="panel-group">
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
                echo anchor(site_url('siswa?kelas_id='.$d->kelas_id),'<i class="fa fa-eye" aria-hidden="true"></i> View Siswa','class="btn btn-success"');  
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

                        <!-- ============ MODAL ADD BARANG =============== -->
                        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                <h3 class="modal-title" id="myModalLabel">Import Data Siswa</h3>
                            </div>
                            <form action="<?= base_url() ?>import/import_siswa" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">File Upload</label>
                                    <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required="">
                                </div>
                                <input type="submit" class="btn btn-primary" value="Import" name="import" />
                            </div>
                            </form>
                            </div>
                            </div>
                        </div>
                        <!--END MODAL ADD BARANG-->