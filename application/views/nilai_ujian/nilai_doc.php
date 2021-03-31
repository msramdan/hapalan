<!doctype html>
<html>

<head>
    <title>Document</title>
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
            <th>Juz</th>
            <th>Akumulasi Hafalan</th>
            <th>Nilai</th>
            <th>Tahun Ajaran</th>
            <th>Tanggal</th>

        </tr><?php
                if ($nilai_data != null) {
                    foreach ($nilai_data as $nilai_ujian) {
                ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td><?php echo $nilai_ujian->nama_siswa ?></td>
                    <td><?php echo $nilai_ujian->juz ?></td>
                    <td><?php echo $nilai_ujian->akumulasi ?></td>
                    <td><?php echo $nilai_ujian->nilai ?></td>
                    <td><?php echo $nilai_ujian->tahun_ajaran . ' | Semester' . $nilai_ujian->semester ?></td>
                    <td><?php echo $nilai_ujian->tanggal ?></td>
                </tr>
        <?php
                    }
                }
        ?>
    </table>
</body>

</html>