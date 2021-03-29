<div class="content-wrapper">

    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA GURU</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">

                <table class='table table-bordered'>
                    <tr>
                        <td width='200'>Username <?php echo form_error('username') ?></td>
                        <td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
                            <?php if ($guru_id != '') { ?>
                                <br><i>*Kosongkan untuk tidak mengubah Username</i>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Password <?php echo form_error('password') ?></td>
                        <td><input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
                            <?php if ($guru_id != '') { ?>
                                <br><i>*Kosongkan untuk tidak mengubah Password</i>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Password Confirmation <?php echo form_error('passconf') ?></td>
                        <td><input type="password" class="form-control" name="passconf" id="passconf" placeholder="Password Confirmation" value="<?php echo $passconf; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Email <?php echo form_error('email') ?></td>
                        <td><input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                            <?php if ($guru_id != '') { ?>
                                <br><i>*Kosongkan untuk tidak mengubah Email</i>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Nama Guru <?php echo form_error('nama_guru') ?></td>
                        <td><input type="text" class="form-control" name="nama_guru" id="nama_guru" placeholder="Nama Guru" value="<?php echo $nama_guru; ?>" /></td>
                    </tr>
                    <tr>
                        <td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td>
                        <td><select name="jenis_kelamin" class="form-control" value="<?= $jenis_kelamin ?>">
                                <option value="">- Pilih -</option>
                                <option value="Laki Laki" <?php echo $jenis_kelamin == 'Laki Laki' ? 'selected' : 'null' ?>>Laki Laki</option>
                                <option value="Perempuan" <?php echo $jenis_kelamin == 'Perempuan' ? 'selected' : 'null' ?>>Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>Tipe <?php echo form_error('level') ?></td>
                        <td><select name="level" class="form-control" value="<?= $level ?>">
                                <option value="">- Pilih -</option>
                                <option value="2" <?php echo $level == '2' ? 'selected' : '' ?>>Wali Kelas</option>
                                <option value="3" <?php echo $level == '3' ? 'selected' : '' ?>>Guru</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width='200'>No Hp <?php echo form_error('no_hp') ?></td>
                        <td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" /></td>
                    </tr>

                    <tr>
                        <td width='200'>Alamat <?php echo form_error('alamat') ?></td>
                        <td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="hidden" name="guru_id" value="<?php echo $guru_id; ?>" />
                            <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
                            <a href="<?php echo site_url('guru') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>
</div>