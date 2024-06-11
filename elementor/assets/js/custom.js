jQuery(document).ready(function ($) {
   "use strict";
   // calender
   $("#wsbp_booking_calender").calendar({
      type: "date",
      inline: true,
   });

   $(".wsbp_booking_calender_canvas").calendar({
      type: "date",
      inline: true,
   });


   //******************************************** */
   //                Booking Multistep Form
   //******************************************* */
   var wsbp_form_1 = $(".form_1");
   var wsbp_form_1_canvas = $(".form_1_canvas");
   var wsbp_form_2 = $(".form_2");
   var wsbp_form_2_canvas = $(".form_2_canvas");
   var wsbp_form_3 = $(".form_3");
   var wsbp_form_3_canvas = $(".form_3_canvas");
   var wsbp_form_4 = $(".form_4");
   var wsbp_form_4_canvas = $(".form_4_canvas");

   var wsbp_form_1_btns = $(".form_1_btns");
   var wsbp_form_1_btns_canvas = $(".form_1_btns_canvas");
   var wsbp_form_2_btns = $(".form_2_btns");
   var wsbp_form_2_btns_canvas = $(".form_2_btns_canvas");
   var wsbp_form_3_btns = $(".form_3_btns");
   var wsbp_form_3_btns_canvas = $(".form_3_btns_canvas");
   var wsbp_form_4_btns = $(".form_4_btns");
   var wsbp_form_4_btns_canvas = $(".form_4_btns_canvas");

   var wsbp_form_1_next_btn = $(".form_1_btns .btn_next");
   var wsbp_form_1_canvas_next_btn = $(".form_1_btns_canvas .btn_next_canvas");
   var wsbp_form_2_back_btn = $(".form_2_btns .btn_back");
   var wsbp_form_2_canvas_back_btn = $(".form_2_btns_canvas .btn_back_canvas");
   var wsbp_form_2_next_btn = $(".form_2_btns .btn_next");
   var wsbp_form_2_canvas_next_btn = $(".form_2_btns_canvas .btn_next_canvas");
  
   var wsbp_form_3_next_btn = $(".form_3_btns .btn_next");
   var wsbp_form_3_cancas_next_btn = $(".form_3_btns_canvas .btn_next_canvas");

   var wsbp_form_3_back_btn = $(".form_3_btns .btn_back");
   var wsbp_form_3_canvas_back_btn = $(".form_3_btns_canvas .btn_back_canvas");

   var wsbp_form_4_back_btn = $(".form_4_btns .btn_back");
   var wsbp_form_4_canvas_back_btn = $(".form_4_btns_canvas .btn_back_canvas");

   var wsbp_form_2_progessbar = $(".form_2_progessbar");
   var wsbp_form_3_progessbar = $(".form_3_progessbar");
   var wsbp_form_4_progessbar = $(".form_4_progessbar");

   var wsbp_btn_done = $(".btn_done");
   var wsbp_btn_done_canvas = $(".btn_done_canvas");
   var wsbp_modal_wrapper = $(".modal_wrapper");
   var wsbp_shadow = $(".shadow");


   //************************************************ */
   //               Avaible Avaiable Time
   //******************************************* ****/

   $("#wsbp_find_available_time").on("click", function (e) {

      e.preventDefault();

      var booking_time = $("#wsbp_booking_calender_date").val();

      var dateObj = new Date(booking_time);
      var year = dateObj.getFullYear();
      var month = ("0" + (dateObj.getMonth() + 1)).slice(-2);
      var day = ("0" + dateObj.getDate()).slice(-2);
      var formattedDate = year + "-" + month + "-" + day;

      $.ajax({
         url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/booking/" + formattedDate,
         type: "GET",
         success: function (response) {
            var htmlStrings = response.map((time) => {
               return `<td><div class="d-grid gap-2"><button class="btn btn-primary" type="button">${time}</button></div></td>`;
            });
            $("#wsbp_available_times_row").append(htmlStrings);
         },
      });
   });

   var wsbp_booking_time_Value; // declare tdValue in a global scope

   $("#wsbp_available_times_row").on("click", "button", function () {
       // Remove the background color from all buttons
       $("#wsbp_available_times_row button").css("background-color", ""); 
       wsbp_booking_time_Value = $(this).parent().parent().text();
        // Get the value of the parent td element
        $(this).css("background-color", "#519259");
   });

   //************************************************ */
   //               Form Conditions
   //******************************************* ****/

   wsbp_form_1_next_btn.on("click", function () {

      var serviceSelect = document.getElementById("wsbp_booking_services");
      var errorMessage = document.getElementById("wsbp_service_error_message");
      var dateInput = document.getElementById("wsbp_booking_calender_date");
      var dateErrorMessage = document.getElementById("wsbp_date_error_message");
      var timeErrorMessage = document.getElementById("wsbp_time_error_message");

      if (serviceSelect.value === "") {
         errorMessage.innerHTML = "Please select a service.";
         dateErrorMessage.innerHTML = "";
         timeErrorMessage.innerHTML = "";
      } else if (dateInput.value === "") {
         dateErrorMessage.innerHTML = "Please select a date.";
         errorMessage.innerHTML = "";
         timeErrorMessage.innerHTML = "";
      } else if (!wsbp_booking_time_Value) {
         timeErrorMessage.innerHTML = "Please select a time.";
         errorMessage.innerHTML = "";
         dateErrorMessage.innerHTML = "";
      } else {
         errorMessage.innerHTML = "";
         dateErrorMessage.innerHTML = "";
         timeErrorMessage.innerHTML = "";

         wsbp_form_1.hide();
         wsbp_form_2.show();

         wsbp_form_1_btns.hide();
         wsbp_form_2_btns.show();

         wsbp_form_2_progessbar.addClass("active");
      }
   });

   wsbp_form_2_back_btn.on("click", function () {
      wsbp_form_1.show();
      wsbp_form_2.hide();

      wsbp_form_1_btns.show();
      wsbp_form_2_btns.hide();

      wsbp_form_2_progessbar.removeClass("active");
   });

   wsbp_form_2_next_btn.on("click", function () {
      const assistance = document.querySelector('input[name="wsbp_booking_assistance"]:checked');

      if (assistance === null) {
         const errorMessage = document.getElementById("wsbp_assistant_error_message");
         errorMessage.innerHTML = "Please select an assistant.";
      } else {
         const errorMessage = document.getElementById("wsbp_assistant_error_message");
         errorMessage.innerHTML = "";
         wsbp_form_2.hide();
         wsbp_form_3.show();

         wsbp_form_3_btns.show();
         wsbp_form_2_btns.hide();

         wsbp_form_3_progessbar.addClass("active");
      }
   });

   wsbp_form_3_back_btn.on("click", function () {
      wsbp_form_2.show();
      wsbp_form_3.hide();

      wsbp_form_3_btns.hide();
      wsbp_form_2_btns.show();

      wsbp_form_3_progessbar.removeClass("active");
   });

   wsbp_form_3_next_btn.on("click", function () {
      wsbp_form_3.hide();
      wsbp_form_4.show();

      wsbp_form_4_btns.show();
      wsbp_form_3_btns.hide();

      wsbp_form_4_progessbar.addClass("active");
   });

   wsbp_form_4_back_btn.on("click", function () {
      wsbp_form_3.show();
      wsbp_form_4.hide();

      wsbp_form_4_btns.hide();
      wsbp_form_3_btns.show();

      wsbp_form_4_progessbar.removeClass("active");
   });

   wsbp_btn_done.on("click", function () {
      var isValid = true;
      if ($('#wsbp_booking_firstName').val() == '') {
         $('#wsbp_booking_firstName').next('.error-message').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_booking_firstName').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_booking_lastName').val() == '') {
         $('#wsbp_booking_lastName').next('.error-message').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_booking_lastName').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_booking_email').val() == '') {
         $('#wsbp_booking_email').next('.error-message').removeClass('hidden');
         isValid = false;
      } else if (!isValidEmail($('#wsbp_booking_email').val())) {
         $('#wsbp_booking_email').next('.error-message').text('Please enter a valid email address').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_booking_email').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_booking_phone').val() == '') {
         $('#wsbp_booking_phone').next('.error-message').removeClass('hidden');
         isValid = false;
      } else if (isNaN($('#wsbp_booking_phone').val())) {
         $('#wsbp_booking_phone').next('.error-message').text('Please enter a valid phone number').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_booking_phone').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_booking_address').val() == '') {
         $('#wsbp_booking_address').next('.error-message').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_booking_address').next('.error-message').addClass('hidden');
      }

      if (isValid) {
         wsbp_modal_wrapper.addClass("active");
      }
   });

   // Function to validate email address
   function isValidEmail(email) {
      var emailRegex = /\S+@\S+\.\S+/;
      return emailRegex.test(email);
   }

   wsbp_shadow.on("click", function () {
      wsbp_modal_wrapper.removeClass("active");
   });

   //************************************************ */
   //               Booking Info
   //******************************************* ****/
   $("#wsbp_booking_info").on("click", function () {

      var wsbp_booking_date = $("#wsbp_booking_calender_date").val();
      var wsbp_num_of_person = $("#wsbp_num_of_person").val();
      var wsbp_services_id = $("#wsbp_booking_services").val();
      $.ajax({
         url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/bookinginfo/" + wsbp_services_id,
         type: "GET",
         success: function (response) {
            var wsbp_total_price = wsbp_num_of_person * response.price;
            // Define the HTML to be appended
            var htmlStrings =
               '<div class="row"> \
            <div class="col-md-4"> \
               <img src="' +
               response.service_img +
               '" alt="Service Image"> \
            </div> \
            <div class="col-md-8"> \
               <h3 class="wsbp_booking_info_services_name">' +
               response.service_name +
               '</h3> \
               <p class="wsbp_booking_info_services_des">' +
               response.service_des +
               '</p> \
               <ul> \
                  <li class="wsbp_booking_info_services_date">Date: ' +
               wsbp_booking_date +
               '</li> \
               \
                  <li class="wsbp_booking_info_services_time">Time: ' +
               wsbp_booking_time_Value +
               '</li> \
                  <li class="wsbp_booking_info_services_duration">Duration: ' +
               response.duration +
               'Min</li> \
                  <li class="wsbp_booking_info_services_per">Persons: ' +
               wsbp_num_of_person +
               '</li> \
                  <li class="wsbp_booking_info_services_price">Price: $' +
               wsbp_total_price +
               "</li> \
               </ul> \
            </div> \
            </div>";

            $("#wsbp_booking_info_show").html(htmlStrings);
         },
      });
   });
   //******************************************** */
   //                Booking Form
   //******************************************* */

   $("#wsbp_book_now").on("click", function (event) {

      var wsbp_booking_first_name = $("#wsbp_booking_firstName").val();
      var wsbp_booking_lastName = $("#wsbp_booking_lastName").val();
      var wsbp_booking_email = $("#wsbp_booking_email").val();
      var wsbp_booking_phone = $("#wsbp_booking_phone").val();
      var wsbp_booking_address = $("#wsbp_booking_address").val();
      var wsbp_booking_date = $("#wsbp_booking_calender_date").val();
      var wsbp_num_of_person = $("#wsbp_num_of_person").val();
      var wsbp_booking_services = $("#wsbp_booking_services").val();
      var wsbp_booking_assistants = $(
         'input[name="wsbp_booking_assistance"]:checked'
      ).data("id");

      $.ajax({
         url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/bookinginfo/" +
            wsbp_booking_services,
         type: "GET",
         success: function (response) {
            var responseData = response;
            var wsbp_total_price = wsbp_num_of_person * responseData.price;
            var formData = {
               wsbp_booking_first_name: wsbp_booking_first_name,
               wsbp_booking_last_name: wsbp_booking_lastName,
               wsbp_booking_email: wsbp_booking_email,
               wsbp_booking_phone: wsbp_booking_phone,
               wsbp_booking_address: wsbp_booking_address,
               wsbp_booking_date: wsbp_booking_date,
               wsbp_booking_time: wsbp_booking_time_Value,
               wsbp_booking_duration: responseData.duration,
               wsbp_booking_services: wsbp_booking_services,
               wsbp_booking_assistants: wsbp_booking_assistants,
               wsbp_num_of_person: wsbp_num_of_person,
               wsbp_booking_status: "pending",
               wsbp_booking_price: wsbp_total_price,
            };
            $.ajax({
               url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/createbookings",
               type: "POST",
               data: formData,
               success: function (response) {

               },
               error: function (xhr, status, error) {
                  console.error(
                     "Request failed. Status: " + status + ", Error: " + error
                  );
               },
            });
         },
      });
   });

    //************************************************ */
   //              Auto Select services
   //******************************************* ****/
     // Add event listener to Book button
     $(".wsbp_services_book_now").on("click", function () {   
      // Get the ID of the selected service
      var serviceID = $(this).data('id');
      // Set the value of the select element to the ID of the selected service
      $("#wsbp_all_booking_services").val(serviceID);
   });

   $('.wsbp_booking-plugin-content').on('click','.row', function() {
      // Find the radio button within the clicked row,
      var radioButton = $(this).find('input[type="radio"]');
      
      // Set the radio button as selected
      radioButton.prop('checked', true);
  });

  $('.wsbp_booking_cross').on('click', function() {
      location.reload();
});
    //************************************************ */
   //             Canvas Avaible Time
   //******************************************* ****/

   $("#wsbp_all_services_find_available_time").on("click", function (e) {

      e.preventDefault();

      var booking_time = $("#wsbp_all_services_booking_calender_date").val();
    
      var dateObj = new Date(booking_time);
      var year = dateObj.getFullYear();
      var month = ("0" + (dateObj.getMonth() + 1)).slice(-2);
      var day = ("0" + dateObj.getDate()).slice(-2);
      var formattedDate = year + "-" + month + "-" + day;

      $.ajax({
         url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/booking/" + formattedDate,
         type: "GET",
         success: function (response) {
            var htmlStrings = response.map((time) => {
               return `<td><div class="d-grid gap-2"><button class="btn btn-primary" type="button">${time}</button></div></td>`;
            });
            $("#wsbp_all_services_available_times_row").append(htmlStrings);
         },
      });
   });

   var wsbp_all_services_booking_time_Value; // declare tdValue in a global scope
   

   $("#wsbp_all_services_available_times_row").on("click", "button", function () {

      // Remove the background color from all buttons
      $("#wsbp_all_services_available_times_row button").css("background-color", ""); 
      wsbp_all_services_booking_time_Value = $(this).parent().parent().text();
       // Get the value of the parent td element
       $(this).css("background-color", "#519259");
       
   });

   //************************************************ */
   //             canvas Form Conditions
   //******************************************* ****/

   wsbp_form_1_canvas_next_btn.on("click", function () {

      var serviceSelect = document.getElementById("wsbp_all_booking_services");
      var errorMessage = document.getElementById("wsbp_service_error_message");
      var dateInput = document.getElementById("wsbp_all_services_booking_calender_date");
      var dateErrorMessage = document.getElementById("wsbp_all_services_date_error_message");
      var timeErrorMessage = document.getElementById("wsbp_all_services_time_error_message");

      if (serviceSelect.value === "") {
         errorMessage.innerHTML = "Please select a service.";
         dateErrorMessage.innerHTML = "";
         timeErrorMessage.innerHTML = "";
      } else if (dateInput.value === "") {
         dateErrorMessage.innerHTML = "Please select a date.";
         errorMessage.innerHTML = "";
         timeErrorMessage.innerHTML = "";
      } else if (!wsbp_all_services_booking_time_Value) {
         timeErrorMessage.innerHTML = "Please select a time.";
         errorMessage.innerHTML = "";
         dateErrorMessage.innerHTML = "";
      } else {
         errorMessage.innerHTML = "";
         dateErrorMessage.innerHTML = "";
         timeErrorMessage.innerHTML = "";

         wsbp_form_1_canvas.hide();
         wsbp_form_2_canvas.show();

         wsbp_form_1_btns_canvas.hide();
         wsbp_form_2_btns_canvas.show();

         wsbp_form_2_progessbar.addClass("active");
      }
   });

   wsbp_form_2_canvas_back_btn.on("click", function () {
      wsbp_form_1_canvas.show();
      wsbp_form_2_canvas.hide();

      wsbp_form_1_btns_canvas.show();
      wsbp_form_2_btns_canvas.hide();

      wsbp_form_2_progessbar.removeClass("active");
   });

   wsbp_form_2_canvas_next_btn.on("click", function () {
      const assistance = document.querySelector('input[name="wsbp_booking_assistance"]:checked');

      if (assistance === null) {
         const errorMessage = document.getElementById("wsbp_assistant_error_message");
         errorMessage.innerHTML = "Please select an assistant.";
      } else {
         const errorMessage = document.getElementById("wsbp_assistant_error_message");
         errorMessage.innerHTML = "";
         wsbp_form_2_canvas.hide();
         wsbp_form_3_canvas.show();

         wsbp_form_3_btns_canvas.show();
         wsbp_form_2_btns_canvas.hide();

         wsbp_form_3_progessbar.addClass("active");
      }
   });

   wsbp_form_3_canvas_back_btn.on("click", function () {
      wsbp_form_2_canvas.show();
      wsbp_form_3_canvas.hide();

      wsbp_form_3_btns_canvas.hide();
      wsbp_form_2_btns_canvas.show();

      wsbp_form_3_progessbar.removeClass("active");
   });

   wsbp_form_3_cancas_next_btn.on("click", function () {
      wsbp_form_3_canvas.hide();
      wsbp_form_4_canvas.show();

      wsbp_form_4_btns_canvas.show();
      wsbp_form_3_btns_canvas.hide();

      wsbp_form_4_progessbar.addClass("active");
   });

   wsbp_form_4_canvas_back_btn.on("click", function () {
      wsbp_form_3_canvas.show();
      wsbp_form_4_canvas.hide();

      wsbp_form_4_btns_canvas.hide();
      wsbp_form_3_btns_canvas.show();

      wsbp_form_4_progessbar.removeClass("active");
   });

   wsbp_btn_done_canvas.on("click", function () {
      var isValid = true;
      if ($('#wsbp_all_services_booking_firstName').val() == '') {
         $('#wsbp_all_services_booking_firstName').next('.error-message').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_all_services_booking_firstName').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_all_services_booking_lastName').val() == '') {
         $('#wsbp_all_services_booking_lastName').next('.error-message').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_all_services_booking_lastName').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_all_services_booking_email').val() == '') {
         $('#wsbp_all_services_booking_email').next('.error-message').removeClass('hidden');
         isValid = false;
      } else if (!isValidEmail($('#wsbp_all_services_booking_email').val())) {
         $('#wsbp_all_services_booking_email').next('.error-message').text('Please enter a valid email address').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_all_services_booking_email').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_all_services_booking_phone').val() == '') {
         $('#wsbp_all_services_booking_phone').next('.error-message').removeClass('hidden');
         isValid = false;
      } else if (isNaN($('#wsbp_all_services_booking_phone').val())) {
         $('#wsbp_all_services_booking_phone').next('.error-message').text('Please enter a valid phone number').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_all_services_booking_phone').next('.error-message').addClass('hidden');
      }
      if ($('#wsbp_all_services_booking_address').val() == '') {
         $('#wsbp_all_services_booking_address').next('.error-message').removeClass('hidden');
         isValid = false;
      } else {
         $('#wsbp_all_services_booking_address').next('.error-message').addClass('hidden');
      }

      if (isValid) {
         wsbp_modal_wrapper.addClass("active");
      }
   });

   // Function to validate email address
   function isValidEmail(email) {
      var emailRegex = /\S+@\S+\.\S+/;
      return emailRegex.test(email);
   }

   wsbp_shadow.on("click", function () {
      wsbp_modal_wrapper.removeClass("active");
   });

    //************************************************ */
   //             Canvas Booking Info
   //******************************************* ****/
   $("#wsbp_all_services_booking_info").on("click", function () {

      var wsbp_booking_date = $("#wsbp_all_services_booking_calender_date").val();
      var wsbp_num_of_person = $("#wsbp_all_services_num_of_person").val();
      var wsbp_services_id = $("#wsbp_all_booking_services").val();
      $.ajax({
         url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/bookinginfo/" + wsbp_services_id,
         type: "GET",
         success: function (response) {
            var wsbp_total_price = wsbp_num_of_person * response.price;
            // Define the HTML to be appended
            var htmlStrings =
               '<div class="row"> \
            <div class="col-md-4"> \
               <img src="' +
               response.service_img +
               '" alt="Service Image"> \
            </div> \
            <div class="col-md-8"> \
               <h3 class="wsbp_booking_info_services_name">' +
               response.service_name +
               '</h3> \
               <p class="wsbp_booking_info_services_des">' +
               response.service_des +
               '</p> \
               <ul> \
                  <li class="wsbp_booking_info_services_date">Date: ' +
               wsbp_booking_date +
               '</li> \
               \
                  <li class="wsbp_booking_info_services_time">Time: ' +
               wsbp_all_services_booking_time_Value +
               '</li> \
                  <li class="wsbp_booking_info_services_duration">Duration: ' +
               response.duration +
               'Min</li> \
                  <li class="wsbp_booking_info_services_per">Persons: ' +
               wsbp_num_of_person +
               '</li> \
                  <li class="wsbp_booking_info_services_price">Price: $' +
               wsbp_total_price +
               "</li> \
               </ul> \
            </div> \
            </div>";

            $("#wsbp_all_services_booking_info_show").html(htmlStrings);
         },
      });
   });

   //******************************************** */
   //          Canvas Booking Form
   //******************************************* */

   $("#wsbp_all_services_book_now").on("click", function (event) {

      var wsbp_booking_first_name = $("#wsbp_all_services_booking_firstName").val();
      var wsbp_booking_lastName = $("#wsbp_all_services_booking_lastName").val();
      var wsbp_booking_email = $("#wsbp_all_services_booking_email").val();
      var wsbp_booking_phone = $("#wsbp_all_services_booking_phone").val();
      var wsbp_booking_address = $("#wsbp_all_services_booking_address").val();
      var wsbp_booking_date = $("#wsbp_all_services_booking_calender_date").val();
      var wsbp_num_of_person = $("#wsbp_all_services_num_of_person").val();
      var wsbp_booking_services = $("#wsbp_all_booking_services").val();
      var wsbp_booking_assistants = $(
         'input[name="wsbp_booking_assistance"]:checked'
      ).data("id");

      $.ajax({
         url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/bookinginfo/" +
            wsbp_booking_services,
         type: "GET",
         success: function (response) {
            var responseData = response;
            var wsbp_total_price = wsbp_num_of_person * responseData.price;
            var formData = {
               wsbp_booking_first_name: wsbp_booking_first_name,
               wsbp_booking_last_name: wsbp_booking_lastName,
               wsbp_booking_email: wsbp_booking_email,
               wsbp_booking_phone: wsbp_booking_phone,
               wsbp_booking_address: wsbp_booking_address,
               wsbp_booking_date: wsbp_booking_date,
               wsbp_booking_time: wsbp_booking_time_Value,
               wsbp_booking_duration: responseData.duration,
               wsbp_booking_services: wsbp_booking_services,
               wsbp_booking_assistants: wsbp_booking_assistants,
               wsbp_num_of_person: wsbp_num_of_person,
               wsbp_booking_status: "pending",
               wsbp_booking_price: wsbp_total_price,
            };
            $.ajax({
               url: wsbp_plugin_data.home_url + "/wp-json/wsbp/v1/createbookings",
               type: "POST",
               data: formData,
               success: function (response) {

               },
               error: function (xhr, status, error) {
                  console.error(
                     "Request failed. Status: " + status + ", Error: " + error
                  );
               },
            });
         },
      });
   });


});