<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Resizer</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        text-align: center;
        width: 320px;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    input[type="file"] {
        display: block;
        margin: 20px auto;
    }

    button {
        background: #ff7700;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    button:hover {
        background: #e66a00;
    }

    .info {
        font-size: 14px;
        color: #666;
        margin-top: 15px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Resize Images</h2>
    <form action="/resize-images" method="POST" enctype="multipart/form-data">
        <!-- CSRF token for Laravel -->
        @csrf
        <input type="file" name="images[]" multiple accept="image/*">
        <button type="submit">OK</button>
    </form>
    <p class="info">Select one or multiple images to resize</p>
</div>

</body>
</html>
