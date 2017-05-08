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
<h4>Input Nilai Realisasi SKP Bawahan</h4>
Nama : <?php echo $profile_bawahan[0]->nama; ?> <br />
Jabatan : <?php echo $profile_bawahan[0]->nama_jabatan; ?>
<form method="post" action="<?php echo base_url('index.php/proses_skp/input_nilai_bawahan');?>">
<tbody>
<?php echo $this->session->flashdata("k");?>
<table class="table table-bordered table-hover" id="verfikasiForm">
	<thead>
		<tr>
			<th width="5%" rowspan="2">ID</th>
			<th rowspan="2" width="40%">
			Uraian Tugas
			</th>
			<th colspan="3"> Target</th>
			<th width="10%" rowspan="2">Realisasi</th>
			<th width="10%" rowspan="2">Kualitas <br />dalam persen max.100</th>
		</tr>
		<tr>
			<th width="8%">Output</th>
			<th width="8%">Waktu</th>
			<th width="8%">Volume</th>
		</tr>
	</thead>
			
		<?php 
		$i = 0;
		// init status
		// kalo ada 1 saja STATUS yang NULL atau STATUS NULL tandai
		// cukup 1 saja untuk menyembunyikan TOMBOL KIRIM target
		$bisa_kirim = true;
		foreach ( $l_urtug as $b ) : 
		$i++;
		if ( $b->status == 4 ) {
			$bisa_kirim = false;
		}
		
		?>
		<tr>
			<td><?php echo $i;?><input type="hidden" class="i-id_urtug" name="id_urtug" value="<?php echo $b->id_urtug;?>"></td>
			<td><?php echo $b->urtug;?></td>
			<td><?php echo $b->target_volume;?></td>	
			<td><?php echo $b->target_output;?></td>	
			<td><?php echo $b->target_bulan;?></td>				
			<td><?php echo $b->jml_realisasi;?></td>			
			<td>
			<?php if ( $bisa_kirim ) :
			?>
			<input type="text" name="kualitas[<?php echo $b->id_urtug;?>]" class="form-control">
			<?php 
			else :
			 echo $b->kualitas;
			 endif;
			?>
			</td>
		</tr>
		<?php endforeach;?>	
		
	</tbody>
</table>
<?php
if ( $bisa_kirim ) :
?>
	<input type="hidden" name="id_bawahan" value="<?php echo $id_bawahan;?>" >
		<input type="submit" value="Kirim">
<?php endif;?>
</form>
</div>
