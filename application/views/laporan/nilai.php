<section class="content">
    <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Laporan Nilai</h3>
        </div>
        <div class="box-body">
            <form action="<?php echo $action; ?>" method="post">
                <table class='table table-bordered>'>
                    <tr>
                        <td width='200'>Siswa<?php echo form_error('siswa_id') ?></td>
                        <td><select name="siswa_id" class="form-control">
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($siswa_list as $key => $data) {
                                ?>
                                    <?php if ($data->siswa_id == $siswa_id) { ?>
                                        <option value="<?php echo $data->siswa_id ?>" selected><?php echo $data->nama_siswa ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $data->siswa_id ?>"><?php echo $data->nama_siswa ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td width='200'>Tahun Ajaran<?php echo form_error('tahun_ajaran_id') ?></td>
                        <td><select name="tahun_ajaran_id" class="form-control">
                                <option value="">-- Pilih -- </option>
                                <?php foreach ($tahunajaran_list as $key => $data) {
                                ?>
                                    <?php if ($data->tahun_ajaran_id == $tahun_ajaran_id) { ?>
                                        <option value="<?php echo $data->tahun_ajaran_id ?>" selected><?php echo $data->tahun_ajaran . ' | Semester ' . $data->semester ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $data->tahun_ajaran_id ?>"><?php echo $data->tahun_ajaran . ' | Semester ' . $data->semester ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td width='200'>Predikat Adab Terhadap Al-Qur'an <?php echo form_error('adab_quran') ?></td>
                        <td><input type="text" class="form-control" name="adab_quran" id="adab_quran" placeholder="Adab Quran" value="<?php echo $adab_quran; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Predikat Adab Terhadap Guru <?php echo form_error('adab_guru') ?></td>
                        <td><input type="text" class="form-control" name="adab_guru" id="adab_guru" placeholder="Adab Guru" value="<?php echo $adab_guru; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Tertib dan Disiplin <?php echo form_error('tertib_disiplin') ?></td>
                        <td><input type="text" class="form-control" name="tertib_disiplin" id="tertib_disiplin" placeholder="Tertib dan Disiplin" value="<?php echo $tertib_disiplin; ?>" /></td>
                    </tr>
                    <tr>
                        <td><button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button></td>
                        <td><a href="<?php echo site_url('laporan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</section>