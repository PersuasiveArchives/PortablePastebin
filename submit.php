

<?php
/**
 * MIT License
 *
 * Copyright (c) 2025 Persuasive Archives
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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
