
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'My MVC App' ?></title>
    <link rel="stylesheet" href="<?php echo \core\View::get_root_route() ?>/app/Views/output.css">
</head>
<body class="min-h-screen flex flex-col bg-slate-200 container mx-auto font-vazir">
    <!-- فراخوانی partial header -->
    <?php

     \core\View::partial('partials.header');
    

    ?>
    <div class="flex-1 flex justify-center">
        <main class="w-full">
            <!-- محتوای اصلی view در اینجا قرار می‌گیرد -->
            <?php \core\View::yieldSection('content'); ?>
        </main>
        
    </div>
    <?php \core\View::partial('partials.navbar'); ?>


    <?php \core\View::partial('partials.footer'); ?>
    <script defer src="<?php echo \core\View::get_root_route() ?>/app/Views/scripts/alpinejs/cdn.min.js"></script>
    
    
    <?php \core\View::yieldSection('scripts'); ?>
    

     
    

</body>
</html>