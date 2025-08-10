<?php
session_start();


$productFile = "products.txt";


$products = [];
if (file_exists($productFile)) {
    $lines = file($productFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($id, $name, $category, $description, $price, $image_url) = explode("   ", $line);
        $products[] = [
            "id" => $id,
            "name" => $name,
            "category" => $category,
            "description" => $description,
            "price" => (float)$price,
            "image_url" => $image_url
        ];
    }
}


$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

$filteredProducts = array_filter($products, function($product) use ($search, $category) {
    $matchesSearch = $search === '' || stripos($product['name'], $search) !== false;
    $matchesCategory = $category === '' || $product['category'] === $category;
    return $matchesSearch && $matchesCategory;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <form class="d-flex" method="get" action="products.php">
            <input class="form-control me-2" type="search" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="mb-4">Browse Our Products</h1>

    <div class="mb-3">
        <form method="get" class="d-flex">
            <select name="category" class="form-select me-2" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <option value="Electronics" <?php if ($category === 'Electronics') echo 'selected'; ?>>Electronics</option>
                <option value="Clothing" <?php if ($category === 'Clothing') echo 'selected'; ?>>Clothing</option>
                <option value="Home" <?php if ($category === 'Home') echo 'selected'; ?>>Home</option>
                <option value="Books" <?php if ($category === 'Books') echo 'selected'; ?>>Books</option>
            </select>
            <?php if ($search) { echo '<input type="hidden" name="search" value="' . htmlspecialchars($search) . '">'; } ?>
        </form>
    </div>

    <div class="row">
        <?php if (empty($filteredProducts)): ?>
            <p>No products found.</p>
        <?php else: ?>
            <?php foreach ($filteredProducts as $row): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="fw-bold">$<?php echo number_format($row['price'], 2); ?></p>
                            <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; <?php echo date("Y"); ?> ShopSmart. All rights reserved.
</footer>

</body>
</html>