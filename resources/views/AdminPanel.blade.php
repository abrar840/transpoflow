<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
   
    @vite('resources/css/admin.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--css file-->
    <link rel="stylesheet" href="assets/css/admin.css" />
  </head>
  <body>
    @livewire('admin-panel')
    @vite('resources/js/admin.js')
    @vite('resources/js/script.js')
    
  </body>
</html>
