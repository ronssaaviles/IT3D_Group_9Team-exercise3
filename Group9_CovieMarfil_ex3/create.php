<?php
$confirmation_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Para masave yung input ng user
    $note_title = trim($_POST['note_title']);
    $note_content = $_POST['note_content'];

    // warning para sure na merong laman yung textboxes
    if (!empty($note_title)) {
        $note_title = preg_replace('/[^A-Za-z0-9_\-]/', '', $note_title); // Clean the title to be filename-friendly
        $file_path = __DIR__ . "/" . $note_title . ".txt"; // Save directly in the project folder

        // Para masave yung file sa project folder
        file_put_contents($file_path, $note_content);

        // Confirmation
        $confirmation_message = "Note '$note_title.txt' has been created successfully!";
    } else {
        $error_message = "Please enter a valid note name.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Note</title>
    <link rel="stylesheet" href="ex3.css">
</head>
<body>
    <div class="container">
        <h1>Create a New Note</h1>

        <!-- confirmation message -->
        <?php if (!empty($confirmation_message)) : ?>
            <p style="color: green; font-size: 18px;"><?php echo $confirmation_message; ?></p>
        <?php endif; ?>

        <!-- error message -->
        <?php if (!empty($error_message)) : ?>
            <p style="color: red; font-size: 18px;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="create.php" method="POST">
            <label for="note_title">Note Name:</label><br>
            <input type="text" id="note_title" name="note_title" required><br><br>

            <label for="note_content">Note Content:</label><br>
            <textarea id="note_content" name="note_content" rows="10" required></textarea><br><br>

            <input type="submit" value="Create Note">
        </form>

        <a href="index.php">Back to Homepage</a>
    </div>
</body>
</html>
