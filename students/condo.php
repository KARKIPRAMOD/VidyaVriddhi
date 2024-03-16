<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Divs</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      .container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Adjust as needed */
}

.left-column {
    width: 45%; /* Adjust width as needed */
    background-color: #f0f0f0;
    padding: 20px;
    box-sizing: border-box;
}

.right-column {
    width: 45%; /* Adjust width as needed */
    background-color: #e0e0e0;
    padding: 20px;
    box-sizing: border-box;
}

</style>
</head>
<body>
    <div class="container">
        <div class="left-column">
            <!-- Content for left column goes here -->
        </div>
        <div class="right-column">
            <!-- Content for right column goes here -->
        </div>
    </div>
</body>
</html>
