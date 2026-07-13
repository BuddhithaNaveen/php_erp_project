<?php

/** 
 * @author Buddhitha 
 */
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['item_code'];
    $name = $_POST['item_name'];
    $cat = $_POST['category_id'];
    $subcat = $_POST['subcategory_id'];
    $qty = $_POST['quantity'];
    $price = $_POST['unit_price'];

    if (!empty($code) && !empty($name)) {
        $stmt = $conn->prepare("INSERT INTO items (item_code, item_name, category_id, subcategory_id, quantity, unit_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiid", $code, $name, $cat, $subcat, $qty, $price);
        $stmt->execute();
        header("Location: items.php?success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Item Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-4">
        <h2>Item Registration</h2>
        <form action="items.php" method="POST" class="needs-validation" novalidate>
            <!-- Form fields similar to customers.php layout... -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Item Code</label><input type="text" name="item_code" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Item Name</label><input type="text" name="item_name" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php
                        $cats = $conn->query("SELECT * FROM item_category");
                        while ($c = $cats->fetch_assoc()) echo "<option value='{$c['id']}'>{$c['category_name']}</option>";
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Sub Category</label>
                    <select name="subcategory_id" class="form-select" required>
                        <option value="">Select Subcategory</option>
                        <?php
                        $subcats = $conn->query("SELECT * FROM item_subcategory");
                        while ($sc = $subcats->fetch_assoc()) echo "<option value='{$sc['id']}'>{$sc['subcategory_name']}</option>";
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Quantity</label><input type="number" name="quantity" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Unit Price</label><input type="number" step="0.01" name="unit_price" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Item</button>
        </form>

        <h2 class="mt-5">Item List</h2>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Category ID</th>
                <th>Subcategory ID</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
            <?php
            $res = $conn->query("SELECT * FROM items");
            while ($r = $res->fetch_assoc()) {
                echo "<tr><td>{$r['item_code']}</td><td>{$r['item_name']}</td><td>{$r['category_id']}</td><td>{$r['subcategory_id']}</td><td>{$r['quantity']}</td><td>{$r['unit_price']}</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>