<!DOCTYPE html>
 <html><head>
    <title>Raport Siswa</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 11px;
                text-align: center;
                line-height: 9px
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 6px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}/

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #a9a9a9;
                color: white;
                text-align: center;
            }
        </style>
</head><body >
    <table border="0" cellpadding="0" align="center">
                    <tr>
                        <td style="width: 20%;">
                            <img  width="135" height="105" src="admin/assets/img/sekolah/<?= $app_setting->logo_sekolah ?>"  >
                        </td>
                        <td style="width: 80%;text-align: center;">
                            <h2><?= $app_setting->nama_sekolah ?></h2>
                            <p style="padding: 5px"><?= $app_setting->alamat_sekolah ?></p>
                        </td>
                    </tr>
    </table><br>
    <hr>

<!--  -->
    <table id="table" style="text-align: left;">
                <tr>
                    <td style="border: 0 !important;">Nama : <?= $siswa->nama_siswa ?> </td>
                    <td style="border: 0 !important;" width="350px"></td>
                    <?php if ($semester==1) { ?>
                        <td style="border: 0 !important;"> <span style="margin-left: 180px">Semester : 1 / Ganjil</span></td>
                    <?php }else{ ?>
                        <td style="border: 0 !important;"> <span style="margin-left: 180px">Semester : 2 / Genap</span></td>
                    <?php } ?>
                    
                </tr>
                <tr>
                    <td style="border: 0 !important;">Kelas :</td>
                    <td style="border: 0 !important;" width="350px"></td>
                    <td style="border: 0 !important;"><span style="margin-left: 180px">Tahun Ajaran : <?= $tahun_ajaran->tahun_ajaran ?></span></td>
                </tr>
        </table>
        <br>
        <br>
        <span style="font-size: 12px"><b>A. Kemampuan Tahzin</b></span>
        <table id="table">
                <tr>
                    <th style="width: 200px">Jilid-Hal / Suroh-Ayat</th>
                    <th style="width: 70">Tartil</th>
                    <th>Pemahaman</th>
                    <th>Fashohah</th>
                    <th>Nilai Rata Rata</th>
                </tr>
                <tr>
                    <td scope="row">Pemahaman</td>
                    <td><?= $tahzin  != null ? $tahzin->tartil : '' ?></td>
                    <td><?= $tahzin  != null ? $tahzin->pemahaman : '' ?></td>
                    <td><?= $tahzin  != null ? $tahzin->pashohah : '' ?></td>
                    <?php if ($tahzin  != null) { ?>
                        <td><?= round(($tahzin->tartil + $tahzin->pemahaman + $tahzin->pashohah)/3,2);  ?></td>
                    <?php }else{ ?>
                        <td></td>
                    <?php } ?>
                    
                </tr>
        </table>
        <br>
        <br>

        <span style="font-size: 12px"><b>B. Kemampuan Tahfizh</b></span>
        <table id="table">
                <tr>
                    <th style="width: 10px">No.</th>
                    <th style="width: 167px">Surah</th>
                    <th style="width: 70">Tartil</th>
                    <th>Pemahaman</th>
                    <th>Fashohah</th>
                    <th>Nilai Rata Rata</th>
                </tr>
                <tr>
                    <td scope="row">1</td>
                    <td>Kacang</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                </tr>
        </table>
        <br>
        <br>

        <span style="font-size: 12px"><b>C. Penilaian Sikap</b></span>
        <table id="table">
                <tr>
                    <th style="width: 10px">No.</th>
                    <th style="width: 167px">Sikap</th>
                    <th style="width: 70">Nilai</th>
                    <th colspan="3">Keterangan</th>
                </tr>
                <tr>
                    <td scope="row">1</td>
                    <td>Tertib</td>
                    <td><?= $sikap  != null ? $sikap->tertib : '' ?></td>
                    <td colspan="3" rowspan="3"><?= $sikap  != null ? $sikap->keterangan : '' ?></td>
                </tr>
                <tr>
                    <td scope="row">2</td>
                    <td>Disiplin</td>
                    <td><?= $sikap  != null ? $sikap->disiplin : '' ?></td>
                </tr>
                <tr>
                    <td scope="row">3</td>
                    <td>Motivasi</td>
                    <td><?= $sikap  != null ? $sikap->motivasi : '' ?> </td>
                </tr>
        </table><br><br>
        <p style="text-align: right;font-size: 12px">Jakarta, <?= date('d-m-Y') ?></p>
        <table id="table">
                <tr>
                    <td style="border: 0 !important;">Wali Siswa</td>
                    <td style="border: 0 !important;">Guru Pembimbing</td>
                </tr>
                <tr>
                    <td style="border: 0 !important;" height="70px"></td>
                    <td style="border: 0 !important;" height="70px"><img src="admin/assets/img/ttd/<?= $hasil  != null ? $hasil->tanda_tangan : '' ?>" width="110px"></td>
                </tr>
                <tr>
                    <td style="border: 0 !important;" width="50%">__________________</td>
                    <td style="border: 0 !important;" width="50%"><?= $hasil  != null ? $hasil->nama_guru : '' ?></td>
                </tr>
        </table>
        <table id="table">
                <tr>
                    <td style="border: 0 !important;">Kepala Sekolah</td>
                </tr>
                <tr>
                    <td style="border: 0 !important;" height="70px"><img src="admin/assets/img/sekolah/<?= $app_setting->ttd_kepsek ?>" width="110px"></td>
                </tr>
                <tr>
                    <td style="border: 0 !important;" width="50%"><?= $app_setting->author ?></td>
                </tr>
        </table>



</html>





