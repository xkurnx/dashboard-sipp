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

	</div>
<!--	<div class="row">
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
								<!-- <th width="5%">Pembuat</th>
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
		</div>	-->

<!--		<div class="row">
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
								<!-- <th width="5%">Pembuat</th>
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
		</div>	-->
<br/>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-group">
				<div class="panel panel-success">
					<div class="panel-heading">
					 <h3 class="panel-title pull-left">Proses Penanganan Perkara Belum Diputus per Ketua Majelis</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th width="35%">Ketua Majelis</th>
								<th width="10%">Beban Ditangani</th>
								<th width="10%">Kurang dari 4 Bln</th>
								<th width="10%">Perkara 4-5 Bln</th>
								<th width="10%">Perkara 6-12 Bln</th>
								<th width="10%">Lebih dari 12 Bln</th>
								<!-- <th width="5%">Pembuat</th>		-->
							</tr>
						</thead>
						<tbody>
							<?php
							#print_r($delegasi_keluar);
							$j_baik = 	$j_kurang = 	$j_sangat = 	$j_bahaya =  	$j_total_hakim =0;#  	$j_total_perkara =0;
foreach ( $process_hakim_total as $row ):
endforeach;
$j_total_hakim=$row['total_hakim'];

#foreach ( $process_perkara_masuk as $row ):
#endforeach;
#$j_total_perkara=$row['masuk'];


							foreach ( $process_hakim as $row ):
							$j_baik+=$row['baik'];
							$j_kurang+=$row['kurang'];
							$j_sangat+=$row['sangat'];
							$j_bahaya+=$row['bahaya'];

$progress = number_format((($row['sangat'] + $row['bahaya'])/($row['baik'] + $row['kurang'] + $row['sangat'] + $row['bahaya'])) * 100, 2);
							if ( $progress < 50 ) { $warna = 'green' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
							else if ( $progress > 80 ) { $warna = 'red' ;}

							// klo ketua majelis belum ditentukan
                            if ( $row['ketua'] == '' ) {
                                $id_km = 0;
							}else {
                                $id_km =$row['id'];
							}
							?>

							<tr>
								<td><?php echo ( $row['ketua'] == '' ) ? 'Blm ditentukan' : $row['ketua'];?>
												<div class="progress xs progress-striped active">
                                                    <div style="width: <?php echo $progress;?>%" class="progress-bar progress-bar-<?php echo $warna;?>"></div>
                                                </div>
												</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><a href='<?php echo site_url('index.php/perkara/process_hakim_detail/'.$id_km.'/baik');?>'><?php echo $row['baik'];?></a></td>
								<td><a href='<?php echo site_url('index.php/perkara/process_hakim_detail/'.$id_km.'/kurang');?>'><?php echo $row['kurang'];?></a></td>
								<td><a href='<?php echo site_url('index.php/perkara/process_hakim_detail/'.$id_km.'/sangat');?>'><?php echo $row['sangat'];?></a></td>
								<td><a href='<?php echo site_url('index.php/perkara/process_hakim_detail/'.$id_km.'/bahaya');?>'><?php echo $row['bahaya'];?></a></td>
							</tr>
							<?php
							endforeach;

$progress = number_format((($j_sangat + $j_bahaya ) / $j_total_hakim) * 100, 2);
							if ( $progress < 50 ) { $warna = 'green' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
							else if ( $progress > 80 ) { $warna = 'red' ;}
							?>

							<tr>
								<td>JUMLAH</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><?php echo $j_baik;?></td>
								<td><?php echo $j_kurang;?></td>
								<td><?php echo $j_sangat;?></td>
								<td><?php echo $j_bahaya;?></td>
							</tr>
						</tbody>

						<tbody>
					</table>
					<span class="badge bg-green">dibawah 50%</span>
					<span class="badge bg-yellow">50 - 80%</span>
					<span class="badge bg-red"> diatas 80%</span>

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
					 <h3 class="panel-title pull-left">Proses Penanganan Perkara Diputus per Ketua Majelis</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="35%">Ketua Majelis</th>
								<th width="10%">Kinerja Hakim</th>
								<th width="10%">Kurang dari 4 Bln</th>
								<th width="10%">Perkara 4-5 Bln</th>
								<th width="10%">Perkara 6-12 Bln</th>
								<th width="10%">Lebih dari 12 Bln</th>
								<!-- <th width="5%">Pembuat</th>		-->
							</tr>
						</thead>
						<tbody>
							<?php
							#print_r($delegasi_keluar);
							$j_baik = 	$j_kurang = 	$j_sangat = 	$j_bahaya =  	$j_total_hakim =  	$j_total_perkara =0;
							$j_sisa_baik = 	$j_sisa_kurang = 	$j_sisa_sangat = 	$j_sisa_bahaya =0;

foreach ( $selesai_hakim_total as $row ):
endforeach;
$j_total_hakim=$row['total_hakim_selesai'];


foreach ( $process_perkara_masuk as $row ):
endforeach;
$j_total_perkara=$row['masuk'];


							foreach ( $selesai_hakim as $row ):
							$j_baik+=$row['baik'];
							$j_kurang+=$row['kurang'];
							$j_sangat+=$row['sangat'];
							$j_bahaya+=$row['bahaya'];

							$j_sisa_baik+=$row['sisa_baik'];
							$j_sisa_kurang+=$row['sisa_kurang'];
							$j_sisa_sangat+=$row['sisa_sangat'];
							$j_sisa_bahaya+=$row['sisa_bahaya'];

$progress = number_format(($row['baik'] + $row['kurang'] + $row['sangat'] + $row['bahaya']) / (($row['baik'] + $row['kurang'] + $row['sangat'] + $row['bahaya']) + ($row['sisa_baik'] + $row['sisa_kurang'] + $row['sisa_sangat'] + $row['sisa_bahaya'])) * 100 , 2);
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
								<td><a href='<?php echo site_url('index.php/perkara/selesai_hakim_detail/'.$row['id'].'/baik');?>'><?php echo $row['baik'];?></a></td>
								<td><a href='<?php echo site_url('index.php/perkara/selesai_hakim_detail/'.$row['id'].'/kurang');?>'><?php echo $row['kurang'];?></a></td>
								<td><a href='<?php echo site_url('index.php/perkara/selesai_hakim_detail/'.$row['id'].'/sangat');?>'><?php echo $row['sangat'];?></a></td>
								<td><a href='<?php echo site_url('index.php/perkara/selesai_hakim_detail/'.$row['id'].'/bahaya');?>'><?php echo $row['bahaya'];?></a></td>
							</tr>
							<?php
							endforeach;


$progress = number_format((($j_baik + $j_kurang + $j_sangat + $j_bahaya)/($j_total_perkara)) * 100, 2);
							if ( $progress < 50 ) { $warna = 'red' ;}
							else if ( $progress >= 50 && $progress < 80 ) { $warna = 'yellow' ;}
							else if ( $progress > 80 ) { $warna = 'green' ;}
							?>

							<tr>
								<td>JUMLAH</td>
								<td><span class="badge bg-<?php echo $warna;?>"><?php echo $progress;?>%</span></td>
								<td><?php echo $j_baik;?></td>
								<td><?php echo $j_kurang;?></td>
								<td><?php echo $j_sangat;?></td>
								<td><?php echo $j_bahaya;?></td>
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

