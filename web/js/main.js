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

	$('.personal-perjawatan-index .glyphicon-trash').click(function(e){
		if(confirm('Padam rekod ini?')) {
			var check = $(this).parent().parent().prev().children(':first');
			if(check.is(':checked')) {
				alert('Tidak dibenarkan memadam perjawatan aktif. Sila nyahaktifkan dahulu.');
				return false;
			}
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#perjawatanGrid'});
				if($.trim(data)/1 == -1)
					alert('Tidak dibenarkan memadam perjawatan aktif. Sila nyahaktifkan dahulu.');
			});
		}
		return false;
	});

	//$('.personal-perjawatan-index .glyphicon-trash').click(function(){
	$('.personal-perjawatan-index').on( "click", ".glyphicon-trash", function() {
		if(confirm('Padam rekod ini?')) {
			var check = $(this).parent().parent().prev().children(':first');
			if(check.is(':checked')) {
				alert('Tidak dibenarkan memadam perjawatan aktif. Sila nyahaktifkan dahulu.');
				return false;
			}
			$.post($(this).parent().attr('href'), function(data){
				if($.trim(data) == 1)
					$.pjax.reload({container: '#perjawatanGrid'});
				if($.trim(data)/1 == -1)
					alert('Tidak dibenarkan memadam perjawatan aktif. Sila nyahaktifkan dahulu.');
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
			$.post($(this).attr('href'), function(data){ 
				if($.trim(data)/1 != 1)
					alert(data);
			});
		}
		return false;
	});

	$('.personal-info').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).attr('href'));
		$('#modal-header').html('Maklumat Personal');
		return false;
	});

	$('.personal-perjawatan').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).attr('href'));
		$('#modal-header').html('Maklumat Perjawatan');
		return false;
	});

	$('.personal-kelulusan').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).attr('href'));
		$('#modal-header').html('Maklumat Kelulusan');
		return false;
	});

	$('.personal-bidang').click(function(){
		$('#modal').modal('show').find('#modalContent').load($(this).attr('href'));
		$('#modal-header').html('Maklumat Bidang');
		return false;
	});


	// JAWATAN GRID VIEW

	// $('.jawatan-aktif-check').click(function(){
	// 	if(confirm('Aktifkan jawatan ini?')) {
	// 		$('.jawatan-aktif-check').prop('checked', false);
	// 		$(this).prop('checked', true);
	// 		$.post($(this).val(), function(data){ /*alert(data)*/});
	// 		$('.personal-view .glyphicon-ok').addClass('glyphicon-remove');
	// 		$('.personal-view .glyphicon-remove').removeClass('glyphicon-ok');
	// 		$(this).parent().prev().html('<span class="glyphicon glyphicon-ok"></span>');
	// 	}
	// 	else 
	// 		$(this).prop('checked', !$(this).prop('checked')); 
	// });

	$('.personal-perjawatan-index').on( "click", ".jawatan-aktif-check", function() {
		if(confirm('Aktifkan jawatan ini?')) {
			$('.jawatan-aktif-check').prop('checked', false);
			$(this).prop('checked', true);
			$.post($(this).val(), function(data){ /*alert(data)*/});
			$('.personal-view .glyphicon-ok').addClass('glyphicon-remove');
			$('.personal-view .glyphicon-remove').removeClass('glyphicon-ok');
			$(this).parent().prev().html('<span class="glyphicon glyphicon-ok"></span>');
		}
		else 
			$(this).prop('checked', !$(this).prop('checked')); 
	});

	// This is to trigger When Tab Panel is active

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	  var target = $(e.target).attr("href") // activated tab
	  if(target == '#w4-tab1') {
	  	var len = $('.jawatan-aktif-check:checked').length;
	  	if(len > 1) { 
				for(var i = 0; i < $('.jawatan-aktif-check').length; i++) {
					if($('.jawatan-aktif-check').eq(i).is(':checked')) {
						break;
					}
				}
				$('.jawatan-aktif-check').prop('checked', false);
				//$('.jawatan-aktif-check').eq(i).prop('checked', true);
				$('.jawatan-aktif-check').eq(i).prop('checked', true);
				var value = $('.jawatan-aktif-check').eq(i).val();
				$.post(value, function(data){ /*alert(data);*/});
				$('.personal-view .glyphicon-ok').addClass('glyphicon-remove');
				$('.personal-view .glyphicon-remove').removeClass('glyphicon-ok');
				$('.jawatan-aktif-check').eq(i).parent().prev().html('<span class="glyphicon glyphicon-ok"></span>');
			
			}
		}
	});

	$('#perjawatanGrid').on('pjax:end', function() { 
		$('.perjawatan-aktif-check').prop('checked', false);
		setActivePerjawatan();
	});

	function setActivePerjawatan() {
		if($('.perjawatan-aktif-check:checked').length == 0) { // find checked box, if no checked set the last inserted record
			$('.perjawatan-aktif-check').eq(0).prop('checked', true);
			var value = $('.perjawatan-aktif-check').eq(0).val();
			$.post(value, function(data){ /*alert(data);*/});
		}

	}
	

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

	// $('.bidang-aktif-check').on('click', function(){
	// 	$('.bidang-aktif-check').prop('checked', false);
	// 	$(this).prop('checked', true);
	// 	$.post($(this).val(), function(data){ /*alert(data)*/});
	// });

	// Setting untuk activekan bidang

	$('.personal-bidang-index').on('click', '.bidang-aktif-check', function(){
		if(confirm('Setkan bidang ini?')) {
			$('.bidang-aktif-check').prop('checked', false);
			$(this).prop('checked', true);
			$.post($(this).val(), function(data){ /*alert(data)*/});
			$('#w5.nav-tabs > li.active').removeClass('active').addClass('disabled');
			$('#w5.nav-tabs > li:first-child a').trigger('click');
			//$('#w5.nav-tabs > li:first-child').addClass('active');
		}
		else 
			$(this).prop('checked', !$(this).prop('checked')); 
	});


	$('li').click(function(e){ 
		if($(this).hasClass('disabled')) {
			e.stopPropagation();
			//$('#w5.nav-tabs > li:first-child a').trigger('click');
		}
	});

	// This is to set latest inserted personal bidang active
	//$('#bidangGrid').on('pjax:start', function() { alert('will load'); });
	$('#bidangGrid').on('pjax:end', function() { 
		$('.bidang-aktif-check').prop('checked', false);
		setActiveBidang();
	});

	function setActiveBidang() {
		if($('.bidang-aktif-check:checked').length == 0) { // find checked box, if no checked set the last inserted record
			$('.bidang-aktif-check').eq(0).prop('checked', true);
			var value = $('.bidang-aktif-check').eq(0).val();
			$.post(value, function(data){ /*alert(data);*/});
		}

	}


	//setActiveBidang();

	// EVALUATION

	//$('input[name=header-radio]').click(function(){
	$('.penilaian-markah').on('click', 'input[name=header-radio]', function(){
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

	//ADMIN

	$('.access input').click(function(){
		//alert($(this).parent().parent().attr('id'));

		if(confirm('Set akses pengguna ini?')) {
			var access_string = '';
			var check_input_label = $(this).parent().parent().children(); 
			var parentDiv = $(this).parent().parent();
			var total_check_input_label = check_input_label.length;
			for(var i = 0; i < total_check_input_label; i++) {
				if(check_input_label.eq(i).children().is(':checked')) {
					if(access_string == '')
						access_string = check_input_label.eq(i).children().val();
					else	
						access_string += ',' + check_input_label.eq(i).children().val();
				}
			}
			//alert(parentDiv.attr('dir'));
			$.post(parentDiv.attr('dir'), {val:access_string}, function(data){ if($.trim(data) != 1) alert('error! '+data);});
		}
		else {
			$(this).prop('checked', !$(this).prop('checked')); 
		}
	});

	$('.access input').load(function(){
		
		// $(this).attr('title','XXX');
		// $(this).tooltip();
	});

	$('input[name="access_level[]"][value=0]').attr('title','Admin System');
	$('input[name="access_level[]"][value=0]').tooltip();
	$('input[name="access_level[]"][value=1]').attr('title','Admin UPPK');
	$('input[name="access_level[]"][value=1]').tooltip();
	$('input[name="access_level[]"][value=2]').attr('title','Admin Agensi');
	$('input[name="access_level[]"][value=2]').tooltip();
	$('input[name="access_level[]"][value=3]').attr('title','Admin Institut');
	$('input[name="access_level[]"][value=3]').tooltip();
	$('input[name="access_level[]"][value=4]').attr('title','HOD');
	$('input[name="access_level[]"][value=4]').tooltip();
	$('input[name="access_level[]"][value=5]').attr('title','Executive');
	$('input[name="access_level[]"][value=5]').tooltip();
	$('input[name="access_level[]"][value=6]').attr('title','Data Entry');
	$('input[name="access_level[]"][value=6]').tooltip();
	$('input[name="access_level[]"][value=7]').attr('title','Pengajar');
	$('input[name="access_level[]"][value=7]').tooltip();

	//	$('#penilaian-tablel table').DataTable({"pageLength": 2});


    $("[data-toggle='tooltip']").tooltip(); 

    $("[data-toggle='popover']").popover(); 


});