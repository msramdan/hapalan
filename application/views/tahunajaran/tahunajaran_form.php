<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TAHUN AJARAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered'>
                    <tr>
                        <td width='200'>Nama Tahun Ajaran <?php echo form_error('tahun_ajaran') ?></td>
                        <td><input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" placeholder="Tahun Ajaran" value="<?php echo $tahun_ajaran; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Semester <?php echo form_error('semester') ?></td>
                        <td>
                            <select name="semester" class="form-control">
                                <option value="">-- Pilih -- </option>
                                <option value="1" <?php echo $semester == '1' ? 'selected' : '' ?>>1</option>
                                <option value="2" <?php echo $semester == '2' ? 'selected' : '' ?>>2</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td width='200'>Status <?php echo form_error('status') ?></td>
                        <td>
                            <select name="status" class="form-control">
                                <option value="">-- Pilih -- </option>
                                <option value="0" <?php echo $status == '0' ? 'selected' : '' ?>>Non Aktif</option>
                                <option value="1" <?php echo $status == '1' ? 'selected' : '' ?>>Aktif</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="hidden" name="tahun_ajaran_id" value="<?php echo $tahun_ajaran_id; ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                            <a href="<?php echo site_url('tahunajaran') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>
</div>