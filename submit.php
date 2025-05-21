<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['content']))) {
    $content = trim($_POST['content']);
    $id = bin2hex(random_bytes(4));  // unique ID
    $pasteDir = __DIR__ . "/pastes/$id";

    if (!is_dir(__DIR__ . '/pastes')) {
        mkdir(__DIR__ . '/pastes', 0755, true);
    }

    mkdir($pasteDir);


    file_put_contents("$pasteDir/paste.txt", $content);


    $escaped = htmlspecialchars($content);
    $html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paste $id</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Paste: $id</h1>
        <pre class="paste">$escaped</pre>
        <a class="back" href="../../index.php">&larr; New Paste</a>
    </div>
</body>
</html>
HTML;

    file_put_contents("$pasteDir/paste.html", $html);


    header("Location: view.php?id=$id");
    exit;
} else {
    echo "Invalid or empty paste.";
}
