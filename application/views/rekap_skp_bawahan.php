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


<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="5%" rowspan="2">ID</th>
			<th width="70%">Nama Bawahan</th>
			<th>Nilai</th>
			<th>Aksi</th>
		</tr>
		
	</thead>
	
	<tbody>		
		<?php 
		$i = 0;	
		foreach ( $l_urtug as $b ) : 
		$i++;
		
		?>
		<tr>
			<td><?php echo $i;?></td>			
			<td><a href="<?php echo base_url('index.php/proses_skp/skp_bawahan/'.$b->id);?>"><?php echo $b->nama;?></td>		
			<td></td>
			<td>Lihat</td>
		</tr>
		<?php endforeach;?>
		
		
	</tbody>
</table>
</div>
