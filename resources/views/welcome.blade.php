<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>URL Shortener</h1>
        @if (session('short_url'))
            <p>Short URL: <a href="{{ session('short_url') }}">{{ session('short_url') }}</a></p>
        @endif

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('shorten') }}" method="POST">
            @csrf
            <label for="original_url">Original URL:</label>
            <input type="url" name="original_url" id="original_url" required>
            <button type="submit">Shorten</button>
        </form>
    </div>
</body>
</html>
