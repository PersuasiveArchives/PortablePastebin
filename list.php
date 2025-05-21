

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
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$pastePath = __DIR__ . '/pastes/';
$pastes = [];

if (is_dir($pastePath)) {
    foreach (scandir($pastePath) as $entry) {
        if ($entry === '.' || $entry === '..') continue;

        $textFile = "$pastePath$entry/paste.txt";
        if (file_exists($textFile)) {
            $content = file_get_contents($textFile);
            if ($search === '' || stripos($content, $search) !== false) {
                $pastes[] = [
                    'id' => $entry,
                    'preview' => substr($content, 0, 100)
                ];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Pastes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>All Pastes</h1>
    <form method="GET" action="list.php">
        <input type="text" name="q" placeholder="Search by text..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a class="back" href="index.php">+ New Paste</a>
    </form>
    <ul class="paste-list">
        <?php if (empty($pastes)): ?>
            <li>No pastes found.</li>
        <?php else: ?>
            <?php foreach ($pastes as $paste): ?>
                <li>
                    <a href="view.php?id=<?= htmlspecialchars($paste['id']) ?>">
                        <?= htmlspecialchars($paste['id']) ?>
                    </a>
                    <div class="preview"><?= nl2br(htmlspecialchars($paste['preview'])) ?></div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
        <footer>
        <p>&copy; Powered by Portable Pastebin.</p>
        <p><a href="https://github.com/PersuasiveArchives/PortablePastebin">View on GitHub</a></p>
    </footer>
</div>
</body>
</html>
