<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method='post' action='' enctype='multipart/form-data'>
        <input type="file" name="file[]" id="file" multiple>
        <input type='submit' name='submit' value='Upload'>
    </form>

</body>

</html>


<?php
if (isset($_POST['submit'])) {
    // Count total files
    $countfiles = count($_FILES['file']['name']);

    // Looping all files
    for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['file']['name'][$i];

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'][$i], 'upload/' . $filename);
    }
}
?>