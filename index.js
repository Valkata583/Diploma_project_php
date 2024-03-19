let addButton = document.getElementById("add_car");
let close = document.getElementsByClassName("close");
let form = document.getElementById("car_add");
let staticData = document.getElementById("carInfoForm");
let consumes = document.getElementById("consumesForm");
let repairShopButton=document.getElementById("repairShopButton");
let carChoose=document.getElementById("car_choose");
let carsButton=document.getElementById("carsButton");
let repairShopsInfo=document.getElementById("repairShopsInfo");
let addRepairShops=document.getElementById("addRepairShops");
let addRepairShopBut=document.getElementById("addRepairShopBut");

function addForm() {
  form.style.display = "flex";
  staticData.style.display = "none";
}

function closeForm() {
  form.style.display = "none";
  staticData.style.display = "flex";
}

function closeForm1(){
  addRepairShops.style.display="none";
  repairShopsInfo.style.display="flex";
}

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".car-button");

  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const license = this.dataset.license;
      const licenseInput = document.getElementById("licenseInput");
      if (licenseInput) {
        licenseInput.value = license;
        document.getElementById("carInfoForm").submit();
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

//Cars Button
function cars(){
  carChoose.style.display="flex";
  addButton.style.display="block";
  repairShopsInfo.style.display="none";
  addRepairShops.style.display="none";
}

//Repair shop button
function repairShopForm(){
  staticData.style.display="none";
  carChoose.style.display="none";
  addButton.style.display="none";
  repairShopsInfo.style.display="flex";
}


//Open form for adding repair shop
function repairShopAddForm(){
  repairShopsInfo.style.display="none";
  addRepairShops.style.display="flex";
}

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
