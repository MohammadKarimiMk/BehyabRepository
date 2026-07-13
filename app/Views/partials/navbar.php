<div class=" fixed flex md:hidden w-full bottom-0 right-0 bg-white justify-between p-2">

<!-- <div class="flex flex-col items-center" :class="activeId==1?'text-red-400':''" @click="activeId=1">
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M10.5 18C14.0899 18 17 15.0899 17 11.5C17 7.91015 14.0899 5 10.5 5C6.91015 5 4 7.91015 4 11.5C4 15.0899 6.91015 18 10.5 18Z" stroke="currentColor" stroke-width="2"/>
  <path d="M20 20L16.5 16.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg>
<h3 class="text-sm">جست و جو</h3>
</div> -->


<a href="<?php echo \core\View::get_root_route() ?>">
<div class="flex flex-col items-center <?= $selected_page=='home'?'text-red-400':''?>">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M3 10.5L12 3L21 10.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M5 9.5V21H19V9.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  <path d="M9 21V14H15V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<h3 class="text-sm">خانه</h3>
</div>
</a>


<a href="<?php echo \core\View::get_root_route() ?>/categories">
<div class="flex flex-col items-center <?= $selected_page=='categories'?'text-red-400':''?>">
 <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 4H10V10H4V4Z" stroke="currentColor" stroke-width="2"/>
  <path d="M14 4H20V10H14V4Z" stroke="currentColor" stroke-width="2"/>
  <path d="M4 14H10V20H4V14Z" stroke="currentColor" stroke-width="2"/>
  <path d="M14 14H20V20H14V14Z" stroke="currentColor" stroke-width="2"/>
</svg>
<h3 class="text-sm">دسته بندی</h3>
</div>
</a>


<div class="flex flex-col items-center" :class="activeId==4?'text-red-400':''" @click="activeId=4">
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="currentColor" stroke-width="2"/>
  <path d="M4 20C4 16.6863 7.58172 14 12 14C16.4183 14 20 16.6863 20 20" stroke="currentColor" stroke-width="2"/>
</svg>
<h3 class="text-sm">پروفایل</h3>
</div>



</div>