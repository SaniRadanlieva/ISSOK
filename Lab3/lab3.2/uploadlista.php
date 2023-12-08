<?php

$uploadDirectory = 'upload/';
$files = glob($uploadDirectory . '*.*');

echo '<h2>Uploaded:</h2>';
echo '<ul>';
foreach ($files as $file) {
    echo '<li>' . basename($file) . '</li>';
}
echo '</ul>';

?>