
      <section class="content">
      <div class="box">
          <div class="box-body table-responsive">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Akses kelas Untuk WALI KELAS : <b><?php echo $user['username'] ?></b> </h3>
            </div>
            <style type="text/css">
              .warna{
                color: #FF0000;
              }
            </style>
            <form action="<?= base_url() ?>user/tambah_akses_walikelas/<?php echo $this->uri->segment(3) ?>" method="post">
              <div class="form-group ">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                    <label for="kelas_id">kelas</label>
                    <select name="kelas_id" class="form-control" required="">
                      <option value="">-- Pilih -- </option>
                      <?php foreach ($kelas as $key => $data) { ?>
                         <?php if ($row->kelas_id==$data->kelas_id) { ?>
                        <option value="<?php echo $data->kelas_id?>" selected><?php echo $data->nama_kelas ?></option>    
                        <?php }else{ ?>
                        <option value="<?php echo $data->kelas_id?>"><?php echo $data->nama_kelas ?></option>      
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
              
              <div class="box-footer">
                <button type="submit" name="add_akses" class="btn btn-success btn"><i class="fa fa-paper-plane"></i> Tambah Akses</button>
              </div>
            </form>
            <table class="table table-bordered table-striped" id="table1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kelas</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $value) {?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$value->nama_kelas?></td>
                    <td class="text-center" width="160px">                     
                      <a href="<?= base_url() ?>user/del_akses_walikelas/<?=$value->akses_kelas_walikelas_id ?>/<?=$value->user_id ?>" onclick="return confirm('Yakin Akan Hapus ?')" class ="btn btn-danger btn-xs"><i class="fa fa-trash"></i>Delete</a>
                       
                        
                    </form>
                    </td> 
                  </tr>
                  <?php  
                } ?>
               
              </tbody>
              
            </table>
            
          </div>
</div>
</section>
            