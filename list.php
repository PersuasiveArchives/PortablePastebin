<?php
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
        <p>&copy; Powered by Portable Pastebin. All rights reserved.</p>
        <p><a href="https://github.com/PersuasiveArchives/PortablePastebin">View on GitHub</a></p>
    </footer>
</div>
</body>
</html>
