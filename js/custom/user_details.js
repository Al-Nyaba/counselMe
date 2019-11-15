

function deleteChildrenData()
{
    var tbl = document.getElementById('lazyEmplTableBody');
    tbl.innerHTML = "";
}

function append_json_data(data, empData)
{
    var emp = empData;
    console.log(emp['emp_name']);
    $("#employee_type").html(emp['emp_type']);
    $("#emp_name").html(emp['emp_name']);
    $("#employee_email").html(emp['email']);
    $("#emp_added_by").html(emp['added_by']);
    $("#date_added").html(emp['date_added']);

    var table_body = document.getElementById('lazyEmplTableBody');
    data.forEach(function(object) {
        var tr = document.createElement('tr');
        tr.innerHTML = '<td>' + object.reason + '</td>' +
        '<td>' + object.date_added + '</td>' +
        '<td>' + object.date_modified + '</td>';
        table_body.appendChild(tr);
    });

    $("#lazyEmplTable").ready(function(){
        var tb = $("#lazyEmplTable");
        var table = $("#lazyEmplTable").DataTable();
    });
}

function getEmpInfo()
{
    var in_id = this.previousElementSibling.value;
    var action = "employee_info.php";
    var form_data = new FormData(this.parentElement);
    // showLoading(this);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    var tb = document.getElementById('lazyEmplTable');
    var anim = document.createElement('span');
    // anim.innerHTML = '<img src="preloaders/loading_text.gif" />';
    // tb.appendChild(anim);
    
    xhr.onreadystatechange = function() {
        deleteChildrenData();
        if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            if(result != '')
            {
                var json = JSON.parse(result);
                if(json.hasOwnProperty('success') && json.success.length > 0)
                {
                    var empInfo = json[0];
                    var arr = json.success;
                    append_json_data(arr, empInfo);
                }
            }
        }
    };
    xhr.send(form_data);
    
}

$(document).ready(function(){
    empInfoBtns = document.getElementsByName('check_employee_info');
    for(var i=0; i<empInfoBtns.length;i++)
    {
        empInfoBtns[i].addEventListener("click", getEmpInfo);
    }
});