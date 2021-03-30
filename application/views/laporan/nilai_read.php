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
    </style>
</head>

<body>
    <h3 class="header"><u>Laporan Perkembangan Hafalan Al-Quran</u></h3>
    <div class="flex-container">
        <p>Nama : <?= $siswa->nama_siswa ?></p>
        <p>Tahun Pelajaran : <?= $tahun_ajaran->tahun_ajaran ?></p>
    </div>
    <div class="flex-container">
        <p>NIS : 123123123</p>
        <p>Semester : <?= $tahun_ajaran->semester ?></p>
    </div>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th colspan='2'>I. Pencapaian Per Semester</th>
            <th>Nilai</th>
        </tr>
        <?php
        $no = 1;
        foreach ($nilai_harian as $value) {
        ?>
            <tr>
                <td width="5%" align="center"><?= $no++ ?></td>
                <td width="75%">
                    <div class="flex-content">
                        <p><?= "Mulai : " . $value->nama_surat1 ?></p>
                        <p><?= " Ayat : " . $value->ayat_mulai ?></p>
                    </div>
                    <div class="flex-content">
                        <p><?= "Selesai : " . $value->nama_surat2 ?></p>
                        <p><?= " Ayat : " . $value->ayat_selesai ?></p>
                    </div>
                </td>
                <td width="20%" align="center"><?= $value->nilai ?></td>
            </tr>
        <?php
        }
        ?>
    </table>

    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th colspan='2'>II. Ujian dan Ijazah</th>
            <th>Nilai</th>
        </tr>
        <?php
        $no = 1;
        foreach ($nilai_ujian as $value) {
        ?>
            <tr>
                <td width="5%" align="center"><?= $no++ ?></td>
                <td width="75%"><?= $value->juz ?></td>
                <td width="20%" align="center"><?= $value->nilai ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th colspan='2'>III. Adab dan Akhlak</th>
            <th>Nilai</th>
        </tr>
        <tr>
            <td width="5%" align="center">1</td>
            <td width="75%">Adab Terhadap Al-Quran</td>
            <td width="20%" align="center"><?= $adab_quran ?></td>
        </tr>
        <tr>
            <td width="5%" align="center">2</td>
            <td width="75%">Adab Terhadap Guru</td>
            <td width="20%" align="center"><?= $adab_guru ?></td>
        </tr>
    </table>
</body>

</html>