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
<div class="container">
    <h1>Test app kma.biz</h1>
    <div class="container-md">
        <div class="card mb-2">
            <div class="row">
                <div class="col">
                    <a href="init.php" target="_blank">1) Inti system create (recreate database)</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="send.php" target="_blank">2) Send to queue (RabitMQ) </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="queue.php" target="_blank">3) Await messages from queue (RabitMQ) actualy you need to run it from console</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="report.php" target="_blank">4) Open report </a>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="container">

<!-- Include Bootstrap JS and jQuery (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</body>
</html>