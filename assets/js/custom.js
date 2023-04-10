function toggleTheme() {
    const body = document.body;
    const themeIcon = document.getElementById("theme-icon");
    if (body.classList.contains("dark")) {
      body.classList.remove("dark");
      body.classList.add("light");
      themeIcon.classList.remove("fa-sun");
      themeIcon.classList.add("fa-moon");
    } else {
      body.classList.remove("light");
      body.classList.add("dark");
      themeIcon.classList.remove("fa-moon");
      themeIcon.classList.add("fa-sun");
    }
  }


$(document).ready(function() {

  $('.add-to-cart').click(function(e){
    e.preventDefault();
    var qty = $(this).closest('.product_data').find(".quantity-input").val();
    var prod_id = $(this).val();
    $.ajax({
        method:"POST",
        url:"./cartController.php",
        data:{
            "prod_id":prod_id,
            "prod_qty":qty,
            "scope":"add"
        },
        success:function(response){
            if(response==201)
            {
                alertify.success("Product added to cart");
            }
            else if(response == 401)
            {
                alertify.success("Login to continue");
            }
            else if(response == 500)
            {
                alertify.success("Something went wrong");
            }
        }
    });
});


// handle minus button click
$('.minus-btn').on('click', function(e) {
    e.preventDefault();
    var quantityInput = $(this).parent().siblings('.quantity-input');
    var currentVal = parseInt(quantityInput.val());
    if (currentVal > 1) {
      quantityInput.val(currentVal - 1);
    }
  });

//   // handle plus button click
  $('.plus-btn').on('click', function(e) {
    e.preventDefault();
    var quantityInput = $(this).parent().siblings('.quantity-input');
    var currentVal = parseInt(quantityInput.val());
    quantityInput.val(currentVal + 1);
  });
    

    

    $(document).on('click','.updateQty',function(){
        var qty = $(this).closest('.product_data').find('.quantity-input').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();
    
        $.ajax({
            method:"POST",
            url:"cartController.php",
            data:{
                "prod_id":prod_id,
                "prod_qty":qty,
                "scope":"update"
            },
            success:function(response){   
                // if(response == 200) 
                // {
                //     alertify.success("Item update succesfully");
    
                // }else{
                //     alertify.success("Something went wrong");
                // }
            }
        });
    });
    
    $(document).on('click','.deleteItem',function(){
        var prod_id = $(this).val();  
    
        $.ajax({
            method:"POST",
            url:"cartController.php",
            data:{
                "prod_id":prod_id,
                "scope":"delete"
            },
            success:function(response){   
                if(response == 200) 
                {
                    alertify.success("Item deleted succesfully");
    
                }else{
                    alertify.success("Something went wrong");
                }
    
            }
        });
    });
    
    $(document).on('click','.deleteCart',function(){
        $.ajax({
            method:"POST",
            url:"cartController.php",
            data:{
                "scope":"deleteCart"
            },
            success:function(response){   
                if(response == 200) 
                {
                    alertify.success("Cart deleted succesfully");
                    header('location:index1.php');
    
    
                }else{
                    alertify.success("Something went wrong");
                }
    
            }
        });
    });
    // Handle form submission
	$(".btn-group").on('click', 'button', function(event) {
		event.preventDefault();
		var category_id = $(this).data('category');
		if (category_id == 'all') {
			category_id = 'all'; // set category_id to 'all' for all products
		}
		$.ajax({
			url: "get_products.php",
			type: "POST",
			data: 'category_id=' + category_id,
			beforeSend: function() {
				$("#product-list").html("<div class='text-center'><i class='fa fa-spinner fa-spin fa-3x'></i></div>");
			},
			success: function(data) {
				$("#product-list").html(data);
			}
		});
		$(".btn-group button").removeClass("active");
		$(this).addClass("active");
	});
});


    

