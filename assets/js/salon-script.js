


//var base_url = "http://www.bookmysalons.com/";
//var base_url = "http://192.168.138.31/Najeela/Codecanyon_BMS/newBMS/";

var city = "Select City ";

/* Maps */
		var map;
        var geocoder;
        var marker;
        var people = new Array();
        var latlng;
        var infowindow;

/*------------------
-------Test---------
------------------*/
$(function() {
	/*$('img').each(function() {
		var src = $(this).attr("src");
		src = base_url+"assets/"+src;
		//$(this).attr("src",src);
	});*/
	$( "form.custom_validate" ).submit(function( event ) {
	var access = true;
	$(this).find('.required').each(function() {
		var v = $(this).val();
		if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error");
		}
		else {
			var n = $(this).attr("name");
			if(n == "phone_no") {
				var phoneno = /^\d{10}$/;
				if(v.match(phoneno)) {
					$(this).removeClass("has-error");
				}
				else {
					access = false;
					$(this).addClass("has-error");
				}
			}
			else {
				$(this).removeClass("has-error");
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
});

/*--------------------------
----- Post Ajax ------------
----------------------------*/
function post_ajax(url, data) {
	var result = {};
	$.ajax({
        type: "POST",
        url: config_url+url,
		data: data,
		headers: headers,
		success: function(response) {
			result = response;
		},
		error: function(response) {
			result = response.responseJSON;
		},
		async: false
		});
		
		return result;
}

/*--------------------------
----- Post Ajax ------------
----------------------------*/
function post_ajax_bms(url, data) {
	var result = {};
	$.ajax({
        type: "POST",
        url: base_url+url,
		data: data,
		success: function(response) {
			result = response;
		},
		error: function(response) {
			result = response.responseJSON;
		},
		async: false
		});
		
		return result;
}

/*---------------------------
---- Validate Email ------
---------------------------*/

function validate_email(v) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test( v );
}

function validate_phone(v) {
	var phoneno = /^\d{10}$/;
	if(v.match(phoneno)) {
		return true;
	}
	else {
		return false;
	}
}


jQuery(document).ready(function ($) {   
	
/*-------------------
Load predefined functions
-----------------*/
	rating_shop();
	load_more();
	
/*-------------------
Show Loader
-------------------*/	
$(document).ajaxStart(function(){
    $('.spinner').show();
});
$(document).ajaxStop(function(){
    $('.spinner').hide();
});

if($('.booking-beauty-dept').length > 0) {
	$("body, html").animate({ scrollTop: $('.booking-beauty-dept').offset().top - 50 }, "slow");
}

/*-----------------
Find current city
------------------*/
/*$.get("http://ipinfo.io", function (response) {
    $('.styled-select').html(response.city);
}, "jsonp");*/

$( ".required" ).on("change", function() {
	
	var v = $(this).val();
	var key = $(this).attr("name");
	var type = $(this).attr("type");
	if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
		}
		else {
			$(this).removeClass("has-error").next('span').removeClass('is-visible');
			if(key == "email_id") {
				if(!validate_email(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			else if(key == "phone_no") {
				if(!validate_phone(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			else if(type=="checkbox") {
				if(!$(this).is(":checked")) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			/*if(type != "checkbox") {
				data[key] = v;
			}*/
		}
});

	var $form_modal = $('.cd-user-modal'),
		$form_login = $form_modal.find('#cd-login'),
		$form_signup = $form_modal.find('#cd-signup');

////////////// Signup /////////////////////////////////////////

	$( "#signUp" ).submit(function( event ) {
	event.preventDefault();
	var thiss = $(this);
	var url = "home/"+thiss.attr("id");
	var access = true,
	    error = true;
	    data = {};
	$(this).find('.required').each(function() {
		var v = $(this).val();
		var key = $(this).attr("name");
		var type = $(this).attr("type");
		if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
		}
		else {
			$(this).removeClass("has-error").next('span').removeClass('is-visible');
			if(key == "email_id") {
				if(!validate_email(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			else if(key == "phone_no") {
				if(!validate_phone(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			else if(type=="checkbox") {
				if(!$(this).is(":checked")) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			if(type != "checkbox") {
				data[key] = v;
			}
		}
		
	});
	if(access) {
		var result = post_ajax_bms(url, data);
		result = JSON.parse(result);
		if(result.status == 'failure') {
			var error = '<div class="error">';
			$.each(result.message, function( index, value ) {
  				error += '<div>'+value+'</div>';
			});
			error += '</div>';
			thiss.find('.message').html(error);
		}
		else if(result.status == 'success') {
			var error = '<div class="success"><div>'+result.message+'</div>';
			thiss.find('.message').html(error);
			localStorage.token = result.token;
			//window.location.href = window.location.href;
			//login_selected();
			$('form#signUp').hide();
			//$('form#signUp_otp').show();
			//$('form#signIn').show();
			login_selected();
		}
		else if(result == undefined) {
			var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
			thiss.find('.message').html(error);
		}
	}
	event.preventDefault();
	
	});

//////////////////// Signup OTP //////////////////////////////////

	$( "#signUp_otp, #signIn_otp" ).submit(function( event ) {
		event.preventDefault();
		var thiss = $(this);
		var url = "home/verify_otp";
		var access = true,
			error = true;
			data = {};
		$(this).find('.required').each(function() {
			var v = $(this).val();
			var key = $(this).attr("name");
			if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
			}
			else {
				$(this).removeClass("has-error").next('span').removeClass('is-visible');
				data[key] = v;
			}
		});
		
	if(access) {
		data['token'] = localStorage.token;
		var result = post_ajax_bms(url, data);
		result = JSON.parse(result);
		if(result.status == 'failure') {
			var error = '<div class="error">';
			$.each(result.message, function( index, value ) {
  				error += '<div>'+value+'</div>';
			});
			error += '</div>';
			thiss.find('.message').html(error);
		}
		else if(result.status == 'success') {
			var error = '<div class="success"><div>'+result.message+'</div>';
			thiss.find('.message').html(error);
			result.remember = '0';
			//alert(JSON.stringify(result));
			$.ajax({
				type: "POST",
				url: base_url+"home/login_success",
				data: result,
				
				success: function(response) {
					//location.reload();
					window.location.href = window.location.href;
					//alert(response);
				},
				error: function(response) {
					var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
					thiss.find('.message').html(error);
				}
			});
			
		}
		else if(result == undefined) {
			var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
			thiss.find('.message').html(error);
		}
	}
	});

//////////////////// SignIn ///////////////////////////////////////

	$( "#signIn" ).submit(function( event ) {
		event.preventDefault();
		var thiss = $(this);
		var url = "home/"+thiss.attr("id");
		var access = true,
			error = true;
			data = {};
		$(this).find('.required').each(function() {
			var v = $(this).val();
			var key = $(this).attr("name");
			if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
			}
			else {
				$(this).removeClass("has-error").next('span').removeClass('is-visible');
				data[key] = v;
			}
		});
		
	if(access) {
		var result = post_ajax_bms(url, data);
		result = JSON.parse(result);
		if(result.status == 'failure') {
			var error = '<div class="error">';
			$.each(result.message, function( index, value ) {
  				error += '<div>'+value+'</div>';
			});
			error += '</div>';
			thiss.find('.message').html(error);
		}
		else if(result.status == 'verify') {
			$('form#signIn').hide();
			$('form#signIn_otp').show();
		}
		else if(result.status == 'success') {
			var error = '<div class="success"><div>'+result.message+'</div>';
			thiss.find('.message').html(error);
			/*localStorage.token = result.token;
			localStorage.username = result.profile.username;
			localStorage.name = result.profile.firstname;*/
			result.remember = '0';
			if(thiss.find('#remember-me').is(":checked")) {
				result.remember = '1';
			}
			//alert(JSON.stringify(result));
			$.ajax({
				type: "POST",
				url: base_url+"home/login_success",
				data: result,
				
				success: function(response) {
					//location.reload();
					window.location.href = window.location.href;
					//alert(response);
				},
				error: function(response) {
					var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
					thiss.find('.message').html(error);
				}
			});
			
		}
		else if(result == undefined) {
			var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
			thiss.find('.message').html(error);
		}
	}
	});

//////////////////// Forgot Password /////////////////////////////////////////
$( "#forgotForm" ).submit(function( event ) {
	event.preventDefault();
	var thiss = $(this);
	var url = "home/forgotPwd";
	var access = true,
	    error = true;
	    data = {};
	$(this).find('.required').each(function() {
		var v = $(this).val();
		var key = $(this).attr("name");
		var type = $(this).attr("type");
		if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
		}
		else {
			$(this).removeClass("has-error").next('span').removeClass('is-visible');
			if(key == "email_id") {
				if(!validate_email(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
				else {
				data[key] = v;
				}
			}
			
		}
		
	});
	if(access) {
		var result = post_ajax_bms(url, data);
		result = JSON.parse(result);
		if(result.status == 'failure') {
			var error = '<div class="error">';
			$.each(result.message, function( index, value ) {
  				error += '<div>'+value+'</div>';
			});
			error += '</div>';
			thiss.find('.message').html(error);
		}
		else if(result.status == 'success') {
			var error = '<div class="success"><div>'+result.message+'</div>';
			$('form#signIn').find('.message').html(error);
			//localStorage.token = result.token;
			//window.location.href = window.location.href;
			login_selected();
			//$('form#signUp').hide();
			//$('form#signUp_otp').show();
		}
		else if(result == undefined) {
			var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
			thiss.find('.message').html(error);
		}
	}
	event.preventDefault();
	
	});


//////////////////////// Send OTP again //////////////////////////////////////

	$('.send_otp_again').click(function() {
			$(this).find('i').addClass("fa-refresh fa-spin").removeClass("fa-check");

			var url = "home/send_otp_again";
			var result = post_ajax_bms(url, data);
			$(this).next().addClass("fa-check").removeClass("fa-refresh fa-spin");
	});

////////////////// Contact Form //////////////////////////////////////////////

	$( "#contactForm" ).submit(function( event ) {
	//event.preventDefault();
	var thiss = $(this);
	var url = thiss.attr("id");
	var access = true;
	$(this).find('.required').each(function() {
		var v = $(this).val();
		var key = $(this).attr("name");
		var type = $(this).attr("type");
		if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
		}
		else {
			$(this).removeClass("has-error").next('span').removeClass('is-visible');
			if(key == "email_id") {
				if(!validate_email(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			else if(key == "phone_no") {
				if(!validate_phone(v)) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			/*else if(type=="checkbox") {
				if(!$(this).is(":checked")) {
					access = false;
					$(this).addClass("has-error").next('span').addClass('is-visible');
				}
			}
			if(type != "checkbox") {
				data[key] = v;
			}*/
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
	
	
/*-------------------
Filter Funciton
--------------------*/
$('.shop_filter_form').submit(function(event) {
	event.preventDefault();
});
$('.shop_filter_form .filter-field').on("change", function(event) {
	event.preventDefault();
	$('#current_page').val(1);
	filter_shops();
});

$('.shop_filter_form .reset-filter').on("click", function(event) {
	//$('.shop_filter_form')[0].reset();
	document.getElementById("shop_filter_form").reset();
	$('#current_page').val(1);
	filter_shops();
	event.preventDefault();
});


/*-----------------
Book Shop
-----------------*/
$( "#book-shop" ).submit(function( event ) {
		event.preventDefault();
		
		var v = $(this).find('input[type="checkbox"]:checked').val();
		if(v == undefined) {
			var error = '<div class="error"><div>Please select services. </div></div>';
			$(this).find('.message').html(error);
		}
		else {
			$(this).find('.message').html('');
		var value = $(this).serialize();
		$.ajax({
				type: "POST",
				url: base_url+"shop/book_shops",
				data: value,
				success: function(response) {
					//location.reload();
					//alert(response);
					$( "#book-shop" ).hide();
					$('.booking-details-wrapper').html(response).show();
					confirm_booking();
					$('html, body').animate({scrollTop:$('.booking-beauty-dept').position().top}, 'slow');
				},
				error: function(response) {
					var error = '<div class="error"><div>Sorry, Error Occured. Please Try Again. </div></div>';
					$(this).find('.message').html(error);
					//alert('error');
				}
			});
		}
});



$('#saloon-user-login').on('click', function(){
		$main_nav.children('ul').removeClass('is-visible');
		//show modal layer
		$body.addClass('model-body');
		$form_modal.addClass('is-visible');
		login_selected();
});

/* Change Password */
$('#change-password').on('click', function(){
		
		
		// on mobile close submenu
		var thiss = $('#change-password-form');
		var access = true,
			data = {};
		thiss.find('.required').each(function() {
			var v = $(this).val();
			var key = $(this).attr("name");
			if((v.replace(/\s+/g, '')) == '') {
			access = false;
			$(this).addClass("has-error").next('span').addClass('is-visible');
			}
			else {
				$(this).removeClass("has-error").next('span').removeClass('is-visible');
				data[key] = v;
			}
		});
		
	if(access) {
		var value = $('#change-password-form').serialize();
		$.ajax({
				type: "POST",
				url: base_url+"user/change_password",
				data: value,
				success: function(response) {
					thiss.find('.message').html(response);
					$('html, body').animate({scrollTop:$('#change-password-form').position().top}, 'slow');
					thiss.find('input').val('');
				},
				error: function(response) {
					var error = '<div class="error"><div>Sorry, Error Occured. </div></div>';
					thiss.find('.message').html(error);
					$('html, body').animate({scrollTop:$('#change-password-form').position().top}, 'slow');
					//alert('error');
				}
			});
	}
	});

/* Rating */
$('.rate-us').on('click', function(){
	
		$('.message').html('');
		var booking_id = $(this).data("booking");
		var review = $(".review-"+booking_id).val();
		var rating = $(".rating-"+booking_id).val();
		var shop_id = $(".shop-"+booking_id).val();

		$("#booking_id").val(booking_id);
		$("#shop_id").val(shop_id);
		$("#review").val(review);
		$("#rating").raty({
		starHalf : 'heart-half.png',
		starOff  : 'heart-off.png',
		starOn   : 'heart-on.png',
		precision: true,
		half     : false,
		numberMax : 5,
        score    : rating, //default stars
    });
});

/* User Rating */
$('.feedback').on('click', function(event){
		
		var score = $('#score').val();
		var review = $('#review').val();
		var access = true;
		var error = '';
		if((review.replace(/\s+/g, '')) == '') {
			access = false;
			error = '<div> Please write your comment</div>';
		}
		if((score.replace(/\s+/g, '')) == '') {
			access = false;
			error += '<div> Please rate us</div>';
		}
		if(access) {
			$('.message').html('');
			var value = $('#ratingsForm').serialize();
			
			$.ajax({
					type: "POST",
					url: base_url+"user/rating_shops",
					data: value,
					success: function(response) {
						//location.reload();
						//alert(response);
						$('.message').html(response.html);
						var booking_id = response.booking_id;
						$(".review-"+booking_id).val(review);
						$(".rating-"+booking_id).val(score);
						$('#myModal').modal('hide');
						
					},
					error: function(response) {
						var error = '<div class="error"><div>Sorry, Error occured. Please try again</div></div>';
						//alert('error');
						$('.message').html(error);
					}
				});
		}
		else {
			error = '<div class="error">'+error+'</div>';
			$('.message').html(error);
		}

	});

/* Profile Pic Change */
$('#profileimg').change(function() {
	$('form#profilepic-form').submit();
});


/*-------------------------------
------- Find current city --------
---------------------------------*/
var current_city = localStorage.currentCity;
if(current_city == undefined || current_city == "") {

$('.styled-select').html(city);
var options = {
enableHighAccuracy: true,
timeout: 1000,
maximumAge: 0
};

if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(successCallback,errorCallback,options);

}
else {
  $('.styled-select').html(city);
  setcity(city);
}
}
else {
	setcity(current_city);
	$('.styled-select').html(current_city);
}

/*-------------------
City Autocomplte
---------------------*/
$("#reset-city").keyup(function () {
        var keyword = $("#reset-city").val();
		$.ajax({
            type: "POST",
            url: base_url+"home/GetCityName",
            data: {
                keyword: keyword
            },
            dataType: "json",
            success: function (data) {
                
				if($('#reset-city').attr("data-toggle") == "" || $('#reset-city').attr("data-toggle") == undefined) {
					$('#DropdownCity').dropdown('toggle');
				}
				if (data.length > 0) {
                    $('#DropdownCity').empty();
                    $('#reset-city').attr("data-toggle", "dropdown");
                    //$('#DropdownCity').dropdown('toggle');
                }
                else if (data.length == 0 || data == "0") {
                    $('#DropdownCity').empty();
					$('#reset-city').attr("data-toggle", "");
					if((keyword.replace(/\s+/g, '')) != '') {
					$('#DropdownCity').html('<div role="presentation" > No results</div>');
					}
					//$('#DropdownCity').dropdown('toggle');
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#DropdownCity').append('<li role="presentation" >' + value['city'] + '</li>');
						//$('#DropdownCity').dropdown('toggle');
                });
            }
        });
    });
    $('ul.txtcity').on('click', 'li', function () {
        $('#reset-city').val($(this).text());
		$('#reset-city').attr("data-toggle", "");
		$('#DropdownCity').empty();
		$('#DropdownCity').dropdown('toggle');
		save_homecity($(this).text());
    });
	
/*-------------------
City Autocomplte
---------------------*/
$("#search-shop").keyup(function () {
        var keyword = $("#search-shop").val();
		
		$.ajax({
            type: "POST",
            url: base_url+"home/GetShopName",
            data: {
                keyword: keyword
            },
            dataType: "json",
            success: function (data) {
                
				if($('#search-shop').attr("data-toggle") == "" || $('#search-shop').attr("data-toggle") == undefined) {
					$('#DropdownShop').dropdown('toggle');
				}
				if (data.length > 0) {
                    $('#DropdownShop').empty();
                    $('#search-shop').attr("data-toggle", "dropdown");
                    //$('#DropdownCity').dropdown('toggle');
                }
                else if (data.length == 0 || data == "0") {
                    $('#DropdownShop').empty();
					$('#search-shop').attr("data-toggle", "");
					if((keyword.replace(/\s+/g, '')) != '') {
					$('#DropdownShop').html('<div role="presentation" > No results</div>');
					$('.shop-autocomplete .dropdown-menu').show();
					}
					//$('#DropdownCity').dropdown('toggle');
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#DropdownShop').append('<li role="presentation" data-shop="'+ value['shop_name'] +'">' + value['shop_name'] + ', ' + value['location'] + '</li>');
						$('.shop-autocomplete .dropdown-menu').show();
						//$('#DropdownCity').dropdown('toggle');
                });
            }
        });
    });
    $('ul.txtshop').on('click', 'li', function () {
       
		$('#search-shop').attr("data-toggle", "");
		var shopname = $(this).data("shop");
		$('#DropdownShop').empty();
		$('#DropdownShop').dropdown('toggle');
		$('.shop-autocomplete .dropdown-menu').hide();
		$('#search-shop').val(shopname);
		form_submit = $("#search-shop").data("submit");
		if(form_submit == "1") {
			filter_shops();
		}
		//save_homecity($(this).text());
    });
/* Save Home City */

$( "#cd-home-city" ).submit(function( event ) {
		event.preventDefault();
	});

});

/*-----------------------
----- Save Home City------
-------------------------*/
function save_homecity(city) {
	$.ajax({
			type: "POST",
			url: base_url+"home/settings",
			data: {city:city},
			success: function(response) {
				localStorage.currentCity = response;
				$('.styled-select').html(response);
				//location.reload();
				window.location.href = window.location.href;
			},
			error: function(e) {
			}
		});
}


/*-------------------------------
------- Set current city --------
---------------------------------*/
function setcity(city) {
	$.ajax({
			type: "POST",
			url: base_url+"home/settings",
			data: {city:city},
			success: function(response) {
				localStorage.currentCity = response;
				$('.styled-select').html(response);
			}
	});
}



function displayLocation(latitude,longitude){
var request = new XMLHttpRequest();

var method = 'GET';
var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&key=AIzaSyBAmX1KaY0ljSpxGgzCqvqJJ0uXNae9BwM';
var async = true;

request.open(method, url, async);
request.onreadystatechange = function(){
  if(request.readyState == 4 && request.status == 200){
	var data = JSON.parse(request.responseText);
	var address = data.results[0];
	var add = address.formatted_address;
	var value=add.split(",");
	var count=value.length;
	city=value[count-3];
	//$('.styled-select').html(city+" ");
	setcity(city);
  }
};
request.send();
}

function successCallback(position){
var x = position.coords.latitude;
var y = position.coords.longitude;
displayLocation(x,y);
}

function errorCallback(error){
var errorMessage = 'Unknown error';
switch(error.code) {
  case 1:
	errorMessage = 'Permission denied';
	break;
  case 2:
	errorMessage = 'Position unavailable';
	break;
  case 3:
	errorMessage = 'Timeout';
	break;
}
console.log(errorMessage);
}


/*--------------------------
------- Filter Shops --------
-----------------------------*/
function filter_shops() {
	var value = $('.shop_filter_form').serialize();

	$.ajax({
				type: "POST",
				url: base_url+"search/filter_shops",
				data: value,
				success: function(response) {
					//location.reload();
					//alert(response);
					if(response.html == "") {
							var error = '<div class="message"><div class="error">Sorry, No shops found. Please try with different keywords. </div></div>';
							$('.search-result-right ul').html(error);
							$('html, body').animate({scrollTop:$('.search-result-main').position().top}, 'slow');
					}
					else {
					ViewCustInGoogleMap(response.map_data);
					$('.search-result-right ul').html(response.html);
					$('html, body').animate({scrollTop:$('.search-result-main').position().top}, 'slow');
					rating_shop();
					load_more();
					}
					//ViewCustInGoogleMap(data);
				},
				error: function(response) {
					var error = '<div class="message"><div class="error">Sorry, No shops found. Please try with different keywords. </div></div>';
					$('.search-result-right ul').html(error);
					$('html, body').animate({scrollTop:$('.search-result-main').position().top}, 'slow');
				}
			});
}

/*--------------------------
------- Filter Shops --------
-----------------------------*/
function load_more_shops() {
	var value = $('.shop_filter_form').serialize()+'&'+$.param({ 'loadmore': "false" });
	
	$.ajax({
				type: "POST",
				url: base_url+"search/filter_shops",
				data: value,
				success: function(response) {
					//location.reload();
					//alert(response);
					if(response.html == "") {
						$(".load-more-button").hide();
					}
					else {
					ViewCustInGoogleMap(response.map_data, true);
					var pos = $('.load-more-button').position().top
					$('.search-result-right ul .load_more_shops').append(response.html);
					$('html, body').animate({scrollTop:pos}, 'slow');
					rating_shop();
					}
					//ViewCustInGoogleMap(data);
				},
				error: function(response) {
					var error = '<div class="message"><div class="error">Sorry, No shops found. Please try with different keywords. </div></div>';
					$('.search-result-right ul').html(error);
				}
			});
}

/*--------------------------
------- Custom Rating--------
-----------------------------*/
function confirm_booking() {
	
	$('#change-booking').on('click', function(){
		$( "#book-shop" ).show();
		$('.booking-details-wrapper').hide();
	});
	
	$('#checkout').on('click', function(){
			var value = $('#book-shop').serialize();
			$.ajax({
				type: "POST",
				url: base_url+"shop/checkout_shops",
				data: value,
				success: function(response) {
					//location.reload();
					//alert(response);
					$('.booking-details-wrapper .booking-confirm-buttons').html('');
					$('.booking-result .message').html(response).show();
					$('html, body').animate({scrollTop:$('.booking-beauty-dept').position().top}, 'slow');
				},
				error: function(response) {
					var error = '<div class="error"><div>Sorry, Error Occured. Please Try Again. </div></div>';
					$('.booking-result .message').html(error).show();
					//alert('error');
				}
			});
	});
	
}

/* Load More */
function load_more() {
$('#load-more').on("click", function(event) {
	event.preventDefault();
	
	var current_page = $('#current_page').val();
	$('#current_page').val(Number(current_page) + 1);
	load_more_shops();
	});
}
/*--------------------------
------- Custom Rating--------
-----------------------------*/


function rating_shop() {
	
	$('.raty').each(function() {
	var rate = $(this).data("rate");
	var read = $(this).data("read");
    $(this).raty({
		readOnly : read,
		starHalf : 'heart-half.png',
		starOff  : 'heart-off.png',
		starOn   : 'heart-on.png',
		precision: true,
		half     : false,
		numberMax : 5,
        score    : rate, //default stars
    });
	});
	
	
	
	$('#custom-user-login input').on('click', function(){
		
		$('#shop_ratingsForm')[0].reset();
		// on mobile close submenu
		$main_nav.children('ul').removeClass('is-visible');
		//show modal layer
		$body.addClass('model-body');
		$form_modal.addClass('is-visible');
		login_selected();
	});
	
	
}
/*-----------------------------*/

/*---------------------------
/**** Search Filter Shop Maps
----------------------------*/
var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: -34.397, lng: 150.644},
           zoom:13,
           mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        ViewCustInGoogleMap(data);
        
      }
	function ViewCustInGoogleMap(data,merge_json) {
  
            merge_json = merge_json || false;
			/*var mapOptions = {
                center: new google.maps.LatLng(9.9710364, 76.2382522),   // Coimbatore = (11.0168445, 76.9558321)
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);*/
			if(merge_json) {
				new_data = JSON.parse(data);
				$.merge(people,new_data);
			}
			else {
            people = JSON.parse(data); 
			}

            for (var i = 0; i < people.length; i++) {
                setMarker(people[i]);
            }
             /*zoom map pointer*/
            var LatLngList = [];
            
                if(people.length>1)
                {
                    for(var i=0;i< people.length; i++)
                    {
                  
                      var myarr = people[i].LatitudeLongitude.split(",");
                      LatLngList.push(new google.maps.LatLng(myarr[0],myarr[1]));
                    }

                    latlngbounds = new google.maps.LatLngBounds();

                    LatLngList.forEach(function(latLng){
                        latlngbounds.extend(latLng);
                    });

                   map.setCenter(latlngbounds.getCenter());
                   map.fitBounds(latlngbounds); 


                }else{
                    var myarr = people[0].LatitudeLongitude.split(",");
                     latlng = new google.maps.LatLng(myarr[0],myarr[1]);
                    map.setCenter(latlng);

                }
                    
              /*end zoom map pointer*/
          

        }

        function setMarker(people) {
            geocoder = new google.maps.Geocoder();
            infowindow = new google.maps.InfoWindow();
            if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
                geocoder.geocode({ 'address': people["Location"] }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: false,
                            html: "<b>"+people["DisplayText"]+"</b><div>"+people["Location"]+"</div>"
                        });
                        //marker.setPosition(latlng);
                        //map.setCenter(latlng);
                        google.maps.event.addListener(marker, 'click', function(event) {
                            infowindow.setContent(this.html);
                            infowindow.setPosition(event.latLng);
                            infowindow.open(map, this);
                        });
                    }
                    else {
                        alert(people["DisplayText"] + " -- " + people["Location"] + ". This address couldn't be found");
                    }
                });
            }
            else {
                var latlngStr = people["LatitudeLongitude"].split(",");
                var lat = parseFloat(latlngStr[0]);
                var lng = parseFloat(latlngStr[1]);
                latlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false,               // cant drag it
                    html: "<b>"+people["DisplayText"]+"</b><div>"+people["Location"]+"</div>"   // Content display on marker click
                    //icon: "images/marker.png"       // Give ur own image
                });
                //marker.setPosition(latlng);
                //map.setCenter(latlng);
                google.maps.event.addListener(marker, 'click', function(event) {
                    infowindow.setContent(this.html);
                    infowindow.setPosition(event.latLng);
                    infowindow.open(map, this);
                });
            }
        }