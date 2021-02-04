<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route( 'upload' ); }}" method="post" enctype="multipart/form-data" >
        <input type="text" name="upload-name" id="upload-name">
        <input type="file" name="upload-content" id="upload-content">
        <button type="submit">Subir</button>
    </form>
</body>
</html>