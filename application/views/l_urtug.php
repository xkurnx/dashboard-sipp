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

<table class="table table-bordered table-hover" id="urtugForm">
	<thead>
		<tr>
			<th width="5%" rowspan="2">ID</th>
			<th rowspan="2" width="50%">Uraian Tugas</th>
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
		
		// do scan
		$bisa_kirim = true;  // SALAH SATU STATUS != 2
		$bisa_tambah = false; // SEMUA HARUS != 2
		foreach ( $l_urtug as $b ) : 
			$bisa_kirim = ( $b->status != 1 ) ? false : $bisa_kirim;
			$bisa_tambah = ( $b->status == 0  ? true : $bisa_tambah );

		endforeach;
		foreach ( $l_urtug as $b ) : 
		$i++;
		
		
		?>
		<tr>
			<td><?php echo $i;?><input type="hidden" class="i-id_urtug" name="id_urtug" value="<?php echo $b->id_urtug;?>"></td>
			<td><input readonly type="text" class="form-control i-urtug" value="<?php echo $b->urtug;?>"></td>
			<td><input readonly type="text" class="form-control i-volume" value="<?php echo $b->target_volume;?>"></td>	
			<td><input readonly type="text" class="form-control i-output" value="<?php echo $b->target_output;?>"></td>	
			<td><input readonly type="text" class="form-control i-bulan" value="<?php echo $b->target_bulan;?>"></td>	
			<td>
			<?php 
			if ( $b->status == '' or $b->status == 0 ) {
			?>
			<div class="btn-group-main">
				<a class="btn btn-success btn-edit btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Ubah</a>
				<a class="btn btn-danger btn-del btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin menghapus Uraian Tugas ini..?')"><i class="icon-edit icon-white"> </i> Hapus</a>
			</div>	
			<div class="btn-group-edit" style="display:none">
				<a class="btn btn-success btn-save btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Simpan</a>
				<a class="btn btn-danger btn-cancel btn-sm" title="Hapus Data"><i class="icon-edit icon-white"> </i> Batal</a>
			</div>
			<?php
			}
			else if ( $b->status == 1 ){
				echo "Menunggu Verifikasi";
			}
			else if ( $b->status == 2 ){
				echo "Diterima oleh atasan";
			}
			?>
			</td>				
		</tr>
		<?php endforeach;?>	
		<tr>
			<?php
			if ( $bisa_tambah == true ) :
			?>
			<td><input type="hidden" name="id_urtug"></td>
			<td><input type="text" class="form-control i-urtug" value=""></td>
			<td><input type="text" class="form-control i-volume" value=""></td>	
			<td><input type="text" class="form-control i-output" value=""></td>	
			<td><input type="text" class="form-control i-bulan" value=""></td>	
			<td>
			<a class="btn btn-success btn-add btn-sm" title="Edit Data"><i class="icon-file icon-white"> </i> Simpan</a>
			</td>
			<?php endif; ?>
		</tr>
		
		<tr>
			<td colspan=5><?php
			if ( $i == 0 ) {
			?>
			Bpk/Ibu <?php echo $this->session->userdata('admin_nama');?>, karena Bpk/Ibu Menjabat sebagai <strong><?php echo $this->session->userdata('admin_nama_jabatan');?>, </strong> 
			klik tombol dibawah ini untuk mengambil Uraian Tugas Jabatan. 
			<br />Dan setelah itu, Bpk/Ibu bisa menambahkan Uraian Tugas yang lainnya
			<br /> <a href="<?php echo base_url('index.php/urtug/import_urtug_by_jabatan');?>" class="btn btn-success btn-add btn-sm" title="Ambil Uraian Tugas Jabatan"><i class="icon-file icon-white"> </i> Ambil Uraian Tugas Jabatan</a>
			<?php
			}
			if ( $bisa_kirim == true && $i > 0 ){
			?>
			Jika Data Uraian Tugas dan Target diatas sudah Benar dan lengkap, Silahkan Lanjut ke Tahap Berikutnya untuk diverifikasi oleh atasan langsung
			
			<br /> <a href="<?php echo base_url('index.php/urtug/submit_target');?>" class="btn btn-success btn-add btn-sm" title="Kirim ke Pejabat Penilai"><i class="icon-file icon-white"> </i> Kirim ke Pejabat Penilai</a>
			<?php
			};
			?>
			 </td>
		</tr>
		
	</tbody>
</table>
</div>
