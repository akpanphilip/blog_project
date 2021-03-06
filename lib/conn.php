<?php

include 'config.php';

try {
    // Enable SQL error reporting.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Establish the connection.
    $conn = new mysqli(
        DB_SERVER,
        DB_USER,
        DB_PASSWORD,
        DB_NAME
    );

    // Set character ser to UTF-8.
    // $conn->set_charset(CHARSET);
} catch (\mysqli_sql_exception  $e) { // Catch SQL errors.
?>
    <pre>
                <?php
                throw new \mysqli_sql_exception(
                    $e->getMessage(),
                    $e->getCode()
                ) // Throw error message. 
                ?>
            </pre>
<?php
}
