<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">

          <div class="box-header">
            <h3 class="box-title">KELOLA DATA USER</h3>
          </div>

          <div class="box-body">
            <div class='row'>
              <div class='col-md-9'>
                <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('user/add'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
            </div>
            <div class=' col-md-3'>
                </div>
              </div>


              <div class="row" style="margin-bottom: 10px">
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">

                </div>
              </div>
              <div class="box-body" style="overflow-x: scroll; ">
                <table class="table table-bordered table-striped" id="table1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>Level</th>
                      <th>Guru Kelas</th>
                      <th>Wali Kelas</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($row->result() as $key => $value) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->username ?></td>
                        <td><?= $value->nama_role ?></td>
                        <?php if ($value->level == 1) { ?>
                          <td>Full Akses</td>
                          <td>Full Akses</td>
                        <?php } elseif ($value->level == 2) { ?>
                          <td><a href="<?= base_url() ?>user/akses_kelas_guru/<?= $value->user_id ?>" class="btn btn-success btn-xs"><i class=""></i><i class="fa fa-eye"></i></a></td>
                          <td><a href="<?= base_url() ?>user/akses_kelas_walikelas/<?= $value->user_id ?>" class="btn btn-success btn-xs"><i class=""></i><i class="fa fa-eye"></i></a></td>
                        <?php } elseif ($value->level == 3) { ?>
                          <td><a href="<?= base_url() ?>user/akses_kelas_guru/<?= $value->user_id ?>" class="btn btn-success btn-xs"><i class=""></i><i class="fa fa-eye"></i></a></td>
                          <td>-</td>
                        <?php } else { ?>
                          <td>-</td>
                          <td>-</td>
                        <?php } ?>

                        <td class="text-center" width="160px">
                          <form action="<?= site_url('user/del') ?>" method="post">
                            <a href="<?= site_url('user/edit/' . $value->user_id) ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            <input type="hidden" name="user_id" value="<?= $value->user_id ?>">
                            <button onclick="return confirm('Yakin Akan Hapus ?')" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    <?php
                    } ?>

                  </tbody>

                </table>


              </div>
            </div>
          </div>
        </div>
  </section>
</div>