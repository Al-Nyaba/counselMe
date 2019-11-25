
function delEmployee()
{
    var form_data = new FormData(this.parentElement);
    var action = "get_employee.php";
    var xhr = new XMLHttpRequest();
    xhr.open('POST', action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
        var modal_body = document.getElementById('confirm_delete_employee');
        modal_body.innerHTML = '';
        if(xhr.readyState == 4 && xhr.status == 200) {
            var result = xhr.responseText;
            if(result != '')
            {
                var json = JSON.parse(result);
                if(json.hasOwnProperty('success'))
                {
                    var fm = document.createElement('form');
                    fm.setAttribute('method', 'POST');
                    fm.setAttribute('action', 'del_employee.php');
                    
                    fm.innerHTML = '<input type="hidden"' +  
                    ' value="' + json.success + '" name="del_employee_confirm" />' +
                    '<input type="submit"  id="delete_employee_confirm" class="btn btn-lg btn-danger value="CONFIRM DELETE" />';
                    modal_body.appendChild(fm);
                    if($("body").hasClass('modal-open'))
                    {
                        var de = document.getElementById('delete_employee_confirm');
                        de.addEventListener("click", cnfDelEmployee);
                    }
                }
                else if(json.hasOwnProperty('failure'))
                {
                    modal_body.innerHTML = 'UNABLE TO DELETE EMPLOYEE';
                    console.log("successfully deleted employee");
                }
            }
        }
    };
    xhr.send(form_data);
}

function cnfDelEmployee()
{
    event.preventDefault();
    var modal_body = document.getElementById('confirm_delete_employee');
    if($("#employeeDeleteModal").hasClass("show"))
    {
        var form_data = new FormData(this.parentElement);
        var action = "del_employee.php";
        var xhr = new XMLHttpRequest();
        xhr.open("POST", action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function(){
            modal_body.innerHTML = '';
            if(xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText;
                if(result != '')                
                {
                    var json = JSON.parse(result);
                    if(json.hasOwnProperty('success'))
                    {
                        modal_body.innerHTML = 'EMPLOYEE HAS BEEN DELETED SUCCESSFULLY!';
                        console.log("successfully deleted employee");
                        $("#employeeDeleteModal .close").click();

                        alert("EMPLOYEE HAS BEEN DELETED SUCCESSFULLY!");
                        window.location.reload();
                        
                    }
                    else if(json.hasOwnProperty('failure'))
                    {
                        modal_body.innerHTML = 'UNABLE TO DELETE EMPLOYEE';
                        console.log("successfully deleted employee");
                    }
                }
            }
        };
        xhr.send(form_data);
    }
}


$(document).ready(function(){
    delBtns = document.getElementsByName('delete_employee');
    for(var i=0;i<delBtns.length;i++)
    {
        delBtns[i].addEventListener("click", delEmployee);
    }
});