<?php
$filename = str_replace(" ","_","SKP-".$prof_peg[0]->nama.".xls");
#echo $filename;exit;
#header('Content-type: text/xls'); header("Content-Disposition: attachment; filename=".$filename);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
	<title>.:: Aplikasi Internal Pengadilan Agama Kisaran ::.</title>
	<style>
	table tr th,
	table tr td{border:1px solid #000}
	table tr.noBorder td{border:0px}
	@media all
  {
  #page-one, .footer, .page-break { display:none; }
  }

@media print
  {
  #page-one, .footer, .page-break   
    { 
    display: block;
    color:red; 
    font-family:Arial; 
    font-size: 16px; 
    text-transform: uppercase; 
    }
  .page-break
    {
    page-break-before:always;
    } 
}
	</style>
	</head>
	
<body>
<div class="clearfix">

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
<center>
<h3>SASARAN KERJA<br />PEGAWAI NEGERI SIPIL</h3>
</center>
<table style="width:100%;">
<tr class="noBorder">
<td style="width:30px">1</td> 
<td style="width:120px">2</td> 
<td style="width:150px">3</td> 
<td style="width:100px">4</td> 
<td style="width:30px">5</td> 
<td style="width:40px">6</td> 
<td style="width:50px">7</td> 
<td style="width:60px">8</td> 
<td style="width:30px">9</td> 
<td style="width:50px">10</td> 
<td style="width:130px">11</td> 
</tr>
<thead>
<tr>
<th colspan="4">I. PEJABAT PENILAI</th>
<th colspan="7">II. PEGAWAI NEGERI SIPIL YANG DINILAI</th>
</tr>
</thead>
<tbody>
 <tr><td colspan="2">N a m a</td><td colspan="2"><?php echo $prof_penilai[0]->nama;?></td><td colspan="3">N a m a</td><td colspan="4"><?php echo $prof_peg[0]->nama;?></td></tr>
 <tr><td colspan="2">NIP</td><td colspan="2"><?php echo $prof_penilai[0]->nip;?></td><td colspan="3">NIP</td><td colspan="4"><?php echo $prof_peg[0]->nip;?></td></tr>
 <tr><td colspan="2">Pangkat/Gol.Ruang</td><td colspan="2">Pembina(IV/a)</td><td colspan="3">Pangkat/Gol.Ruang</td><td colspan="4">Penata Tk I (III/d)</td></tr>
 <tr><td colspan="2">Jabatan</td><td colspan="2"><?php echo $prof_penilai[0]->nama_jabatan;?></td><td colspan="3">Jabatan</td><td colspan="4"><?php echo $prof_peg[0]->nama_jabatan;?></td></tr>
 <tr><td colspan="2">Unit Kerja</td><td colspan="2">Pengadilan Tinggi Agama Medan</td><td colspan="3">Unit Kerja</td><td colspan="4">Pengadilan Tinggi Agama Medan</td></tr>
</tbody>
<thead>
		<tr>
			<th width="2%" rowspan="2">No.</th>
			<th colspan="3" rowspan="2">III. Kegiatan Tugas Jabatan</th>
			<th rowspan="2">AK</th>			
			<th colspan="6">Target</th>			
		</tr>
		<tr>			
			<th colspan="2">Kuant/Output</th>
			<th>Kualitas</th>
			<th colspan="2">Waktu</th>
			<th>Biaya</th>
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
			<td colspan="3"><?php echo $b->urtug;?></td>
			<td> - </td>
			<td><?php echo $b->target_volume;?></td>	
			<td><?php echo $b->target_output;?></td>	
			<td>KUAL</td>	
			<td><?php echo $b->target_bulan;?></td>
			<td>BLN</td>
			<td></td>
						
		</tr>
		
		<?php endforeach;?>	
		
		
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
			<td colspan="3"><?php echo $b->urtug;?></td>
			<td> - </td>
			<td><?php echo $b->target_volume;?></td>	
			<td><?php echo $b->target_output;?></td>	
			<td>KUAL</td>	
			<td><?php echo $b->target_bulan;?></td>
			<td>BLN</td>
			<td></td>
						
		</tr>
		<?php endforeach;?>	
		
	</tbody>
<tr class="noBorder">
<td  colspan="4" style="text-align:center;">
Pejabat Penilai, 
<br/>
<br/>
<br/>
<?php
echo $prof_penilai[0]->nama;
?>
<br />
<?php
echo $prof_penilai[0]->nip;
?>
</td>
<td colspan="7" style="text-align:center">

Pegawai Negeri Sipil Yang Dinilai,
<br/>
<br/>
<br/>
<?php
echo $prof_peg[0]->nama;
?>
<br />
<?php
echo $prof_peg[0]->nip;
?>

</td>
</tr>
</table>
</div>
</body></html>
