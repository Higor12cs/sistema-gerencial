<!DOCTYPE html>
<html>

<head>
    <title>Sistema Gerencial</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }

        .logo {
            display: inline-block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 30px;
        }
    </style>

</head>

<body>
    <div class="container">
        <img src="{{ asset('vendor/adminlte/dist/img/Logo.png') }}" alt="Logo" class="logo">
        <h1 class="title">Sistema Gerencial</h1>
        <p class="subtitle">{{ __('Desenvolvido por Higor Carneiro') }}</p>
        <a href="{{ route('login') }}" class="cta-button">{{ __('Comece Agora!') }}</a>
    </div>
</body>

</html>
