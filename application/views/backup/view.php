
            <div class="panel-body">
              <div class="alert alert-success alert-dismissible fade in" role="alert" style="display: none;" id="alert-box">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <p>Berhasil mencadangkan database</p>
              </div>
              <center>
                <a href="<?= site_url() ;?>backup/file" class="btn btn-primary btn-raised btn-lg" onclick="alert()"><i class="fa fa-download"></i> Back Up DataBase</a>
              </center>
            </div>
<script type="text/javascript">
  function alert() {
    $("#alert-box").css({"display":"block"});
  }
</script>