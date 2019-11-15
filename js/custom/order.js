

table_body = document.getElementById('lazyTableBody');
inv_creator = document.getElementById('assigned_employee');

function deleteChildrenData()
{
  var tbl = table_body;
  tbl.innerHTML = "";
}

//this function appends the json data to the table 'gable'
function append_json(data, inv_date)
{
  var table = document.getElementById('lazyTableBody');
  document.getElementById('inventory_date').innerHTML = inv_date;
  data.forEach(function(object) {
      var tr = document.createElement('tr');
      tr.innerHTML = '<td>' + object.product_name + '</td>' +
      '<td>' + object.order_quantity + '</td>' +
      '<td>' + object.unit_price + '</td>' +
      '<td>' + object.order_total_amount + '</td>' +
      '<td>' + object.date_added + '</td>';
      table.appendChild(tr);
      inv_creator.innerHTML = object.user_name.toUpperCase();
      // console.log("Date added: " + object.date_added);
  });
}

function showLoading(x)
{
  // console.log(x);
  x.innerHTML = "";
  sp = document.createElement('span');
  t = document.createTextNode("Loading...");

  sp.setAttribute('class', 'spinner-border spinner-border-sm');
  sp.setAttribute('role', 'status');
  sp.setAttribute('aria-hidden', 'true');
  x.appendChild(sp);
  x.appendChild(t);

}

function hideLoading(x)
{
  // console.log(x);
  x.children[0].remove();
  x.innerHTML = "Details";
}

function getInvDetails()
{
  var in_id = this.previousElementSibling.value;
  var action = "inventory_details.php";
  var form_data = new FormData(this.parentElement);

  showLoading(this);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  var tb = document.getElementById('lazyTableBody');
  var anim = document.createElement('span');
  anim.innerHTML = '<img src="preloaders/loading_text.gif" />';
  tb.appendChild(anim);

  xhr.onreadystatechange = function() {
    // <span id="loading_icon"><img src="preloaders/loading_text.gif" /></span>
    deleteChildrenData();

    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result != '')
      {
        var json = JSON.parse(result);
        if(json.hasOwnProperty('success') && json.success.length > 0)
        {
          // console.log("There were " + json.success.length + " products found for the chosen inventory!");
          var arr = json.success;
          append_json(arr[0], arr[1]['date_added']);
        }
      }
    }
  };
  xhr.send(form_data);
  hideLoading(this);
}

function cnfDelInventory()
{
  var inv_id = this.parentElement.getElementsByClassName('inv_order_id')[0].value;
  var action = "del_inv.php?inv_id="+inv_id;
  // console.log(in_id);
  var xhr = new XMLHttpRequest();
  xhr.open('GET', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function(){
    var m_body = document.getElementById('confirm_delete_inventory');
    m_body.innerHTML = '';
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result != '')
      {
        var json_response = JSON.parse(result);
        if(json_response.hasOwnProperty('valid_inv_id'))
        {
          // create confirmation button
          console.log(json_response.valid_inv_id);
          console.log(m_body.firstChildElement);
          var fm = document.createElement('form');
          fm.setAttribute('method', 'post');
          fm.setAttribute('action', 'test10.php');
          fm.innerHTML =
          '<input type="hidden" value="' + json_response.valid_inv_id + '" name="del_confirm" />'
          + '<input type="submit" id="delete_inventory_confirm" class="btn btn-lg btn-info" value="CONFIRM" />';
          m_body.appendChild(fm);
          $('body').hasClass('modal-open');
          var di  = document.getElementById('delete_inventory_confirm');
          if(di)
          {

            // if user confirms delete action

            di.addEventListener('click', function(event){
              event.preventDefault();
              var s_inv_id = di.previousElementSibling.value;
              var action = "del_inv.php?inv_id="+s_inv_id + "&confirm=true";
              var xhr = new  XMLHttpRequest();
              xhr.open('GET', action, true);
              xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
              xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200) {
                  m_body.innerHTML = '';
                  var result = xhr.responseText;
                  if(result != '')
                  {
                    var json = JSON.parse(result);
                    if(json.hasOwnProperty('success'))
                    {
                      m_body.innerHTML = 'INVENTORY HAS BEEN DELETED SUCCESSFULLY';
                      console.log('INVENTORY HAS BEEN DELETED SUCCESSFULLY');
                      window.location.reload();
                    }
                  }
                }
              };
              xhr.send();
            });

          }
        }
      }
    }
  }
  xhr.send();
}

function userDelInventory()
{
  alert("I have been clicked!");
  console.log(this);
}

$(document).ready(function(){
  detailsBtns = document.getElementsByName('check_product_info');
  for(var i=0;i<detailsBtns.length;i++)
  {
    detailsBtns[i].addEventListener("click", getInvDetails);
  }
});

function reloadDelBtns()
{
  // alert('reloadDelBtns has been called because of an operation on the data table');
  $(document).ready(function(){
    delBtns = document.getElementsByName('delete_inventory');
    for(var i=0;i<delBtns.length;i++)
    {
      delBtns[i].addEventListener("click", cnfDelInventory);
    }
  });
}

$(document).ready(function(){
  delBtns = document.getElementsByName('delete_inventory');
  for(var i=0;i<delBtns.length;i++)
  {
    delBtns[i].addEventListener("click", cnfDelInventory);
  }
});
