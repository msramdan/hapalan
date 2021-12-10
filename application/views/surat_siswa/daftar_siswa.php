<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">            
        </div>
            </div>
            <div class='col-md-3'>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll; ">
        <table class="table table-bordered" id="table3">
            <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php foreach ($siswa_data as $siswa) { ?>
                <tr>
                    <td width="10px"><?php echo ++$start ?></td>
                    <td><?php echo $siswa->nis ?></td>
                    <td><?php echo $siswa->nama_siswa ?></td>
                    <td><?php echo $siswa->nama_kelas ?></td>
                    <td><a href="<?= base_url() ?>surat_siswa/daftar_surah/<?php echo $siswa->siswa_id ?>/<?= $this->uri->segment(4) ?>/<?= $this->uri->segment(5) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Surat</a>
                </td>
                </tr>
            <?php } ?> 
        </table>
        </div>
        </div>
            </div>
            </div>
    </section>
</div>




