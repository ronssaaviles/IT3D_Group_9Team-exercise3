<?php
$files = glob("*.txt"); // pang kuha ng mga txt file na nasa folder
$content = '';
$fileToDelete = '';

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // pang check lang din uli kung may txt file
    if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
        $content = file_get_contents($file); // pang kuha ng laman ng file
        $fileToDelete = $file;
    } else {
        $content = "File does not exist or is not a valid text file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Notes</title>
    <link rel="stylesheet" href="ex3.css">
</head>
<body>
    <div class="container">
        <h1>Browse Notes</h1>

        <div class="note-list">
            
            <?php if (!empty($files)) : ?>
                <ul>
                    <?php foreach ($files as $file) : ?>
                        <li><a href="view.php?file=<?php echo urlencode($file); ?>"><?php echo htmlspecialchars($file); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No notes found.</p>
            <?php endif; ?>
        </div>

        <?php if (!empty($content)) : ?>
            <div class="note-content-container">
                <h2>Note Content</h2>
                <div class="note-content">
                    <?php echo htmlspecialchars($content); ?>
                </div>
            </div>

            <!-- Buttons -->
            <div class="action-buttons">
                <a href="index.php" class="btn">Back to Homepage</a>
                <a href="delete.php?file=<?php echo urlencode($fileToDelete); ?>" class="btn delete">Delete Note</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
