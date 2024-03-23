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
let repairsInfo=document.getElementById("repairsInfo");
let addRepairs=document.getElementById("addRepairs");
let addConsumes=document.getElementById("addConsumes");
let consInfo=document.getElementById("consInfo");

function addForm() {
  staticData.style.display = "none";
  form.style.display = "flex";
}

function closeForm() {
  form.style.display = "none";
  staticData.style.display = "flex";
}

function closeForm1(){
  addRepairShops.style.display="none";
  repairShopsInfo.style.display="flex";
}

function closeForm2(){
  addRepairs.style.display="none";
  repairsInfo.style.display="flex";
}

function closeForm3(){
  addConsumes.style.display="none";
  consInfo.style.display="flex";
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


//Cars Button
function cars(){
  repairShopsInfo.style.display="none";
  addRepairShops.style.display="none";
  repairsInfo.style.display="none";
  addRepairs.style.display="none";
  carChoose.style.display="flex";
  addButton.style.display="block";
  
}

//Repair shop button
function repairShopForm(){
  staticData.style.display="none";
  carChoose.style.display="none";
  addButton.style.display="none";
  repairsInfo.style.display="none";
  addRepairs.style.display="none";
  repairShopsInfo.style.display="flex";
}

//Open form for adding repair shop
function repairShopAddForm(){
  repairShopsInfo.style.display="none";
  addRepairShops.style.display="flex";
}

//Repair button
function repairsForm(){
  staticData.style.display="none";
  carChoose.style.display="none";
  addButton.style.display="none";
  repairShopsInfo.style.display="none";
  addRepairs.style.display="none";
  repairsInfo.style.display="flex";
}

//Open form for adding repair 
function repairsAddForm(){
  repairsInfo.style.display="none";
  addRepairs.style.display="flex";
}

//Consumes button
function consForm(){
  staticData.style.display="none";
  carChoose.style.display="none";
  addButton.style.display="none";
  repairShopsInfo.style.display="none";
  consInfo.style.display="flex";
}

function consAddForm(){
  consInfo.style.display="none";
  addConsumes.style.display="flex";
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
