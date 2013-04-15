jQuery(function($) { 
  
  $("#help-form").validate({
    rules: {
      email: {
        required: true,
        email: true
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
      }
    },
        messages: { 
            email: { 
                required: "Please enter an email address", 
        email: "Please enter a valid email address"
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
        }
        }, 

        submitHandler: function(form) { 
      // alert('submit help');
      form.submit();
        } 
  });
});
