<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/business-background-vector-blue-abstract-style_53876-126697.jpg?t=st=1720088218~exp=1720091818~hmac=faaaeb465d135c6824e077e5bae46bb9611398985faa01f68fae3f3d9d68b8e4&w=996');            background-size: cover;

            font-family: 'Open Sans', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            margin: 20px auto;
            background-image: linear-gradient(to bottom, #fff, #e5e5e5);
            background-size: 100% 300px;
            background-position: 0% 100%;
            transition: background-position 0.5s ease;
        }

        .container:hover {
            background-position: 0% 0%;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn+.btn {
            margin-left: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .buttons {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="buttons">
            <a href="{{ url('adminloginPage') }}" class="btn">Login</a>
            <a href="{{ url('register') }}" class="btn">Register</a>
        </div>
    </div>
</body>
</html>