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
    <h2>User_role List</h2>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th>No</th>
            <th>Role</th>

        </tr><?php
                foreach ($user_role_data as $user_role) {
                ?>
            <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $user_role->role ?></td>
            </tr>
        <?php
                }
        ?>
    </table>
</body>

</html>