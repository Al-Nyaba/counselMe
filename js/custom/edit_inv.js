
edit_inv_table_body = document.getElementById('editLazyTableBody');
edit_inv_form = document.getElementById('edit_inventory_form');

invEditBtn = document.getElementById('invEditBtn');
invEditBtn.addEventListener("click", getProducts);

function getProducts()
{
  var form_data = new FormData(edit_inv_form);
  var action = 'process_return_products.php';
  var xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result != '')
      {
        var json = JSON.parse(result);
        if(json.hasOwnProperty('result'))
        {
          var json_res = json.result;
          var ct = 0;
          highlightArr = Array();
          for(var i=0; i<json_res.length; i++)
          {
            if(json_res[i][1] == true)
            {
              ++ct;
              // store the id of the product in an array
              prdt_id = json_res[i][0];
              highlightArr.push(prdt_id);
            }
          }
          highlight(highlightArr);
        }
      }
    }
  };
  xhr.send(form_data);
}

function highlight(arr)
{
  elems = document.getElementsByName('product_qty[]');
  for(var i=0; i<elems.length; i++)
  {
    for(var j=0; j<arr.length; j++)
    {
      if(elems[i].previousElementSibling.value == arr[j])
      {
        elems[i].value = '';
        elems[i].parentElement.parentElement.style.background = '#0d2182';
        elems[i].parentElement.parentElement.style.color = '#ffffff';
      }
    }
  }
}

function removeChildrenNodes()
{
  var tbl = edit_inv_table_body;
  tbl.innerHTML = "";
}

function show_inventory_info(data, inv_data, empInfo)
{
  $("span#assigned_employee").text(empInfo['employee_full_name']);
  var inv_id_input = document.getElementById('inv_id');
  inv_id_input.setAttribute('value', inv_data);

  var select_employee = document.getElementById("select_employee");
  select_employee.addEventListener("click", getEmployees);

  var t_body = document.getElementById('editLazyTableBody');

  data.forEach(function(object) {
    var tr = document.createElement('tr');
    tr.innerHTML = '<td>' +
     object.product_name + '</td>' +
     '<td>' + object.order_quantity + '</td>' +
    '<td>' +
    '<input type="hidden" name="product_id[]" value=' + object.product_id + ' />' +
    '<input type="text" name="product_qty[]" class="form-control" />' +
    '</td>';
    t_body.appendChild(tr);

  });
}

// callers => editBtn click
function getInv()
{
  var in_id = this.previousElementSibling.value;
  var action = "edit_inv.php";
  var form_data = new FormData(this.parentElement);
  removeChildrenNodes();
  var xhr = new XMLHttpRequest();
  xhr.open('POST', action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) {
      var result = xhr.responseText;
      if(result != '') {
        var json = JSON.parse(result);
        if(json.hasOwnProperty('success') && json.success.length > 0)
        {
          var inv_id = json.success[1].inventory_order_id;
          var arr = json.success;
          show_inventory_info(arr[0], inv_id, arr[1]);
          selectEmployee();
        }
      }
    }
  };
  xhr.send(form_data);
}

function selectEmployee() {
  var se = $("#select_employee")[0];
  var inv_id = se.previousElementSibling.value;
  $("#select_employee").on('select2:select', function(e){
    var data = e.params.data.id;
    console.log(data);
    var action = "change_inventory_employee.php?emp_id="+data+"&inv_id="+inv_id;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200) {
        var result = xhr.responseText;
        if(result != '') {
          console.log(result);
        }
      }
    };
    xhr.send();
  });
}


function getEmployees()
{
  $(document).ready(function(){
    selectEmployee();
    $("#select_employee").select2({
      ajax: {
        url: 'get_employee_list.php',
        type: 'post',
        dataType: 'json',
        delay: 0,
        data: function(params) {
          return {
            searchTerm: params.term
          };
        }, 
        processResults: function(response) {
          return {
            results: response
          };
        }, 
        cache: false
      }
    });
  });

}



// Edit buttons on the page
$(document).ready(function(){
  editBtns = document.getElementsByName('edit_inventory');
  for(var i=0;i<editBtns.length;i++)
  {
    editBtns[i].addEventListener("click", getInv);
  }
});

table.on( 'page.dt', function () {
  reloadDelBtns();

  editBtns = document.getElementsByName('edit_inventory');
  for(var i=0;i<editBtns.length;i++)
  {
    editBtns[i].addEventListener("click", getInv);
  }
  detailsBtns = document.getElementsByName('check_product_info');
  for(var i=0;i<detailsBtns.length;i++)
  {
    detailsBtns[i].addEventListener("click", getInvDetails);
  }
});


table.on( 'draw', function () {
  reloadDelBtns();

  editBtns = document.getElementsByName('edit_inventory');
  for(var i=0;i<editBtns.length;i++)
  {
    editBtns[i].addEventListener("click", getInv);
  }
  detailsBtns = document.getElementsByName('check_product_info');
  for(var i=0;i<detailsBtns.length;i++)
  {
    detailsBtns[i].addEventListener("click", getInvDetails);
  }
});

table.on( 'length.dt', function () {
  reloadDelBtns();
  editBtns = document.getElementsByName('edit_inventory');
  for(var i=0;i<editBtns.length;i++)
  {
    editBtns[i].addEventListener("click", getInv);
  }
  detailsBtns = document.getElementsByName('check_product_info');
  for(var i=0;i<detailsBtns.length;i++)
  {
    detailsBtns[i].addEventListener("click", getInvDetails);
  }
});
