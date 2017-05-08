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

<table class="table table-bordered table-hover" id="inputharianSKPForm">
	<thead>
		<tr>
			<th width="5%" rowspan="2">ID</th>
			<th rowspan="2" width="30%">Uraian Tugas</th>
			<th rowspan="2" width="10%">Target</th>
			<th colspan="7">Realisasi 7 hari terakhir</th>
			
		</tr>
		<tr>
			
			<?php
			$date = date ( 'Y-m-d' );			
			for($i = 6; $i >= 0; $i--) {
				$newdate = strtotime ( '-'.$i.' days' , strtotime ( $date ) ) ;
				$newdate = date ( 'd-M' , $newdate );
				echo "<th width='5%'>".$newdate."</th>";
			}	
			?>
			
		</tr>
	</thead>
	
	<tbody>		
		<?php 
		$i = 0;
		// init status
		// kalo ada 1 saja STATUS yang NULL atau STATUS NULL tandai
		// cukup 1 saja untuk menyembunyikan TOMBOL KIRIM target
		
		// do scan
		$bisa_kirim = true;  // SALAH SATU STATUS != 2
		$bisa_tambah = false; // SEMUA HARUS != 2
		foreach ( $l_urtug as $b ) : 
			$bisa_kirim = ( $b->status == 1 ) ? false : $bisa_kirim;
			$bisa_tambah = ( $b->status == 0  ? true : $bisa_tambah );

		endforeach;
		foreach ( $l_urtug as $b ) : 
		$i++;
		
		
		?>
		<tr>
			<td><?php echo $i;?><input type="hidden" class="i-id_urtug" name="id_urtug" value="<?php echo $b->id_urtug;?>"></td>
			<td><?php echo $b->urtug;?></td>
			<td> <?php echo $b->target_volume;?> <?php echo $b->target_output;?></td>	
			
			<?php
			$date = date ( 'Y-m-d' );			
			for($j = 6; $j >= 0; $j--) {
				$newdate = strtotime ( '-'.$j.' days' , strtotime ( $date ) ) ;
				$newdate = date ( 'd-M' , $newdate );
				$col = "r_".$j;
				$value = $b->$col;
				echo '<td><input name="input-'.$b->id_urtug.'" readonly class="col col-'.$j.' form-control" type="text" value="'.$value.'"></td>';
			}	
			?>
			
		</tr>
		<?php endforeach;?>	
		<tr>
			<td colspan="3"></td>
			<?php
			if ($i > 0 )
				for($j = 6; $j >= 0; $j--) {
				$newdate = strtotime ( '-'.$j.' days' , strtotime ( $date ) ) ;
				$newdate = date ( 'd-M' , $newdate );
				echo '<td><a class="btn btn-warning btn-col-'.$j.' btn-sm" onclick="edit_col('.$j.')" title="Edit Data">Isi Data</a></td>';			}	
			?>
			
		</tr>
		
		
		
	</tbody>
</table>
</div>
