<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'DbConnectMaria.php';
require_once 'DbConnectClickHouse.php';

$maria = new DbConnectMaria();
$clickhouse = new DbConnectClickHouse();

$result = $maria->report();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Grid Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


</head>
<body>
<div class="container d-none">
    <h1>Grouped result</h1>
    <div class="container-md">
        <div class="card mb-2">
            <div class="row">
                <div class="col">
                    count
                </div>
                <div class="col">
                    grouped_minutes
                </div>
                <div class="col">
                    avg_length
                </div>
                <div class="col">
                    first_datetime
                </div>
                <div class="col">
                    last_datetime
                </div>
            </div>
        </div>
        <div class="card mb-4">
        <?php
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
<div class="container">
    <h1>Grouped result table</h1>
    <div class="container-md">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">count</th>
                <th scope="col">gropup by minutes</th>
                <th scope="col">average length</th>
                <th scope="col">first in group</th>
                <th scope="col">last in group</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($result as $item) {
                ?>
                <tr>
                    <th scope="row"><?php echo $item['count']; ?></th>
                    <td><?php echo $item['grouped_minutes']; ?></td>
                    <td><?php echo $item['avg_length']; ?></td>
                    <td><?php echo $item['first_datetime']; ?></td>
                    <td><?php echo $item['last_datetime']; ?></td>
                </tr>

                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</body>
</html>

