<ul class="nav nav-pills" role="tablist">
	<li class="active"><a href="#chart1" role="tab" data-toggle="tab" aria-expanded="true"> Nilai Tahzin</a></li>
	<li class=""><a href="#chart2" role="tab" data-toggle="tab" aria-expanded="false"> Nilai Tahfizh</a></li>
	<li class=""><a href="#chart3" role="tab" data-toggle="tab" aria-expanded="false"> Nilai Sikap</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane fade active in" id="chart1">
		<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        		<th>Jilid - Hal / Suroh - Ayat</th>
        		<th>Tartil</th>
        		<th>Pemahaman</th>
        		<th>Fashohah</th>
                <th>Nilai Rata Rata</th>
            </tr>
        </table>
	</div>
	<div class="tab-pane fade active" id="chart2">
		<table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        		<th>Surat</th>
        		<th>Tartil</th>
        		<th>Pemahaman</th>
        		<th>Fashohah</th>
                <th>Nilai Rata Rata</th>
            </tr>
        </table>
	</div>
	<div class="tab-pane fade active" id="chart3">
        <?php
            $queryData = "SELECT * from sikap where siswa_id='$siswa_id' and semester='1'";
            $data = $this->db->query($queryData)->row();
        ?>

        <h3>Semester 1</h3>

        <?php if ($data==NUll) { ?>
            <table class="table table-bordered table-xs" style="margin-bottom: 10px">
            <tr>
                <th style="text-align:center; width: 20%">Sikap</th>
                <th style="text-align:center; width: 10%">Nilai</th>
                <th style="text-align:center">Keterangan</th>
            </tr>
            <tr>
                <th>Tertib</th>
                <th style="text-align:center">-</th>
                <th style="vertical-align: middle;" rowspan="3"> -</th>
            </tr>
            <tr>
                <th>Disiplin</th>
                <th style="text-align:center">-</th>
            </tr>
            <tr>
                <th>Motivasi</th>
                <th style="text-align:center">-</th>
            </tr>
        </table><br>

        <?php }else{ ?>
            <table class="table table-bordered table-xs" style="margin-bottom: 10px">
            <tr style="width: 20%">
                <th style="text-align:center; width: 20%">Sikap</th>
                <th style="text-align:center; width: 10%">Nilai</th>
                <th style="text-align:center">Keterangan</th>
                <th style="text-align:center">Action</th>
            </tr>
            <tr>
                <th>Tertib</th>
                <th style="text-align:center"><?= $data->tertib ?></th>
                <th style="vertical-align: middle;" rowspan="3"> <?= $data->keterangan ?></th>
                <th style="vertical-align: middle;" rowspan="3"> <a href="<?= base_url() ?>penilaian/del_sikap/<?= $data->sikap_id  ?>/<?= $this->uri->segment(3) ?>" class="btn btn-danger btn-sm" delete=""><i class="fa fa-trash-o" aria-hidden="true"></i></a></th>
            </tr>
            <tr>
                <th>Disiplin</th>
                <th style="text-align:center"><?= $data->disiplin ?></th>
            </tr>
            <tr>
                <th>Motivasi</th>
                <th style="text-align:center"><?= $data->motivasi ?></th>
            </tr>
        </table><br>

        <?php } ?>


		
        <h3>Semester 2</h3>
        <?php
            $queryData2 = "SELECT * from sikap where siswa_id='$siswa_id' and semester='2'";
            $data2 = $this->db->query($queryData2)->row();

        ?>

        <?php if ($data2==NUll) { ?>
            <table class="table table-bordered table-xs" style="margin-bottom: 10px">
            <tr style="width: 20%">
                <th style="text-align:center; width: 20%">Sikap</th>
                <th style="text-align:center; width: 10%">Nilai</th>
                <th style="text-align:center">Keterangan</th>
            </tr>
            <tr>
                <th>Tertib</th>
                <th style="text-align:center">-</th>
                <th style="vertical-align: middle;" rowspan="3"> -</th>
            </tr>
            <tr>
                <th>Disiplin</th>
                <th style="text-align:center">-</th>
            </tr>
            <tr>
                <th>Motivasi</th>
                <th style="text-align:center">-</th>
            </tr>
        </table>
           
        <?php }else{ ?>
            <table class="table table-bordered table-xs" style="margin-bottom: 10px">
            <tr  style="width: 20%">
                <th style="text-align:center; width: 20%">Sikap</th>
                <th style="text-align:center; width: 10%">Nilai</th>
                <th style="text-align:center">Keterangan</th>
                <th style="text-align:center">Action</th>
            </tr>
            <tr>
                <th>Tertib</th>
                <th style="text-align:center"><?= $data2->tertib ?></th>
                <th style="vertical-align: middle;" rowspan="3"> <?= $data2->keterangan ?></th>
                <th style="vertical-align: middle;" rowspan="3"><a href="<?php base_url() ?>penilaian/del_sikap/<?= $data->sikap_id  ?>/<?= $this->uri->segment(3) ?>" class="btn btn-danger btn-sm" delete=""><i class="fa fa-trash-o" aria-hidden="true"></i></a></th>
            </tr>
            <tr>
                <th>Disiplin</th>
                <th style="text-align:center"><?= $data2->disiplin ?></th>
            </tr>
            <tr>
                <th>Motivasi</th>
                <th style="text-align:center"><?= $data2->motivasi ?></th>
            </tr>
        </table>

        <?php } ?>
        
	</div>
</div>