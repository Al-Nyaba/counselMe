
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

$("#firstname").focus(function(){
  var firstname = $("#firstname").val();
  lastname = $("#lastname").val();
  if(lastname) {
    document.getElementById("username").value = firstname + "_" + lastname;
  }
});

$("#lastname").focus(function(){
  var lastname = $("#lastname").val();
  firstname = $("#firstname").val();
  if(firstname) {
    document.getElementById("username").value = firstname + "_" + lastname;
  }
});


$("#username").focus(function(){
  var firstname = $("#firstname").val();
  var lastname = $("#lastname").val();
  if(firstname && lastname && !this.value){
    this.value = firstname + "_" + lastname;
  } else {
    if(firstname && lastname) {
      this.value = firstname + "_" + lastname;
    }
  }
});

$("#user_registration_form").submit(function(event){
  event.preventDefault();
  if($(this).valid())
  {
    $.ajax({
      type: 'post',
      url: 'register.php',
      data: $(this).serializeArray(),
      beforeSubmit: function() {
        $("i#spinner").removeClass('d-none');
        $("input#signUpBtn").attr("disabled", true);
      },
      uploadProgress: function (event, position, total, percentComplete) {
        $("input#signUpBtn").attr("disabled", true);
        $("p#errorInfo").text("Please wait...");
        $("i#spinner").removeClass("d-none");
        $("i#spinner").show();
      },
      success: function (value) {
        // console.log(value);
        myxhr = JSON.parse(value);
        console.log(myxhr);
        if(myxhr.hasOwnProperty('success'))
        {
          $('#user_registration_form')[0].reset();
          $("#spinner").addClass('d-none');
          $("#modalRegisterForm .close").click();
          $( "div#new_user_success" ).removeClass( "d-none bg-error" ).addClass("d-block");
          $("span#new_user").text(myxhr.success[0]);
          $("p#errorInfo").text('');
          $("p#errorInfo").removeClass('error');
          $("input#signUpBtn").attr("disabled", false);
          
        }
        else
        {
          if(myxhr.hasOwnProperty('failure'))
          {
            $("#spinner").addClass('d-none');
            $("#errorIcon").removeClass('d-none');
            $( "div#new_user_success" ).addClass( "d-none bg-error" );
            console.log(myxhr.failure);
            $("span#new_user").text(myxhr.failure[0]);
            $("p#errorInfo").text(myxhr.failure[0]);
            $("p#errorInfo").addClass('error');
          }
        }
      }, 
      error: function(value) {
        $("#spinner").addClass('d-none');
        $("#errorIcon").removeClass('d-none');
        $( "div#new_user_success" ).addClass( "d-none bg-error" );
        $("span#new_user").text("An error occured. Please try again.");
        $("p#errorInfo").text("An error occured. Please try again.");
        $("p#errorInfo").addClass('error');
      }
    });
  }
  else
  {
    console.log("the form is not yet valid");
  }
});

$(document).ready(function(){
  $("#user_registration_form").validate({
    rules: {

      firstname : {
        required: true,
        minlength: 3, 
        maxlength: 32,
        normalUsername: true
      },

      lastname : {
        required: true,
        minlength: 3, 
        maxlength: 32,
        normalUsername: true
      },

      username : {
        required: true,
        minlength: 6,
        maxlength: 32, 
        normalUsername: true
      },

      email : {
        required: true,
        email: true
      },

      phone : {
        required: true,
        minlength: 12,
        maxlength: 15,
        phoneNum: true
      },

      location : {
        required: true,
        maxlength: 65,
      },

      password : {
        required: true,
        minlength: 8,
        portalaPass: true
      },

      conf_password : {
        required: true,
        equalTo: "#password",
        minlength: 8,
        portalaPass: true
      }
    },

    messages : {
      firstname: {
        required: "Please enter your first name",
        minlength: "Your first name cannot be less than 3 characters!",
        maxlength: "Your first name cannot be more than 32 characters!",
        normalUsername: "Username must begin with english letter, and optionally followed by numbers, letters, underscores, or hyphens"
      },
      lastname: {
        required: "Please enter your last name",
        minlength: "Your last name cannot be less than 3 characters!",
        maxlength: "Your last name cannot be more than 32 characters!"
      },
      username: {
        required: "Please enter your first name",
        minlength: "Your username must be at least 6 characters",
        maxlength: "Creatively make a username that is at most 32 characters!. Dont' blame us if we truncate it in the future!"
      },
      email: "We would need your email to setup the account. Ensure it is valid.",
      password: {
        required: "Please provide a strong password",
        minlength: "Your password must be at least 8 characters long for security sake"
      },
      conf_password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long",
        equalTo: "Please enter the same password as above"
      }
    }

  });
});


jQuery.validator.addMethod("portalaPass", function(value, element){
  return this.optional(element) || /^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})/.test(value);
}, "Your password must contain letters, symbols, and numbers");

jQuery.validator.addMethod("phoneNum", function(value, element){
  return this.optional(element) || /^([0-9]{1,3})([0-9]){9}$/.test(value);
}, "We beleive this phone number is not in the correct format. Please enter the number in international format (e.g 233 for Ghana and enter the last nine digits of your usual ten digit phone number.");


jQuery.validator.addMethod("normalUsername", function(value, element){
  return this.optional(element) || /^[A-Za-z]*([A-Za-z0-9_-]){3,32}$/.test(value);
}, "Username must not contain spaces! Only english alphabets, digits, underscores and hyphens can be used");
