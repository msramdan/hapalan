<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
        
        <div class="box-body">
            <div class="col-md-5">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tahun Ajaran</h3>
                    </div>
                    <div class="panel-body">
                        <form method="GET">
                            <div class="input-group">
                                <select name="tahun_ajaran_id" class="form-control" required="">
                                    <option value="">-- Pilih -- </option>
                                    <?php foreach ($tahun_ajaran as $key => $data) { ?>
                                            
                                            <?php if(isset($_GET['tahun_ajaran_id']) ){ ?>

                                                <?php
                                                    $queryData = "SELECT tahun_ajaran_detail.*, tahun_ajaran.tahun_ajaran from tahun_ajaran_detail join tahun_ajaran on tahun_ajaran.tahun_ajaran_id=tahun_ajaran_detail.tahun_ajaran_id where tahun_ajaran_detail.tahun_ajaran_id='$data->tahun_ajaran_id' and tahun_ajaran_detail.status='Aktif'";
                                                    $hasil = $this->db->query($queryData)->result();
                                                ?>

                                                <?php foreach ($hasil as $d) : ?>
                                                    <option value="<?php echo $d->tahun_ajaran_detail_id ?>"
                                                        <?php if ($_GET['tahun_ajaran_id']==$d->tahun_ajaran_detail_id) { ?>
                                                            selected
                                                        <?php } ?>><?php echo $d->tahun_ajaran?> Semester <?php echo $d->semester ?>                                                         
                                                    </option>
                                                <?php endforeach ?>                                                
                                            <?php }else{ ?>
                                                <!-- jika tidak ada tahun ajaran id -->
                                                <!-- tampilakan detail tahun ajaran id -->
                                                <?php
                                                    $queryData = "SELECT tahun_ajaran_detail.*, tahun_ajaran.tahun_ajaran from tahun_ajaran_detail join tahun_ajaran on tahun_ajaran.tahun_ajaran_id=tahun_ajaran_detail.tahun_ajaran_id where tahun_ajaran_detail.tahun_ajaran_id='$data->tahun_ajaran_id' and tahun_ajaran_detail.status='Aktif'";
                                                    $hasil = $this->db->query($queryData)->result();
                                                ?>

                                                <?php foreach ($hasil as $d) : ?>
                                                    <option value="<?php echo $d->tahun_ajaran_detail_id ?>"><?php echo $d->tahun_ajaran?> Semester <?php echo $d->semester ?> </option>
                                                <?php endforeach ?>


                                                
                                            <?php } ?>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                    <?php if(isset($_GET['tahun_ajaran_id']) ){ ?>
                                      <a href="<?= base_url('penilaian') ?>" class="btn btn-warning"> Reset</a>
                                    <?php } ?> 

                                </span>
                            </div>   
                        </form>
                        <br>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Kelompok</h3>
                    </div>
                    <div class="panel-body">
                                <?php
                                    
                                    if(isset($_GET['tahun_ajaran_id'])){
                                        // cari id tahun ajaran
                                        $tahun_ajaran_detail_id = $_GET['tahun_ajaran_id'];
                                        $ambil_tahun_ajaran = "SELECT * from tahun_ajaran_detail where tahun_ajaran_detail_id='$tahun_ajaran_detail_id'";
                                        $hasil = $this->db->query($ambil_tahun_ajaran)->row();
                                        $fix = $hasil->tahun_ajaran_id;
                                        $fix2 = $hasil->semester;


                                        if ($this->fungsi->user_login()->level =="ADMIN") {
                                            $sql = "SELECT * from kelompok where tahun_ajaran_id='$fix '";
                                        }else if ($this->fungsi->user_login()->level =="GURU") {
                                            $guru_id = $this->fungsi->guru_login()->guru_id;
                                            $sql = "SELECT access_guru_to_kelompok.*, kelompok.nama_kelompok, kelompok.tahun_ajaran_id from access_guru_to_kelompok join kelompok on kelompok.kelompok_id= access_guru_to_kelompok.kelompok_id where tahun_ajaran_id='$fix' and guru_id='$guru_id'";
                                        }
                                        $daftar_kelompok = $this->db->query($sql)->result_array();
                                    }
                                    
                                ?>

                        <?php if(isset($_GET['tahun_ajaran_id'])){ ?>
                            <div class="form-group">
                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-upload" aria-hidden="true"></i> Import Nilai Tahzin </a>

                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new2"><i class="fa fa-upload" aria-hidden="true"></i> Import Nilai Tahfizh </a>  

                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new3"><i class="fa fa-upload" aria-hidden="true"></i> Import Nilai Sikap</a>   
                                
                            </div>
                        <?php } ?>

                        <table class="table table-bordered" id="table3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelompok</th>
                                    <th style="text-align:center">Anggota Kelompok</th>
                                </tr>
                            </thead>
                            <?php if(isset($_GET['tahun_ajaran_id'])){ ?>
                                <?php $no = 1; foreach ($daftar_kelompok as $list) :  ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?= $list['nama_kelompok'] ?></td>
                                            <td style="text-align:center">

                                                <a href="<?= base_url() ?>penilaian/show/<?= $list['kelompok_id'] ?>/<?= $fix ?>/<?= $fix2 ?>" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</a>


                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                            <?php } ?>
                                
                        </table>
                    </div>
                </div>
            </div>

                            
            
            </div>
            </div>
            </div>
    </section>
</div>

<!-- ============ MODAL ADD tahsin =============== -->
        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Nilai Tahzin</h3>
                <a class="btn btn-success" href="<?= base_url() ?>penilaian/excel_tahzin/<?= $_GET['tahun_ajaran_id'] ?>"><i class="fa fa-file-excel-o faa-pulse animated"></i> &nbsp;Klik untuk Generate Format Tahzin</a>
                <a class="btn btn-danger" href="<?= base_url() ?>penilaian/hapus_nilai_tahzin/<?= $_GET['tahun_ajaran_id'] ?>"><i class="fa fa-trash faa-pulse animated"></i> &nbsp;Hapus semua nilai Tahzin</a>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>import/import_nilai_tahzin">
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
        <!--END MODAL ADD-->




<!-- ============ MODAL ADD tahfiz =============== -->
        <div class="modal fade" id="modal_add_new2" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Nilai Tahfizh</h3>
                <a class="btn btn-success" href="<?= base_url() ?>penilaian/excel_tahfizh/<?= $_GET['tahun_ajaran_id'] ?>"><i class="fa fa-file-excel-o faa-pulse animated"></i> &nbsp;Klik untuk Generate Format Tahfizh</a>
                <a class="btn btn-danger" href="<?= base_url() ?>penilaian/hapus_nilai_tahfizh/<?= $_GET['tahun_ajaran_id'] ?>"><i class="fa fa-trash faa-pulse animated"></i> &nbsp;Hapus semua nilai Tahfizh</a>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php base_url() ?>import/import_nilai_tahfizh">
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
        <!--END MODAL ADD-->

        <!-- ============ MODAL ADD sikap =============== -->
        <div class="modal fade" id="modal_add_new3" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Nilai Sikap</h3>
                <a class="btn btn-success" href="<?= base_url() ?>penilaian/excel_sikap/<?= $_GET['tahun_ajaran_id'] ?>"><i class="fa fa-file-excel-o faa-pulse animated"></i> &nbsp;Klik untuk Generate Format Sikap</a>
                <a class="btn btn-danger" href="<?= base_url() ?>penilaian/hapus_nilai_sikap/<?= $_GET['tahun_ajaran_id'] ?>"><i class="fa fa-trash faa-pulse animated"></i> &nbsp;Hapus semua nilai sikap</a>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>import/import_nilai_sikap">
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
        <!--END MODAL ADD-->