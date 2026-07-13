<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP ERP System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            display: flex;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
        }

        .sidebar {
            width: 250px;
            background-color: #1a2226;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            background-color: #151a1e;
            border-bottom: 1px solid #2c3b41;
        }

        .menu-category {
            padding: 15px 20px 5px;
            font-size: 0.75rem;
            color: #4b646f;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }

        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            color: #b8c7ce;
            display: block;
            transition: 0.2s ease-in-out;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #1e282c;
            color: #fff;
            border-left: 4px solid #00a65a;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            height: 60px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .content-area {
            padding: 30px;
            flex: 1;
        }
    </style>

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            SIMPLE ERP
        </div>

        <div class="menu-category">Management</div>
        <a href="index.php">Home</a>
        <a href="customers.php" class="active">Customers</a>
        <a href="items.php">Items</a>

        <div class="menu-category">Reports</div>
        <a href="report_invoice.php">Invoice Report</a>
        <a href="report_invoice_items.php">Invoice Items</a>
        <a href="report_items.php">Item Report</a>
    </div>

</body>

</html>