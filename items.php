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

        $check_stmt = $conn->prepare("SELECT id FROM items WHERE item_code = ?");
        $check_stmt->bind_param("s", $code);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows > 0) {
            // The code exists! Redirect with an error flag
            $check_stmt->close();
            header("Location: items.php?error=duplicate");
            exit();
        }
        $check_stmt->close();

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header text-dark">
                <h4>Item Registration</h4>
            </div>
            <div class="px-3 pt-3">
                <?php if (isset($_GET['success'])): ?>
                    <div class='alert alert-success'>Item saved successfully!</div>
                <?php endif; ?>

                <?php if (isset($_GET['error']) && $_GET['error'] == 'duplicate'): ?>
                    <div class='alert alert-danger'>
                        <strong>Error:</strong> Item Code already exists. Please use a unique code.<br>
                        Use browser Back Arrow For restore typed informations
                    </div>
                <?php endif; ?>
            </div>
            <!--Item  Form  -->

            <div class="card-body">
                <form action="items.php" method="POST" class="needs-validation" novalidate>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Item Code</label>
                            <input type="text" name="item_code" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Item Name</label>
                            <input type="text" name="item_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                <?php
                                $cats = $conn->query("
                                    SELECT * 
                                    FROM item_category
                                ");
                                while ($c = $cats->fetch_assoc()) echo "
                                    <option value='{$c['id']}'>
                                        {$c['category_name']}
                                    </option>";
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Sub Category</label>
                            <select name="subcategory_id" class="form-select" required>
                                <option value="">Select Sub Category</option>
                                <?php
                                $subcats = $conn->query("
                            SELECT * 
                            FROM item_sub_category
                        ");
                                while ($sc = $subcats->fetch_assoc()) echo "
                            <option value='{$sc['id']}'>
                                {$sc['sub_category_name']}
                            </option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check"> </i>Save Item</button>

                        <a href="./items.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Clear Details
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Item List</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("
            SELECT i.*,
                ic.category_name AS category_name,
                isc.sub_category_name AS sub_category_name
            FROM items i
                JOIN item_category ic ON ic.id=i.category_id
                LEFT JOIN item_sub_category isc ON isc.id=i.subcategory_id
            ");
                while ($row = $res->fetch_assoc()) {
                    echo '<tr>' .
                        '<td>' . $row['item_code'] . '</td>' .
                        '<td>' . $row['item_name'] . '</td>' .
                        '<td>' . $row['category_name'] . '</td>' .
                        '<td>' . $row['sub_category_name'] . '</td>' .
                        '<td>' . $row['quantity'] . '</td>' .
                        '<td>' . $row['unit_price'] . '</td>' .
                        '<td >' .
                        '<a href="edit_item.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm me-2">' .
                        '<i class="bi bi-pencil-square"></i>' .
                        '</a>' .
                        '<a href="delete_item.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this customer?\');">' .
                        '<i class="bi bi-trash"></i>' .
                        '</a>' .
                        '</td>' .
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>