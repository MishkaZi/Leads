(function ($) {

	"use strict";
	var userData = {
		ip: '',
		country: ''
	};

	// Function to fetch user IP and country
	function fetchUserIPAndCountry() {
		$.getJSON('http://ip-api.com/json', function (data) {
			userData.ip = data.query;
			userData.country = data.country;
		}).fail(function () {
			console.log("Error fetching IP and country information.");
		});
	}



	// Call the function on page load
	fetchUserIPAndCountry();

	// Form
	var contactForm = function () {
		if ($('#contactForm').length > 0) {
			$("#contactForm").validate({
				rules: {
					firstName: "required",
					lastName: "required",
					email: {
						required: true,
						email: true
					},
					phoneNumber: {
						required: true,
						digits: true
					},
					note: "required"
				},
				messages: {
					firstName: "Please enter your first name",
					lastName: "Please enter your last name",
					email: "Please enter a valid email address",
					phoneNumber: "Please enter your phone number",
					note: "Please enter a note"
				},

				submitHandler: function (form, event) {
					event.preventDefault();
					var formData = $(form).serializeArray();
					var firstName = '';
					var lastName = '';
				
					formData.forEach(function (item) {
						if (item.name === 'firstName') {
							firstName = item.value;
						} else if (item.name === 'lastName') {
							lastName = item.value;
						}
					});

					formData.push({ name: 'ip', value: userData.ip });
					formData.push({ name: 'country', value: userData.country });
					formData.push({ name: 'url', value: window.location.href });

					var urlParams = new URLSearchParams(window.location.search);
					if (urlParams.has('sub_1')) {
						formData.push({ name: 'sub_1', value: urlParams.get('sub_1') });
					}

					$.ajax({
						type: "POST",
						url: "src/leads.php",
						data: formData,
						success: function (response) {
							if (response && response.status === 'success') {
								$('#form-message-warning').hide(); // Hide the error message
								var fullName = firstName + ' ' + lastName;
								$('#success-message-text').text('Thank you ' + fullName + ', we’ll contact you soon'); // Update text only
								$('#form-message-success').fadeIn();
								setTimeout(function () {
									$('#form-message-success').fadeOut();
								}, 8000);
							} else if (response && response.status === 'error') {
								$('#form-message-warning').html(response.message).fadeIn();
							}
						},
						error: function () {
							$('#form-message-warning').html("Something went wrong. Please try again.").fadeIn();
						}
					});
				}
			});
		}
	};
	contactForm();

	// Close popup and clear form inputs
	document.querySelector('.popup-close').addEventListener('click', function () {
		document.getElementById('form-message-success').style.display = 'none';
		$('#contactForm').trigger("reset"); // Clear form inputs
	});

})(jQuery);
