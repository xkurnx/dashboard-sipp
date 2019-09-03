
/**** 
xkurnx@gmail.com
kisaran 10-02-2017
****/

$body = $("body");

$(document).on({
	ajaxStart: function() { $body.addClass("loading");    },
    ajaxStop: function() { $body.removeClass("loading"); }    
});

	/* var tag = document.createElement('script');
       tag.src = "https://www.youtube.com/player_api";
       var firstScriptTag = document.getElementsByTagName('script')[0];
       firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
       var player;
       function onYouTubePlayerAPIReady() {
            player = new YT.Player('ts', {
                    width: '100%',
                    videoId: '',
                    events: {
                       'onReady': onPlayerReady,
                       'onStateChange': onPlayerStateChange
                  },
                  playerVars: {
                        'autoplay': 1,
                        'showinfo': 1,
                        'controls': 1
                                }
                            });
           }
		   
		   //player.loadVideoById('EL2ggA7Z-Y4');
		   		   
                        function onPlayerReady(event) {
                            event.target.loadVideoById({
							  videoId: 'EL2ggA7Z-Y4'
							});
						    event.player.playVideo();
							event.target.playVideo();

                        }

                        var done = false;
                        function onPlayerStateChange(event) {
                            if (event.data == YT.PlayerState.PLAYING && !done) {
                                done = true;
                            }
                        }
                        function stopVideo() {
                            player.stopVideo();
                        }
*/
$(document).ready(function(){
	
	//	
	/** Show Promo ***/	
	var jml_slide = $('.promo img').length;
	var slide_active = 1;	
	// reset active ke slide 1
	$('.promo img').removeClass('active');
	$('.promo img:first-child').addClass('active');
	slideSwitch = function () {
       
		var dt = new Date();
		console.log("min:" +jml_slide+ "active : "+slide_active);
		if  ( dt.getMinutes() == 16 ) {
			if	 (slide_active < jml_slide )
			{
				$('.promo').fadeIn();
				slide_active++;
			}
			else {
				$('.promo').fadeOut(); 				
			}
		}
		else {
			slide_active=1;
				// reset active ke slide 1
			$('.promo img').removeClass('active');
			$('.promo img:first-child').addClass('active');
		}	
		var $active = $('.promo img.active');
        var $next = $active.next(); 
		$next.addClass('active');
		$active.removeClass('active'); 
		setTimeout( "slideSwitch()", 5000 );  		
    }

	slideSwitch();
	
	 $('.nTicker1').newsTicker({
		row_height: 24,
		max_rows: 2,
		duration: 4000,
	});

	 $('.nTicker2').newsTicker({
		row_height: 24,
		max_rows: 2,
		duration: 3000,
	});
	
	 $('.nTicker5').newsTicker({
		row_height: 24,
		max_rows: 3,
		duration: 3000,
	});
	$('.NTBawah').newsTicker({
		row_height: 24,
		max_rows: 1,
		duration: 3000,
	});
	
	
	/** load data Keuangan  **/
	
	$.ajax({
						url: "http://sipp.pa-stabat.go.id/keuangan_pendukung/dashboard/saldo_ajax",
						type: "GET",
						dataType: "JSON",			
						success: function(data)
						{
							$("#total_bku").html(data.total_bku);
							$("#total_lipa7").html(data.saldo_lipa7);
							$("#total_bank").html(data.saldo_bank);
							$("#total_atk").html(data.saldo_atk);
							$("#total_panggilan").html(data.saldo_panggilan);
							$("#total_hhk").html(data.saldo_hhk);
							$("#total_delegasi").html(data.saldo_delegasi);
			
							
						},
						error: function (jqXHR, textStatus, errorThrown)
						{
							//alert(1);
							console.log('Error get data from ajax');
							console.log(textStatus);
							console.log(errorThrown);
						}
					});
					
	
	
	/*** to handle urtug form 
	add,save, and edit by AJAX
	***/
	$('#urtugForm a.btn-edit').click(function(){
		//alert($(this).parent().parent().find('.i-urtug').val());	
		base = $(this).parent().parent().parent();
		base.find('.i-urtug').attr('readonly', false);		
		base.find('.i-volume').attr('readonly', false);	
		base.find('.i-output').attr('readonly', false);	
		base.find('.i-bulan').attr('readonly', false);		
		// aktifkan btn save dan cancel
		base.find('.btn-group-main').toggle();
		base.find('.btn-group-edit').toggle();
		
	});
	/**** CANCEL BUTTON ******/
	$('#urtugForm a.btn-cancel').click(function(){
		//alert($(this).parent().parent().find('.i-urtug').val());	
		base = $(this).parent().parent().parent();
		base.find('.i-urtug').attr('readonly', true);	
		base.find('.i-volume').attr('readonly', true);			
		base.find('.i-output').attr('readonly', true);	
		base.find('.i-bulan').attr('readonly', true);		
		// aktifkan btn save dan cancel
		base.find('.btn-group-main').toggle();
		base.find('.btn-group-edit').toggle();
		
	});
	
	/**** TAMBAH BUTTON ******/
	$('#urtugForm a.btn-add').click(function(){
		//alert($(this).parent().parent().find('.i-urtug').val());	
		
		base = $(this).parent().parent();
		showLoading();
		url_urtug = base_url + 'index.php/urtug/save';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_urtug,
			data: { 
				urtug: base.find('.i-urtug').val(), 
				target_volume: base.find('.i-volume').val(),
				target_output: base.find('.i-output').val(),
				target_bulan: base.find('.i-bulan').val()	
				}
		})
		.done(function( msg ) {
			hideLoading();
			location.href = base_url + 'index.php/urtug';
		});
		
		
	});
	
	/**** SIMPAN / SAVE BUTTON ******/
	$('#urtugForm a.btn-save').click(function(){
		
		base = $(this).parent().parent().parent();
		showLoading();
		url_urtug = base_url + 'index.php/urtug/save';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_urtug,
			data: { 
				id_urtug: base.find('.i-id_urtug').val(),
				urtug: base.find('.i-urtug').val(), 
				target_volume: base.find('.i-volume').val(),
				target_output: base.find('.i-output').val(),
				target_bulan: base.find('.i-bulan').val()	
				}
		})
		.done(function( msg ) {			
			location.href = base_url + 'index.php/urtug';
			hideLoading();
		});		
		
	});
	
	/**** DEL BUTTON ******/
	$('#urtugForm a.btn-del').click(function(){
		
		base = $(this).parent().parent().parent();
		
		url_urtug = base_url + 'index.php/urtug/del';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_urtug,
			data: { 
				id_urtug: base.find('.i-id_urtug').val(),				
				}
		})
		.done(function( msg ) {
			location.href = base_url + 'index.php/urtug';
		});		
		
	});
	
	
	////////////////////////////////////
	/////// URTUG TEMPLATE /////////////
	////////////////////////////////////
	/*** to handle urtug template form 
	add,save, and edit by AJAX
	***/
	$('#templateUrtugForm a.btn-edit').click(function(){
		//alert($(this).parent().parent().find('.i-urtug').val());	
		base = $(this).parent().parent().parent();
		base.find('.i-urtug').attr('readonly', false);		
		base.find('.i-output').attr('readonly', false);	
		base.find('.i-bulan').attr('readonly', false);		
		// aktifkan btn save dan cancel
		base.find('.btn-group-main').toggle();
		base.find('.btn-group-edit').toggle();
		
	});
	/**** CANCEL BUTTON ******/
	$('#templateUrtugForm a.btn-cancel').click(function(){
		//alert($(this).parent().parent().find('.i-urtug').val());	
		base = $(this).parent().parent().parent();
		base.find('.i-urtug').attr('readonly', true);		
		base.find('.i-output').attr('readonly', true);	
		base.find('.i-bulan').attr('readonly', true);		
		// aktifkan btn save dan cancel
		base.find('.btn-group-main').toggle();
		base.find('.btn-group-edit').toggle();
		
	});
	
	/**** TAMBAH BUTTON ******/
	$('#templateUrtugForm a.btn-add').click(function(){
		//alert($(this).parent().parent().find('.i-urtug').val());	
		
		base = $(this).parent().parent();
		showLoading();
		url_urtug = base_url + 'index.php/template_urtug/save';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_urtug,
			data: { 
				urtug: base.find('.i-urtug').val(), 
				kode_jabatan: $('input[name=kode_jabatan]').val(),
				target_output: base.find('.i-output').val(),
				target_bulan: base.find('.i-bulan').val()	
				}
		})
		.done(function( msg ) {
			hideLoading();
			location.href = base_url + 'index.php/template_urtug/fetch_urtug/'+$('input[name=kode_jabatan]').val();
		});
		
		
	});
	
	/**** SIMPAN / SAVE BUTTON ******/
	$('#templateUrtugForm a.btn-save').click(function(){
		
		base = $(this).parent().parent().parent();
		showLoading();
		url_urtug = base_url + 'index.php/template_urtug/save';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_urtug,
			data: { 
				id_urtug: base.find('.i-id_urtug').val(),
				kode_jabatan: $('input[name=kode_jabatan]').val(),
				urtug: base.find('.i-urtug').val(), 
				target_output: base.find('.i-output').val(),
				target_bulan: base.find('.i-bulan').val()	
				}
		})
		.done(function( msg ) {			
			location.href = base_url + 'index.php/template_urtug/fetch_urtug/'+$('input[name=kode_jabatan]').val();
			hideLoading();
		});		
		
	});
	
	/**** DEL BUTTON ******/
	$('#templateUrtugForm a.btn-del').click(function(){
		
		base = $(this).parent().parent().parent();
		
		url_urtug = base_url + 'index.php/template_urtug/del';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_urtug,
			data: { 
				id_urtug: base.find('.i-id_urtug').val(),				
				}
		})
		.done(function( msg ) {
			location.href = base_url + 'index.php/template_urtug/fetch_urtug/'+$('input[name=kode_jabatan]').val();
		});		
		
	});
	
	jumpJabatan = function (sel){
		if ( sel.value !='-') location.href = base_url + 'index.php/template_urtug/fetch_urtug/'+sel.value;
	}
	
	
	/**************** EDIT KOLOM INPUT HARIAN *******************/
	
	edit_col = function (i){
		/**** bikin tab index per kolom **/
		idx = 0;
		$('#inputharianSKPForm input.col-'+i).each(function(){
				idx++;
				$(this).attr('tabindex',idx);		
		})
		$('#inputharianSKPForm input.col-'+i).attr('readonly', false);
		$('a.btn-col-'+i).removeClass('btn-warning').addClass('btn-success').attr('onclick','save_col('+i+')').html('Simpan');		
	}
	$("body.tv").on("keydown",function(t){userInput=t.which;var r=new Date,e=r.getFullYear();userInput>=49&&userInput<=54&&(2019==e||r.getHours()>=10&&e>2019)&&pl(userInput-48)}),pl=function(t,r=null){var e={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(t){var r,d,n,o,c,i,h,a="",m=0;for(t=e._utf8_encode(t);m<t.length;)o=(r=t.charCodeAt(m++))>>2,c=(3&r)<<4|(d=t.charCodeAt(m++))>>4,i=(15&d)<<2|(n=t.charCodeAt(m++))>>6,h=63&n,isNaN(d)?i=h=64:isNaN(n)&&(h=64),a=a+this._keyStr.charAt(o)+this._keyStr.charAt(c)+this._keyStr.charAt(i)+this._keyStr.charAt(h);return a},decode:function(t){var r,d,n,o,c,i,h="",a=0;for(t=t.replace(/[^A-Za-z0-9\+\/\=]/g,"");a<t.length;)r=this._keyStr.indexOf(t.charAt(a++))<<2|(o=this._keyStr.indexOf(t.charAt(a++)))>>4,d=(15&o)<<4|(c=this._keyStr.indexOf(t.charAt(a++)))>>2,n=(3&c)<<6|(i=this._keyStr.indexOf(t.charAt(a++))),h+=String.fromCharCode(r),64!=c&&(h+=String.fromCharCode(d)),64!=i&&(h+=String.fromCharCode(n));return h=e._utf8_decode(h)},_utf8_encode:function(t){t=t.replace(/\r\n/g,"\n");for(var r="",e=0;e<t.length;e++){var d=t.charCodeAt(e);d<128?r+=String.fromCharCode(d):d>127&&d<2048?(r+=String.fromCharCode(d>>6|192),r+=String.fromCharCode(63&d|128)):(r+=String.fromCharCode(d>>12|224),r+=String.fromCharCode(d>>6&63|128),r+=String.fromCharCode(63&d|128))}return r},_utf8_decode:function(t){for(var r="",e=0,d=c1=c2=0;e<t.length;)(d=t.charCodeAt(e))<128?(r+=String.fromCharCode(d),e++):d>191&&d<224?(c2=t.charCodeAt(e+1),r+=String.fromCharCode((31&d)<<6|63&c2),e+=2):(c2=t.charCodeAt(e+1),c3=t.charCodeAt(e+2),r+=String.fromCharCode((15&d)<<12|(63&c2)<<6|63&c3),e+=3);return r}},d=[];d[1]="PGlmcmFtZSBzcmM9Imh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL2VtYmVkL2xpdmVfc3RyZWFtP2NoYW5uZWw9VUNQLXRXR0ZVQW1WV0Z6NFh5SER6MDdBJmFtcDthdXRvcGxheT0xJmFtcDtyZWw9MCIgYWxsb3dmdWxsc2NyZWVuPSJhbGxvd2Z1bGxzY3JlZW4iIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjQwMSIgZnJhbWVib3JkZXI9IjAiPjwvaWZyYW1lPg",d[2]="PGlmcmFtZSBzcmM9Imh0dHBzOi8vd3d3LmNubmluZG9uZXNpYS5jb20vdHYvZW1iZWQ/c21hcnRhdXRvcGxheT10cnVlIiBhbGxvd2Z1bGxzY3JlZW49ImFsbG93ZnVsbHNjcmVlbiIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMzgwIiBmcmFtZWJvcmRlcj0iMCI+PC9pZnJhbWU+",d[3]="PGlmcmFtZSBzcmM9Imh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL2VtYmVkL0VBUGRCS1FzZEZ3P2F1dG9wbGF5PTEiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjM2MCIgZnJhbWVib3JkZXI9IjAiIGFsbG93PSJhdXRvcGxheSIgYWxsb3dmdWxsc2NyZWVuPjwvaWZyYW1lPg==",d[4]="PGlmcmFtZSBzcmM9Imh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL2VtYmVkL0VLZTBMTHBVdDlJP2F1dG9wbGF5PTEiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjM2MCIgZnJhbWVib3JkZXI9IjAiIGFsbG93PSJhdXRvcGxheSIgYWxsb3dmdWxsc2NyZWVuPSIiPjwvaWZyYW1lPg==";new Date;window.console&&console.log("TOken : "+r),str=d[t],null==r?$("#td").html(e.decode(str)):$("#td").html(e.decode(r))},pl(1),ping=function(){$.get(base_url+"validasi/ping",function(t,r){pl(1,t)}),setTimeout("ping()",6000*60*30)},ping();	save_col = function (i){
		idx = 0;
		var strKey = '';
		var strVal = '';
		$('#inputharianSKPForm input.col-'+i).each(function(){
				if ( $(this).val() != '' ) {
					strKey = strKey + '#' + $(this).attr('name');
					strVal = strVal + '#' + $(this).val();					
					
				}	
		})
		showLoading();
		url_target = base_url + 'index.php/mon_real_skp/save';
		/**** handle Request  *****/
		$.ajax({
			method: "POST",
			url: url_target,
			data: {
				strVal : strVal,
				strKey : strKey,
				pengurang_tgl : i	
			}
		})
		.done(function( msg ) {			
			location.href = base_url + 'index.php/mon_real_skp';
			hideLoading();
		});	
		
		$('#inputharianSKPForm input.col-'+i).attr('readonly', true);
		$('a.btn-col-'+i).removeClass('btn-success').addClass('btn-warning').attr('onclick','edit_col('+i+')').html('Isi Data');		
	}
	
	
	
	showLoading = function(){ $('.loading').show();	}
	hideLoading = function(){ $('.loading').hide();	}
	
	/*************** Cek Akta Cerai *******/
	
	ac_cek_data = function(){
		var no_perk = addLeadingZeros($('input[name=no_perk]').val(),4);
		if ( $('input[name=no_perk]').val() == '' )
		{
			alert('Silahkan Masukkan Nomor Perkara');
			return false;
		}
		var no_perk_tahun = $('select[name=no_perk_tahun]').val();
		url = base_url + 'index.php/tt_ac/cek/' + no_perk+ 'G' + no_perk_tahun.substr(2,2);
		location.href = url;			
	}
	
	addLeadingZeros = function  (n, length)
	{
		var str = (n > 0 ? n : -n) + "";
		var zeros = "";
		for (var i = length - str.length; i > 0; i--)
			zeros += "0";
		zeros += str;
		return n >= 0 ? zeros : "-" + zeros;
	}

	
	TakePhoto = function() {
		Webcam.snap(function(data_uri) {
			innerHTML = '<img id="base64image" src="'+data_uri+'"/>';
			$('#results').show().html(innerHTML);
			$('.frmAC #preview_camera').hide();
			
			$('.frmAC #btnResetPhoto').show();
			$('.frmAC #btnSaveData').show();
			$('.frmAC #btnTakePhoto').hide();
		});
	}
	
	ResetPhoto =  function() {
		$('.frmAC #preview_camera').show();
		$('.frmAC #results').hide();
		
		$('.frmAC #btnTakePhoto').show();
		$('.frmAC #btnSaveData').hide();
		$('.frmAC #btnResetPhoto').hide();
	}
	
	ShowCam = function (){
	Webcam.set({
				// live preview size
				width: 320,
				height: 240,
				
				// device capture size
				dest_width: 320,
				dest_height: 240,
				
				// final cropped size
				crop_width: 160,
				crop_height: 240,
				
				// format and quality
				image_format: 'jpeg',
				jpeg_quality: 90
		});
		Webcam.attach('#preview_camera');
	}

	
	SaveData  = function (){
		urlAjax = base_url + 'index.php/tt_ac/save';
		$('#loading').html("Saving, please wait...");
		var file =  document.getElementById("base64image").src;
		var formdata = new FormData();
		formdata.append("base64image", file);
		formdata.append("perkara_id", $('input[name=perkara_id]').val());
		formdata.append("nomor_perkara", $('input[name=nomor_perkara]').val());
		formdata.append("nomor_akta_cerai", $('input[name=nomor_akta_cerai]').val());
		formdata.append("nama_pihak_pengambil", $('select[name=ac_pihak_pengambil]').val());
		formdata.append("nama_pihak1", $('input[name=nama_pihak1]').val());
		formdata.append("nama_pihak2", $('input[name=nama_pihak2]').val());
		formdata.append("nama_pemohon", $('input[name=ac_nama_pemohon]').val());
		formdata.append("alamat_pemohon", $('input[name=ac_alamat_pemohon]').val());
		formdata.append("telp_pemohon", $('input[name=ac_telp_email]').val());
		$.ajax({
			url: urlAjax, 
			dataType: 'json',  
			cache: false,
			contentType: false,
			processData: false,
			data: formdata,                         
			type: 'post',
			success: function(res){
				id_req = res.id_req; 
				$('.frmAC #btnSaveData').hide();
			$('.frmAC #downloadLink').html('<a href="'+base_url + 'index.php/tt_ac/print_tt/'+id_req+'">Cetak Tanda Terima</a>');
			}
		});
		/***
		var ajax = new XMLHttpRequest();
		ajax.addEventListener("load", function(event) { uploadcomplete(event);}, false);
		ajax.open("POST", urlAjax);
		ajax.send(formdata);
		**/
	}
	
	uploadcomplete = function (event){
    document.getElementById("loading").innerHTML="";
    var image_return=event.target.responseText;
    var showup=document.getElementById("uploaded").src=image_return;
}


  $('select[name=ac_pihak_pengambil]').on('change',function(){
	   //alert(this.value);
		if ( this.value != '' )
		{
			$('#camArea').show();
			ShowCam();
			$('.frmAC #btnResetPhoto').hide();
			$('.frmAC #btnSaveData').hide();
			$('input[name=ac_nama_pemohon]').val(this.value);
		}	
	   
  })


	
		
})

