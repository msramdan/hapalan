const flasData = $('.flash-data').data('flashdata'); //dataflash ini harus di panggil di fofter ex lane 182 footer
const flasDataError = $('.flash-data2').data('flashdata2');


if(flasData){
	Swal.fire(
	  'Terima Kasih',
	  flasData,
	  'success'
	)
}

if(flasDataError){
	Swal.fire(
	  'Error 404',
	  flasDataError,
	  'error'
	)
}


