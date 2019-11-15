
function getProductId()
{

}

var add_to_order_btns = document.getElementsByName('add_to_order');
for(var i=0;i<add_to_order_btns;i++)
{
  add_to_order_btns[i].addEventListener("click", function(event)
  {
    event.preventDefault();
    console.log("Hello Portala. I'm loving Helvetica");
  });
}
