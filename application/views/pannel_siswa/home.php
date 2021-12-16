<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
        
        <div class="box-body">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tahun Ajaran</h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="<?= base_url() ?>pannel_siswa/raport" target="_blank">
                            <div class="input-group">
                                <select name="tahun_ajaran_detail_id" class="form-control" required="">
                                    <option value="">-- Pilih -- </option>
                                    <?php foreach ($tahun_ajaran as $key => $data) { ?>
                                                <?php
                                                    $queryData = "SELECT tahun_ajaran_detail.*, tahun_ajaran.tahun_ajaran from tahun_ajaran_detail join tahun_ajaran on tahun_ajaran.tahun_ajaran_id=tahun_ajaran_detail.tahun_ajaran_id where tahun_ajaran_detail.tahun_ajaran_id='$data->tahun_ajaran_id' and tahun_ajaran_detail.status='Aktif'";
                                                    $hasil = $this->db->query($queryData)->result();
                                                ?>
                                                <?php foreach ($hasil as $d) : ?>
                                                    <option value="<?php echo $d->tahun_ajaran_detail_id ?>"><?php echo $d->tahun_ajaran?> Semester <?php echo $d->semester ?> </option>
                                                <?php endforeach ?>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">View Raport</button>
                                </span>
                            </div>   
                        </form>
                        <br>
                    </div>
                </div>
            </div>                           
            
            </div>
            </div>
            </div>
    </section>
</div>