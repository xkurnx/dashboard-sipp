<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
	<title>.:: Dashboard SIPP ::.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<style type="text/css">
	@font-face {
	  font-family: 'Cabin';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Cabin Regular'), local('Cabin-Regular'), url(<?php echo base_url(); ?>aset/font/satu.woff) format('woff');
	}
	@font-face {
	  font-family: 'Cabin';
	  font-style: normal;
	  font-weight: 700;
	  src: local('Cabin Bold'), local('Cabin-Bold'), url(<?php echo base_url(); ?>aset/font/dua.woff) format('woff');
	}
	@font-face {
	  font-family: 'Lobster';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Lobster'), url(<?php echo base_url(); ?>aset/font/tiga.woff) format('woff');
	}	

	</style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/bootstrap.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/ionicons.min.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/adminLTE.css" media="screen">
	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/custom-pakis.css" media="screen">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/bootstrap/assets/js/html5shiv.js"></script>
      <script src="../bower_components/bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.css" />
  
    <script src="<?php echo base_url(); ?>aset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/bootswatch.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/scripts.js"></script>
	<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	// <![CDATA[
	$(document).ready(function () {
		$(function () {
			$( "#kode_surat" ).autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo site_url('index.php/admin/get_klasifikasi'); ?>",
						data: { kode: $("#kode_surat").val()},
						dataType: "json",
						type: "POST",
						success: function(data){
							response(data);
						}    
					});
				},
			});
		});
		
		$(function () {
			$( "#dari" ).autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo site_url('index.php/admin/get_instansi_lain'); ?>",
						data: { kode: $("#dari").val()},
						dataType: "json",
						type: "POST",
						success: function(data){
							response(data);
						}    
					});
				},
			});
		});
		
		
		$(function() {
			$( "#tgl_surat" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});
	});
	// ]]>
	</script>
	</head>
	
  <body style="">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
		
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">	
			<li><a href="<?php echo base_url(); ?>index.php/dashboard"><i class="icon-home icon-white"> </i> Dashboard SIPP</a></li>
           <li><a href="<?php echo base_url(); ?>index.php/dashboard/ikrar">Perkara Putus Belum Ikrar</a></li>
		

        </div>
      </div>
    </div>

	
    <div class="container  paddingBottom50" style="padding-top:80px">

<?php echo $content; ?>


	
 
    </div>
	<div id="footer">
	 <table width="100%">
	 <tr>
	 <td width="35%"></td>
	 <td width="30%" align="center" style="vertical-align:middle;">
	 <?php foreach ( $nama_pn as $row):
	  	echo $row['value'];
	  	endforeach;
	  	?></td>
	  	<td width="35%" align="center" style="font-size:13px; vertical-align:middle;">
	 Hak Cipta &copy; Tim Satgas IT PTA Medan 2017  </td>

	 </tr>
	  	</table>
	</div>
	<div class="loading"></div>

  
</body></html>
