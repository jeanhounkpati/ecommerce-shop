<?php include("includes/header.php") ?>

<?php
include '../database.php';
global $PDO;
$order_id = $_GET['id'];
$req = $PDO->prepare("
    SELECT o.*, c.*
    FROM orders o
    JOIN carts c ON o.cart_id = c.id
    WHERE o.id = :order_id
");
$req->execute(['order_id' => $order_id]);
$order = $req->fetch(PDO::FETCH_OBJ);
$cart_id = $order->cart_id;

// Fetch cart data
$req = $PDO->prepare("SELECT cp.prod_id, p.name, p.file, cp.prod_qty, cp.subtotal, p.price FROM cartproducts cp JOIN products p ON cp.prod_id = p.id WHERE cp.cart_id = :cart_id");
$req->execute(['cart_id' => $cart_id]);
$cart_items = $req->fetchAll(PDO::FETCH_OBJ);
?>


<div class="content">
  <div class="row">
    <div class="col-md-6">
      <h2 class="mt-4 text-center">Delivery Details</h2>

        <table class="table table-striped">
          <tr>
            <td>Order ID:</td>
            <td><?= $order->id; ?></td>
          </tr>
          <tr>
            <td>Name:</td>
            <td><?= $order->name; ?></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td><?= $order->email; ?></td>
          </tr>
          <tr>
            <td>Phone:</td>
            <td><?= $order->phone; ?></td>
          </tr>
          <tr>
            <td>Shipping Address:</td>
            <td><?= $order->shipping_address; ?></td>
          </tr>
        </table>
    </div>
    <div class="col-md-6">
      <h2 class="mt-4 text-center">Cart Items</h2>
        <table class="table table-striped">
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
          <?php foreach ($cart_items as $item): ?>
            <tr>
            <td><img src="../uploads/<?= $item->file; ?>" style="width: 30px; height: 30px"  alt="my image"></td>
              <td><?= $item->name; ?></td>
              <td><?= $item->prod_qty; ?></td>
              <td><?= $item->price; ?></td>
              <td><?= $item->subtotal; ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
    </div>
</div>
<br>
<label class="fw-bold">payement mode</label>
<div class="border p-1 mb-3">
<td><?= $order->payement_mode; ?></td>
</div>
<label class="fw-bold">Status</label>
<div class="m-3">
  <form method="POST" action="">
    <select>
      <option value="0" <?= $order->status==0?"selected":""; ?> >under process</option>
      <option value="1" <?= $order->status==1?"selected":""; ?>>completed</option>
      <option value="2" <?= $order->status==2?"selected":""; ?>>cancelled</option>
    </select>
    <button type="submit" name="update_order" class="btn btn primary mt-2">update status</button>

  </form>
</div>
<?php
if(isset($_POST['update_order'])){
  global $PDO;
  $q=$PDO->prepare("UPDATE orders SET status ='$order->status' WHERE id = '$order->id'");
                 $q->execute([
                     'staus'=>$status,
                     'id'=>$order->id,
                 ]);

}
?> 
</div>

<?php include("includes/footer.php") ?>

