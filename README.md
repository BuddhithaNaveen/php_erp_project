# ERP System - Intern Assignment

## How to Setup (Local Environment)
1. Install a local server environment like XAMPP or WAMP.
2. Clone this repository into the `htdocs` (XAMPP) or `www` (WAMP) directory.
3. Open phpMyAdmin (`http://localhost/phpmyadmin`).
4. Create a new database or use the attached SQL file. (If using my provided schema, run `php_erp_system.sql`).
5. Open `db_connection.php` and ensure the `$host`, `$user`, `$pass`, and `$dbname` variables match your local MySQL configuration.
6. Navigate to `http://localhost/php_erp_project` in your browser to start using the system.

## Assumptions Made
*   **Database Attachment:** Since the specific SQL file attached to the assignment wasn't accessible at the time of writing, a relational database schema was designed to strictly accommodate the required fields for Tasks   1, 2, and 3.
*   **Categories:** The item category and subcategory data is assumed to be pre-populated in the database or managed via a separate administrative view, allowing them to be loaded dynamically into the select dropdowns.
*   **Invoice Generation:** The reports assume an invoice creation process exists in the backend that populates the `invoice` and `invoice` tables.
*   **Frameworks:** Bootstrap 5 (via CDN) was used for layout and frontend validation styling. Native HTML5 form validation acts as the first layer of security, supplemented by basic PHP validation on submission.