$.ajaxSetup({
	headers: {
	    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	}
});

$(document).on('keyup paste','.number',function(){
    this.value = this.value.replace(/[^0-9]/g, '');
});