<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        p {
            line-height: 1.6;
            color: #333;
        }

        .logo {
            display: block;
            margin: 20px auto;
            max-width: 150px;
            
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>{{ $data['title'] }}</h1>
        <p>{{ $data['body'] }}</p>

    </div>
</body>

</html>
