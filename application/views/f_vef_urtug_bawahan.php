<div class="clearfix">

<?php echo $this->session->flashdata("k");?>
	
<!--	
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Well done!</strong> You successfully read <a href="http://bootswatch.com/amelia/#" class="alert-link">this important alert message</a>.
</div>
	
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Oh snap!</strong> <a href="http://bootswatch.com/amelia/#" class="alert-link">Change a few things up</a> and try submitting again.
</div>	
-->
<h4>Verifikasi Target SKP Bawahan</h4>
Nama : <?php echo $profile_bawahan[0]->nama; ?> <br />
Jabatan : <?php echo $profile_bawahan[0]->nama_jabatan; ?>
<table class="table table-bordered table-hover" id="verfikasiForm">
	<thead>
		<tr>
			<th width="5%" rowspan="2">ID</th>
			<th rowspan="2" width="50%">
			Uraian Tugas
			</th>
			<th colspan="3"> Target</th>
			<th rowspan="2">Aksi</th>
		</tr>
		<tr>
			
			<th width="10%">Volume</th>
			<th width="10%">Output</th>
			<th width="10%">Waktu</th>
		</tr>
	</thead>
	
	<tbody>		
		<?php 
		$i = 0;
		// init status
		// kalo ada 1 saja STATUS yang NULL atau STATUS NULL tandai
		// cukup 1 saja untuk menyembunyikan TOMBOL KIRIM target
		$bisa_kirim = true;
		foreach ( $l_urtug as $b ) : 
		$i++;
		if ( $b->status == '' or $b->status == 0 ) {
			$bisa_kirim = false;
		}
		
		?>
		<tr>
			<td><?php echo $i;?><input type="hidden" class="i-id_urtug" name="id_urtug" value="<?php echo $b->id_urtug;?>"></td>
			<td><input readonly type="text" class="form-control i-urtug" value="<?php echo $b->urtug;?>"></td>
			<td><input readonly type="text" class="form-control i-volume" value="<?php echo $b->target_volume;?>"></td>	
			<td><input readonly type="text" class="form-control i-output" value="<?php echo $b->target_output;?>"></td>	
			<td><input readonly type="text" class="form-control i-bulan" value="<?php echo $b->target_bulan;?>"></td>	
			<td>
			<?php 
			switch ( $b->status ) :
			case "1" :
			?>
			<div class="btn-group-main">
				<a class="btn btn-success btn-edit btn-sm btn-action" href="<?php echo base_url('index.php/validasi_urtug/verifikasi_target/'.$b->id_urtug.'/2');?>" title="Valid" onclick="return confirm('Anda Yakin Menerima Uraian Tugas dan Target ini..?')"><i class="icon-check icon-white"> </i> Terima</a>
				<a class="btn btn-danger btn-del btn-sm btn-action" href="<?php echo base_url('index.php/validasi_urtug/verifikasi_target/'.$b->id_urtug.'/0');?>" title="Tolak" onclick="return confirm('Anda Yakin menghapus Uraian Tugas ini..?')"><i class="icon-minus-sign icon-white"> </i> Tolak</a>
			</div>	
			
			<?php
			break;
			case "2" :
				echo "Anda Telah Menerima Target Ini";
				break;
			default :
				echo "<span style='color:red';>Menunggu Perbaikan Oleh Bawahan</span>";	
			endswitch;
			?>
			</td>				
		</tr>
		<?php endforeach;?>	
		
		
		
	</tbody>
</table>
</div>
