
<section class="flex bg-white max-h-96 " x-data="{
    allItems:<?php echo htmlspecialchars(json_encode($categories,JSON_UNESCAPED_UNICODE)) ?>,
    activeId:<?php echo $categories[0]["id"] ?>,
    activeName:'<?php echo $categories[0]["name"] ?>',
    activeItems:<?php echo htmlspecialchars(json_encode($categories[0]["categories"],JSON_UNESCAPED_UNICODE)) ?>,
    changeActiveItem(id){
    this.activeId=id;
    this.activeItems= this.allItems.find(n => n.id === this.activeId).categories;    
    },

    }">
    <div class="w-1/3 overflow-auto" >
        <ul class="h-full divide-y divide-gray-200">
    <?php foreach ($categories as $item): ?>
        <div @click="changeActiveItem(<?php echo $item["id"] ?>)" class="rounded rounded-xs p-2 text-sm h-14 text-center flex items-center justify-center" :class="activeId==<?php echo $item["id"] ?>?'bg-white text-black':'bg-gray-400 text-white'">
            <?php echo $item["name"] ?>
        </div>
    <?php endforeach; ?>


        </ul>
    </div>

    <div class="w-2/3 overflow-auto">

    <a :href="`<?= \core\View::get_root_route() ?>/category/${activeId}`"><h2 class="text-center text-lg rounded-xl p-1 m-2 border-2 border-gray-200" x-text="activeName"></h2></a>
      <ul class="h-full divide-y divide-gray-200">
        <template x-for="(mainItem, index) in activeItems" :key="mainItem.id">

        <li x-data="{
        isOpen:index==0?true:false,
        toggleIsOpen(){
        this.isOpen=!this.isOpen;        
        }
        }"
        >

        <div @click="toggleIsOpen()" class="flex justify-between items-center p-2"
        >
            <h2 x-text="mainItem.name"></h2>
            <svg x-show="isOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 14l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<svg x-show="!isOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 10l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>



        </div>


        <div x-show="isOpen">
            <div class="">
                <a :href="`<?= \core\View::get_root_route() ?>/category/${mainItem.id}`"><h3 class="text-center text-base rounded-xl p-1 m-2 border-2 border-gray-200" x-text="mainItem.name"></h3></a>
                <div class="border-b border-dashed border-gray-300 m-2"></div>
            </div>
            <div class="flex flex-wrap">
            <template x-for="subItem in mainItem.categories" :key="subItem.id">                
                    <a :href="`<?= \core\View::get_root_route() ?>/category/${subItem.id}`"><p class="text-sm rounded-xl p-1 m-2 border-2 border-gray-200" x-text="subItem.name"></p></a>
            </template>
        

            </div>
        </div>

    </li>

        </template>

        </ul>

    </div>
</section>