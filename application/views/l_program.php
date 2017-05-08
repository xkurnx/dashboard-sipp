<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><?php echo $l_tipe;?></a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>index.php/program/add/<?php echo $tipe;?>" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
				<form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>index.php/program/cari/<?php echo $tipe;?>">
					<input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
					<button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
				</form>
			</ul>
		</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>

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

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="5%">ID</th>
			<th width="30%"><?php echo $l_tipe;?></th>		
			<th width="5%">Target</th>
			<th width="10%">Pelaksana</th>
			<th width="10%">Status / Progress</th>
			<th width="10%">Pembuat</th>
			<th width="20%">Aksi</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if (empty($l_program)) {
			echo "<tr><td colspan='6'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($l_program as $b) {
		?>
		<tr>
			<td><?php echo $b->tipe."-".$b->idp;?></td>
			<td><a href="<?php echo base_URL()?>index.php/program/view/<?php echo $b->idp?>"><?php echo $b->program;?></a></td>
			<td style="background:<?php echo $b->css_bg;?>"><?php echo $b->duedate; ?></td>
			<td><?php echo $b->pelaksana;?></td>
			<td><?php echo $b->status;?></td>
			<td><?php echo $b->pembuat;?></td>
			
			<td class="ctr">
				<?php  
				if (1 == 1 or $b->pelaksana == $this->session->userdata('admin_id')) {
				?>
				<div class="btn-group">
					<a href="<?php echo base_URL()?>index.php/program/edt/<?php echo $b->idp?>/<?php echo $b->tipe?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>
					<?php if ( $b->deletable == 1 ) : ?>
						<a href="<?php echo base_URL()?>index.php/program/del/<?php echo $b->idp?>/<?php echo $b->tipe?>" class="btn btn-danger btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>			
					<?php else : ?>
					<a href="javascript:;" class="btn btn-warning btn-sm"><i class="icon-trash icon-remove"></i>Del</a>	
					<?php endif; ?>
					<a href="<?php echo base_URL()?>index.php/program/selesai/<?php echo $b->idp?>" class="btn btn-info btn-sm" title="Selesaikan" onclick="return confirm('Anda Yakin..?')"><i class="icon-ok icon-white"> </i> Selesaikan</a>
				</div>	
				<?php 
				} else {
				?>
				<div class="btn-group">
					<a href="<?php echo base_URL()?>index.php/program/detail/<?php echo $b->idp?>" class="btn btn-info btn-sm" target="_blank" title="Cetak Disposisi"><i class="icon-print icon-white"> </i> Ctk</a>
				</div>	
				<?php 
				}
				?>
				
			</td>
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
</table>
<span style="background:yellow;padding:1px">Kuning </span> : Jatuh tempo 7-14 hari lagi<br />
<span style="background:red;padding:1px">Red </span> : Jatuh tempo dibawah 7 hari lagi <br />
<span style="background:green;padding:1px">Hijau </span> : Sudah Selesai<br />
<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
