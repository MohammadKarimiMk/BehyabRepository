<section x-data="{isModalOpen:false,}">

    <div
  id="modal"
  class="fixed inset-0 bg-black/90 flex flex-col justify-center"
  x-data="{
  selectedImage:'<?php echo $detail["MainImageName"]  ?>'
  }"
  x-cloak
  x-show="isModalOpen"
x-on:keydown.escape.window="isModalOpen = false"
>
    <button
  class="absolute top-4 right-4 text-white text-3xl hover:text-red-500"
  @click="isModalOpen=false"
>
  &times;
</button>

    <img class="object-contain m-2 h-64 md:h-96" :src="selectedImage" alt="">

    <div class="flex flex-wrap max-h-64 md:max-h-96 overflow-auto justify-center">
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/mV/15/mV15zgXvnOCBoSVs.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/Ki/LC/KiLC4USrByg9LXUV.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/_k/PD/_kPDqrGRmK6EDxoy.webp" alt="">        
          <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/mV/15/mV15zgXvnOCBoSVs.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/Ki/LC/KiLC4USrByg9LXUV.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/_k/PD/_kPDqrGRmK6EDxoy.webp" alt="">        
          <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/mV/15/mV15zgXvnOCBoSVs.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/Ki/LC/KiLC4USrByg9LXUV.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/_k/PD/_kPDqrGRmK6EDxoy.webp" alt="">        
          <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/mV/15/mV15zgXvnOCBoSVs.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/Ki/LC/KiLC4USrByg9LXUV.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20 md:max-w-32" src="https://image.torob.com/base/images/_k/PD/_kPDqrGRmK6EDxoy.webp" alt="">        

        
    </div>
</div>


    <div class="flex flex-col md:flex-row justify-center bg-gray-500 m-4 rounded-lg shadow-lg items-center" x-data="{
    selectedImage:'<?php echo $detail["MainImageName"]  ?>'
    }">


   <div class="flex flex-row justify-center items-center">
     <div class="flex flex-col">
        <?php if (count($images) > 0): ?>
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="<?php echo $images[0]["Name"] ?>" alt="">        
        <?php endif; ?>
        <?php if (count($images) > 1): ?>
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="<?php echo $images[1]["Name"] ?>" alt="">        
        <?php endif; ?>
        <?php if (count($images) > 2): ?>
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="<?php echo $images[2]["Name"] ?>" alt="">        
        <?php endif; ?>
        <!-- <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="https://image.torob.com/base/images/_k/PD/_kPDqrGRmK6EDxoy.webp" alt="">         -->
        <?php if (count($images) > 3): ?>

         <div @click="isModalOpen=true" class="flex justify-center items-center rounded border border-slate-300 p-1 m-2 h-20 w-20">
            <p>+<?php echo (count($images)-3)?></p>
         </div>
        <?php endif; ?>

    </div>

    <img class="rounded-lg max-h-40 md:max-h-64 m-2" :src="selectedImage" alt="">
   </div>
    


    <div class="flex flex-col">
        <h2 class="text-lg text-white font-bold m-2"><?php echo $detail["Name"] ?></h2>
        <h4 class="m-2 text-sm text-gray-300"><?php echo $detail["EnglishName"] ?></h4>
        <a class="m-2 text-base text-white hover:text-gray-300" href="<?= \core\View::get_root_route() ?>/category/<?= $detail["CategoryId"] ?>"><?php echo $detail["category_name"] ?></a>
        <div class="flex m-2 max-w-80 md:max-w-96 overflow-auto">

          <?php foreach ($in_group_schemas as $item): ?>
          
            <a href="<?= \core\View::get_root_route() ?>/product/<?= $item["Id"] ?>">
              <div class="whitespace-nowrap min-w-fit text-sm text-white border border-black p-2 rounded-lg m-2">
              <p><?= $item["EnglishName"] ?></p>
              <p>از <?= $item["cheapest_price"] ?> تومان</p>
            </div>
            </a>
          <?php endforeach; ?>
          
            

        </div>
        <h2 class="rounded p-2 max-w-fit text-sm text-white m-2 border border-black"><?php echo $products_count ?> فروشنده</h2>
            <?php if ($minProductData != null): ?>                    
            <a target="_blank" href="<?php echo $minProductData["Link"]  ?>">
        <div class="flex flex-col bg-red-500 p-2 rounded-lg m-2">
            <p class="m-1 text-white font-bold">خرید از <?php echo $minProductData["websiteName"] ?></p>
            <p class="m-1 text-white font-bold"><?php echo $minProductData["price"] ?> تومان</p>
        </div>
            </a>
            <?php endif; ?>

    </div>

    </div>






  <div class="flex flex-col md:flex-row max-h-[2000px] md:max-h-[1000px]">
      <div class="flex flex-col bg-gray-500 m-4 rounded-lg shadow-lg max-w-full md:w-2/3 p-2 overflow-auto">
        <h2 class="font-bold text-white text-lg m-2">فروشنده ها</h2>
        
            <?php foreach ($products as $item): ?>
            <a target="_blank" href="<?php echo $item["Link"]  ?>">
            <div class="flex flex-col md:flex-row justify-between p-8 border border-gray-400 m-2 rounded-xl md:items-center">
                <h2 class="font-bold text-white text-lg"><?php echo $item["WebsiteName"]  ?></h2>                
                <h2 class="text-white text-lg"><?php echo $item["Name"]  ?></h2>                
                <div class="flex flex-row md:flex-col">
                    <?php if ($item["FinalPrice"] != '۰'): ?>                    
                    <h2 class="m-2 font-bold text-white text-lg"><?php echo $item["FinalPrice"]  ?> تومان</h2>
                    <?php else: ?>
                    <h2 class="m-2 font-bold text-white text-lg">ناموجود</h2>

                    <?php endif; ?>

                    <h2 class="m-2 text-white text-lg bg-red-500 p-2 rounded whitespace-nowrap md:max-w-fit">خرید اینترنتی</h2>                
                </div>

            </div>
            </a>
            <?php endforeach; ?>


            


        
    </div>



    <div class="flex flex-col bg-gray-500 m-4 rounded-lg shadow-lg max-w-full md:w-1/3 p-2 overflow-auto">
        <h2 class="font-bold text-white text-lg m-2">مشخصات محصول</h2>
        <?php foreach ($properties as $item): ?>
        <div class="m-2">
            <h3 class="text-base text-white"><?php echo $item["_Key"] ?></h3>
            <h3 class="text-base text-gray-300"><?php echo $item["_Value"] ?></h3>
        </div>
        <?php endforeach; ?>



    </div>
  </div>



  <div class="bg-gray-500 rounded-lg shadow-lg m-4 p-2">
  <h2 class="font-bold text-white text-lg m-2">محصولات مشابه</h2>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-7 content-center">
        
    <?php foreach ($related_schemas as $item): ?>
    <?php \core\View::component('schema_card', [
    'detail' => $item,
]); ?>

        
    <?php endforeach; ?>       
  </div>
  </div>

</section>