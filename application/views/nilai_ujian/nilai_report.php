<!doctype html>
<html>

<head>
    <title>Laporan</title>
    <style>
        h3 {
            text-align: center;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }

        .flex-content {
            display: flex;
            justify-content: space-between;
        }

        .word-table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        .word-table tr th,
        .word-table tr td {
            border: 1px solid black;
            padding: 15px;
        }

        th {
            background-color: #C0C0C0;
            color: black;
        }

        .title {
            text-align: left;
            font-weight: bold;
        }

        .content-detail {
            margin-left: 20px;
        }

        .nilai {
            text-align: center;
            margin: auto;
            font-weight: bold;
            font-size: 70px;
            border: 1px solid black;
            border-radius: 25px;
            width: 200px;
            height: 80px;
        }
    </style>
</head>

<body>
    <h3 class="header"><u>IJAZAH TAHFIZ AL QUR`AN</u></h3>
    <p class="title">DIBERIKAN KEPADA</p>
    <div class="content-detail">
        <p>Nama : <?= $siswa->nama_siswa ?></p>
        <p>NIS : <?= $siswa->nis ?></p>
        <p>Jenis Kelamin : <?= $siswa->jenis_kelamin ?></p>
        <p>No HP Walimurid : <?= $siswa->no_hp_wali_murid ?></p>
    </div>
    <p class="title">YANG TELAH MENGIKUTI UJIAN TAHFIZH AL QUR`AN</p>
    <div class="content-detail">
        <p>Juz : <?= $ujian->juz ?></p>
        <p>Metode Ujian : <?= $siswa->nis ?></p>
        <p>1. Setoran hafalan per juz secara keseluruhan</p>
        <p>2. Tes acak melanjutkan kalimat dan atau ayat</p>
    </div>
    <p>Alhamdulillah Ananda <b><?= $siswa->nama_siswa ?></b> telah berhasil menyelesaikan ujian ini, dengan nilai</p>
    <p class="nilai"><?= $ujian->nilai ?></p>
</body>

</html>