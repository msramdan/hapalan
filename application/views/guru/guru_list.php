<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA GURU</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('guru/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('guru/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('guru/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('guru'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <div class="box-body" style="overflow-x: scroll;">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        		<th>Nip</th>
        		<th>Nama Guru</th>
        		<th>Jenis Kelamin</th>
        		<th>Alamat</th>>
        		<th>Action</th>
            </tr><?php
            foreach ($guru_data as $guru) { ?>
                <tr>
        			<td width="10px"><?php echo ++$start ?></td>
        			<td><?php echo $guru->nip ?></td>
        			<td><?php echo $guru->nama_guru ?></td>
        			<td><?php echo $guru->jenis_kelamin ?></td>
        			<td><?php echo $guru->alamat ?></td>
        			<td style="text-align:center" width="200px">
        				<?php 
        				echo anchor(site_url('guru/read/'.$guru->guru_id),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
        				echo '  '; 
        				echo anchor(site_url('guru/update/'.$guru->guru_id),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
        				echo '  '; 
        				echo anchor(site_url('guru/delete/'.$guru->guru_id),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
        				?>
        			</td>
        		</tr>
            <?php } ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>