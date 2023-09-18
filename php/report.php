<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'DbConnectMaria.php';
require_once 'DbConnectClickHouse.php';

$maria = new DbConnectMaria();
$clickhouse = new DbConnectClickHouse();

$result = $maria->report();
//echo "<pre>";
//var_dump($result);
//echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Grid Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

</head>
<body>
<div class="container">
    <h1>Grouped result</h1>
    <div class="container-md">
        <div class="card mb-4">
        <?php
        // Sample array of 10 items
        $items = range(1, 10);

        // Loop through the items and create a Bootstrap column for each item
        foreach ($result as $item) {
            ?>
            <div class="row">
                    <div class="col">
                        <?php echo $item['count']; ?>
                    </div>
                    <div class="col">
                        <?php echo $item['grouped_minutes']; ?>
                    </div>
                    <div class="col">
                        <?php echo $item['avg_length']; ?>
                    </div>
                    <div class="col">
                        <?php echo $item['first_datetime']; ?>
                    </div>
                    <div class="col">
                        <?php echo $item['last_datetime']; ?>
                    </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</body>
</html>

