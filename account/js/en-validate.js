jQuery(function($) { 

  $("#update-form").validate({
      rules: { 
            email: { 
                required: true, 
                email: true,
        remote: {
          url: "../php/checkEmail.php",
          type: "post",
          data: {
            email: function(){
              var email_orig = $("#orig-email").val();
              var email_change = $("#email").val();
              if(email_orig == email_change){
                return "good@ok.com";
              }
              else {
                return $("#email").val();                
              }            
            }
          }
        }
            },
      mobile1: {
        required: true,
        minlength: 3,
        number: true
      },
      mobile2: {
        required: true,
        minlength: 3,
        number: true
      },
      mobile3: {
        required: true,
        minlength: 4,
        number: true
      },
      mobile: {
        required: true,
        number: true
      } 
        }, 
        messages: { 
            email: { 
                required: "Please enter an email address", 
        remote: "That email address is already in use.  Please enter another email address"
            },
      mobile1: {
        required: "Please enter a number",
        minlength: "must be 3 digits"
        },
      mobile2: {
        required: "Please enter a number",
        minlength: "must be 3 digits"
        },
      mobile3: {
        required: "Please enter a number",
        minlength: "must be 4 digits"
        },
      mobile: {
        required: "Please enter your mobile number",
        number: "Please enter numbers only"
      }
    }, 

        submitHandler: function(form) { 
      // alert('submit login');
      form.submit();
        } 

    }); 
});