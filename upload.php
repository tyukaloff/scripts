    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadDirectory = '/var/www/upload/';
    $uploadFilePath = $uploadDirectory . $_FILES['file']['name'];

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
    // Зеркалирование файла на сервер 3
    $server3Url = 'http://192.168.2.203/upload'; // URL сервера 3
    $c = curl_init($server3Url);
    $data = array('file' => new CURLFile($uploadFilePath));
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($c);
    if ($response !== false) {
    // Зеркалирование файла на сервер 4
    $server4Url = 'http://192.168.2.204/upload'; // URL сервера 4
    $c2 = curl_init($server4Url);
    $data2 = array('file' => new CURLFile($uploadFilePath));
    curl_setopt($c2, CURLOPT_POST, true);
    curl_setopt($c2, CURLOPT_POSTFIELDS, $data2);
    $response2 = curl_exec($c2);
    if ($response2 !== false) {
    echo 'File successfully uploaded and mirrored on Server 3 and Server 4.';
    } else {
    echo 'Error mirroring file on Server 4.';
    }
    curl_close($c2);
    } else {
    echo 'Error mirroring file on Server 3.';
    }
    curl_close($c);
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


