<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
</head>
<body>
    @vite("resources/css/admin.css")
      @livewire("side-bar")
   
   
     {{-- @livewire('Admin.Cargo.RouteManager') --}}
{{--  
     @livewire('Admin.Cargo.WeightConfig') --}}

{{-- 
     
     @livewire('Admin.Cargo.VolumeConfig') --}}

     
{{--      
     @livewire('Admin.Cargo.ServiceTypeConfig') --}}

     {{-- @livewire('Admin.Cargo.cargo-dashboard') --}}
     @livewire('Admin.Cargo.BookingManager')
</body>
</html>