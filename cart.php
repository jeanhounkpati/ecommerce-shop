<?php include("includes/header.php") ?>

<?php


if(isset($_SESSION['auth']) && isset($_SESSION['cart_id']))
{
    include 'database.php';

    global $PDO;
    $cart_id = $_SESSION['cart_id'];
    $req = $PDO->prepare("SELECT cp.prod_id, p.name, p.file, cp.prod_qty, cp.subtotal, p.price FROM cartproducts cp JOIN products p ON cp.prod_id = p.id WHERE cp.cart_id = :cart_id");
    $req->execute(['cart_id' => $cart_id]);
    $cart_products = $req->fetchAll(PDO::FETCH_OBJ);
    $count = count($cart_products);
    $_SESSION['cart_count'] = $count;
    $req = $PDO->prepare("SELECT total FROM carts WHERE id = :cart_id");
    $req->execute(['cart_id' => $cart_id]);
    $total = $req->fetch(PDO::FETCH_OBJ)->total;
    ?>

<h2 class="text-center">Your Cart</h2>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th>Name</th>
                    <th class="text-center">Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($cart_products as $product) : ?>
                    <tr>
                    <td><img src="uploads/<?= $product->file; ?>"  style="width: 30px; height: 30px"  alt="my image"></td>
                    <td><?= $product->name ?></td>
                    <td>
                    
                    <div class="input-group justify-content-center input product_data">
                        <input type="hidden" class="prodId" value="<?=$product->prod_id; ?>">
                        <div class="input-group-prepend col-3 col-md-2 col-lg-1">
                            <button class="btn btn-primary minus-btn updateQty" type="button">-</button>
                        </div>
                        <input type="text" class="form-control text-center quantity-input col-6 col-md-8 col-lg-10" value="<?= $product->prod_qty ?>">
                        <div class="input-group-prepend col-3 col-md-2 col-lg-1">
                            <button class="btn btn-primary plus-btn updateQty" type="button">+</button>
                        </div>
                    </div>

                   

            <!-- <div class="input-group justify-content-center">
                <input type="hidden" class="prodId">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                </div>
                <input type="text" class="form-control text-center quantity-input" value="1">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                </div>
            </div>  -->


                    </td>    
                    <td><?= $product->price ?></td>
                    <td><?= $product->subtotal ?></td>
                    <td>
                        <button class="btn btn-danger deleteItem" value="<?= $product->prod_id ?>">Delete</button>
                    </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table> 
            <?php
            if($cart_count>0){
            ?>
                <button class="btn btn-danger deleteCart">DeleteCart</button>
            <?php
            }
            ?>

            <div class="btn btn-success btn-block mt-4">
                        Total: $<?= $total ?>
            </div>           
        </div>

        
    </div>
   
    <a href="checkout.php" class="btn btn-primary btn-block mt-4">Checkout</a>
</div>


<?php
}
else
{
    echo "You need to login and add products to your cart first.";
}
?>



<!-- <script>
    $(document).ready(function() {
    // handle minus button click
    $('.minus-btn').on('click', function(e) {
      e.preventDefault();
      var quantityInput = $(this).parent().siblings('.quantity-input');
      var currentVal = parseInt(quantityInput.val());
      if (currentVal > 1) {
        quantityInput.val(currentVal - 1);
      }
    });
  
    // handle plus button click
    $('.plus-btn').on('click', function(e) {
      e.preventDefault();
      var quantityInput = $(this).parent().siblings('.quantity-input');
      var currentVal = parseInt(quantityInput.val());
      quantityInput.val(currentVal + 1);
    });
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

</script> -->
<?php include("includes/footer.php") ?>

