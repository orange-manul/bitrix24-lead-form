<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .center-form {
            height: 50vh;
        }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center center-form">
    <form class="align-content-center w-50">
        <div class="form-group mb-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="text" aria-describedby="text" placeholder="Enter name">
        </div>
        <div class="form-group mb-4">
            <label for="number">Phone</label>
            <input type="number" class="form-control" id="number" placeholder="Enter phone number">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
