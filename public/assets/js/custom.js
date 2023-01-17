	$('#click').click(function(){
		$('.navbar-toggle').css({transition:'ease .3s',top:'0%'});
	});
	$('#click2').click(function(){
		$('.navbar-toggle').css({transition:'ease .3s',top:'-12%'});
	});

	$('#poli').change(function(){
		var poli = $(this).val();
		$.ajax({
			url: 'http://localhost/poliklinik_2017/?c=operator&m=get_dokter&id='+poli,
			type: 'GET',
		})
		.done(function(param) {
			$('#dokter').each(function(){
				$(this).html(param);
			});
		})
		.fail(function(fail) {
			console.log(fail);
		})
	});

	$('#poli_admin').change(function(){
		var poli = $(this).val();
		$.ajax({
			url: 'http://localhost/poliklinik_2017/?c=admin&m=get_dokter&id='+poli,
			type: 'GET',
		})
		.done(function(param) {
			$('#dokter').each(function(){
				$(this).html(param);
			});
		})
		.fail(function(fail) {
			console.log(fail);
		})
	});

	$('#jagaw').change(function(){
		var poli = $(this).val();
		$.ajax({
			url: 'http://localhost/poliklinik_2017/?c=petugas&m=get_dokter&id='+poli,
			type: 'GET'
		})
		.done(function(param) {
			$('#dokter-resep').each(function(){
				$(this).html(param);
			});
		})
		.fail(function(fail) {
			console.log("error");
		});
	});

	$('#jagaw_admin').change(function(){
		var poli = $(this).val();
		$.ajax({
			url: 'http://localhost/poliklinik_2017/?c=admin&m=get_dokter&id='+poli,
			type: 'GET'
		})
		.done(function(param) {
			$('#dokter-resep').each(function(){
				$(this).html(param);
			});
		})
		.fail(function(fail) {
			console.log("error");
		});
	});

	$('#bayar').keyup(function(){
		var bayar = parseInt($(this).val());
		var total = parseInt($('.total').val());
		$('#kembali').val(bayar - total);
	});

	$('.resep-dokter').on('change','.obat-petugas',function(){
		var resep = $(this).val();
		var jumlah_bayar = $('.total-petugas').val();
		$.ajax({
			url: 'http://localhost/poliklinik_2017/?c=petugas&m=get_harga&obat='+resep,
			type: 'GET',
		})
		.done(function(param) {
			var value = parseInt(param);
			var div = $(this).length;
			var bayar = $('.total-petugas').val();
			var i = 0;
			$(this).each(function(){
				value+=(bayar != '' ? parseInt(bayar) : ''); 
			});
			$('.total-petugas').val(value);
			$('.bnyk-petugas').val('1');
		})
		.fail(function(error) {
			console.log(error);
		})
	});

	$('.resep-admin').on('change','.obat-admin',function(){
		var resep = $(this).val();
		var jumlah_bayar = $('.jmlh-admin').val();
		$.ajax({
			url: 'http://localhost/poliklinik_2017/?c=admin&m=get_harga&obat='+resep,
			type: 'GET',
		})
		.done(function(param) {
			var value = parseFloat(param);
			var div = $(this).length;
			var bayar = $('.jmlh-admin').val();
			var i = 0;
			$(this).each(function(){
				value+=(bayar != '' ? parseInt(bayar) : ''); 
			});
			$('.jmlh-admin').val(value);
			$('.bnyk-admin').val('1');
			// console.log(value);
		})
		.fail(function(error) {
			console.log(error);
		})
	});

	$('.resep-admin').on('keyup','.bnyk-admin',function() {
		var harga = $('.jmlh-admin').val();
		var jumlah = ($(this).val() != '' ? $(this).val() * harga : harga);
		$('.jmlh-admin').val(jumlah);
	});

	$('.resep-dokter').on('keyup','.bnyk-petugas',function() {
		var harga = $('.total-petugas').val();
		var jumlah = ($(this).val() != '' ? $(this).val() * harga : harga);
		$('.total-petugas').val(jumlah);
	});

	$('.bayar-petugas').keyup(function(){
		var total_harga = $('.total-petugas').val();
		var bayar = $(this).val();
		var kembali = bayar - total_harga;

		$('.kembali-petugas').val(kembali);
	});

	$('#tambah').click(function(){
		$('#hapus').css({visibility:'visible'});
		$('.resep-dokter').each(function(){
			$('#nm_obt').clone().appendTo('.resep-dokter');
			$('#jml_obt').clone().appendTo('.resep-dokter');
			$('#dss_obt').clone().appendTo('.resep-dokter');
		});
	});

	$('#hapus').click(function(){
		$('#nm_obt').remove().eq(1);
		$('#jml_obt').remove().eq(1);
		$('#dss_obt').remove().eq(1);
		if ($('.resep-dokter').children().length == 3) {
			$(this).css({transition:'0s',visibility:'hidden'});
		}
	});

