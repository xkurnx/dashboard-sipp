

<?php
$mode		= $this->uri->segment(3);
//print_r($d_program[0]);exit;
if (isset($d_program[0])) {
	$idp		= $d_program[0]->idp;
	$tipe	= $d_program[0]->tipe;
	$program = $d_program[0]->program;
	$deskripsi		= $d_program[0]->deskripsi;
	$id_pelaksana		= $d_program[0]->id_pelaksana;
	$duedate		= $d_program[0]->duedate;	
	$l_tipe  = ( $tipe == 'T' )? "TUGAS" :"PROGRAM";
		
	
} else {
	$act		= "act_add";
	$idp		= "";
	$no_agenda	= gli("t_surat_masuk", "no_agenda", 4);
	$indek_berkas="";
	$kode		= "";
	$dari		= "";
	$no_surat	= "";
	$duedate	= "";
	$deskripsi		= "";
	$ket		= "";
	$program = "";
}
?>
<div class="navbar navbar-inverse">
	<div class="container z0">
		<div class="navbar-header">
			<span class="navbar-brand" href="#"><?php echo $l_tipe;?></span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	
	<form action="<?php echo base_URL(); ?>index.php/program/save" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-6">
		<table  class="table-form">
		<input type="hidden" name="tipe" value="<?php echo $tipe;?>">
		<tr><td width="20%"><?php echo $l_tipe;?></td><td><b><input type="text" name="program" tabindex="2" required value="<?php echo $program; ?>" style="width: 400px" class="form-control"></b></td></tr>		
		<tr><td width="20%">Isi Ringkas</td><td><b><textarea name="deskripsi" tabindex="4" required style="width: 400px; height: 120px" class="form-control"><?php echo $deskripsi; ?></textarea></b><small>Misal : Target Biaya = 50 JT</small></td></tr>	
		<tr><td width="20%">Pelaksana</td><td>
			<select name="id_pelaksana" class="form-control" required style="width: 200px" tabindex="6" ><option value=""> -- Penanggung jawab -- </option>
			<?php
				foreach ($l_pejabat as $v ) :
					echo "<option ".( $v->id == $id_pelaksana ? 'selected':'') ." value=$v->id>$v->nama</option>";
				endforeach;	
			?>			
			?>		
			</select>
		</td></tr>	
		<!-- <tr><td width="20%">Sumber Dana</td><td><b>
			<select required  class="form-control"  name="sumber_dana">
			<option value="-">-- Pilih Sumber Dana --</option>
			<option value="0">Tanpa Dana</option>
			<option value="1">DIPA</option>
			</select>
		</td></tr>	
		-->
		
		<tr><td width="20%">Target Selesai</td><td><b><input type="text" tabindex="4" name="duedate" required value="<?php echo $duedate; ?>"  id="tgl_surat" style="width: 100px" class="form-control"></b></td></tr>
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary"tabindex="10" ><i class="icon icon-ok icon-white"></i> Simpan</button>
		<a href="<?php echo base_URL(); ?>index.php/program" class="btn btn-success" tabindex="11" ><i class="icon icon-arrow-left icon-white"></i> Kembali</a>
		</td></tr>
		</table>
	</div>
	
	

	</div>
	
	</form>
