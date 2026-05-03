<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Tidak Valid - Surat</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }
        .box {
            width: 100%;
            max-width: 460px;
            padding: 28px;
            border-radius: 10px;
            background: #fff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .08);
            text-align: center;
        }
        h1 { margin: 0 0 10px; font-size: 1.25rem; color: #2563eb; }
        p { margin: 0 0 18px; color: #4b5563; line-height: 1.5; }
        a {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 6px;
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Login Tidak Valid</h1>
        <p>{{ $message }}</p>
        <a href="{{ route('login') }}">Ke Halaman Login</a>
    </div>
</body>
</html>
