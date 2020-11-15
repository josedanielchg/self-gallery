<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ $tittle }}</title>
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="css/main.css">
</head>
<body>

     {{ layout->header }}
     
     <main class="container {{ $site }}">
          {{ content }}
     </main>

      <?php 
               if( isset($addImageBtn) )
               print("{{ layout->add_image_btn }}");
     ?>

     {{ layout->footer }}

     {{ scripts->js }}
</body>
</html>