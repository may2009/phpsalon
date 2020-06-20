//var config_url = "http://192.168.138.31/RaGu/bookmysaloon-admin-panel/";
//var config_url = "http://www.techware.in/bms-admin/";
$( "form.validate" ).submit(function( event ) {

	var access = true;
	$(this).find('.required').each(function() {
		var v = $(this).val();
		if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).parents(".form-group").addClass("has-error");
		}
		else {
			var n = $(this).attr("name");
			if(n == "phone_no") {
				var phoneno = /^\d{10}$/;
				if(v.match(phoneno)) {
					$(this).parents(".form-group").removeClass("has-error");
				}
				else {
					access = false;
					$(this).parents(".form-group").addClass("has-error");
				}
			}
			else {
				$(this).parents(".form-group").removeClass("has-error");
			}
		}
	});
	if(access) {
		return;
	}
	else {
		$("body").animate({ scrollTop: $('.has-error').offset().top - 50 }, "slow");
	}
	event.preventDefault();
	
});

$( "form.validate .required" ).change(function( event ) {
	var v = $(this).val();
	if((v.replace(/\s+/g, '')) == '') {
		$(this).parents(".form-group").addClass("has-error");
	}
	else {
		$(this).parents(".form-group").removeClass("has-error");
	}
});
// View Shop Details
$(function() {
	

$('#pick-map').click(function (e) {
        e.preventDefault();
        $('#mapModal').modal('show');
});
	
$('#mapModal').on('shown.bs.modal', function () {
	load_map();
	//google.maps.event.trigger(map, 'resize')
});

$('.select-location').click(function (e) {
	$('#latitude').val($('#pick-lat').val());
	$('#longitude').val($('#pick-lng').val());
	$('#mapModal').modal('hide');
});

$('.view-shop').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'shop/view_single_shop';
	var result = post_ajax(url, data);
	if(result != 'error') {
	$('#myModal .modal-body').html(result);
	remove_shop_service();
	}
	reload_gallery();
});

$('.view-review').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'review/view_shop_review';
	var result = post_ajax(url, data);
	if(result != 'error') {
	$('#myModal .modal-body').html(result);
	rating();
	
	}
});

$('.thumbnails').on('click', '.gallery-delete', function (e) {
    e.preventDefault();
    //get image id
    var id = $(this).parents('.thumbnail').data("id");
	var data = {id:id};
	var url = config_url+'shop/delete_gallery_image';
	var result = post_ajax(url, data);
	if(result != 'error') {
		$(this).parents('.thumbnail').fadeOut();
	}
    });
    
 $('.view-customer').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'customer/view_single_customer';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	
	reload_gallery();
	
});

$('.view-bookings').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var status = $(this).data('status');
	if(status == "Booked") {
		$("#complete-booking").show();
		
	}
	else {
		$("#complete-booking").hide();
	}
	$("#complete-booking").attr("data-id",id);
	var data = {id:id};
	var url = config_url+'booking/view_booking_details';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	setTimeout(function() {
		add_services();
	},1000);
	
});

$('#complete-booking').on("click", function() {
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'booking/complete_booking_details';
	var result = post_ajax(url, data);
	location.reload();
	
	
});


 $('.view-user').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'user/view_single_user';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
	
});

 $('.view-trend').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'trend/view_single_trend';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
});

$('.view-slider').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'settings/view_single_slider';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
});

$('.view-whats-new').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'settings/view_whats_new';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
});

$('.view-ad').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'ad/view_single_ad';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
});

$('.view-offers').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'offers/view_single_offers';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
});

$('.view-testimonials').on("click", function() {
	var loader = '<p class="text-center"><img src="'+config_url+'/assets/images/ajax-loader-4.gif" /></p>';
	$('#myModal .modal-body').html(loader);
	$('#myModal').modal({show:true});
	var id = $(this).data('id');
	var data = {id:id};
	var url = config_url+'testimonials/view_single_testimonials';
	var result = post_ajax(url, data);
	$('#myModal .modal-body').html(result);
	reload_gallery();
});
	
});


function post_ajax(url, data) {
	var result = '';
	$.ajax({
        type: "POST",
        url: url,
		data: data,
		success: function(response) {
			result = response;
		},
		error: function(response) {
			result = 'error';
		},
		async: false
		});
		
		return result;
}

function add_services() {
	$('.btn-minimize').on("click",function (e) {
        e.preventDefault();
        var $target = $(this).parent().parent().next('.box-content');
        if ($target.is(':visible')) $('i', $(this)).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        else                       $('i', $(this)).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        $target.slideToggle();
    });
	
	$('#add_new_services').on("click",function (e) {
        e.preventDefault();
		var data = $('#new_services_form').serialize();
		if(data=='') {
			$('.new_service_message').show();
		}
		else {
			$('.new_service_message').hide();
			data = data+"&booking_id="+$(this).data("id")+"&shop_id="+$(this).data("shop");
			var url = config_url+'booking/add_new_services';
			var result = post_ajax(url, data);
			if(result == "success") {
				sessionStorage.load_booking = $(this).data("id");
				location.reload();
			}
		}
    });
}

function reload_gallery() {
	
	$('.thumbnail a').colorbox({
        rel: 'thumbnail a',
        transition: "elastic",
        maxWidth: "95%",
        maxHeight: "95%",
        slideshow: true
    });
	
}

function remove_shop_service() {
	$('.remove_services').on("click", function() {
		var id = $(this).data("id");
		var data = {id:id};
		var url = config_url+'shop/remove_shop_service';
		var result = post_ajax(url, data);
		if(result != 'Error') {
			$(this).parents('.row').first().remove();
		}
	});
	
}

function load_map() {
	var map = new google.maps.Map(document.getElementById('map_canvas'), {
						zoom: 7,
						center: new google.maps.LatLng(35.137879, -82.836914),
						mapTypeId: google.maps.MapTypeId.HYBRID
					});
					
	var myMarker = new google.maps.Marker({
		position: new google.maps.LatLng(9.369, 76.803),
		draggable: true
	});
	
	var latitude = document.getElementById('pick-lat');
	var longitude = document.getElementById('pick-lng');
	
	google.maps.event.addListener(myMarker, 'dragend', function (evt) {
		document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
		latitude.value = evt.latLng.lat().toFixed(3);
		longitude.value = evt.latLng.lng().toFixed(3);
	});
	
	google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
		document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
	});
	
	map.setCenter(myMarker.position);
	myMarker.setMap(map);
}