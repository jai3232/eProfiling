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


	// JAWATAN GRID VIEW
	$('.jawatan-aktif-check').click(function(){
		$('.jawatan-aktif-check').prop('checked', false);
		$(this).prop('checked', true);
		$.post($(this).val(), function(data){ /*alert(data)*/

		});
		$('.personal-view .glyphicon-ok').addClass('glyphicon-remove');
		$('.personal-view .glyphicon-remove').removeClass('glyphicon-ok');
		$(this).parent().prev().html('<span class="glyphicon glyphicon-ok"></span>');
	});

	// PERSONAL BIDANG

	$('#tambah-bidang').click(function(){
		$('#modal3').modal('show').find('#modalContent3').load($(this).attr('value'));
		$('#modal-header3').html('Tambah Bidang');
	});

	$('.personal-bidang-index').on('click', '.glyphicon-pencil', function(){
		$('#modal3').modal('show').find('#modalContent3').load($(this).parent().attr('href'));
		$('#modal-header3').html('Kemaskini Bidang');
		return false;
	});

	$('.personal-bidang-index').on('click', '.glyphicon-eye-open', function(){
		$('#modal3').modal('show').find('#modalContent3').load($(this).parent().attr('href'));
		$('#modal-header3').html('Maklumat Bidang');
		return false;
	});

	$('.personal-bidang-index').on( "click", ".glyphicon-trash", function() {
		if(confirm('Padam rekod ini?')) {
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#bidangGrid'});
			});
		}
		return false;
	});

	$('.bidang-aktif-check').on('click', function(){
		$('.bidang-aktif-check').prop('checked', false);
		$(this).prop('checked', true);
		$.post($(this).val(), function(data){ /*alert(data)*/});
		
	});


	if($('.bidang-aktif-check:checked').length == 0) { // find checked box, if no checked set the last inserted record
		$('.bidang-aktif-check').eq(0).prop('checked', true);
		var value = $('.bidang-aktif-check').eq(0).val();
		$.post(value, function(data){ /*alert(data);*/});

	}

	// EVALUATION

	$('input[name=header-radio]').click(function(){
		if($(this).val()/1 == 0) {
			$('.score-radio input').removeAttr('checked');
			$('.score-radio input[value=0]').prop('checked', true);
			
		}
		if($(this).val()/1 == 1) {
			$('.score-radio input').removeAttr('checked');
			$('.score-radio input[value=1]').prop('checked', true);
		}
		if($(this).val()/1 == 2) {
			$('.score-radio input').removeAttr('checked');
			$('.score-radio input[value=2]').prop('checked', true);
		}
		if($(this).val()/1 == 3) {
			$('.score-radio input').removeAttr('checked');
			$('.score-radio input[value=3]').prop('checked', true);
		}
		if($(this).val()/1 == 4) {
			$('.score-radio input').removeAttr('checked');
			$('.score-radio input[value=4]').prop('checked', true);
		}
	});

});