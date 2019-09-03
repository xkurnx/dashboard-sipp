
<div class="row frmAC">

<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#"><?php echo $title;?></span>
		</div>
	</div><!-- /.container -->
</div>

<div class="row-fluid well" style="overflow: hidden;">

	<div class="col-md-12">
	<div class="container">	
	<table class="table-form">
		<tr>
			<td>Nomor Perkara</td>
			<td>
				<input class="form-control pull-left" style="width:80px" size="5" type="text" name="no_perk"> 
				<label class="pull-left"> / Pdt.G/ </label>
				<select name="no_perk_tahun" class="form-control pull-left" required="" style="width: 100px" tabindex="6">
					
					<?php 
					$thn_skrg = date('Y');
					for ($tahun = $thn_skrg; $tahun>=$thn_skrg-3; $tahun--){
						echo '<option value="'.$tahun.'">'.$tahun.'</option>';
					} ?>
				</select>
				<button type="button" href="javascript:;" onclick="ac_cek_data()" class="btn btn-primary mb-2">Lihat</button>
			</td>
		</tr>
	</table>
	<?php if (isset($info_perkara)): ?>
	<h3>Informasi Perkara</h3>
	<?php #print_r($info_perkara); ?>
	<div class="col-md-12">	
	<table class="table-form">
		<tr>
			<td style="width:15%">Nama Pihak P</td>
			<td><strong><?php echo $info_perkara->pihak1_text;?></strong></td>
		</tr>
		<tr>
			<td>Nama Pihak T</td>
			<td><strong><?php echo $info_perkara->pihak2_text;?></strong></td>
		</tr>
		<tr>
			<td>Tgl Putusan</td>
			<td><label class="label_tgl_putusan"><?php echo $info_perkara->tanggal_putusan;?></label></td>
		</tr>
		<tr>
			<td>Amar Putusan</td>
			<td><?php echo $info_perkara->amar_putusan;?></td>
		</tr>
	</table>
	<div class="col-md-9">	
	<table class="table-form">
	<form id="formReq">
	<input type="hidden" name="perkara_id" value="<?php echo $info_perkara->perkara_id;?>">
	<input type="hidden" name="nomor_perkara" value="<?php echo $nomor_perkara;?>">
	<input type="hidden" name="nama_pihak1" value="<?php echo $info_perkara->pihak1_text;?>">
	<input type="hidden" name="nama_pihak2" value="<?php echo $info_perkara->pihak2_text;?>">
	<tr>
			<td style="width:20%">Nomor Akta Cerai</td>
			<td><input class="form-control" name='nomor_akta_cerai' class="nomor_akta_cerai" value="<?php echo $info_perkara->nomor_akta_cerai;?>"></td>
		</tr>
		<tr>
			<td style="width:20%">Silahkan Pilih Para Pihak</td>
			<td><select class="form-control" name="ac_pihak_pengambil">
				<option value=''> -- Silahkan Pilih --</option>
				<option value='<?php echo $info_perkara->pihak1_text;?>'><?php echo $info_perkara->pihak1_text;?></option>
				<option value='<?php echo $info_perkara->pihak2_text;?>'><?php echo $info_perkara->pihak2_text;?></option>
				</select></td>
		</tr>
		<tr>
			<td style="width:20%">Pemohon</td>
			<td><input class="form-control" name='ac_nama_pemohon' class="ac_nama_pemohon"></td>
		</tr>
		<tr>
			<td style="width:20%">Alamat</td>
			<td><input class="form-control" name='ac_alamat_pemohon' class="ac_alamat_pemohon"></td>
		</tr>
		<tr>
			<td style="width:20%">No. Telp / Email</td>
			<td><input class="form-control" name='ac_telp_email' class="ac_telp_email"></td>
		</tr>
		
		<tr><td></td><td><span id="downloadLink"></span><input type="button" id="btnSaveData" value="Simpan Data" onClick="SaveData()"></td></tr>
	</form>
	</table>	
	</div>
	
	<div class="col-md-3" id="camArea">
		<b>Preview Foto</b>
		<div id="preview_camera"></div>
		<div id="results"></div>
			<input type="button" id="btnTakePhoto" value="Ambil Foto" onClick="TakePhoto()">	
			<input type="button" id="btnResetPhoto" value="Reset Foto" onClick="ResetPhoto()">
			
	</div>	
		
	
	</div>
	<?php endif;?>	
	
	
					

		
	</div>
	
		
	</div>
</div>	
</div>		