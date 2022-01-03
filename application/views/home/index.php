
<?php if ($this->fungsi->user_login()->level =="ADMIN") { ?>
	<div class="row">
							<div class="col-md-3 col-sm-6">
								<div class="widget widget-metric_1 animate">
									<span class="icon-wrapper custom-bg-orange"><i class="fa fa-list"></i></span>
									<div class="right">
										<span class="value"><?=$this->fungsi->count_guru() ?> Data </span>
										<span class="title">GURU
											
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget widget-metric_1 animate">
									<span class="icon-wrapper custom-bg-lightseagreen"><i class="fa fa-list"></i></span>
									<div class="right">
										<span class="value"><?=$this->fungsi->count_siswa() ?> Data </span>
										<span class="title">SISWA
											
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget widget-metric_1 animate">
									<span class="icon-wrapper custom-bg-blue2"><i class="fa fa-users"></i></span>
									<div class="right">
										<span class="value"><?=$this->fungsi->count_kelompok() ?> Data</span>
										<span class="title">KELOMPOK
											
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget widget-metric_1 animate">
									<span class="icon-wrapper custom-bg-purple"><i class="fa fa-user"></i></span>
									<div class="right">
										<span class="value"><?=$this->fungsi->count_user() ?> Data </span>
										<span class="title">USER
										</span>
									</div>
								</div>
							</div>
						</div>
						<center>
							<img style="width: 50%" src="<?= base_url() ?>admin/assets/img/home2.png" alt="">
						</center>
					<?php }else{ ?>
						<div class="row">
							<div class="col-md-3 col-sm-6 col-sm-offset-3">
								<div class="widget widget-metric_1 animate">
									<span class="icon-wrapper custom-bg-lightseagreen"><i class="fa fa-list"></i></span>
									<div class="right">
										<span class="value"><?=$this->fungsi->count_siswa_guru() ?> Data </span>
										<span class="title">SISWA
											
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="widget widget-metric_1 animate">
									<span class="icon-wrapper custom-bg-blue2"><i class="fa fa-users"></i></span>
									<div class="right">
										<span class="value"><?=$this->fungsi->count_kelompok_guru() ?> Data</span>
										<span class="title">KELOMPOK
											
										</span>
									</div>
								</div>
							</div>
						</div>
						<center>
							<img style="width: 50%" src="<?= base_url() ?>admin/assets/img/home2.png" alt="">
						</center>
<?php } ?>
				

						