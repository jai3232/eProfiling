$(function(){

	// PERSONAL PERJAWATAN

	$('#modalButton').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
		$('#modal-header').html('Tambah Perjawatan');
	});

	$('.personal-perjawatan-index .glyphicon-pencil').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).parent().attr('href'));
		$('#modal-header').html('Kemaskini Perjawatan');
		return false;
	});

	$('.personal-perjawatan-index .glyphicon-eye-open').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).parent().attr('href'));
		$('#modal-header').html('Maklumat Perjawatan');
		return false;
	});

	$('.personal-perjawatan-index').on( "click", ".glyphicon-pencil", function() {
  	$('#modal').modal('show').find('#modalContent').load($(this).parent().attr('href'));
		$('#modal-header').html('Kemaskini Perjawatan');
		return false;
	});


	$('.personal-perjawatan-index').on( "click", ".glyphicon-eye-open", function() {
  	$('#modal').modal('show').find('#modalContent').load($(this).parent().attr('href'));
		$('#modal-header').html('Maklumat Perjawatan');
		return false;
	});

	// $('.personal-perjawatan-index').on( "click", ".glyphicon-trash", function() {
 //  	$('#modal').modal('show').find('#modalContent').load($(this).parent().attr('href'));
	// 	$('#modal-header').html('Maklumat Perjawatan');
	// 	return false;
	// });

	$('.personal-perjawatan-index .glyphicon-trash').click(function(){
		if(confirm('Padam rekod ini?')) {
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#perjawatanGrid'});
			});
		}
		return false;
	});

	//$('.personal-perjawatan-index .glyphicon-trash').click(function(){
	$('.personal-perjawatan-index').on( "click", ".glyphicon-trash", function() {
		if(confirm('Padam rekod ini?')) {
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#perjawatanGrid'});
			});
		}
		return false;
	});

	// PERSONAL KELULUSAN

	$('#tambah-kelulusan').click(function(){
		$('#modal2').modal('show').find('#modalContent2').load($(this).attr('value'));
		$('#modal-header2').html('Tambah Kelulusan');
	});

	$('.personal-kelulusan-index .glyphicon-pencil').click(function(){
		$('#modal2').modal('show').find('#modalContent2').load($(this).parent().attr('href'));
		$('#modal-header2').html('Kemaskini Kelulusan');
		return false;
	});

	$('.personal-kelulusan-index .glyphicon-eye-open').click(function(){
		$('#modal2').modal('show').find('#modalContent2').load($(this).parent().attr('href'));
		$('#modal-header2').html('Maklumat Kelulusan');
		return false;
	});

	$('.personal-kelulusan-index').on( "click", ".glyphicon-pencil", function() {
  	$('#modal2').modal('show').find('#modalContent2').load($(this).parent().attr('href'));
		$('#modal-header2').html('Kemaskini Perjawatan');
		return false;
	});

	$('.personal-kelulusan-index').on( "click", ".glyphicon-eye-open", function() {
  	$('#modal2').modal('show').find('#modalContent2').load($(this).parent().attr('href'));
		$('#modal-header2').html('Maklumat Perjawatan');
		return false;
	});

	$('.personal-kelulusan-index').on( "click", ".glyphicon-trash", function() {
		if(confirm('Padam rekod ini?')) {
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#kelulusanGrid'});
			});
		}
		return false;
	});

	$('.personal-kelulusan-index .glyphicon-trash').click(function(){
		if(confirm('Padam rekod ini?')) {
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#kelulusanGrid'});
			});
		}
		return false;
	});

	// PERSONAL GRID VIEW

	$('.aktif-check').click(function(){
		var checked = $(this).is(':checked');
		if(checked) {
			$.post($(this).val()+'&checked=0', function(data){ /*alert(data)*/});
		}
		else {
			$.post($(this).val()+'&checked=1', function(data){ /*alert(data)*/});
		}
	});

	$('.tahap-akses').change(function(){
		//alert($(this).attr('title')+'&'+$(this).val());
		$.post($(this).attr('title')+'&val='+$(this).val(), function(data){/*alert(data)*/});
	});

	$('.personal-sah').click(function(){
		if(confirm('Peraku pengguna ini?')) {
			$(this).parent().prev().html(4);
			$(this).parent().html('Selesai');
		}
		return false;
	});
});