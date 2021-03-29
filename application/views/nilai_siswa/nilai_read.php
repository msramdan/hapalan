<div class="content-wrapper">
    <section class="content">
        <div class="box">

            <body>
                <h2 style="margin-top:0px">Nilai Read</h2>
                <table class="table">
                    <tr>
                        <td>Siswa</td>
                        <td><?php echo $nama_siswa; ?></td>
                    </tr>
                    <tr>
                        <td>Surat Mulai</td>
                        <td><?php echo $nama_surat1; ?></td>
                    </tr>
                    <tr>
                        <td>Surat Selesai</td>
                        <td><?php echo $nama_surat2; ?></td>
                    </tr>
                    <tr>
                        <td>Ayat Mulai</td>
                        <td><?php echo $ayat_mulai; ?></td>
                    </tr>
                    <tr>
                        <td>Ayat Selesai</td>
                        <td><?php echo $ayat_selesai; ?></td>
                    </tr>
                    <tr>
                        <td>Nilai</td>
                        <td><?php echo $nilai; ?></td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran</td>
                        <td><?php echo $tahun_ajaran; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><?php echo $tanggal; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo site_url('nilai_siswa/index/' . $kelas_id) ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
                </table>
            </body>
        </div>
    </section>
</div>