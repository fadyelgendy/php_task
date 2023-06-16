<?php
const BYTE_SIZE = 8;

include dirname(__FILE__) . "/validator.php";
include dirname(__FILE__) . "/uploader.php";
include dirname(__FILE__) . "/Database.php";

// Handle Form Submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check for token
    if (!isset($_POST['_token']) || $_POST['_token'] != $_SESSION['_token']) {
        http_response_code(409);
        abort('error', 'CSRF token MISSING');
    }

    // check and validate data
    validateString('First Name', $_POST['first_name']);
    validateString('Last Name', $_POST['last_name']);
    validateFile($_FILES['image'], 2048, 'image', ['png', 'jpeg', 'jpg']);

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // upload image
    $image = uploadFile($_FILES['image'], 'users');


    // save data
    try {
        $db = new Database('mysql:dbname=task;host:127.0.0.1', 'root', '');

        $saved = $db->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'image' => $image
        ]);

        if ($saved) {
            http_response_code(200);
            $_SESSION['success'] = 'Saved Successfully';
            header('Location: /');
        }
    } catch (Exception $exception) {
        abort('error', $exception->getMessage(), 500);
    }

} else {
    session_destroy();
}
