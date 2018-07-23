    <div class="clearfix">
	
	<br />
	<div class="row">
			<div class="col-lg-6">
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
				<div class="panel panel-danger">
					<div class="panel-heading"> <i class="fa fa-list-alt"></i> Tata Tertib Persidangan
					 <div class="clearfix"></div>
					 </div>
					<div class="panel-body pstyle2 bgTatib">
					
					
					
					
					<ol type="1"  class="nTicker nTicker5">
							<li>Berpakaian Sopan, Rapi dan Menutup Aurat</li>
							<li>Dilarang membawa Sejata Api maupun Senjata Tajam</li>
							<li>Dilarang Makan dan Minum di Ruang Sidang</li>
							<li>Dilarang Berbicara kecuali diperintahkan Majelis Hakim</li>
					</ol>					
				
					</div>
				</div>					
				</div>
				
				<br />
				<div class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading">
					 <i class="fa fa-line-chart"></i> <a onclick="toggleFullScreen()">Rekap Per Jenis Perkara</a>
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
			<div class="NTBawah"><marquee>
			Selamat Datang di Pengadilan Agama Kisaran Kelas IB "Prima dalam Layanan Adil dalam Putusan"| 
			Sebelum sidang, pastikan diri anda telah mendaftar kepada petugas persidangan untuk didaftarkan pada di antrian sidang | 
			Jagalah Kebersihan dan buanglah sampah pada tempatnya | 
			Kawasan Bebas Rokok dan dilarang keras Merokok di kawasan ini| 
			Pastikan Kendaraan anda telah terkunci dan parkir pada tempatnya | 	
			</marquee>			
			</div>
		</div>	
		
    </div>
	
