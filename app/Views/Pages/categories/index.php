
<section class="flex bg-white max-h-96 " x-data="{
    allItems:<?php echo htmlspecialchars(json_encode($categories,JSON_UNESCAPED_UNICODE)) ?>,
    activeId:<?php echo $categories[0]["id"] ?>,
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

      <ul class="h-full divide-y divide-gray-200">
        <template x-for="mainItem in activeItems" :key="mainItem.id">

        <li x-data="{
        isOpen:false,
        toggleIsOpen(){
        this.isOpen=!this.isOpen;
        }
        }"
        >


        <div @click="toggleIsOpen()" class="flex justify-between p-2"
        >
            <h2 x-text="mainItem.name"></h2>
            <svg x-show="isOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 14l6-6 6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

<svg x-show="!isOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M6 10l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>



        </div>


        <div x-show="isOpen" class="flex flex-wrap">
        <template x-for="subItem in mainItem.categories" :key="subItem.id">                
                <p class="text-sm rounded-xl p-1 m-2 border-2 border-gray-200" x-text="subItem.name"></p>
        </template>
        

        </div>


    </li>

        </template>

        </ul>

    </div>
</section>