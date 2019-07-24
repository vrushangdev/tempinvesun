$.ajaxSetup({
	headers: {
	    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	}
});

$(document).on('keyup paste','.number',function(){
    this.value = this.value.replace(/[^0-9]/g, '');
});

$(document).on('click','#copyButton',function(){
	copyToClipboard('#copyTarget')
})

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).val()).select();
  document.execCommand("copy");
  $temp.remove();
}