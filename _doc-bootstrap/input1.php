<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Input Field for Array Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <h1>Bootstrap Input Field for Array Example</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="items" class="form-label">Enter Items (comma-separated):</label>
            <input type="text" class="form-control" id="items" name="items[]" placeholder="Enter items..." required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the array of items from the form
            $items = isset($_POST['items']) ? $_POST['items'] : array();

            // Display the submitted items
            if (!empty($items)) {
                echo '<h2>Submitted Items:</h2>';
    echo '<ul>';
    foreach ($items as $item) {
    echo '<li>' . htmlspecialchars($item) . '</li>';
    }
    echo '</ul>';
    }
    }
    ?>
</div>

<!-- Include Bootstrap JS and jQuery (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-aZX5gf3y5s2c5z5uP3eFnj0r5l3E5+5uqqF7sxyybI+nzrBp93U2t2oDd6hCk/jl6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+tsf6nSvT/4pOGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</body>
</html>
