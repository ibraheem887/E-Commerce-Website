<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/business-background-vector-blue-abstract-style_53876-126697.jpg?t=st=1720088218~exp=1720091818~hmac=faaaeb465d135c6824e077e5bae46bb9611398985faa01f68fae3f3d9d68b8e4&w=996');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Roboto', sans-serif;
        }

        .form-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
        }

        input, textarea, .custom-file-input {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 12px;
            width: 100%;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #2072ff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 24px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .product-images {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.product-image-wrapper {
    width: 50px; /* Adjust the width as needed */
    height: 50px; /* Adjust the height as needed */
    margin-right: 15px; /* Add some spacing between the images */
    margin-bottom: 15px;
    overflow: hidden;
    position: relative;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

        .custom-file-label {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    
       
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
        <h1 class="text-center mb-4">Edit Product</h1>
        <form action="{{ route('products.update', $data['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id">
                    <option value="">{{$data->category_name()}}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">-{{ $category->category }} </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="TITLE">Title</label>
                <input type="text" class="form-control" name="TITLE" value="{{ $data['TITLE'] }}">
                @error('TITLE')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="DESCRIPTION">Description</label>
                <textarea class="form-control" name="DESCRIPTION" rows="5">{{ $data['DESCRIPTION'] }}</textarea>
                @error('DESCRIPTION')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group d-flex align-items-center">
                <label for="IMAGE">Choose Image</label>
                <div class="input-group">
                    <input type="file" class="custom-file-input" name="IMAGE[]" multiple>
                </div>
            </div>
            <div class="form-group">
                <div class="product-images ">
                    @if ($data->IMAGE)
                        @foreach (json_decode($data->IMAGE, true) as $imagePath)
                        <div class="product-image-wrapper mr-3 mb-3">
                            <img class="product-image round small" src="{{ asset('product_images/' . $data->category_id . '/' . $data->TITLE . '/' . $imagePath) }}" alt="{{ $data->TITLE }} Image">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
                          
                          
            <div class="form-group">
                <label for="PRICE">Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" class="form-control" name="PRICE" step="0.01" value="{{ $data['PRICE'] }}">
                    @error('PRICE')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="QUANTITY">Quantity</label>
                <input type="number" class="form-control" name="QUANTITY" value="{{ $data['QUANTITY'] }}">
                @error('QUANTITY')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="COLOR">Color</label>
                <input type="color" class="form-control form-control-color" name="COLOR" title="Choose your color" value="{{ $data['COLOR'] }}">
                <div class="mt-2" style="border-radius: 20%; width: 60px; height: 40px; background-color: {{ $data['COLOR'] }}"></div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
        </form>
    </div>
</body>
</html>
