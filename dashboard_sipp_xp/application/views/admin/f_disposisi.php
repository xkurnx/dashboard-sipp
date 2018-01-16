<?php 
$q_instansi	= $this->db->query("SELECT * FROM tr_instansi LIMIT 1")->row();
?>

<html>
<head>
<style type="text/css" media="print">
	
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000}
	td { padding: 7px 5px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
	ol { margin:4px;padding:4px;padding-left:20px}
	ol li{ padding-top:4px}
	
</style>
<style type="text/css" media="screen">
	table {border: solid 1px #000; border-collapse:collapse;width: 100%}
	tr { border: solid 1px #000}
	td { padding: 7px 5px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
	ol { margin:4px;padding:4px;padding-left:20px}
	ol li{ padding-top:10px}
</style>
<style>
body { font-size:12px; }
body table td{ font-size:14px; }
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    height: 200mm;
    width: 297mm;
  }
  @page {size: landscape}

}
</style>
</head>

<body onload="window.print()xx">
<table style="border:solid 0px #000;border-collapse:none">
<tr><td style="50%">

	<table>
		<tr><td colspan="3">
		<h2><?php echo $q_instansi->nama; ?></h2>
		Alamat : <?php echo $q_instansi->alamat; ?>	
		</td>
		</tr>
		
		<tr><td colspan="3" align="center" style="padding: 15px 0"><b style="font-size: 21px;">LEMBAR DISPOSISI</b></td></tr>
		<tr><td width="25%"><b>Indeks Berkas</b></td><td width="40%">: <?php echo $datpil1->indek_berkas; ?></td><td><b>Kode : </b><?php echo $datpil1->kode; ?></td></tr>
		<tr><td width="25%"><b>Tanggal/Nomor</b></td><td colspan="2">: <?php echo tgl_jam_sql($datpil1->tgl_surat)." / ".$datpil1->no_surat; ?></td></tr>
		<tr><td><b>Asal Surat</b></td><td colspan="2">: <?php echo $datpil1->dari; ?></td></tr>
		<tr><td><b>Isi Ringkas</b></td><td colspan="2">: <?php echo $datpil1->isi_ringkas; ?></td></tr>
		<tr><td><b>Diterima Tanggal</b></td><td colspan="2">: <?php echo tgl_jam_sql($datpil1->tgl_diterima); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>No. Agenda &nbsp;&nbsp; </b> ( <?php echo $datpil1->no_agenda; ?> ) </td></tr>
		<tr><td colspan="3"><b>Tanggal Penyelesaian </b>: </td></tr>
		<tr><td style="height: 200px" valign="top" colspan="2"><b>Isi Disposisi : </b> <br><br>

		
		<?php 
		if (!empty($datpil3)) {
			foreach ($datpil3 as $d3) {
				echo "<li><b><i>".$d3->isi_disposisi."</i></b>. Batas : ".tgl_jam_sql($d3->batas_waktu).", Sifat: ".$d3->sifat." </li>";
			}
		}
		?>
	
		
		
		</b></td><td valign="top" width="50%" style="border-left: solid 1px">
		Diteruskan kepada  :<br /> 
		<ol>
		<?php
		$i=0;
		foreach (explode('<br/>',$datpil1->diteruskan_ke) as $diteruskan) {
			$i++;
		echo "<li>$diteruskan</li>";
		}
		?>
		<ol>
		</td></tr>
		<tr><td colspan="3" style="line-height: 30px;width:300px">Sesudah digunakan harap dikembalikan<br>
		Kepada : ................................................................<br>
		Tanggal : ...................................................................<br>
		</td></tr>
	</table>
</td>
<td>
&nbsp;&nbsp;&nbsp;
</td>

<td>

	<table>
		<tr>
			<td style="border-left: solid 1px">
				Indeks Berkas : 	
			</td>
			<td  style="border-left: solid 1px">
			Tgl : <?php echo tgl_jam_sql($datpil1->tgl_diterima); ?>      Jam :
			No. : <strong><?php echo $datpil1->no_agenda; ?></strong>
			</td  style="border-left: solid 1px">
			<td  style="border-left: solid 1px">
			 Kode : <?php echo $datpil1->kode; ?>
			</td>
		</tr>
		<tr>
			<td style="border-left: solid 1px" colspan="3">
			Isi Ringkas : <i><?php echo $datpil1->isi_ringkas; ?> </i></td>
		</tr>
		<tr> 
			<td colspan="3">
			Lampiran :
			</td>
		</tr>
		
		<tr> 
			<td style="border-left: solid 1px" >
			Dari : <?php echo $datpil1->dari; ?>
			</td>
			<td  colspan="2" style="border-left: solid 1px" >
			Kepada : 
			</td>
		</tr>
		<tr> 
			<td style="border-left: solid 1px" >
			Tanggal :
			</td>
			<td colspan="2"  style="border-left: solid 1px" >
			No Surat : <?php echo $datpil1->no_surat;?>
			</td>
		</tr>
		
		<tr> 
			<td  colspan="2"  style="border-left: solid 1px" >
			Pengolah :
			</td>
			<td style="border-left: solid 1px" >
			Paraf : 
			</td>
		</tr>
		
		<tr> 
			<td colspan="3">
			Catatan : <br />
			- Pengantar Surat : <br />
			- Penerima Surat : <br />
			- Keadaan Amplop : 
			
			</td>
		</tr>
		
		
	</table>
	&nbsp;<br />&nbsp;<br />&nbsp;<br />
	<table>
		<tr>
			<td style="border-left: solid 1px">
				Indeks Berkas : 	
			</td>
			<td  style="border-left: solid 1px">
			Tgl : <?php echo tgl_jam_sql($datpil1->tgl_diterima); ?>      Jam :
			No. : <strong><?php echo $datpil1->no_agenda; ?></strong>
			</td  style="border-left: solid 1px">
			<td  style="border-left: solid 1px">
			 Kode : <?php echo $datpil1->kode; ?>
			</td>
		</tr>
		<tr>
			<td style="border-left: solid 1px" colspan="3">
			Isi Ringkas : <i><?php echo $datpil1->isi_ringkas; ?> </i></td>
		</tr>
		<tr> 
			<td colspan="3">
			Lampiran :
			</td>
		</tr>
		
		<tr> 
			<td style="border-left: solid 1px" >
			Dari : <?php echo $datpil1->dari; ?>
			</td>
			<td  colspan="2" style="border-left: solid 1px" >
			Kepada : PA. KIS
			</td>
		</tr>
		<tr> 
			<td style="border-left: solid 1px" >
			Tanggal :
			</td>
			<td colspan="2"  style="border-left: solid 1px" >
			No Surat : <?php echo $datpil1->no_surat;?>
			</td>
		</tr>
		
		<tr> 
			<td  colspan="2"  style="border-left: solid 1px" >
			Pengolah :
			</td>
			<td style="border-left: solid 1px" >
			Paraf : 
			</td>
		</tr>
		
		<tr> 
			<td colspan="3">
			Catatan : <br />
			- Pengantar Surat : <br />
			- Penerima Surat : <br />
			- Keadaan Amplop : 
			
			</td>
		</tr>
		
		
	</table>
</td>
</tr>
</table>	
</body>
</html>
