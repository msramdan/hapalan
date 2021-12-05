<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
        
        <div class="box-body">
            <div class="col-md-4">
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
                                                <option value="<?php echo $data->tahun_ajaran_id ?>"
                                                    <?php if ($_GET['tahun_ajaran_id']==$data->tahun_ajaran_id) { ?>
                                                        selected
                                                    <?php } ?>><?php echo $data->tahun_ajaran?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $data->tahun_ajaran_id ?>"><?php echo $data->tahun_ajaran?></option>
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

            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Kelompok</h3>
                    </div>
                    <div class="panel-body">
                                <?php
                                    
                                    if(isset($_GET['tahun_ajaran_id'])){

                                        $tahun_ajaran_id = $_GET['tahun_ajaran_id'];
                                        if ($this->fungsi->user_login()->level =="ADMIN") {
                                            $sql = "SELECT * from kelompok where tahun_ajaran_id='$tahun_ajaran_id '";
                                        }else if ($this->fungsi->user_login()->level =="GURU") {
                                            $guru_id = $this->fungsi->guru_login()->guru_id;
                                            $sql = "SELECT access_guru_to_kelompok.*, kelompok.nama_kelompok, kelompok.tahun_ajaran_id from access_guru_to_kelompok join kelompok on kelompok.kelompok_id= access_guru_to_kelompok.kelompok_id where tahun_ajaran_id='$tahun_ajaran_id' and guru_id='$guru_id'";
                                        }
                                        $data = $this->db->query($sql)->result_array();
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
                                <?php $no = 1; foreach ($data as $list) :  ?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?= $list['nama_kelompok'] ?></td>
                                            <td style="text-align:center">
                                                <a href="<?= base_url() ?>penilaian/show/<?= $list['kelompok_id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
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