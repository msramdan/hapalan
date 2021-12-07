<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA SISWA</h3>
                    </div>
        
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
                            <div class="form-group">

                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new"><i class="fa fa-upload" aria-hidden="true"></i> Import Nilai Tahzin & Tahfizh </a>  

                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_new2"><i class="fa fa-upload" aria-hidden="true"></i> Import Nilai Sikap</a>   
                                
                            </div>
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
                    <td><a href="<?= base_url() ?>penilaian/data/<?php echo $siswa->siswa_id ?>" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Nilai</a>
                    <a href="<?= base_url() ?>penilaian/data/<?php echo $siswa->siswa_id ?>" class="btn btn-default btn-sm"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
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

<!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="modal_add_new" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Nilai Tahzin & Tahfizh</h3>
                <a href="files/Format Import Guru.xlsx"><i class="fa fa-file-excel-o faa-pulse animated"></i> &nbsp;Klik untuk Generate Format</a>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php base_url() ?>import/import">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">File Upload</label>
                    <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required="">
                </div>
                <input type="submit" class="btn btn-primary" value="Import" name="import" />
            </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="modal_add_new2" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Import Nilai Sikap</h3>
                <a href="<?= base_url() ?>penilaian/excel_sikap/<?= $this->uri->segment(3) ?>"><i class="fa fa-file-excel-o faa-pulse animated"></i> &nbsp;Klik untuk Generate Format</a>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>import/import_nilai_sikap">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputFile">File Upload</label>
                    <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required="">
                </div>
                <input type="submit" class="btn btn-primary" value="Import" name="import" />
            </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->

