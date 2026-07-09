<header class="sticky top-0 relative p-6 font-medium bg-white shadow-xl rounded-lg flex justify-between items-center">
  <a href="<?= \core\View::get_root_route() ?>"><h1 class="text-xl">وب‌سایت من</h1></a>
  <nav id="myNav" class="hidden md:block">
    <ul class="flex space-x-4">
      <li class="" x-data="{isOpen:false}">
        <a class="text-xl hover:bg-gray-300 transition duration-100 p-2 rounded-lg" @click.prevent="isOpen=!isOpen" 
        @click.outside="
          (event)=>{
          if(event.target.getAttribute('data-mega-member')==null){
            isOpen=false;
          }
          }
        "
        >دسته بندی</a>

        
        
        <div data-mega-member :class="isOpen==false?'hidden':'block'" class="bg-slate-200 flex w-full h-80 absolute right-0 top-[120px] bg-white shadow-xl rounded-xl" x-data='{activeItem:<?php echo $data["categories"][0]["id"] ?>,
          allCategories:<?php echo htmlspecialchars(json_encode($data["categories"], JSON_UNESCAPED_UNICODE))?>,
          activeItemName: "<?php echo htmlspecialchars($data["categories"][0]["name"], ENT_QUOTES, 'UTF-8') ?>",
          currentCategories:<?php echo htmlspecialchars(json_encode($data["categories"][0]["categories"], JSON_UNESCAPED_UNICODE))?>}'>
          <ul data-mega-member class="w-1/6 m-2 space-y-2 p-2 overflow-x-visible overflow-y-auto" >

          
    <?php foreach ($data["categories"] as $item): ?>
    <li data-mega-member @click="()=>{
    alert(test);
    activeItem=<?php echo $item["id"] ?>;
    activeItemName=<?php echo htmlspecialchars($item["id"], ENT_QUOTES, 'UTF-8') ?>;
    currentCategories= allCategories.find(n => n.id === activeItem).categories;
    
    }" :class="activeItem==<?php echo $item["id"] ?>?'bg-slate-400':'bg-white'" class="transition-all duration-200 shadow-xl p-2 rounded-xl">
      <?php echo $item["name"] ?>
    </li>
    <?php endforeach; ?>
            
          </ul>
          <div data-mega-member class="m-4 w-5/6 flex flex-col flex-wrap content-start gap-x-10">
              
            
                  <h1 class="font-bold text-2xl hover:text-blue-300 my-2"><a :href="`<?= \core\View::get_root_route() ?>/category/${activeItem}`" x-text="activeItemName"></a></h1>
            
            <template x-for="mainItem in currentCategories" :key="mainItem.id">
              <div class="contents">
                  <h1 class="font-bold text-xl hover:text-blue-300"><a :href="`<?= \core\View::get_root_route() ?>/category/${mainItem.id}`" x-text="mainItem.name"></a></h1>
                  <template x-for="subItem in mainItem.categories" :key="subItem.id">
                      <div class="mr-4 text-sm hover:text-blue-300"><a :href="`<?= \core\View::get_root_route() ?>/category/${subItem.id}`" x-text="subItem.name"></a></div>  
                  </template>
              </div>
              </template>
            
          </div>
        </div>
      </li>
      <li><a class="text-xl hover:bg-gray-300 transition duration-100 p-2 rounded-lg" href="/">تماس با ما</a></li>
      <li><a class="text-xl hover:bg-gray-300 transition duration-100 p-2 rounded-lg" href="/">درباره ما</a></li>
    </ul>       
  </nav>
 
  <a class="border border-2 border-gray-300 rounded-xl p-2" href="#">ورود/ثبت نام</a>
</header>


  