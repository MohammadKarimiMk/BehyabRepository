

<h1 class="text-2xl font-bold m-2">جست جو برای "<?= $searchKey ?>"</h1>

<!-- محتوای اصلی (به طور خودکار در بخش 'content' قرار می‌گیرد) -->
    <div
     x-data="infiniteList('<?= \core\View::get_root_route() ?>','<?= $searchKey ?>')"
     x-init="init()"
     x-ref="rootContainer"
     >

    <div x-ref="grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 content-center">
    
    <?php foreach ($schemas as $item): ?>
    <?php \core\View::component('schema_card', [
    'detail' => $item,
]); ?>

        
    <?php endforeach; ?>        
    </div>


    <p x-text="items.length"></p>





    <div x-show="hasMore" id="loader" x-ref="loader" class="p-4 text-center bg-blue-400">
        Loading more...
    </div>


    
    <div
        x-show="!hasMore"
        class="p-4 text-center"
    >
        No more data
    </div>


    </div>

<?php
// شروع بخش sidebar
\core\View::startSection('scripts');
?>


<script src="<?php echo \core\View::get_root_route() ?>/app/Views/Pages/search/script.js"></script>
<?php \core\View::endSection(); ?>

