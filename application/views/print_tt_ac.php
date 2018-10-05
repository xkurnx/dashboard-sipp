<html>
<head>
<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/print.css">
</head>
<body>
	<div id="print">
		<div class="page">
			<h2>Formulir Permintaan Akta Cerai</h2>
			<br />Permintaan Akta Cerai<br />
			<div style="float:right;margin-right:30px">
					<img style="width:150px;" src="<?php echo base_url($data_req->url_photo);?>">	
				</div>	
			<div><label>Tanggal</label> : <?php echo $data_req->date_req_short;?></div>
			<div><label>No. Perkara</label> : <?php echo $data_req->nomor_perkara;?></div>
			
			<div><br />Kami menyampaikan kepada saudara/i </div>
			<div><label>Nama</label> : <?php echo $data_req->nama_pemohon;?></div>
			<div><label>Alamat</label> : <?php echo $data_req->alamat_pemohon;?></div>
			<div><label>Nomor Telp/email</label> : <?php echo $data_req->telp_pemohon;?></div>
			<br />
			<h4>Diberitahukan Sebagai berikut :</h4>
			<div><strong>B. Permintaan Akta Cerai Dapat diberikan :</strong>:
			<table>
				<tr><td>No.</td><td>Hal Terkait Permohonan Akta Cerai</td><td>Keterangan</td></tr>
				<tr><td>1</td><td>Bentuk Akta Cerai yang tersedia</td><td>[ &nbsp; ] Hardcopy</td></tr>
				<tr><td>2</td><td>Biaya yang dibutuhkan</td><td>[ &nbsp; ] PNBP  &nbsp;&nbsp;Rp. 5.000,-<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah &nbsp; Rp. 5.000,-</td></tr>
				<tr><td>3</td><td>Waktu penyediaan</td><td> ___ Hari</td></tr>			
			</table>
			</div>
			
			<br />	
			<div style="float:left;display:block">
					
				<div class="tab2">Kisaran, <?php echo $data_req->date_req_short;?><br />
				Pemohon
				<br /><br /><br />
				<?php echo $data_req->nama_pemohon;?>
				</div>
			</div>
		
		<div style="display: block;clear: both;"><br />
		---------------------------------------------------------------------------------------</div>
		<h2>Instrumen Penyerahan Akta Cerai Kepada <?php echo $data_req->nama_pemohon;?></h2>
		Sudah diterima Akta Cerai dari Pengadilan Agama Kisaran<br />
		<div><label>Nomor Perkara</label> : <?php echo $data_req->nomor_perkara;?></div>
		<div><label>Nomor Akta Cerai</label> : <?php echo $data_req->nomor_akta_cerai;?></div>
		<div><label>Nama Penggugat/Pemohon</label> : <?php echo $data_req->nama_pihak1;?></div>
		<div><label>Nama Tergugat/Termohon</label> : <?php echo $data_req->nama_pihak2;?></div>
		<br /><br />
		<div class="tab1"><br />Yang Menerima<br /><br /><br /><br /><?php echo $data_req->nama_pemohon;?></div>
		<div class="tab1">Kisaran, <?php echo $data_req->date_req_short;?><br />Petugas Meja III<br /><br /><br /><br />Ade liana, A.Md</div>
	</div>
</body>
</html>