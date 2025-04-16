<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket Management | Tivotal</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- CSS File -->
    @vite('resources/css/admin.css')
    <style>
      /* Add to admin.css */
.wire-transition {
    transition: opacity 300ms ease;
}
.wire-transition.in {
    opacity: 1;
}
.wire-transition.out {
    opacity: 0;
}

/* Header button styles */
.page-header .header-options {
    display: flex;
    gap: 1rem;
}
.page-header button {
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: background 0.3s ease;
}
.page-header button.active {
    background: #3498db;
    color: white;
}
    </style>
  </head>
  <body>

  @livewire('side-bar')
  
  @livewire('manage-ticket')
    
  </body>
</html>
