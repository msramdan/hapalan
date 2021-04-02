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

        .header-table {
            border-collapse: collapse;
            width: 100%;
        }

        .ttd-table {
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
        }

        .kop_surat {
            width: 100%;
        }

        .alamat_kop {
            font-size: 14px;
        }

        .img_kop {
            width: 100%;
        }

        .ttd-kolom {
            height: 100px;
        }
    </style>
</head>

<body>
    <table class="kop_surat">
        <tr>
            <td width="20%"><img src="<?= base_url() . 'assets/img/logo_sekolah-cropped-100-100.jpeg' ?>" alt="Logo Sekolah" class="img_kop"></td>
            <td width="80%">
                <h2><?= $sekolah->nama ?></h2><br>
                <span class="alamat_kop"><b><?= $sekolah->alamat . ' ' . $sekolah->no_hp ?></b></span>
            </td>
        </tr>
    </table>

    <h3 class="header"><u>Laporan Perkembangan Hafalan Al-Quran</u></h3>
    <table class="header-table">
        <tr>
            <td width="50%" align="left">
                <b>Nama : <?= $siswa->nama_siswa ?></b>
            </td>
            <td width="50%" align="right">
                <b>NIS : <?= $siswa->nis ?></b>
            </td>
        </tr>
        <tr>
            <td width="50%" align="left">
                <b>Tahun Pelajaran : <?= $tahun_ajaran->tahun_ajaran ?></b>
            </td>
            <td width="50%" align="right">
                <b>Semester : <?= $tahun_ajaran->semester ?></b>
            </td>
        </tr>
    </table>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th colspan='2' class="title">I. Pencapaian Per Semester</th>
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
                        <p><?= "Mulai : " . $value->nama_surat1 . " Ayat : " . $value->ayat_mulai ?></p>
                        <p></p>
                    </div>
                    <div class="flex-content">
                        <p><?= "Selesai : " . $value->nama_surat2 . " Ayat : " . $value->ayat_selesai ?></p>
                    </div>
                </td>
                <td width="20%" align="center"><?= $value->nilai ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th colspan='2' class="title">II. Ujian dan Ijazah</th>
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
    <br>
    <table class="word-table" style="margin-bottom: 10px">
        <tr>
            <th colspan='2' class="title">III. Adab dan Akhlak</th>
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
        <tr>
            <td width="5%" align="center">2</td>
            <td width="75%">Tertib dan Disiplin</td>
            <td width="20%" align="center"><?= $tertib_disiplin ?></td>
        </tr>
    </table>

    <br>
    <p align="right">................... , ...................</p>
    <table class="ttd-table" style="margin-bottom: 10px">
        <tr>
            <td width="30%" align="center">
                <p></p>
                <h3>Orang Tua/Wali Murid</h3>
            </td>
            <td width="30%" align="center">
                <p></p>
                <h3>Walikelas</h3>
            </td>
            <td width="30%" align="center">

                <h3>Kepala Sekolah</h3>
            </td>
        </tr>
        <tr>
            <td width="30%" class="ttd-kolom" align="center">

            </td>
            <td width="30%" class="ttd-kolom" align="center">

            </td>
            <td width="30%" class="ttd-kolom" align="center">

            </td>
        </tr>
        <tr>
            <td width="30%" align="center">
                <h3></h3>
            </td>
            <td width="30%" align="center">
                <h3><?= $walikelas->nama_guru ?></h3>
            </td>
            <td width="30%" align="center">
                <h3><?= $sekolah->kepala_sekolah ?></h3>
            </td>
        </tr>
    </table>
</body>

</html>