<a target="_blank" href="<?= \core\View::get_root_route() ?>/product/<?php echo $detail["Id"] ?>">
    <div class="flex flex-col m-2 bg-gray-400 shadow shadow-lg rounded-lg">
            <img class="object-contain h-40 rounded-t-lg" src="<?php echo $detail["MainImageName"] ?>" alt="">
            <h1 class="line-clamp-3 text-sm text-black m-2"><?php echo $detail["Name"] ?></h1>
            <h3 class="line-clamp-3 text-sm text-slate-800 m-2 mt-4">از <?php echo $detail["cheapest_price"] ?> تومان</h3>

        </div>      
        </a>