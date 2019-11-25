
var ghana = document.getElementsByTagName('tbody')[0];

function updateRows()
{
  var fs = document.getElementsByClassName('submit_edit');
  for(var i=0;i<fs.length;i++)
  {
    fs[i].parentElement.onsubmit = function(event)
    {
      event.preventDefault();
      console.log("I have prevented the default behaviour");
    }
  }
}


$("#productsTable").on('draw.dt', function(){
  // alert("page was re-drawn");
  updateRows();
});
