let addButton = document.getElementById("add_car");
let close = document.getElementsByClassName("close");
let form = document.getElementById("car_add");
let staticData = document.getElementById("carInfoForm");
let consumes = document.getElementById("consumesForm");

function addForm() {
  form.style.display = "flex";
  staticData.style.display = "none";
}

function closeForm() {
  form.style.display = "none";
  staticData.style.display = "flex";
}

// document.addEventListener('DOMContentLoaded', function() {
//     const buttons = document.querySelectorAll('.car-button');

//     buttons.forEach(button => {
//         button.addEventListener('click', function() {
//             const license = this.dataset.license;
//             const xhr = new XMLHttpRequest();
//             xhr.onreadystatechange = function() {
//                 if (xhr.readyState === XMLHttpRequest.DONE) {
//                     if (xhr.status === 200) {
//                         console.log(xhr.responseText);
//                         // Handle the response here (display data or update DOM)
//                     } else {
//                         console.error('Request failed');
//                     }
//                 }
//             };
//             xhr.open('GET', 'get_car_info.php?license=' + license, true);
//             xhr.send();
//         });
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const buttons = document.querySelectorAll('.car-button');

//     buttons.forEach(button => {
//         button.addEventListener('click', function() {
//             const license = this.dataset.license;
//             document.getElementById('licenseInput').value = license;
//             document.getElementById('carInfoForm').submit();
//         });
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".car-button");

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const license = this.dataset.license;
      const licenseInput = document.getElementById("licenseInput");
      if (licenseInput) {
        licenseInput.value = license;
        document.getElementById("carInfoForm").submit();
        // const currentUrl = window.location.href;

        // // Append the license as a query parameter to the current URL
        // const urlWithLicense = currentUrl + '?license=' + encodeURIComponent(license);
        // console.log('Updated URL:', urlWithLicense);
      } else {
        console.error('Element with ID "licenseInput" not found');
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const button_consumes = document.getElementById("consButton");
  button_consumes.addEventListener("click", function () {
    // const license = this.dataset.license;
    // const comsumeInput = document.getElementById('comsumeInput');
    //if (comsumeInput) {
    //comsumeInput.value = license;
    document.getElementById("consumesForm").submit();
    //} else {
    //console.error('Element with ID "comsumeInput" not found');
    // }
  });
});

// Wait for the document to be fully loaded
// $(document).ready(function() {
//     // Event listener for comsButton click
//     $('#comsButton').on('click', function(event) {
//         event.preventDefault(); // Prevent form submission

//         // Get the license plate of the active car button
//         var license = $('.car-button.active').data('license');
//         console.log(license);
//         // Make AJAX request to fetch comsumes information
//         // $.ajax({
//         //     url: 'index.php', // Update this with the path to your PHP script
//         //     type: 'POST',
//         //     data: { license: license }, // Send the license plate as POST data
//         //     dataType: 'html', // Expected data type
//         //     success: function(response) {
//         //         // Replace the content of the div with id="comsumesInfo" with the fetched data
//         //         $('#comsumesForm').html(response);
//         //     },
//         //     error: function(xhr, status, error) {
//         //         console.error('AJAX Error:', error); // Log any errors to the console
//         //     }
//         // });
//     });
// });

// // Get the input element by its ID
// var licenseInput = document.getElementById("licenseInput");

// // Get the value of the input field
// var licenseValue = licenseInput.value;

// // Now, licenseValue contains the value of the input field
// console.log(licenseValue);
