
<div class='content'>
	<h2>Products</h2>

  <?php
include 'database.php';

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    if ($category_id == 'all') {
        // query all products
        $req = $PDO->query('SELECT * FROM products');
    } else {
        // query products in a specific category
        $req = $PDO->prepare('SELECT * FROM products WHERE category_id = :category_id');
        $req->execute(['category_id' => $category_id]);
    }
    $products = $req->fetchAll(PDO::FETCH_OBJ);
    $output = '';
    if ($products) {
        foreach ($products as $product) {
            // generate HTML for each product
            $output .= '<div class="col-md-4">';
            $output .= '<div class="card mb-4 box-shadow">';
            $output .= '<img class="card-img-top" src="uploads/' . $product->file . '" alt="' . $product->name . '">';
            $output .= '<div class="card-body">';
            $output .= '<h5 class="card-title">' . $product->name . '</h5>';
            $output .= '<p class="card-text">' . $product->description . '</p>';
            $output .= '</div></div></div>';
        }
    } else {
        $output = 'No products found';
    }
} else {
    $output = 'Category ID not set';
}
echo '<div class="row">' . $output . '</div>';

?>
