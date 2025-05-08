<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
     <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    @vite("resources/css/admin.css")
    @vite("resources/css/app.css")

      @livewire("side-bar")
   
   
     {{-- @livewire('Admin.Cargo.RouteManager') --}}
{{--  
     @livewire('Admin.Cargo.WeightConfig') --}}

{{-- 
     
     @livewire('Admin.Cargo.VolumeConfig') --}}

     
{{--      
     @livewire('Admin.Cargo.ServiceTypeConfig') --}}

     @livewire('Admin.Cargo.cargo-dashboard')
 
</body>
</html>