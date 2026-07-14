<?php

/** 
 * @author Buddhitha 
 */
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $contact = $_POST['contact'];
    $district_id = $_POST['district_id'];

    // Basic Backend Validation
    if (!empty($fname) && !empty($lname) && !empty($contact) && !empty($district_id)) {
        $stmt = $conn->prepare("INSERT INTO customers (title, first_name, last_name, contact_number, district_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $title, $fname, $lname, $contact, $district_id);
        $stmt->execute();
        $stmt->close();
        header("Location: customers.php?success=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header text-dark">
                <h4>Customer Registration</h4>
            </div>
            <?php if (isset($_GET['success'])) echo "<div class='alert alert-success'>Customer saved successfully!</div>"; ?>

            <!--Customer POST Form  -->
            <div class="card-body">
                <form action="customers.php" method="POST" class="needs-validation" novalidate>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label class="form-label">Title</label>
                            <select name="title" class="form-select" required>
                                <option value="">Select...</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Miss">Miss</option>
                                <option value="Dr">Dr</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact" class="form-control" required pattern="[0-9]{10}">
                            <div class="invalid-feedback">Please enter a valid 10-digit number.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">District</label>
                            <select name="district_id" class="form-select" required>
                                <option value="">Select...</option>
                                <?php
                                $districts = $conn->query("SELECT * FROM district");

                                while ($district = $districts->fetch_assoc())
                                    echo "<option value='{$district['id']}'>
                                {$district['district_name']}
                            </option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check"> </i>Save Customer</button>

                        <a href="./customers.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Clear Details
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="mt-5">Customer List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>District</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("
                SELECT c.*,
                d.district_name AS district_name
                FROM customers c
                JOIN district d ON d.id=c.district_id
                ");
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>' .
                        '<td>' . $row['id'] . '</td>' .
                        '<td>' . $row['title'] . '</td>' .
                        '<td>' . $row['first_name'] . '</td>' .
                        '<td>' . $row['last_name'] . '</td>' .
                        '<td>' . $row['contact_number'] . '</td>' .
                        '<td>' . $row['district_name'] . '</td>' .
                        '<td >' .
                        '<a href="edit_customer.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm me-2">' .
                        '<i class="bi bi-pencil-square"></i>' .
                        '</a>' .
                        '<a href="delete_customer.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this customer?\');">' .
                        '<i class="bi bi-trash"></i>' .
                        '</a>' .
                        '</td>' .
                        '</tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- Validation -->
        <script>
            (function() {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation')
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>
    </div>
</body>

</html>