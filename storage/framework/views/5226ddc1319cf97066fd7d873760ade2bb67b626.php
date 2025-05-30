<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Products</title>
    <style>
        /* Global Styles */
        body {
            background-image: url('https://img.freepik.com/free-vector/business-background-vector-blue-abstract-style_53876-126697.jpg?t=st=1720088218~exp=1720091818~hmac=faaaeb465d135c6824e077e5bae46bb9611398985faa01f68fae3f3d9d68b8e4&w=996');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Header Styles */
        header {
            background-color: #73C2FB;
            padding: 10px 20px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px 8px 0 0;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        /* Table Styles */
        .table {
            margin-bottom: 20px;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table tr:hover {
            background-color: #f9f9f9;
        }

        /* Product Image Styles */
        .product-image {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        /* Product Color Styles */
        .product-color {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-success {
            background-color: #4CAF50;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #45a049;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

      


        
        

       

     
    </style>
</head>
<body>
    
    <?php if(session('Success')): ?>
    <div class="message" style="text-align:center ;margin-top:10px">
        <h3><?php echo e(session('Success')); ?></h3>
    </div>
    <?php endif; ?>

    <div style="position: absolute; top: 20px; right: 20px;">
        <a href="<?php echo e(url('logout')); ?>">
            <button class="btn btn-primary" style="background-color: #007bff; color: #fff; border-color: #007bff; padding: 10px 20px; font-size: 16px; border-radius: 5px;">
                Logout
            </button>
        </a>
    </div>
    <div class="container">
        <header >
            <div class="title">Categories List</div>
             <div class="dropdown">
                    <form action="" method="get">
                        <?php echo csrf_field(); ?>
                        <input type="search" name="search" placeholder="Search">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                
                <div class="dropdown">

                   
                        <a class="btn btn-primary" href="<?php echo e(route('products.index')); ?>">Home</a>
                    
                        
                </div> 
            <div>
                <a href="category/create" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
                <a href="products/create" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
            </div>
            
        </header>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    
                    <td><?php echo e($item['id']); ?></td>
                    <td><a href="<?php echo e(route('category.show',$item->id )); ?>"><?php echo e($item->category); ?></a></td>
                    
                    <td>
                        <form action="category/<?php echo e($item['id']); ?>/edit" method="GET" style="display: inline-block;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Edit</button>
                        </form>
                        <form action="category/<?php echo e($item['id']); ?>" method="POST" style="display: inline-block;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
       
        <?php echo $data->withQueryString()->links('pagination::bootstrap-5'); ?>


        
    </div>
</body>
</html><?php /**PATH E:\lara\Products\crud\resources\views/categories.blade.php ENDPATH**/ ?>