
<!-- محتوای اصلی (به طور خودکار در بخش 'content' قرار می‌گیرد) -->
 


    <div
     x-data="infiniteList()"
     x-init="init()"
     x-ref="rootContainer"
     >

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 content-center">
    
    <?php foreach ($schemas as $item): ?>
    <?php \core\View::component('schema_card', [
    'detail' => $item,
]); ?>

        
    <?php endforeach; ?>

    
        <template x-for="item in items" :key="item.Id">
            <a target="_blank" :href="`<?= \core\View::get_root_route() ?>/product/${item.Id}`">
 <div class="flex flex-col m-2 bg-gray-400 shadow shadow-lg rounded-lg">
            <img class="object-contain h-40 rounded-t-lg" :src="item.MainImageName" alt="">
            <h1 class="line-clamp-3 text-sm text-black m-2" x-text="item.Name"></h1>
            <h3 class="line-clamp-3 text-sm text-slate-800 m-2 mt-4" x-text="`از ${item.cheapest_price} تومان`"></h3>
        </div> 
        </a>

        </template>

        
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


<script src="<?php echo \core\View::get_root_route() ?>/app/Views/Pages/home/script.js"></script>
<?php \core\View::endSection(); ?>

