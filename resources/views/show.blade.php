<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>Product Details</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/business-background-vector-blue-abstract-style_53876-126697.jpg?t=st=1720088218~exp=1720091818~hmac=faaaeb465d135c6824e077e5bae46bb9611398985faa01f68fae3f3d9d68b8e4&w=996');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 6rem auto;
            background-color: rgb(237, 243, 244);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            display: flex;
            justify-content: space-between;
        }

        .product-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .product-header h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }

        .product-image-container {
            flex-basis: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 2rem;
        }

        .main-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .main-image:hover {
            transform: scale(1.1);
        }

        .thumbnail-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0.5rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .thumbnail:hover {
            transform: scale(4.1);
        }

        .product-info {
            flex-basis: 50%;
            font-size: 1.1rem;
            color: #555;
        }

        .product-info p {
            margin-bottom: 0.5rem;
        }

        .color-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            margin-left: 0.5rem;
        }

        .product-actions {
            margin-top: 2rem;
            text-align: right;
        }

        .product-actions a, .product-actions button {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .product-actions a {
            background-color: #007bff;
            color: white;
        }

        .product-actions a:hover {
            background-color: #0056b3;
        }

        .product-actions button {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }

        .product-actions button:hover {
            background-color: #c82333;
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
    <div class="container">
       
        @if ($data->IMAGE)
            @php
                $images = json_decode($data->IMAGE, true);
                $mainImage = array_shift($images);
            @endphp
            <div class="product-image-container">
                <img class="main-image" src="{{ asset('product_images/' . $data->category_id . '/' . $data->TITLE . '/' . $mainImage) }}" alt="{{ $data->TITLE }} Image">
                <div class="thumbnail-container">
                    @foreach ($images as $imagePath)
                        <img class="thumbnail" src="{{ asset('product_images/' . $data->category_id . '/' . $data->TITLE . '/' . $imagePath) }}" alt="{{ $data->TITLE }} Image">
                    @endforeach
                </div>
            </div>
        @endif
        <div class="product-info">
            <div class="product-header">
                <h1>{{$data->TITLE}}</h1>
            </div>
            <p><b>CATEGORY:</b> {{ $data->category_name() }}</p>
            <p><b>PRODUCT ID:</b> {{ $data->id }}</p>
            <p>{{ $data->DESCRIPTION }}</p>
            <div>
                <p><b>Color:</b> {{ $data->COLOR }}</p>
                <div class="color-indicator" style="background-color: {{ $data['COLOR'] }}"></div>
            </div>
            <p><strong>Price:</strong> ${{ number_format($data->PRICE, 2) }}</p>
            <p><b>Quantity:</b> {{ $data->QUANTITY }}</p>
            <div class="product-actions">
                <a href="{{ route('products.edit', $data->id) }}" class="btn btn-success"><i class="fas fa-edit"></i>Edit</a>
                <form action="{{ route('products.destroy', $data->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>