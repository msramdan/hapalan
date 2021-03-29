<!doctype html>
<html>

<head>
    <title>harviacode.com - codeigniter crud generator</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        .word-table {
            border: 1px solid black !important;
            border-collapse: collapse !important;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            border: 1px solid black !important;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <h2>Nilai List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Surat Mulai</th>
            <th>Nama Surat Selesai</th>
            <th>Ayat Mulai</th>
            <th>Ayat Selesai</th>
            <th>Nilai</th>
            <th>Tahun Ajaran</th>
            <th>Tanggal</th>

        </tr><?php
                if ($nilai_data != null) {
                    foreach ($nilai_data as $nilai_siswa) {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $nilai_siswa->nama_siswa ?></td>
                    <td><?php echo $nilai_siswa->nama_surat1 ?></td>
                    <td><?php echo $nilai_siswa->nama_surat2 ?></td>
                    <td><?php echo $nilai_siswa->ayat_mulai ?></td>
                    <td><?php echo $nilai_siswa->ayat_selesai ?></td>
                    <td><?php echo $nilai_siswa->nilai ?></td>
                    <td><?php echo $nilai_siswa->tahun_ajaran . ' | Semester' . $nilai_siswa->semester ?></td>
                    <td><?php echo $nilai_siswa->tanggal ?></td>
                </tr>
        <?php
                    }
                }
        ?>
    </table>
</body>

</html>