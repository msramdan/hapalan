    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Nilai</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="table1">
            <?php if ($this->fungsi->user_login()->level != '4') { ?>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kelas</th>
                  <th>View Data Kelas</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row as $key => $value) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value->nama_kelas ?></td>
                    <td><a href="<?= site_url('nilai_ujian/index/' . $value->kelas_id) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i>View</a></td>
                  </tr>
                <?php
                } ?>
              </tbody>
            <?php } else if ($this->fungsi->user_login()->level == '4') { ?>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tahun Ajaran</th>
                  <th>Juz</th>
                  <th>Akumulasi</th>
                  <th>Nilai</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row as $key => $value) { ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $value->tahun_ajaran . ' | Semester ' . $value->semester ?></td>
                    <td><?= $value->juz ?></td>
                    <td><?= $value->akumulasi ?></td>
                    <td><?= $value->nilai ?></td>
                    <td><?= $value->tanggal ?></td>
                    <td><a href="<?= site_url('nilai/read_ujian_siswa/' . $value->nilai_id) ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i>View</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            <?php } ?>
          </table>

        </div>

    </section>