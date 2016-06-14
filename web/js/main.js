$(function(){
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
		$('#modal-header').html('Kemaskini Perjawatan');
		return false;
	});

	$('.glyphicon-trash').click(function(){
		if(confirm('Delete?')) {

		}
		return false;
	});
});