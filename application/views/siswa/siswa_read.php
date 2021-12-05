<div class="content-wrapper">
        <section class="content">
            <div class="box">
    <body>
        <h2 style="margin-top:0px">Siswa Read</h2>
        <table class="table">
	    <tr><td>Nis</td><td><?php echo $nis; ?></td></tr>
	    <tr><td>Nama Siswa</td><td><?php echo $nama_siswa; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
	    <tr><td>Nama Ibu</td><td><?php echo $nama_ibu; ?></td></tr>
	    <tr><td>Nama Ayah</td><td><?php echo $nama_ayah; ?></td></tr>
	    <tr><td>No Hp Wali Murid</td><td><?php echo $no_hp_wali_murid; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('siswa?kelas_id=' .$this->uri->segment(4)) ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
    </div>
    </section>
</div>