$(document).ready(function () {
   
    $("#form1").validate({
        rules: {
        
            name: {
                required: true
            },
            detail: {
                required: true
            },
            // image: {
            //     required : true
            // },
            price: {
                required: true
            }
            
        },
        messages: {
         
            name: {
                required: "Name is required",
                
            },
            detail: {
               required: "Detail is required"  
            },
            // image: {
            //     required : "Image is Required"
            // },
            price: {
                required: "Price  is required" 
            }
          
        },
    });
});
