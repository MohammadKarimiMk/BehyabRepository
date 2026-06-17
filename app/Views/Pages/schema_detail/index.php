<section x-data="{isModalOpen:false,}">

    <div
  id="modal"
  class="fixed inset-0 bg-black/90 flex flex-col justify-center"
  x-data="{
  selectedImage:'https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp'
  }"
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


    <div class="flex flex-col md:flex-row justify-center bg-gray-500 m-4 rounded-lg shadow-lg items-center" x-data="{selectedImage:'https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp'}">


   <div class="flex flex-row justify-center items-center">
     <div class="flex flex-col">
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="https://image.torob.com/base/images/OQ/VS/OQVSCl6l72I6CEVv.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="https://image.torob.com/base/images/mV/15/mV15zgXvnOCBoSVs.webp_/280x280.webp" alt="">        
        <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="https://image.torob.com/base/images/Ki/LC/KiLC4USrByg9LXUV.webp_/280x280.webp" alt="">        
        <!-- <img @click="selectedImage=$el.getAttribute('src')" class="rounded border border-slate-300 p-1 m-2 max-w-20" src="https://image.torob.com/base/images/_k/PD/_kPDqrGRmK6EDxoy.webp" alt="">         -->
         <div @click="isModalOpen=true" class="flex justify-center items-center rounded border border-slate-300 p-1 m-2 h-20 w-20">
            <p>+4</p>
         </div>
    </div>

    <img class="rounded-lg max-h-40 md:max-h-64 m-2" :src="selectedImage" alt="">
   </div>
    


    <div class="flex flex-col">
        <h2 class="text-lg text-white font-bold m-2">گوشی شیائومی Redmi Note 14 4G | حافظه 256 رم 8 گیگابایت</h2>
        <h4 class="m-2 text-sm text-gray-300">Xiaomi Redmi Note 14 4G 256/8 GB</h4>
        <div class="flex m-2 max-w-80 md:max-w-96 overflow-auto">

            <div class="min-w-fit text-sm text-white border border-black p-2 rounded-lg m-2">
                <p>256 GB - 8 GB - گلوبال</p>
                <p>از ۳۴٫۳۸۸٫۰۰۰ تومان</p>
            </div>
             <div class="min-w-fit text-sm text-white border border-black p-2 rounded-lg m-2">
                <p>256 GB - 8 GB - گلوبال</p>
                <p>از ۳۴٫۳۸۸٫۰۰۰ تومان</p>
            </div>
              <div class="min-w-fit text-sm text-white border border-black p-2 rounded-lg m-2">
                <p>256 GB - 8 GB - گلوبال</p>
                <p>از ۳۴٫۳۸۸٫۰۰۰ تومان</p>
            </div>
              <div class="min-w-fit text-sm text-white border border-black p-2 rounded-lg m-2">
                <p>256 GB - 8 GB - گلوبال</p>
                <p>از ۳۴٫۳۸۸٫۰۰۰ تومان</p>
            </div>
            

        </div>
        <h2 class="rounded p-2 max-w-fit text-sm text-white m-2 border border-black">۲۰۱ فروشنده دیگر</h2>
        <div class="flex flex-col bg-red-500 p-2 rounded-lg m-2">
            <p class="m-1 text-white font-bold">خرید از گوشی آنلاین</p>
            <p class="m-1 text-white font-bold">۳۴٫۹۸۸٫۸۰۰ تومان</p>
        </div>
    </div>

    </div>






  <div class="flex flex-col md:flex-row max-h-[1000px]">
      <div class="flex flex-col bg-gray-500 m-4 rounded-lg shadow-lg max-w-full md:w-2/3 p-2 overflow-auto">
        <h2 class="font-bold text-white text-lg m-2">فروشنده ها</h2>
        
            <div class="flex flex-col md:flex-row justify-between p-8 border border-gray-400 m-2 rounded-xl md:items-center">
                <h2 class="font-bold text-white text-lg">موبایل 140</h2>                
                <h2 class="text-white text-lg">گوشی موبایل شیائومی مدل 14 Redmi Note ظرفیت 256 گیگابایت رم 8 گیگابایت</h2>                
                <div class="flex flex-row md:flex-col">
                    <h2 class="m-2 font-bold text-white text-lg">۳۴٫۹۹۹٫۰۰۰ تومان</h2>
                    <h2 class="m-2 text-white text-lg bg-red-500 p-2 rounded whitespace-nowrap md:max-w-fit">خرید اینترنتی</h2>                
                </div>

            </div>


        
    </div>



    <div class="flex flex-col bg-gray-500 m-4 rounded-lg shadow-lg max-w-full md:w-1/3 p-2 overflow-auto">
        <h2 class="font-bold text-white text-lg m-2">مشخصات محصول</h2>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
        <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
         <div class="m-2">
            <h3 class="text-base text-white">برند</h3>
            <h3 class="text-base text-gray-300">شیائومی</h3>
        </div>
    </div>
  </div>




</section>