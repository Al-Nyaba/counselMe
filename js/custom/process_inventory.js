proceedBtn = document.getElementById('proceedBtn');
function alertMe()
{
  alert("Hola! Buenos Adios");
}

function showErrors()
{
  $(document).ready(function(){
    $(".invalid_input").show();
  });
}

function hideAllErrors()
{
  $(document).ready(function(){
    if($(".invalid_input").is(":visible")){
      $(".invalid_input").hide();
    }
  });
}

function hideError(elem)
{
  elem.nextElementSibling.style.display = "none";
}

function disableBtn(btn)
{
  btn.disabled = true;
  btn.style.display = "none";
}

function enableBtn(btn)
{
  btn.disabled = false;
  btn.style.display = "block";
}

function check_order_reason()
{
  if(this.value.trim() == '')
  {
    showErrors();
    disableBtn(proceedBtn);
  }
  else
  {
    hideError(this);
    enableBtn(proceedBtn);
  }
}



function sendAjax()
{
  var server_message = document.getElementById('server_message');
  server_message.innerHTML = "";
  var order_reason = document.getElementById('reason_for_order');
  if(order_reason.value.trim() == '')
  {
    showErrors();
    return false;
  }
  var form_data = new FormData(prdtForm);
  var action = 'process_inventory2.php';
  var xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  xhr.onreadystatechange = function(){

    if(xhr.readyState == 4 && xhr.status == 200){
      var result = xhr.responseText;
      if(result != '')
      {
        console.log("raw responseText is: " + result);
        if(JSON.parse(result))
        {
          var json = JSON.parse(result);
          if(json.hasOwnProperty('success') && json.hasOwnProperty('new_qty'))
          {
            var json_success = json.success;
            var json_new_qty = json.new_qty;
            var elems = document.getElementsByClassName('prdt_id');
            for(var i=0;i<json_success.length;i++)
            {
              for(var j=0;j<elems.length;j++)
              {
                if(json_success[i] == elems[j].value)
                {
                  elems[j].parentNode.parentElement.classList.add('table-primary');
                  elems[j].parentNode.parentElement.getElementsByClassName('qty_remaining')[0].value =  json_new_qty[i];
                  elems[j].parentNode.nextElementSibling.innerHTML = json_new_qty[i];
                  elems[i].nextElementSibling.value ='';
                  order_reason.value = '';
                  order_reason.focus();
                }
              }
            }
            server_message.innerHTML = "Successfully created inventory for valid inputs of the following product ids: " + "<strong>" + json_success + "</strong>";
            hideAllErrors();
          }
          else
          {
            if(json.hasOwnProperty('failure') && ! json.hasOwnProperty('success'))
            {
              console.log(json.failure);
              server_message.innerHTML = '<strong class="has_error">There were some errors in creating the inventory. Please reload the page and try again';
            }
            else
            {
              console.log(json);
            }
          }
        }
      }
    }
  };

  xhr.send(form_data);

  // prdtForm.submit();
}
