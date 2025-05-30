<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Login</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/business-background-vector-blue-abstract-style_53876-126697.jpg?t=st=1720088218~exp=1720091818~hmac=faaaeb465d135c6824e077e5bae46bb9611398985faa01f68fae3f3d9d68b8e4&w=996');            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .form-container {
            max-width: 600px;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input, textarea {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 24px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>
    <div class="form-container">
        <h1 class="text-center mb-4">Admin Login</h1>
        <form class="pure-form pure-form-aligned" action="{{url('login')}}" method="Get">
            @csrf
            @method('Post')
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <span class="error-message">
                    @error('email')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="error-message">
                    @error('password')
                        {{$message}}
                    @enderror
                </span>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-login"></i> Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('show.register')}}" class="text-primary">Don't have an account?</a>
        </div>
    </div>
</body>
</html>