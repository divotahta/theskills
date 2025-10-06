<?php
// C:\laragon\www\theskills\public\test-upload.php
if ($_POST['upload'] ?? false) {
    $file = $_FILES['file'];
    $target = __DIR__ . '/test-upload/' . basename($file['name']);
    
    if (!is_dir(__DIR__ . '/test-upload')) {
        mkdir(__DIR__ . '/test-upload', 0777, true);
    }

    if (move_uploaded_file($file['tmp_name'], $target)) {
        echo "Upload berhasil!";
    } else {
        echo "Gagal upload.";
        print_r(error_get_last());
    }
} else {
    echo '<form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button name="upload" value="1">Upload</button>
    </form>';
}