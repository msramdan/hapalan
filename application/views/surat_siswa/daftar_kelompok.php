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
                                      <a href="<?= base_url('surat_siswa') ?>" class="btn btn-warning"> Reset</a>
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
                                                <a href="<?= base_url() ?>surat_siswa/show/<?= $list['kelompok_id'] ?>/<?= $fix ?>/<?= $fix2 ?>" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
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