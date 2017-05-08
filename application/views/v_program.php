<?php
//print_r($d_program);
if ( !isset($d_program[0])) {
	exit ('Data tidak ditemukan');
}
else if( isset($d_program[0])) {
	$idp	= $d_program[0]->idp;
	$kode	= $d_program[0]->tipe."-".$d_program[0]->idp;
	$tipe	= $d_program[0]->tipe;
	$program = $d_program[0]->program;
	$deskripsi		= $d_program[0]->deskripsi;
	$id_pelaksana		= $d_program[0]->id_pelaksana;
	$id_pembuat		= $d_program[0]->id_pembuat;
	$pelaksana		= $d_program[0]->pelaksana;
	$duedate		= $d_program[0]->duedate;	
	
	
}

?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Program</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	
	
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-12">
			<div class="panel-group">
			<div class="panel panel-info">
			<div class="panel-heading"> [<?php echo $kode; ?>] <?php echo $program; ?></div>
			<div class="panel-body">
			<?php echo nl2br($deskripsi); ?>
			</div>
			<div class="panel-body">Pelaksana : <?php echo $pelaksana; ?><br />Target Selesai : <?php echo $duedate; ?>
			</div>
			<div class="panel-body">
			<h5>Komentar dan Progress</h5>
			<?php
					foreach ($d_komentar as $row ):
					echo "<small>$row->tgl_input</small> <strong>$row->komentator</strong> : $row->komentar<br />";
				endforeach;
			?>
			<form action="<?php echo base_URL(); ?>index.php/program/addcomment" method="post">
				
				<input type="hidden" name="idp" value="<?php echo $idp;?>">
				<input type="hidden" name="kode" value="<?php echo $kode;?>">
				<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('admin_id'); ?>">
				<input type="hidden" name="id_pembuat" value="<?php echo $id_pembuat;?>">
				<input type="hidden" name="id_pelaksana" value="<?php echo $id_pelaksana;?>">
				
				<textarea name="komentar" required style="width: 400px; height: 90px" class="form-control"></textarea>
				Anda Komentar sebagai <?php echo $this->session->userdata('admin_nama'); ?><br /><br />								
				<a href="<?php echo base_URL(); ?>index.php/program/<?php echo ($tipe == 'T' ?'task':'' );?>" class="btn btn-success" tabindex="8" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
				<button type="submit" class="btn btn-primary"tabindex="10" ><i class="icon icon-ok icon-white"></i>Kirim Komentar</button>
				<?php
				if ( $admin_id == $id_pembuat ) :
				?>
				<a href="<?php echo base_URL()?>index.php/program/selesai/<?php echo $idp?>" class="btn btn-success" title="Selesaikan" onclick="return confirm('Anda Yakin..?')"><i class="icon-ok icon-white"> </i> Selesaikan</a>
				<?php 
				else :
					echo "Tugas ini hanya bisa ditutup oleh pembuat tugas";
				endif;?>
				
			</form>
			</div>
			
		</div>
		
		
	</div>
	
	

	</div>
	
	
	</form>
