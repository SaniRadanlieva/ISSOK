<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Datoteka:</label>
    <input type="file" name="file" id="file" />
    <br/>
    <input type="submit" name="submit" value="Upload" />
</form>

<?php

$uploadDirectory = 'upload/';
$maxFileSize = 300 * 1024; // 300KB

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $fileName = $uploadDirectory . basename($file["name"]);
    $fileSize = $file["size"];
    if ($fileSize > $maxFileSize) {
        echo "Error - File is too large (300KB allowed)";
    } else {
        if (move_uploaded_file($file["tmp_name"], $fileName)) {
            echo "Sucessfully uploaded.";
            }
        else {
            echo "Error uploading the file.";
            }
        }
}
?>
</body>
</html>
