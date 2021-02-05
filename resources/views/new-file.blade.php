<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/mdb.min.css">
</head>
<body>
    
    <form action="{{ route( 'upload' ) }}" method="post" enctype="multipart/form-data" >
        @csrf 
        <input type="text" name="upload-name" id="upload-name">
        <label for="">@error( 'upload-name' ) is-invalid  @enderror  </label>
        <input type="file" name="upload-content" id="upload-content">
        <label for="">@error( 'upload-content' ) file-bad @enderror </label>
        <button class="btn btn-primary" type="submit">Subir</button>
    </form>
    <script src="assets/js/mdb.min.js"></script>
</body>
</html>