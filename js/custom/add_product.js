/*
  TODO:
    perform client-side validation before server-side validation
    show a spinner when processing the add product form
    hide the spinner when the processing is complete

*/

function clearError()
{
  // hide the custom errors
  $(document).ready(function(){
    if($(".invalid_input").is(":visible")){
      $(".invalid_input").hide();
    }
  });

  // select the inputs and add a red border around them using the .has_error class
  var add_prdt_form = document.getElementById('add_prdt_form');
  for(var i = 0; i < add_prdt_form.elements.length; i++)
  {
      add_prdt_form.elements[i].classList.remove('has_error');
  }
}

function showErrors()
{
  $(document).ready(function(){
    $(".invalid_input").show();
  });
}

function showServerMsg(text)
{
  serverMessage.innerHTML = text;
  serverMessage.style.display = 'block';
}

function clearForm(form) {
  form.reset();
}

function processProductInfo() {
  var add_prdt_form = document.getElementById('add_prdt_form');
  var action = add_prdt_form.getAttribute('action');

  var form_data = new FormData(add_prdt_form);
  // showSpinner();

  var xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  xhr.onreadystatechange = function() {
  if(xhr.readyState == 4 && xhr.status == 200)
  {
    var result = xhr.responseText;
    if(result != '')
    {
      // if not an empty reply, parse the result with JSON.
      json = JSON.parse(result);
      console.log(window.location.href);
      clearError();
      $("#serverMessage").html("");
      // hideSpinner();
      if(json.hasOwnProperty('errors') && json.errors.length > 0)
      {
        for(var i=0; i<json.errors.length; i++)
        {
          // display errors
          // console.log(json.errors[i]);
          document.getElementById(json.errors[i]).classList.add('has_error');

          if($(document).ready(function(){
              $('.has_error').siblings('.invalid_input').css("display", "block");
            }));
        }
      }
      else if(json.hasOwnProperty('success'))
      {
        alert("successfully added product");
        showServerMsg(json.success);
        clearForm(add_prdt_form);
        $(document).ready(function(){
          if($("#brand-select").is(":visible")){
            $("#brand-select").hide();
            location.reload();
          }
        });
        location.reload();
        $("serverMessage").html("Successfully added product");
      }
    }

  }
};
  xhr.send(form_data);

}

function updateBrandsList() {

  var cat_select = document.getElementById('category-select');
  var brand_select = document.getElementById('brand-select');

  var cat_id = cat_select.options[cat_select.selectedIndex].value;
  var url = 'get_brands_by_cat.php?category_id=' + cat_id;
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);

  xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) {
    brand_select.innerHTML = xhr.responseText;
    brand_select.style.display = 'inline';
    }
  }
  xhr.send();
}

// serverMessage div
var serverMessageDiv = document.getElementById('serverMessageDiv');
var hideSuccessMsg = document.getElementById('hide-success-btn');
hideSuccessMsg.addEventListener("click", function(event) {
  serverMessageDiv.style.display = 'none';
  serverMessage.innerHTML = '';
});
var serverMessage = document.getElementById('serverMessage');

// for updating brand list using the selected category
var cat_select = document.getElementById('category-select');
cat_select.addEventListener("change", updateBrandsList);

// for submitting product information
var add_prdt_submit_btn = document.getElementById('add_prdt_submit_btn');
add_prdt_submit_btn.addEventListener("click", function(event) {
  event.preventDefault();
  processProductInfo();
});
