
<?php include("includes/header.php") ?>

<?php
include 'database.php';
if(isset($_GET['id'])){    
    global $PDO;
    $req=$PDO->prepare("SELECT *  FROM products WHERE id=:id");
    $req->execute(['id'=>$_GET['id']]);
    $product=$req->fetchAll(PDO::FETCH_OBJ);    
}
?>
<div class="container product_data">
    <div class="row ">
        <div class='col-sm '>						
            <img src="uploads/<?= $product[0]->file; ?>" class="img-responsive" style="width: 250px; height: 250px" alt="good">
        </div>
        <div class="col-sm">
            <p><?= $product[0]->name; ?></p>
            <button class="btn-primary add-to-cart " value="<?= $product[0]->id; ?>" >Add to Cart</button>

            <p>Price:<?= $product[0]->price; ?>$</p>
            <div class="input-group justify-content-center">
                <input type="hidden" class="prodId" value="<?=$product[0]->id; ?>">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary minus-btn" type="button">-</button>
                </div>
                <input type="text" class="form-control text-center quantity-input" value="1">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary plus-btn" type="button">+</button>
                </div>
            </div>
            <p><?= substr($product[0]->description,0,10);?></p>	

        </div>        
    </div>    
</div>

<!-- <script>
$(document).ready(function() {

    $('.add-to-cart').click(function(e){
        e.preventDefault();
        var qty = $(this).closest('.product_data').find(".quantity-input").val();
        var prod_id = $(this).val();
        $.ajax({
            method:"POST",
            url:"cartController.php",
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
});
</script>  -->


    <!-- $(document).ready(function() {
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
    }); -->

   
<?php include("includes/footer.php") ?>     

