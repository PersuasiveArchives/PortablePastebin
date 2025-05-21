<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Portable Pastebin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <a class="back" href="list.php"> View All Pastes</a>
        <h1>New Paste</h1>
        <form method="POST" action="submit.php">
            <textarea name="content" rows="15" placeholder="Enter your text here..."></textarea>
            <button type="submit">Submit Paste</button>
        </form>
    </div>
    <footer>
        <p>&copy; Powered by Portable Pastebin. All rights reserved.</p>
        <p><a href="https://github.com/PersuasiveArchives/PortablePastebin">View on GitHub</a></p>
    </footer>
</body>
</html>
