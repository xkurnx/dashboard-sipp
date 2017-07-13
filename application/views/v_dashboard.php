    <div class="clearfix">
		
	<div class="row">
			
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
			<div class="small-box bg-green">
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
		
	</div>	<div class="row">
			<div class="col-lg-12">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <h3 class="panel-title pull-left">Delegasi Keluar (Sidang hari ini s.d 4 hari lagi)</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th width="15%">Nomor Perkara</th>
								<th width="10%">Tgl Sidang</th>		
								<th width="">PA Tujuan</th>
								<th width="">Tgl Kirim</th>
								<!-- <th width="5%">Pembuat</th>		-->					
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ( $delegasi_keluar as $row ):
							$pars = explode("/",$row['nomor_perkara']);
							$no_perk =  $pars[0].(str_replace('Pdt.','',$pars[1])).$pars[2];
							?>
							<tr>
								<td><?php echo $no_perk;?></td>
								<td><?php echo $row['tgl_sidang'];?></td>
								<td><?php echo $row['pn_tujuan_text'];?></td>
								<td><?php echo $row['tgl_pengiriman'];?></td>
							</tr>
							<?php
							endforeach;
							?>
						</tbody>
						
						<tbody>
					</table>
					
				
					</div>
				</div>		
				</div>
			</div>	
		</div>	
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <h3 class="panel-title pull-left">Delegasi Masuk (Sidang hari ini s.d 4 hari lagi)</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th width="15%">Nomor Perkara</th>
								<th width="10%">Tgl Sidang</th>		
								<th width="">PA Pengirim</th>
								<th width="">Tgl Kirim</th>
								<!-- <th width="5%">Pembuat</th>		-->					
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ( $delegasi_masuk as $row ):
							$pars = explode("/",$row['nomor_perkara']);
							$no_perk =  $pars[0].(str_replace('Pdt.','',$pars[1])).$pars[2];
							?>
							<tr>
								<td><?php echo $no_perk;?></td>
								<td><?php echo $row['tgl_sidang'];?></td>
								<td><?php echo $row['pn_asal_text'];?></td>
								<td><?php echo $row['tgl_pengiriman'];?></td>
							</tr>
							<?php
							endforeach;
							?>
						</tbody>
						
						<tbody>
					</table>
					
				
					</div>
				</div>		
				</div>
			</div>	
		</div>	
<br/>		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <h3 class="panel-title pull-left">Progress Penyelesaian Perkara per Ketua Majelis</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th width="35%">Ketua Majelis</th>
								<th width="10%">Progres Putus</th>
								<th width="10%">Sisa Thn Lalu</th>		
								<th width="10%">Terima</th>
								<th width="10%">Putus</th>
								<th width="10%">Minutasi</th>
								<th width="10%">Belum Putus</th>
								<!-- <th width="5%">Pembuat</th>		-->					
							</tr>
						</thead>
						<tbody>
							<?php
							#print_r($delegasi_keluar);	
							$j_sisa = 	$j_terima = 	$j_putus = 	$j_minutasi = $j_sisask = 0;
							foreach ( $progres_hakim as $row ):
							$j_sisa+=$row['sisa'];
							$j_terima+=$row['terima'];
							$j_putus+=$row['putus'];
							$j_minutasi+=$row['minutasi'];
							$j_sisask+=$row['sisask'];
							$progress = number_format($row['putus'] * 100 / ( $row['sisa'] + $row['terima'] ),2);
							if ( $progress < 50 ) { $warna = 'red' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
							else if ( $progress > 80 ) { $warna = 'green' ;}
							?>
							<tr>
								<td><?php echo ( $row['ketua'] == '' ) ? 'Blm ditentukan' : $row['ketua'];?>
												<div class="progress xs progress-striped active">
                                                    <div style="width: <?php echo $progress;?>%" class="progress-bar progress-bar-<?php echo $warna;?>"></div>
                                                </div>
												</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_hakim_detail/'.$row['id'].'/sisa');?>'><?php echo $row['sisa'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_hakim_detail/'.$row['id'].'/terima');?>'><?php echo $row['terima'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_hakim_detail/'.$row['id'].'/putus');?>'><?php echo $row['putus'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_hakim_detail/'.$row['id'].'/minutasi');?>'><?php echo $row['minutasi'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_hakim_detail/'.$row['id'].'/sisask');?>'><?php echo $row['sisask'];?></a></td>
							</tr>
							<?php
							endforeach;
							$progress = number_format($j_putus *100 / ($j_sisa+$j_terima),2);
							if ( $progress < 50 ) { $warna = 'green' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
							else if ( $progress > 80 ) { $warna = 'red' ;}
							?>
							
							<tr>
								<td>JUMLAH</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><?php echo $j_sisa;?></td>
								<td><?php echo $j_terima;?></td>
								<td><?php echo $j_putus;?></td>
								<td><?php echo $j_minutasi;?></td>
								<td><?php echo $j_sisask;?></td>
							</tr>
						</tbody>
						
						<tbody>
					</table>
					<span class="badge bg-red">dibawah 50%</span>
					<span class="badge bg-yellow">50 - 80%</span>
					<span class="badge bg-green"> diatas 80%</span>
				
					</div>
				</div>		
				</div>
			</div>	
		</div>	
	<br/>	
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <h3 class="panel-title pull-left">Progress Penyelesaian Perkara per Panitera Pengganti</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="35%">Panitera Pengganti</th>
								<th width="10%">Progres Minut</th>
								<th width="10%">Sisa Thn Lalu</th>		
								<th width="10%">Terima</th>
								<th width="10%">Putus</th>
								<th width="10%">Minutasi</th>
								<th width="10%">Belum Minutasi</th>
								<!-- <th width="5%">Pembuat</th>		-->					
							</tr>
						</thead>
						<tbody>
							<?php
							#print_r($delegasi_keluar);	
							$j_sisa = 	$j_terima = 	$j_putus = 	$j_minutasi = $j_sisask = 0;
							foreach ( $progres_pp as $row ):
							$j_sisa+=$row['sisa'];
							$j_terima+=$row['terima'];
							$j_putus+=$row['putus'];
							$j_minutasi+=$row['minutasi'];
							$j_sisask+=$row['sisask'];
							$progress = number_format($row['minutasi'] * 100 / ( $row['terima'] + $row['sisa']) ,2);
							if ( $progress < 50 ) { $warna = 'red' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
							else if ( $progress > 80 ) { $warna = 'green' ;}
							?>
							<tr>
								<td><?php echo ( $row['pp'] == '' ) ? 'Blm ditentukan' : $row['pp'];?>
												<div class="progress xs progress-striped active">
                                                    <div style="width: <?php echo $progress;?>%" class="progress-bar progress-bar-<?php echo $warna;?>"></div>
                                                </div>
												</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_pp_detail/'.$row['id'].'/sisa');?>'><?php echo $row['sisa'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_pp_detail/'.$row['id'].'/terima');?>'><?php echo $row['terima'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_pp_detail/'.$row['id'].'/putus');?>'><?php echo $row['putus'];?></a></td>
								<td><a href='<?php echo site_url('index.php/dashboard/progress_pp_detail/'.$row['id'].'/minutasi');?>'><?php echo $row['minutasi'];?></a></td>												<td><a href='<?php echo site_url('index.php/dashboard/progress_pp_detail/'.$row['id'].'/sisask');?>'><?php echo $row['sisask'];?></a></td>
							</tr>
							<?php
							endforeach;
							$progress = number_format($j_minutasi *100 / ($j_sisa+$j_terima),2);
							if ( $progress < 50 ) { $warna = 'red' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'red' ;}
							else if ( $progress > 80 ) { $warna = 'green' ;}
							?>
							
							<tr>
								<td>JUMLAH</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><?php echo $j_sisa;?></td>
								<td><?php echo $j_terima;?></td>
								<td><?php echo $j_putus;?></td>
								<td><?php echo $j_minutasi;?></td>
								<td><?php echo $j_sisask;?></td>
							</tr>
						</tbody>
						
						<tbody>
					</table>
					<span class="badge bg-red">dibawah 50%</span>
					<span class="badge bg-yellow">50 - 80%</span>
					<span class="badge bg-green"> diatas 80%</span>
				
					</div>
				</div>		
				</div>
			</div>	
		</div>	
		
		
    </div>
