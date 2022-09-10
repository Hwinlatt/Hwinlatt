<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <title> &raquo; User &raquo; Booking</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Favicons -->
      <link href="https://www.passport.gov.mm/images/mm-logo.png" rel="icon">
      <link href="https://www.passport.gov.mm/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

      <!-- Vendor CSS Files -->
      <link href="https://www.passport.gov.mm/assets/vendor/aos/aos.css" rel="stylesheet">
      <link href="https://www.passport.gov.mm/assets/vendor/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://www.passport.gov.mm/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="https://www.passport.gov.mm/assets/vendor/glightbox/glightbox.min.css" rel="stylesheet">

      <!-- Template Main CSS File -->
      <link href="https://www.passport.gov.mm/assets/css/style.css" rel="stylesheet">


        <script type="text/javascript">
            function setCookie(name,value,days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days*24*60*60*1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "")  + expires + "; path=/";
            }
            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1,c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
                }
                return null;
            }
        </script>
        <style>
          .navbar a { font-size: 11px; font-weight:bold; }
          .calander
          {
              background-image: url(https://i.imgur.com/u6upaAs.png);
              background-repeat: no-repeat;
              padding-left: 5px;
              background-position-x: 95%;
              background-position-y: 50%;
          }
        </style>
    </head>
    <body oncontextmenu="return false;">

            <header id="header" class="fixed-top d-flex align-items-center">


            <div class="container d-flex justify-content-between align-items-center">
                <div id="logo">
                    <h2>

                            <a href="https://www.passport.gov.mm" style="color: #fff; font-size: 22px;">
                           မြန်မာနိုင်ငံကူးလက်မှတ်ထုတ်ပေးရေးရုံး</a>
                    </h2>
                </div>

                <nav id="navbar" class="navbar">
                    <ul>

                                                    <li><a class="nav-link " href="https://www.passport.gov.mm/user" id="a_book">Online Booking လျှောက်ထားရန်</a></li>

                        <li><a class="nav-link "  href="https://www.passport.gov.mm/user/view-booking" id="a_view">View Booking  Info</a></li>
                        <li><a class="nav-link scrollto" href="https://www.passport.gov.mm/home/contact">Contact</a></li>
                        <script type="text/javascript"></script>
                        <!-- <li><a class="nav-link" href="https://www.passport.gov.mm/admin">Login</a></li> -->
                                    </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
          </div>
        </header><!-- End Header -->

        <style type="text/css">
  .important { padding:10px; color:red; }
</style>

<link href="https://www.passport.gov.mm/css/sweetalert2.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<main id="main">
  	<!-- ======= Breadcrumbs Section ======= -->
	<section class="breadcrumbs">
    	<div class="container">
      	<div class="d-flex justify-content-between align-items-center">
        		<h2 style='margin-left:25%;'>Online Booking လျှောက်ထားရန် </h2>
        		<ol>
          		<li><a href="https://www.passport.gov.mm/">Home</a></li>
          		<li>Appointment - Step 1</li>
        		</ol>
        		<br>
  		</div>
  		<a target="_blank"  href="https://www.passport.gov.mm/guide/Online Booking Announcement.pdf" style='color:#0d28bd; font-size: 14px; font-weight: bold; float: right;'><< အသိပေးကြေငြာချက် >></a>
    	</div>
  	</section><!-- End Breadcrumbs Section -->
	<section class="inner-page">
    	<div class="container">
    		<div class="row">
	    		<div class="col-md-3">
	    			<div style='border:1px solid #afafaf; border-radius:10px;'>
						<h6 class="alert alert-danger">နိုင်ငံကူးလက်မှတ်လျှောက်ထားရန် လိုအပ်သောစာရွက်စာတမ်းများ</h6>
						<div style='padding:10px;'>
						<table>
						    <tr><td width="30px" style="vertical-align:top;">၁။</td><td style="vertical-align:top;" >နိုင်ငံသားစိစစ်ရေးကတ်မူရင်း၊ မိတ္တူ (၂) စောင်</td></tr>
						    <tr><td style="vertical-align:top;">၂။</td><td style="vertical-align:top;">အိမ်ထောင်စုစာရင်း မူရင်း၊ မိတ္တူ (၂) စောင်</td></tr>
						    <tr><td style="vertical-align:top;">၃။</td><td style="vertical-align:top;">ဝန်ထမ်းဖြစ်ပါက သက်ဆိုင်ရာဝန်ကြီးဌာန၏ ခွင့်ပြုချက် (သို့) ပြည်ပခွင့်</td></tr>
					        <tr><td style="vertical-align:top;">၄။</td><td style="vertical-align:top">သက်တမ်းတိုးဖြစ်ပါက နိုင်ငံကူးလက်မှတ်အဟောင်း ပူးတွဲတင်ပြရန်၊ ရှေ့စာမျက်နှာမိတ္တူ (၂) စောင်</td></tr>
						    </tr>
						</table>
						</div>
					</div>
					<div style='border:1px solid #afafaf; border-radius:10px; margin-top:30px; margin-bottom:15px;'>
						<h6 class="alert alert-danger" style='text-align:center; height:50px;'>ရုံးပိတ်ရက်များ</h6>
						<div style='padding:5px; padding-top:0px'>
						    <div id="show_holiday" style="margin-bottom:10px;"></div>
							<label>** စနေ၊ တနင်္ဂနွေနေ့များသည် ပုံမှန်ရုံးပိတ်ရက်များဖြစ်ပါသည်။ </label>
						</div>
					</div>
	    		</div>
	    		<div class="col-md-8">
	    			<div class="panel panel-custom">
						<div class="panel-heading"></div>
						<div class="panel-body">
							<form id="upload-form"  name="upload-form" action="https://www.passport.gov.mm/user/appointment" method="POST" enctype="multipart/form-data" style='margin-bottom:20px;'>
								<input type='hidden' id='back' name='back' value='0' />
								<div class="page_above">
									<label class="important"></label>
									<div class="page_above">
									<?	if (!$msg) 	echo $msg;	 ?>
									</div>
								</div>

								<div class="row">
									<label class="col-md-8" for="station">လျှောက်မည့်ရုံးခွဲ * </label>
				                  	<div class="form-group col-md-4">
				                  		<select id="ddl_station" name="ddl_station" class="form-control">
								            <option value="16"  >ရန်ကုန် </option>
							          	</select>
				                  	</div>
				                </div>

				                <div class="row" style="margin-top:10px;">
									<label class="col-md-8" for="appdate">နိုင်ငံကူးလက်မှတ်ထုတ်ပေးရေးရုံးသို့လာရောက် လျှောက်ထားလိုသည့်ရက် * </label>
				                  	<div class="form-group col-md-4">
				                  		<input type="text" readonly  id="appdate" name="appdate" class="form-control calander" value="" style="background-color: #f5faff"><i class="fa fa-calendar"></i>
				                  	</div>
				                </div>

								<div class="row" style="margin-top:10px;">
									<label class="col-md-12" for="apptime">နိုင်ငံကူးလက်မှတ်ထုတ်ပေးရေးရုံးသို့လာရောက် လျှောက်ထားလိုသည့်အချိန် * </label><br>
									<div class="col-md-12">
										<div id="appointtime"  style="padding: 15px;">
										</div>
									</div>
								</div>

								<div class="row" style="margin-top:25px;">
									<label class="col-md-8" for="ddl_no_of_booking">လျှောက်ထားလိုသည့်လူဦးရေ (Reserve)</label>
									<div class="col-lg-4">
										<select id="ddl_no_of_booking" name="ddl_no_of_booking" class="form-control">
										</select>
									</div>
								</div>

								<div class="row" style="margin-top:10px;">
									<label class="col-md-12" for="captcha">လုံခြုံရေးစိစစ်ရန်အတွက်  ပုံတွင်ပြထားသည့်စာသားများရိုက်ပါ။</label>  <br>
									<div class="col-md-8">
										<div id="captchaimage">
																						<a href="javascript:void(0)" id="refreshimg" title="Click to refresh image"><img src="https://www.passport.gov.mm/libs/captcha.php?captcha_id=RTFW73" width="132" height="46" alt="Captcha image" /></a>
										</div>
										<div class="col-md-4" style='margin-top:20px;'><input type="text" id="captcha" name="captcha" class="form-control" value="" autocomplete="false"></div>
									</div>
									<div class="col-md-4"></div>
								</div>

								<div class="row" style="margin-top:10px;">
									<div class="col-md-2"></div>
									<div class="col-lg-7">
										<div id="inComplete" class="errorTxt" style="font-weight:bold; color:red;" ></div>
																			</div>
									<div class="col-md-12">
										<button type="button" class="btn btn-success" style="float: right;" id='btnNext'  >Next</button>
									</div>
								</div>
							</form>
						</div>
					</div>
	    		</div>
			</div>
		</div>
	</section>
	<pre id='lbl_concurrent_count'>252</pre>
</main>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://www.passport.gov.mm/js/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://www.passport.gov.mm/js/jquery.validate.js"></script>
<script type="text/javascript">

    var is_valid = 0;
    var start = 0; var end = 0;

	$(document).ready(function() {
		$("body").on("click", "#refreshimg", function(){
			$.post(PATH+"/user/reg-captcha", function( data ) {
				$("#captchaimage").html(data);
			});
			return false;
		});

		$("#appdate").attr("autocomplete", "off");

		$("#upload-form").validate({
			rules: {
				appdate: {
					required: true
				},
				apptime: {
					required: true
				},
				captcha: {
			            required: true,
			            remote: PATH + "/user/reg-captcha/check"
			          }
			},
			messages: {
				appdate: "လျှောက်ထားလိုသည့်ရက်ရွေးပါ။",
				apptime: "လျှောက်ထားလိုသည့်အချိန်ရွေးပါ။ ",
				captcha: "လုံခြုံရေးစိစစ်ရန်စာသားအား မှန်ကန်စွာဖြည့်ပါ။"
			},
			errorElement : 'div',
			errorLabelContainer: '.errorTxt'
		});

		$("#appdate").change( function(){
			$("#appointtime").html("");
			var obj = {
				appdate : $(this).val(),
				start_day : start,
				end_day : end
			};

			$.ajax({
	            type: "POST",
	            url: PATH+"/user/get-time",
	            data: obj,
	            success: function (data) {
	            	console.log('success');
	            	if(data == ""){
						showpopup('Warning!', 'အသုံးပြုသူများနေသည့်အတွက် ခေတ္တစောင့်ဆိုင်းပြီးမှ ထပ်မံအသုံးပြုစေလိုပါသည်။', 'warning');
					}
					else
					{
						const myArray = data.split("--");
    	            	$("#appointtime").html(myArray[0]);
    	            	if(myArray.length>1) $('#btnNext').attr('disabled', true);
    	            	else $('#btnNext').attr('disabled', false);
					}
	            }
	        });
			$('#ddl_no_of_booking').val(1);
			return false;
		});
	});

	/*$('#ddl_no_of_booking').change(function(){
		var selected_Id = $('input[name="apptime"]:checked').attr('id');
		if(selected_Id == undefined)	{
			showpopup('Warning!', 'Booking ပြုလုပ်လိုသော အချိန်ကိုရွေးပါ။', 'warning');
			$('#ddl_no_of_booking').val(1);
		}
		else{
			var lbl = '#lbl_count_'+selected_Id;
			if( parseInt($('#ddl_no_of_booking').val()) > parseInt($(lbl).text())){
				showpopup('Warning!', 'Booking ပြုလုပ်နိုင်သော အရေအတွက်ထက် များနေပါသည်။', 'warning');
				$('#ddl_no_of_booking').val(1);
			}
		}
	});*/

	$('#btnNext').click(function(){
		$.getJSON(PATH+'/user/expire_reserve', function(data) {
        });
        console.log('expire delete');
		var selected_Id = $('input[name="apptime"]:checked').attr('id');
		if(selected_Id == undefined)	{
			showpopup('Warning!', 'Booking ပြုလုပ်လိုသော အချိန်ကိုရွေးပါ။', 'warning');
		}
		else{
			if($("#upload-form").valid()){

				var ip = "";
			    jQuery.ajaxSetup({async:false});
			    $.getJSON("https://api.ipify.org?format=json", function(data) {
		            ip = data.ip;
		        });

				var selected_Id = $('input[name="apptime"]:checked').attr('id');
				var post_obj = {
		            "appdate": $('#appdate').val(),
		            "apptime": $('#'+selected_Id).val(),
		            "station": $('#ddl_station').val(),
		            "no_of_booking": $('#ddl_no_of_booking').val(),
		            "ip_address": ip,
		            "captcha": $('#captcha').val(),
		            "start_day" : start,
					"end_day" : end
		        };
		        console.log('b4 reserve');
		        $.ajax({
		            type: 'POST',
		            url: PATH+'/user/reserve',
		            data: post_obj  ,
		            success: function (data) { //console.log('data ' +data);
		            	if(data == 0) {
							showpopup('Warning!', 'Invalid reserve count.', 'warning');
		                   /* $.get(PATH+"/user/get-time/"+$('#appdate').val(), function( data ) {
					            $("#appointtime").html(data);
				            });*/
		                }
		                else if(data == 1) {
							showpopup('Warning!', ' Booking ပေးရက်မရောက်သေးပါ။', 'warning');
		                }
		                else if(data == 2) {
							showpopup('Warning!', 'ရွေးထားသောအချိန်အတွက်  Booking ပြည့်သွားပါပြီ။', 'warning');
							/*$.get(PATH+"/user/get-time/"+$('#appdate').val(), function( data ) {
					            $("#appointtime").html(data);
				            });	 */
		                }
		                else if (data == 3){
							showpopup('Warning!', 'လုံခြုံရေးစိစစ်ရန်စာသားအား မှန်ကန်စွာဖြည့်ပါ။', 'warning');
		                }
		                else if(data == 4) {
							showpopup('Error!', 'Invalid Reserve Date.', 'error');
		                }
		                else if(data == 5) {
							showpopup('Warning!', 'ခေတ္တစောင့်ဆိုင်းပြီးမှ ထပ်မံ Booking တင်ပါရန်။', 'warning');
		                }
		                else if(data == 6) {
							showpopup('Error!', 'Invalid', 'error');
		                }
		                else {
		                    window.location.href = PATH + '/user/booking_info';
		                }
		            },
		            error: function () {
		            }
		        });
			}
		}
	});

	function showpopup(title, message, icon){
		Swal.fire({
				  	title: title,
				  	text: message,
				  	icon: icon,
				  	confirmButtonText: 'OK'
				});
	}

    var click_count = 0 ;
	$("#appdate1").click( function(){
		if(click_count == 0){
			$.ajax({
	            async: false,
	            type: "POST",
	            url: PATH+"/user/get-config",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            success: function (data) {
					if(data.message.connect_error == 1){
							showpopup('Warning!', 'အသုံးပြုသူများနေသည့်အတွက် ခေတ္တစောင့်ဆိုင်းပြီးမှ ထပ်မံအသုံးပြုစေလိုပါသည်။', 'warning');
					}
					else{
						start = data.message.from_day;
					 	end = data.message.to_day;

						var minDate = data.message.from_date;
					 	var maxDate = data.message.to_date;

	                	minDate = $.datepicker.parseDate("yy-mm-dd", data.message.from_date);

	                	maxDate = $.datepicker.parseDate("yy-mm-dd", data.message.to_date);

						holiday = data.message.offday;

						gholiday = data.message.holiday;
						var holiday_data = "<ul>";
						for(var i=0; i<gholiday.length; i++){
							if(gholiday[i]['closed_date'] !='2022-04-01'){
						    var myArray = gholiday[i]['closed_date'].split("-");
	                        var datestring = myArray[2]  + "-" + myArray[1] + "-" + myArray[0];

						    holiday_data += '<li>'+datestring+' ('+gholiday[i]['description']+')</li>';
							}
						}
						holiday_data += "</ul>";
						$("#show_holiday").html(holiday_data);

		            	InitDatePickers(minDate, maxDate);

						var no_of_booking = "";
						for(i=1; i<=data.message.max_person; i++)
						{
							no_of_booking += '<option value="'+i +'">'+ i +'</option>';
						}
						$('#ddl_no_of_booking').html(no_of_booking);
						click_count++;
					}
	            }
	        });
		}
	});
	$("#appdate").click( function(){
		if(click_count == 0){
			$.ajax({
	            async: false,
	            type: "POST",
	            url: PATH+"/user/get-config",
	            contentType: "application/json; charset=utf-8",
	            dataType: "json",
	            success: function (data) {
	            	console.log('here');
					if(data.message.connect_error == 1){
							showpopup('Warning!', 'အသုံးပြုသူများနေသည့်အတွက် ခေတ္တစောင့်ဆိုင်းပြီးမှ ထပ်မံအသုံးပြုစေလိုပါသည်။', 'warning');
					}
					else{
						start = data.message.from_day;
					 	end = data.message.to_day;

						var minDate = data.message.from_date;
					 	var maxDate = data.message.to_date;

	                	minDate = $.datepicker.parseDate("yy-mm-dd", data.message.from_date);

	                	maxDate = $.datepicker.parseDate("yy-mm-dd", data.message.to_date);

						weekend = data.message.weekend;
						gholiday = data.message.holiday;
						var holiday_data = "<ul>";
						for(var i=0; i<gholiday.length; i++){
							//if(gholiday[i]['closed_date'] !='2022-04-01'){
						    var myArray = gholiday[i]['closed_date'].split("-");
	                        var datestring = myArray[2]  + "-" + myArray[1] + "-" + myArray[0];

						    holiday_data += '<li>'+datestring+' ('+gholiday[i]['description']+')</li>';
							//}
						}
						holiday_data += "</ul>";
						$("#show_holiday").html(holiday_data);

		            	InitDatePickers(minDate, maxDate);

						var no_of_booking = "";
						for(i=1; i<=data.message.max_person; i++)
						{
							no_of_booking += '<option value="'+i +'">'+ i +'</option>';
						}
						$('#ddl_no_of_booking').html(no_of_booking);
						click_count++;
					}
	            }
	        });
		}
	});

	function publicHoliday1(date) {
		var yyyy = date.getFullYear().toString();
  		var mm = (date.getMonth()+1).toString();
  		var dd  = date.getDate().toString();

  		var mmChars = mm.split('');
  		var ddChars = dd.split('');

  		date1 = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);

      	for (i = 0; i < holiday.length; i++) {
        	if (date1 == holiday[i]) {
          		return [false,''];
        	}
      	}
      	return [true, ''];
	}
	function publicHoliday(date) {
		var yyyy = date.getFullYear().toString();
  		var mm = (date.getMonth()+1).toString();
  		var dd  = date.getDate().toString();

  		var mmChars = mm.split('');
  		var ddChars = dd.split('');

  		date1 = yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);

      	for (i = 0; i < gholiday.length; i++) {
        	if (date1 == gholiday[i]['closed_date']) {
          		return [false,''];
        	}
      	}
      	for (i = 0; i < weekend.length; i++) {
      		//console.log(date1+" weekeng "+weekend[i]);
        	if (date1 == weekend[i]) {
          		return [false,''];
        	}
      	}
      	return [true, ''];
	}

	function InitDatePickers(minDate, maxDate){
		$("#appdate").datepicker({
			dateFormat: "dd-mm-yy",
			minDate: minDate,
			maxDate: maxDate,
			beforeShowDay: publicHoliday,
			//numberOfMonths: 4, showCurrentAtPos: 0
		});
		$('#appdate').datepicker("show");
	}

	/*setInterval(function () {
		var c = '';
		console.log(c);
		$('#lbl_concurrent_count').text(c) ;
	} , 10000);*/
</script>	        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="copyright">
                        &copy; Copyright <strong>2022</strong>. All Rights Reserved
                        </div>
                        <div class="credits">
                    </div>
                </div>
                <div class="col-lg-6" style="text-align: right">
                    <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                </div>
            </div>
          </div>
        </footer><!-- End  Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-chevron-up"></i></a>

        <!-- Vendor JS Files -->
        <script src="https://www.passport.gov.mm/assets/vendor/aos/aos.js"></script>
        <script src="https://www.passport.gov.mm/assets/vendor/js/bootstrap.bundle.min.js"></script>
        <script src="https://www.passport.gov.mm/assets/vendor/glightbox/glightbox.min.js"></script>
        <script src="https://www.passport.gov.mm/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="https://www.passport.gov.mm/assets/js/main.js"></script>

        <script type="text/javascript">
            var PATH = "https://www.passport.gov.mm";

          document.onkeydown = function(e) {
                /*if (e.ctrlKey &&
                    (e.keyCode === 67 ||
                     e.keyCode === 86 ||
                     e.keyCode === 85 ||
                     e.keyCode === 117)) {
                    return false;
                } else {
                    return true;
                }*/
                if ((e.ctrlKey && e.shiftKey && e.keyCode == 73) || (e.ctrlKey && e.shiftKey && e.keyCode == 74)){
                  return false;
                }
                else if (e.ctrlKey && e.keyCode === 85) {
                    return false;
                } else {
                    return true;
                }
            };
            var ip_address;
            jQuery.ajaxSetup({async:false});
            $.getJSON("https://api.ipify.org?format=json", function(data) {
                  ip_address = data.ip;
            });
        </script>
    </body>
</html>
