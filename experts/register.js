

x = document.getElementById("paymentMethodDiv");
y = x.getElementsByClassName('custom-control-input');
v = x.nextElementSibling.querySelector('#momo_number');

for(i=0;i<y.length-1;i++)
{
	y[i].addEventListener('click', function(event) {
		enableCCForms();
	});
}


function enableCCForms() {
	// disables the credit card information forms and removes the required propertiess
	console.log("WE are re-enable the CC forms");

	// disable the form for the momo number and remove the required attribute on the input element
	v.removeAttribute('required');

	// enable the credit card information forms below it
	ci = document.getElementById('cardInfo');
	inputs = ci.querySelectorAll('input');

	for(i=0;i<inputs.length;i++) {
		inputs[i].setAttribute('required', 'required');
		inputs[i].disabled = false;
	}
}

y.mtn_gh_momo.addEventListener('click', function(event) {

	if(y.mtn_gh_momo.checked)
	{
		v.setAttribute('required', 'required');

		// disable the credit card information forms below it
		ci = document.getElementById('cardInfo');
		inputs = ci.querySelectorAll('input');

		for(i=0;i<inputs.length;i++) {
			inputs[i].removeAttribute('required');
			inputs[i].disabled = true;
		}
	}
});

