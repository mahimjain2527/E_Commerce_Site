$(document).ready(function () {
   
    $("#regform").validate({
        rules: {
        
            name: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required : true
            },
            password_confirmation: {
                required: true
            }
            
        },
        messages: {
         
            name: {
                required: "Name is required",
                
            },
            email: {
               required: "Detail is required"  
            },
            password: {
                required : "Image is Required"
            },
            password_confirmation: {
                required: "Price  is required" 
            }
          
        },
    });
});
