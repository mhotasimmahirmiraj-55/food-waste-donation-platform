<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Food Picture</title>
</head>
<body>

    <h1>Upload Food Picture</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/donor/donations/upload-photo" method="POST" enctype="multipart/form-data">

        @csrf

        <input type="file" name="food_image">

        <br><br>

        <button type="submit">
            Done
        </button>

    </form>

</body>
</html>