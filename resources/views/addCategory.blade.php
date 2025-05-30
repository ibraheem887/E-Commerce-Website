<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Add Product</title>
    <style>
       
        body {
            background-image: url('https://img.freepik.com/free-vector/business-background-vector-blue-abstract-style_53876-126697.jpg?t=st=1720088218~exp=1720091818~hmac=faaaeb465d135c6824e077e5bae46bb9611398985faa01f68fae3f3d9d68b8e4&w=996');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }


        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input, textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div style="position: absolute; top: 0; left: 0; padding: 10px;">
            <a href="{{ url('products') }}">
                <button class="btn btn-primary" style="background-color: #007bff; color: #fff; border-color: #007bff; padding: 10px 20px; font-size: 16px; border-radius: 5px;">
                    Home
                </button>
            </a>
        </div>
        <div style="position: absolute; top: 20px; right: 20px;">
            <a href="{{ url('logout') }}">
                <button class="btn btn-primary" style="background-color: #007bff; color: #fff; border-color: #007bff; padding: 10px 20px; font-size: 16px; border-radius: 5px;">
                    Logout
                </button>
            </a>
        </div>
    </header>
    
    <div class="form-container">
        <h1 class="text-center mb-4">Add Category</h1>
        <form class="pure-form pure-form-aligned" action="{{url('category')}}" method="POST"  >
            @csrf
            <div class="form-group">
                <label for="category">Category name</label>
                <input type="text" class="form-control" name="category" >
                <span>
                    @error('category')
                        {{$message}}
                    @enderror
                </span>
            </div>

            
            
            
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Add Category</button>
        </form>
    </div>
</body>
</html>