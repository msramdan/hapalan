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
    <h2>Siswa List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
            <th>Nama Ibu</th>
            <th>Nama Ayah</th>
            <th>No Hp Wali Murid</th>

        </tr><?php
                foreach ($siswa_data as $siswa) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $siswa->nis ?></td>
                <td><?php echo $siswa->nama_siswa ?></td>
                <td><?php echo $siswa->jenis_kelamin ?></td>
                <td><?php echo $siswa->nama_kelas ?></td>
                <td><?php echo $siswa->nama_ibu ?></td>
                <td><?php echo $siswa->nama_ayah ?></td>
                <td><?php echo $siswa->no_hp_wali_murid ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>