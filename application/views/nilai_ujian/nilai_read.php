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
                        <td>Juz</td>
                        <td><?php echo $juz; ?></td>
                    </tr>
                    <tr>
                        <td>Akumulasi Hafalan</td>
                        <td><?php echo $akumulasi; ?></td>
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
                        <td><a href="<?php echo site_url('nilai_ujian/index/' . $kelas_id) ?>" class="btn btn-default">Cancel</a></td>
                    </tr>
                </table>
            </body>
        </div>
    </section>
</div>