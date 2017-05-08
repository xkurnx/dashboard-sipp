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

<table class="table table-bordered table-hover" id="templateUrtugForm">
	<thead>
		<tr>
			<th width="5%" rowspan="2">ID</th>
			<th rowspan="2" width="60%">Uraian Tugas <br />
			<select  onchange="jumpJabatan(this)" class="form-control">
				<option value='-'> -- Silahkan Pilih Jabatan --</option>
				<?php
				foreach ($l_jabatan as $rdata ):
					echo "<option ". ($sel_kode_jabatan == $rdata->kode_jabatan ? 'selected':'' )." value=".$rdata->kode_jabatan.">".$rdata->nama_jabatan."</option>";
				endforeach;
				?>
			</select>
			</th>
			<th colspan="2"> Target</th>
			<th rowspan="2">Aksi</th>
		</tr>
		<tr>			
			<th width="10%">Output</th>
			<th width="10%">Waktu</th>
		</tr>
	</thead>
	
	<tbody>		
		<?php 
		$i = 0;
		foreach ( $l_urtug as $b ) : 
		$i++;
		?>
		<tr>
			<td><?php echo $i;?><input type="hidden" class="i-id_urtug" name="id_urtug" value="<?php echo $b->id;?>"></td>
			<td><input readonly type="text" class="form-control i-urtug" value="<?php echo $b->urtug;?>"></td>
			<td><input readonly type="text" class="form-control i-output" value="<?php echo $b->target_output;?>"></td>	
			<td><input readonly type="text" class="form-control i-bulan" value="<?php echo $b->target_bulan;?>"></td>	
			<td>
			<div class="btn-group-main">
				<a class="btn btn-success btn-edit btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Ubah</a>
				<a class="btn btn-danger btn-del btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin menghapus Uraian Tugas ini..?')"><i class="icon-edit icon-white"> </i> Hapus</a>
			</div>	
			<div class="btn-group-edit" style="display:none">
				<a class="btn btn-success btn-save btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Simpan</a>
				<a class="btn btn-danger btn-cancel btn-sm" title="Hapus Data"><i class="icon-edit icon-white"> </i> Batal</a>
			</div>
			</td>				
		</tr>
		<?php endforeach;?>	
		<tr>
			<input type="hidden" name="kode_jabatan" value="<?php echo $sel_kode_jabatan?>">
			<td><input type="hidden" name="id_urtug"></td>
			<td><input type="text" class="form-control i-urtug" value=""></td>
			<td><input type="text" class="form-control i-output" value=""></td>	
			<td><input type="text" class="form-control i-bulan" value=""></td>	
			<td>
			<a class="btn btn-success btn-add btn-sm" title="Edit Data"><i class="icon-file icon-white"> </i> Simpan</a>
			</td>				
		</tr>
		
		
	</tbody>
</table>
</div>
