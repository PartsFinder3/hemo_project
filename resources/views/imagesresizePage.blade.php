<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Resize Online Images</title>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 20px;
    }

    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    textarea {
        width: 100%;
        height: 200px;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        resize: vertical;
        font-size: 14px;
        margin-bottom: 10px;
        box-sizing: border-box;
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
        width: 100%;
    }

    button:hover {
        background: #e66a00;
    }

    .info {
        font-size: 14px;
        color: #666;
        margin-top: 15px;
        text-align: left;
    }
    
    .loading {
        display: none;
        margin-top: 10px;
        color: #ff7700;
    }
</style>
</head>
<body>
    @if(session('success'))
    <script>
        swal("Success!", "{{ session('success')|raw }}", "success");
    </script>
    @endif

    @if(session('error'))
    <script>
        swal("Error!", "{{ session('error') }}", "error");
    </script>
    @endif

<div class="container">
    <h2>Resize Online Images</h2>
    <form action="{{route('imagesresiz.post')}}" method="POST" id="resizeForm">
        @csrf
        <textarea name="image_urls" placeholder="Paste image URLs here, one per line.
Example:
https://example.com/image1.jpg
https://example.com/image2.png
https://example.com/image3.webp"></textarea>
        <div class="loading" id="loading">Processing images, please wait...</div>
        <button type="submit" id="submitBtn">Resize Images</button>
    </form>
    <p class="info">
        <strong>Instructions:</strong><br>
        1. Paste all image links here (one link per line)<br>
        2. Maximum 10 images at a time<br>
        3. Supported formats: JPG, PNG, GIF, WEBP<br>
        4. Images will be resized to max 800x800px
    </p>
</div>

<script>
    document.getElementById('resizeForm').addEventListener('submit', function() {
        document.getElementById('loading').style.display = 'block';
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerText = 'Processing...';
    });
</script>
</body>
</html>