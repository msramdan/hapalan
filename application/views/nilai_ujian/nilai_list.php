<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA NILAI</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;"'>
                                <?php if ($this->session->userdata('level') != '1' || $this->session->userdata('level') != '3') {
                                    if ($this->session->userdata('level') == '1' || check_access_guru($kelas_id) == true) { ?>
        <?php echo anchor(site_url('nilai_ujian/create/' . $kelas_id), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"');
                                    }
                                } ?>
		<?php echo anchor(site_url('nilai_ujian/excel/' . $kelas_id), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('nilai_ujian/word/' . $kelas_id), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class=' col-md-3'>
                                    <form action="<?php echo site_url('nilai_ujian/index/' . $kelas_id); ?>" class="form-inline" method="get">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                            <span class="input-group-btn">
                                                <?php
                                                if ($q <> '') {
                                                ?>
                                                    <a href="<?php echo site_url('nilai_ujian/index/' . $kelas_id); ?>" class="btn btn-default">Reset</a>
                                                <?php
                                                }
                                                ?>
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-4 text-center">
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    </div>
                                </div>
                                <div class="col-md-1 text-right">
                                </div>
                                <div class="col-md-3 text-right">

                                </div>
                            </div>
                            <div class="box-body" style="overflow-x: scroll; ">
                                <table class="table table-bordered" style="margin-bottom: 10px">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Juz</th>
                                        <th>Akumulasi Hafalan</th>
                                        <th>Nilai</th>
                                        <th>Tanggal</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Action</th>
                                    </tr><?php
                                            foreach ($nilai_siswa_data as $nilai_ujian) {
                                            ?>
                                        <tr>
                                            <td width="10px"><?php echo ++$start ?></td>
                                            <td><?php echo $nilai_ujian->nama_siswa ?></td>
                                            <td><?php echo $nilai_ujian->juz ?></td>
                                            <td><?php echo $nilai_ujian->akumulasi ?></td>
                                            <td><?php echo $nilai_ujian->nilai ?></td>
                                            <td><?php echo $nilai_ujian->tanggal ?></td>
                                            <td><?php echo $nilai_ujian->tahun_ajaran . ' | Semester ' . $nilai_ujian->semester ?></td>
                                            <td style="text-align:center" width="200px">
                                                <?php
                                                echo anchor(site_url('nilai_ujian/read/' . $nilai_ujian->nilai_id . '/' . $kelas_id), '<i class="fa fa-eye" aria-hidden="true"></i>', 'class="btn btn-success btn-sm"');
                                                echo '  ';
                                                if ($this->session->userdata('level') != '1' || $this->session->userdata('level') != '3') {
                                                    if ($this->session->userdata('level') == '1' || check_access_guru($kelas_id) == true) {
                                                        echo anchor(site_url('nilai_ujian/update/' . $nilai_ujian->nilai_id . '/' . $kelas_id), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm"');
                                                        echo '  ';
                                                        echo anchor(site_url('nilai_ujian/delete/' . $nilai_ujian->nilai_id . '/' . $kelas_id), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                            }
                                    ?>
                                </table>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php echo $pagination ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>