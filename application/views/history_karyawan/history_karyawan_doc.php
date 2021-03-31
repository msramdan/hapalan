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
    <h2>History_karyawan List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Info</th>
            <th>Tanggal</th>
            <th>User Agent</th>

        </tr><?php
                foreach ($history_karyawan_data as $history_karyawan) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $history_karyawan->nama ?></td>
                <td><?php echo $history_karyawan->info ?></td>
                <td><?php echo $history_karyawan->tanggal ?></td>
                <td><?php echo $history_karyawan->user_agent ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>