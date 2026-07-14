<?php
include 'db_connection.php';

// Get
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM customers WHERE id = $id");

    if ($result->num_rows == 0) {
        die("Customer not found.");
    }

    $customer = $result->fetch_assoc();
} else {
    header("Location: ./customers.php");
    exit();
}

// Update 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];
    $district_id = $_POST['district_id'];

    $sql = "UPDATE customers SET
            title='$title',
            first_name='$first_name',
            last_name='$last_name',
            contact_number='$contact_number',
            district_id='$district_id'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: ./customers.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Update Failed.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4>Edit Customer</h4>
            </div>
            <div class="card-body">
                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <select name="title" class="form-select" required>

                            <option value="Mr" <?= ($customer['title'] == "Mr") ? "selected" : "" ?>>Mr</option>
                            <option value="Mrs" <?= ($customer['title'] == "Mrs") ? "selected" : "" ?>>Mrs</option>
                            <option value="Miss" <?= ($customer['title'] == "Miss") ? "selected" : "" ?>>Miss</option>
                            <option value="Dr" <?= ($customer['title'] == "Dr") ? "selected" : "" ?>>Dr</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text"
                            name="first_name"
                            class="form-control"
                            value="<?= $customer['first_name']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text"
                            name="last_name"
                            class="form-control"
                            value="<?= $customer['last_name']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text"
                            name="contact_number"
                            class="form-control"
                            value="<?= $customer['contact_number']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">District</label>

                        <select name="district_id" class="form-select" required>

                            <?php
                            $districts = $conn->query("SELECT * FROM district");

                            while ($district = $districts->fetch_assoc()) {
                                $selected = ($district['id'] == $customer['district_id']) ? "selected" : "";

                                echo "<option value='{$district['id']}' $selected>
                                    {$district['district_name']}
                                  </option>";
                            }
                            ?>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Update
                    </button>

                    <a href="./customers.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Cancel
                    </a>

                </form>

            </div>
        </div>

    </div>

</body>

</html>