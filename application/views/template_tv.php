<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
	<title>Pengadilan Agama Kisaran Kelas IB</title>
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
	<link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/font-awesome.min.css" media="screen">
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
	<script src="<?php echo base_url(); ?>aset/js/jquery.newsTicker.min.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/scripts.js"></script>
			
	<script language="JavaScript">
	function toggleFullScreen() {
	  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
	   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
		
		   
		if (document.documentElement.requestFullScreen) { 
			document.getElementById("playerElement").requestFullscreen();		
		  document.documentElement.requestFullScreen();  
		} else if (document.documentElement.mozRequestFullScreen) {  
		  document.documentElement.mozRequestFullScreen();  
		} else if (document.documentElement.webkitRequestFullScreen) {  
		  document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
		}  
	  } else {  
		if (document.cancelFullScreen) {  
		  document.cancelFullScreen();  
		} else if (document.mozCancelFullScreen) {  
		  document.mozCancelFullScreen();  
		} else if (document.webkitCancelFullScreen) {  
		  document.webkitCancelFullScreen();  
		}  
	  }  
	}
</script>
	
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
	
  <body class="tv tv2">
  
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
		<?php echo (isset($style) == "tv" ? "<h2 class='title'><i class='fa fa-tachometer'></i>Pengadilan Agama Kisaran Kelas IB</h2>":""); ?>
          <ul class="nav navbar-nav">	
			<li><a href="<?php echo base_url(); ?>index.php/dashboard"><i class="icon-home icon-white"> </i> Beranda</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/perkara"><i class="ion-clock icon-white"> </i> Penanganan Perkara</a></li>

        <li class="dropdown"><a href="<?php echo base_url(); ?>index.php/validasi/pts_blm_ikrar"><i class="ion-document-text icon-white"> </i> Perkara Putus Belum Ikrar</a>
            <ul class="dropdown-menu">
                <li>testing</li>
            </ul>
              </li>

		

        </div>
      </div>
    </div>

	
    <div class="container  paddingBottom50" style="padding-top:60px">
		<?php echo $content; ?>
	 </div>
	
	<div id="footer">
	 <div class="container">
        <?php
        echo $this->session->userdata('namaPN');
        ?>
        <?php if (!isset($style)) :
		?>
		
		<?php endif;?>
    </div>
	</div>
	<div class="loading"></div>

  
</body></html>
