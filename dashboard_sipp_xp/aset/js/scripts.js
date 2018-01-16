/**** 
xkurnx@gmail.com
kisaran 10-02-2017
****/

$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading");    },
     ajaxStop: function() { $body.removeClass("loading"); }    
});

$(document).ready(function(){
	
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
	
	save_col = function (i){
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
	
	
})