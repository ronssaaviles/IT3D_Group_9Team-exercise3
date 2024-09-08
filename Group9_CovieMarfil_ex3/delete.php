<?php
$file = '';
$confirmationMessage = '';

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Pang check ng txt file
    if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
        if (isset($_POST['confirm'])) {
            // pang delete
            if (unlink($file)) {
                $confirmationMessage = "The file has been deleted.";
                $file = ''; // Clear file 
            } else {
                $confirmationMessage = "Error deleting the file.";
            }
        }
    } else {
        $confirmationMessage = "File does not exist or is not a valid text file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Note</title>
    <link rel="stylesheet" href="ex3.css">
</head>
<body>
    <div class="container">
        <h1>Delete Note</h1>

        <?php if ($file) : ?>
            <p>Are you sure you want to delete <strong><?php echo htmlspecialchars($file); ?></strong>?</p>
            <form method="post">
                <input type="submit" name="confirm" value="Yes, Delete" class="btn delete">
                <a href="view.php?file=<?php echo urlencode($file); ?>" class="btn">Cancel</a>
            </form>
        <?php else : ?>
            <p><?php echo htmlspecialchars($confirmationMessage); ?></p>
            <a href="index.php" class="btn">Back to Homepage</a>
        <?php endif; ?>
    </div>
</body>
</html>
