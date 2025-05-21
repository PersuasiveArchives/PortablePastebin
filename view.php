<?php
$id = isset($_GET['id']) ? basename($_GET['id']) : null;
$pasteFile = __DIR__ . "/pastes/$id/paste.html";

if ($id && file_exists($pasteFile)) {
    readfile($pasteFile);
} else {
    echo "Paste not found.";
}

?>
