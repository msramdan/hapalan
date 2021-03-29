    <section class="content">
      <?php $this->view('messages') ?>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Nilai</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="table1">
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

          </table>

        </div>

    </section>