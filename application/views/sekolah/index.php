<section class="content">
    <?php $this->view('messages') ?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Master Data Sekolah</h3>
        </div>
        <div class="box-body">
            <form action="<?php echo $action; ?>" method="post">
                <table class='table table-bordered>'>
                    <tr>
                        <td width='200'>Nama <?php echo form_error('nama') ?></td>
                        <td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Sekolah" value="<?php echo $nama; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Alamat <?php echo form_error('alamat') ?></td>
                        <td><input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Sekolah" value="<?php echo $alamat; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Telepon <?php echo form_error('no_hp') ?></td>
                        <td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor Telepon Sekolah" value="<?php echo $no_hp; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Kepala <?php echo form_error('kepala_sekolah') ?></td>
                        <td><input type="text" class="form-control" name="kepala_sekolah" id="kepala_sekolah" placeholder="Nama Kepala Sekolah" value="<?php echo $kepala_sekolah; ?>" /></td>
                    </tr>
                    <input type="hidden" class="form-control" name="sekolah_id" id="sekolah_id" value="<?php echo $sekolah_id; ?>" /></ <tr>
                    <td><button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button></td>
                    </td>
                    </tr>
                </table>
            </form>
        </div>
</section>