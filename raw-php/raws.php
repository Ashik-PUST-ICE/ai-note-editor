<?php
 // raw-php folder / raw.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['text'] ?? '';

    // Simple keyword extractor: count word frequency and return top 5
    $words = str_word_count(strtolower($text), 1);
    $freq = array_count_values($words);
    arsort($freq);
    $top = array_slice(array_keys($freq), 0, 5);

    header('Content-Type: application/json');
    echo json_encode(['keywords' => $top]);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Keyword Extractor</title></head>
<body>
<form method="POST" action="">
    <textarea name="text" rows="5" cols="40" placeholder="Paste your text here..."></textarea><br>
    <button type="submit">Extract Keywords</button>
</form>
</body>
</html>
