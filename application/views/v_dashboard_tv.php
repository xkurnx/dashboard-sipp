    <div class="clearfix">
		
	<div class="row">
	
		<div class="carousel">
			
		<?php
		foreach ( $stat_perkara as $row ):
			
		endforeach;
		?>
		<div class="col-lg-3">
			<div class="small-box bg-green">
				<div class="inner">
					<h3 id="jml-total"><?php echo $stat_perkara[0]['terima'];?></h3>	
					Hari ini : <?php echo $stat_perkara[1]['terima'];?><br>
					Bulan ini : <?php echo $stat_perkara[2]['terima'];?>			
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-archive"></i>
				</div>
				<span class="small-box-footer"><strong>Terima Tahun ini</strong></span>
			</div>	
		</div>	
		<div class="col-lg-3">
			<div class="small-box" style="background:#256d38;color:white">
				<div class="inner">
					<h3 id="jml-total"><?php echo $stat_perkara[0]['minutasi'];?></h3>	
					Hari ini : <?php echo $stat_perkara[1]['minutasi'];?><br>
					Bulan ini : <?php echo $stat_perkara[2]['minutasi'];?>					
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-checkmark"></i>
				</div>
				<span class="small-box-footer">Minutasi Tahun ini</span>
			</div>	
		</div>	
		
		<div class="col-lg-3">
		<?php 
		$progress = number_format($stat_perkara[0]['minutasi']*100 / ($stat_perkara[0]['sisa'] + $stat_perkara[0]['terima']),2);
		if ( $progress < 50 ) { $warna = 'red' ;}
		else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
		else if ( $progress > 80 ) { $warna = 'green' ;}
		?>
			<div class="small-box bg-<?php echo $warna;?>">
				<div class="inner">
					<h3 id="jml-total"><?php echo $progress;?> %</h3>
Rumus : <br />Minut / ( Sisa + Terima) * 100%					
					<br>
								
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-speedometer"></i>
				</div>
				<span class="small-box-footer">Penyelesaian Perkara</span>
			</div>	
		</div>
		
		<div class="col-lg-3">
			<div class="small-box bg-aqua">
				<div class="inner">
					<?php 
					foreach ( $rekap_sidang  as $row ) { ?>
					<h3 id="jml-total"><?php echo ( $row['s_hari_ini'] == '' ) ? 0 : $row['s_hari_ini'];?></h3>					
					Sidang di PA : <?php echo $row['s_pa'];?><br>
					Sidang Keliling : <?php echo $row['sidkel'];?><br>	
					<?php }; ?>					
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-calendar"></i>
				</div>
				<span class="small-box-footer">Sidang Hari ini</span>
			</div>	
		</div>
		
		</div>	
	</div>
	<div class="row">
			<div class="col-lg-6">
				<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading">
					  <i class="fa fa-envelope"></i> Delegasi Masuk (Sidang hari ini s.d 21 hari kedepan)
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					
					
						<div style="">
							<span class="w20"><strong>Nomor Perkara</strong></span>
							<span class="w20"><strong>Tgl Sidang</strong></span>
							<span class="w40"><strong>PA Pengirim</strong></span>
							<span class="w20"><strong>Jurusita</strong></span>
						</div>
						<ul  class="nTicker nTicker1">
								<?php
								#print_r($delegasi_masuk);
								foreach ( $delegasi_masuk as $row ):
								$pars = explode("/",$row['nomor_perkara']);
								$no_perk =  $pars[0].(str_replace('Pdt.','',$pars[1])).$pars[2];
								?>
								
								
								<li>
									<span class="w20"><?php echo $no_perk;?></span>
									<span class="w20"><?php echo $row['tgl_sidang'];?></span>
									<span class="w40"><?php echo $row['pn_asal_text'];?></span>
									<span class="w20"><?php echo $row['jurusita_nama'];?></span>
								</li>
								
								<?php
								endforeach;
								?>
						</ul>
				
					</div>
				</div>		
				</div>
			</div>	
			
			<div class="col-lg-6">
				<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading">					
					 <i class="fa fa-envelope"></i> Delegasi Keluar (Sidang hari ini s.d 21 hari kedepan)
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					
					<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w20"><strong>Tgl Sidang</strong></span>
						<span class="w40"><strong>PA Tujuan</strong></span>
						<span class="w20"><strong>Tgl Kirim</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker1">
							<?php
							foreach ( $delegasi_keluar as $row ):
							$pars = explode("/",$row['nomor_perkara']);
							$no_perk =  $pars[0].(str_replace('Pdt.','',$pars[1])).$pars[2];
							?>
							
							
							<li>
								<span class="w20"><?php echo $no_perk;?></span>
								<span class="w20"><?php echo $row['tgl_sidang'];?></span>
								<span class="w40"><?php echo $row['pn_tujuan_text'];?></span>
								<span class="w20"><?php echo $row['tgl_pengiriman'];?></span>
							</li>
							<?php
							endforeach;
							?>
					</ul>
					
				
					</div>
				</div>		
				</div>
			</div>	
			
			
	</div>	
	
	<br />
	<div class="row">
			<div class="col-lg-6">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <i class="fa fa-building"></i> Ruang Sidang I
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					
					<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w50"><strong>Pihak Pertama</strong></span>
						<span class="w30"><strong>Agenda</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker2">
							<?php
							foreach ( $jadwal_sidang_1 as $row ):
							$pars = explode("/",$row['nomor_perkara']);
							$no_perk =  $pars[0].(str_replace('Pdt.','',$pars[1])).$pars[2];
							?>
							
							
							<li>
								<span class="w20"><?php echo $no_perk;?></span>
								<span class="w40"><?php echo $row['pihak1_text'];?></span>
								<span class="w40"><?php echo $row['agenda'];?></span>
							</li>
							<?php
							endforeach;
							?>
					</ul>
					
				
					</div>
				</div>		
				</div>
			</div>	
			
			<div class="col-lg-6">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <i class="fa fa-building"></i> Ruang Sidang II</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					
					
						<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w50"><strong>Pihak Pertama</strong></span>
						<span class="w30"><strong>Agenda</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker2">
							<?php
							foreach ( $jadwal_sidang_2 as $row ):
							$pars = explode("/",$row['nomor_perkara']);
							$no_perk =  $pars[0].(str_replace('Pdt.','',$pars[1])).$pars[2];
							?>
							
							
							<li>
								<span class="w20"><?php echo $no_perk;?></span>
								<span class="w50"><?php echo $row['pihak1_text'];?></span>
								<span class="w30"><?php echo $row['agenda'];?></span>
							</li>
							<?php
							endforeach;
							?>
					</ul>
				
					</div>
				</div>		
				</div>
			</div>	
	</div>
	
	
	<br />
	
	<div class="row">
			<div class="col-lg-6">
				<div class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
					 <i class="fa fa-line-chart"></i> Rekap Per Jenis Perkara
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					
					<div style="">
						<span class="w40"><strong>Jenis Perkara</strong></span>
						<span class="w20"><strong>Sisa</strong></span>
						<span class="w20"><strong>Terima</strong></span>
						<span class="w20"><strong>Putus</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker1">
							<?php
							foreach ( $rekap_jenis_perkara as $row ):
							?>
							
							
							<li>
								<span class="w40"><?php echo $row['jenis_perkara_text'];?></span>
								<span class="w20"><?php echo $row['sisa'];?></span>
								<span class="w20"><?php echo $row['terima'];?></span>
								<span class="w20"><?php echo $row['putus'];?></span>
							</li>
							<?php
							endforeach;
							?>
					</ul>
					
				
					</div>
				</div>		
				</div>
			</div>	
			
			<div class="col-lg-6">
				<div class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
					 <i class="fa fa-info-circle"></i> Informasi Sistem</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					
						
					<ul  class="nTicker">
							<?php
							foreach ( $sys_info as $row ):
							?>
							
							
							<li>
								<span class="w50"><?php echo $row['ket'];?></span>
								<span class="w30"><?php echo $row['val'];?></span>
							</li>
							<?php
							endforeach;
							?>
					</ul>
				
					</div>
				</div>		
				</div>
			</div>	
	</div>
		
		
<br/>		
		
	<br/>	
		<div class="row">
			
		</div>	
		
		
    </div>
	
