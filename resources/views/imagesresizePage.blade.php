<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resize Online Images</title>
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
        width: 400px;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    textarea {
        width: 100%;
        height: 150px;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        resize: none;
        font-size: 14px;
    }

    button {
        margin-top: 15px;
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
    <h2>Resize Online Images</h2>
    <form action="{{route('imagesresiz.post')}}" method="POST">
        
        @csrf
        <textarea name="image_urls" placeholder="Paste image URLs here, one per line"></textarea>
        <button type="submit">OK</button>
    </form>
    <p class="info">Paste all image links here. One link per line.</p>
</div>

</body>
</html>
