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
    <h2>Kelas List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Nama Kelas</th>

        </tr><?php
                foreach ($kelas_data as $kelas) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $kelas->nama_kelas ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>