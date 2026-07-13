

<div class="flex gap-x-2 m-4">
    <?php foreach ($categories_tree as $index =>$item): ?>
        <a href="<?= \core\View::get_root_route() ?>/category/<?= $item["Id"] ?>">
            <h3 class="font-bold text-lg text-gray-400 hover:text-black transition transition-200"><?= $item["Name"] ?></h3>
        </a>
        <h3 class="text-gray-400 text-lg"> / </h3>        


    <?php endforeach; ?>

</div>

<!-- محتوای اصلی (به طور خودکار در بخش 'content' قرار می‌گیرد) -->
    <div
     x-data="infiniteList('<?= \core\View::get_root_route() ?>',<?= $category_id ?>)"
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


<script src="<?php echo \core\View::get_root_route() ?>/app/Views/Pages/category/script.js"></script>
<?php \core\View::endSection(); ?>

