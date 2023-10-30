<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
$uploadDirectory = '/var/www/upload/';
$uploadFilePath = $uploadDirectory . $_FILES['file']['name'];

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
echo 'File successfully uploaded.';
} else {
echo 'Error uploading file.';
}
} else {
echo 'No file uploaded or an error occurred.';
}
} else {
echo 'Invalid request.';
}
?>
