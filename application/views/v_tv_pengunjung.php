    <div class="clearfix">

	<div class="row">
			<div class="col-lg-6">
				<?php
				if ( $this->config->item('jml_r_sidang') >= 2 ) :			
				?>
				
				<div class="panel-group">
				<div class="panel panel-green">
					<div class="panel-heading">
					 <i class="fa fa-building"></i> Ruang Sidang I
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body pstyle1">
					
					<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w50"><strong>Pihak Pertama</strong></span>
						<span class="w30"><strong>Agenda</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker5">
							<?php
							if (count($jadwal_sidang_1) > 0 ) :
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
							else :
							echo "-- Tidak ada sidang --";
							endif;
							?>
							
							
					</ul>
					
				
					</div>
				</div>		
				</div>
				<?php endif; ?>
			</div>	
			
			<div class="col-lg-6">
				<?php
				if ( $this->config->item('jml_r_sidang') >= 2 ) :			
				?>
				
				<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel-heading">
					 <i class="fa fa-building"></i> Ruang Sidang II</h3>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body pstyle1">
					
					
						<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w50"><strong>Pihak Pertama</strong></span>
						<span class="w30"><strong>Agenda</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker5">
							<?php
							if (count($jadwal_sidang_2) > 0 ) :
							foreach ( $jadwal_sidang_2 as $row ):
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
							else :
							echo "-- Tidak ada sidang --";
							endif;
							?>
					</ul>
				
					</div>
				</div>		
				</div>
				<?php
				endif;
				?>
			</div>	
	</div>
	
	
	<br />
	
	<div class="row">
			
			<div class="col-lg-6">
				<?php
				if ( $this->config->item('jml_r_sidang') == 1 ) :			
				?>
				
				<div class="panel-group">
				<div class="panel panel-green">
					<div class="panel-heading">
					 <i class="fa fa-building"></i> Ruang Sidang I
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body pstyle1">
					
					<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w50"><strong>Pihak Pertama</strong></span>
						<span class="w30"><strong>Agenda</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker5">
							<?php
							if (count($jadwal_sidang_1) > 0 ) :
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
							else :
							echo "-- Tidak ada sidang --";
							endif;
							?>
							
							
					</ul>
					
				
					</div>
				</div>		
				</div>
				<?php endif; ?>
				
				<?php
				if ( $this->config->item('jml_r_sidang') == 3 ) :			
				?>
				<div class="panel-group">
				<div class="panel panel-danger">
					<div class="panel-heading">
					 <i class="fa fa-building"></i> Ruang Sidang III
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body pstyle1">
					
					<div style="">
						<span class="w20"><strong>Nomor Perkara</strong></span>
						<span class="w50"><strong>Pihak Pertama</strong></span>
						<span class="w30"><strong>Agenda</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker5">
							<?php
							if (count($jadwal_sidang_3) > 0 ) :
							foreach ( $jadwal_sidang_3 as $row ):
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
							else :
							echo "-- Tidak ada sidang --";
							endif;
							?>
							
							
					</ul>
					
				
					</div>
				</div>					
				</div>
				<?php
				endif;
				?>
				
				<br />
				<div class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
					 <i class="fa fa-line-chart"></i> <a tabindex="0" onclick="toggleFullScreen()" href="javascript:;">Rekap Per Jenis Perkara</a>
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body  pstyle3">
					
					<div style="">
						<span class="w40"><strong>Jenis Perkara</strong></span>
						<span class="w20"><strong>Sisa</strong></span>
						<span class="w20"><strong>Terima</strong></span>
						<span class="w20"><strong>Putus</strong></span>
					</div>
					
					
					<ul  class="nTicker nTicker5">
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
				<div id="td"></div>	
				<div id="ts"></div>
			</div>
		
		
			<br/>		
		
			<br/>	
		<div class="row">
			
		</div>	
		
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel-group">	
				<div class="panel panel-danger">
					<div class="panel-body" style="background:#f2dede;padding:3px 10px;">
						 <span style="float:left;font-size:18px;margin-right:30px">
Sisa Panjar Perkara yang belum diambil
</span>
<marquee direction="up" scrollamount=1 style="float:left;width:900px;height:20px;font-size:18px;"> 
<table cellspacing="0" cellpadding="0">
<?php
foreach ($blm_psp as $r):
	echo "<tr><td width='30%'>".$r['nomor_perkara']."</td><td width='70%'>YUSNANI DEWI MANURUNG Binti JANUN MANURUNG</td><td>230,000</td></tr>";
endforeach;
?>
</table>
</marquee>
						 
					</div>
				</div>	
			</div>	
		</div>
	</div>	
	
	<br />
	<div class="row">
		<div class="col-lg-12">
			<div class="NTBawah"><marquee>
			Selamat Datang di  <?php
        echo $this->session->userdata('namaPN')." | ".$this->config->item('msg_running'); 
        ?></marquee>			
			</div>
		</div>	
		
    </div>
	
