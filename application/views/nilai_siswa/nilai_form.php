<div class="content-wrapper">

	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">INPUT DATA NILAI</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">

				<table class='table table-bordered>'>
					<tr>
						<td width='200'>Siswa<?php echo form_error('siswa_id') ?></td>
						<td><select name="siswa_id" class="form-control">
								<option value="">-- Pilih -- </option>
								<?php foreach ($siswa_list as $key => $data) {
								?>
									<?php if ($data->siswa_id == $siswa_id) { ?>
										<option value="<?php echo $data->siswa_id ?>" selected><?php echo $data->nama_siswa ?></option>
									<?php } else { ?>
										<option value="<?php echo $data->siswa_id ?>"><?php echo $data->nama_siswa ?></option>
									<?php } ?>
								<?php } ?>
							</select></td>
					</tr>
					<tr>
						<td width='200'>Surat Mulai<?php echo form_error('surat_id_mulai') ?></td>
						<td><select name="surat_id_mulai" class="form-control">
								<option value="">-- Pilih -- </option>
								<?php foreach ($surat_list as $key => $data) {
								?>
									<?php if ($data->surat_id == $surat_id_mulai) { ?>
										<option value="<?php echo $data->surat_id ?>" selected><?php echo $data->surat_indonesia ?></option>
									<?php } else { ?>
										<option value="<?php echo $data->surat_id ?>"><?php echo $data->surat_indonesia ?></option>
									<?php } ?>
								<?php } ?>
							</select></td>
					</tr>
					<tr>
						<td width='200'>Surat Selesai<?php echo form_error('surat_id_selesai') ?></td>
						<td><select name="surat_id_selesai" class="form-control">
								<option value="">-- Pilih -- </option>
								<?php foreach ($surat_list as $key => $data) {
								?>
									<?php if ($data->surat_id == $surat_id_selesai) { ?>
										<option value="<?php echo $data->surat_id ?>" selected><?php echo $data->surat_indonesia ?></option>
									<?php } else { ?>
										<option value="<?php echo $data->surat_id ?>"><?php echo $data->surat_indonesia ?></option>
									<?php } ?>
								<?php } ?>
							</select></td>
					</tr>
					<tr>
						<td width='200'>Ayat Mulai <?php echo form_error('ayat_mulai') ?></td>
						<td><input type="text" class="form-control" name="ayat_mulai" id="ayat_mulai" placeholder="Ayat Halaman" value="<?php echo $ayat_mulai; ?>" /></td>
					</tr>
					<tr>
						<td width='200'>Ayat Selesai <?php echo form_error('ayat_selesai') ?></td>
						<td><input type="text" class="form-control" name="ayat_selesai" id="ayat_selesai" placeholder="Ayat Halaman" value="<?php echo $ayat_selesai; ?>" /></td>
					</tr>
					<tr>
						<td width='200'>Nilai <?php echo form_error('nilai') ?></td>
						<td><input type="text" class="form-control" name="nilai" id="nilai" placeholder="Nilai" value="<?php echo $nilai; ?>" /></td>
					</tr>
					<tr>
						<td width='200'>Tahun Ajaran<?php echo form_error('tahun_ajaran_id') ?></td>
						<td><select name="tahun_ajaran_id" class="form-control">
								<option value="">-- Pilih -- </option>
								<?php foreach ($tahunajaran_list as $key => $data) {
								?>
									<?php if ($data->tahun_ajaran_id == $tahun_ajaran_id) { ?>
										<option value="<?php echo $data->tahun_ajaran_id ?>" selected><?php echo $data->tahun_ajaran . ' | Semester ' . $data->semester ?></option>
									<?php } else { ?>
										<option value="<?php echo $data->tahun_ajaran_id ?>"><?php echo $data->tahun_ajaran . ' | Semester ' . $data->semester ?></option>
									<?php } ?>
								<?php } ?>
							</select></td>
					</tr>
					<tr>
						<td width='200'>Tanggal <?php echo form_error('tanggal') ?></td>
						<td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="hidden" name="nilai_id" value="<?php echo $nilai_id; ?>" />
							<input type="hidden" name="kelas_id" value="<?php echo $kelas_id; ?>" />
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button>
							<a href="<?php echo site_url('nilai_siswa/index/' . $kelas_id) ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
</div>
</div>