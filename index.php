<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP ERP System</title>
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

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
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
        <a href="customers.php">Customers</a>
        <a href="items.php">Items</a>

        <div class="menu-category">Reports</div>
        <a href="report_invoice.php">Invoice Report</a>
        <a href="report_invoice_items.php">Invoice Items</a>
        <a href="report_items.php">Item Report</a>
    </div>

</body>

</html>