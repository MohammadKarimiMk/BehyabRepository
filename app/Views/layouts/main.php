<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My MVC App' ?></title>
    <link rel="stylesheet" href="/behyab/app/Views/output.css">
</head>
<body class="bg-slate-200 container mx-auto font-vazir">
    <!-- فراخوانی partial header -->
    <?php

     \core\View::partial('partials.header');
    

    ?>
    <div class="container">
        <main>
            <!-- محتوای اصلی view در اینجا قرار می‌گیرد -->
            <?php \core\View::yieldSection('content'); ?>
        </main>
        
    </div>
    <?php \core\View::partial('partials.navbar'); ?>


    <?php \core\View::partial('partials.footer'); ?>
    <script defer src="/behyab/app/Views/scripts/alpinejs/cdn.min.js"></script>
    
    
    <?php \core\View::yieldSection('scripts'); ?>
    

     
    

</body>
</html>