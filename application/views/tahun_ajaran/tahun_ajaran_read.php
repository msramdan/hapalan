<div class="content-wrapper">
        <section class="content">
            <div class="box">
    <body>
        <h2 style="margin-top:0px">Tahun_ajaran Read</h2>
        <table class="table">
	    <tr><td>Tahun Ajaran</td><td><?php echo $tahun_ajaran; ?></td></tr>
        <?php if ($status =='1') { ?>
            <tr><td>Status</td><td>Aktif</td></tr>
        <?php }else{ ?>
            <tr><td>Status</td><td>Non Aktif</td></tr>
        <?php } ?>
	    
	    <tr><td></td><td><a href="<?php echo site_url('tahun_ajaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
    </div>
    </section>
</div>