<!DOCTYPE html>
<html>
<head>
    <title>Resize Image from CDN</title>
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        input[type="url"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Resize Image from CDN</h2>
        <form method="POST" action="{{ route('resize.cdn') }}">
            @csrf
            <input type="url" name="image_url" placeholder="Enter CDN image URL" required>
            <br>
            <button type="submit">Resize Image</button>
        </form>

        @if(session('success'))
            <div style="color: green; margin-top: 20px;">
                {!! session('success') !!}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; margin-top: 20px;">
                {{ session('error') }}
            </div>
        @endif
    </div>
</body>
</html>
