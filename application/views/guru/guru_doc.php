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
    <h2>Guru List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Nama Guru</th>
            <th>Jenis Kelamin</th>
            <th>No Hp</th>
            <th>Alamat</th>

        </tr><?php
                foreach ($guru_data as $guru) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $guru->nama_guru ?></td>
                <td><?php echo $guru->jenis_kelamin ?></td>
                <td><?php echo $guru->no_hp ?></td>
                <td><?php echo $guru->alamat ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>