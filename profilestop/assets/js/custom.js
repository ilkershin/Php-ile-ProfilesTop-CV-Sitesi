(function($){

    "use strict";

	$('#confirm-delete').on('show.bs.modal', function(e) {
	    // Silme işlemi onaylandığında, ilgili butonun href değerini güncelleme
	    $(this).find('.btn-primary').attr('href', $(e.relatedTarget).data('href'));
	});

	// Toastr bildirim ayarları
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": true,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}

	$(document).ready( function () {
		// DataTables özelliğini kullanarak tabloları etkinleştirme
		$(".dataTable").DataTable({
			responsive: true
		});
	} );

})(jQuery);

function previewFile(input){
	var file = $("input[type=file]").get(0).files[0];

	if(file){
	    var reader = new FileReader();

	    reader.onload = function(){
	        // Dosyanın önizlemesini yapmak için görüntüyü güncelleme
	        $("#profileImg").attr("src", reader.result);
	    }

	    reader.readAsDataURL(file);
	}
}	