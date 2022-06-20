<template>
<!-- <div>{{getbilltests}}</div> -->
  <div id="printMe" ref="printMe" class="px-0">
        <div class="flex justify-between mx-0 py-0">
            <div class=" py-0">
                <img
                  class="h-16 w-42"
                  :src="pathLogoSG"
                  :alt="LogoThin"
                />
            </div>
            <div class="py-0">
              <img
                  class="h-16 w-24 rounded-full"
                  :src="pathLogoThin"
                  :alt="LogoThin"
                />
            </div>
        </div>
      <div class="grid grid-cols-5 w-full mt-0 py-0 my-0">
          <div class="col-span-4 text-center">
              <div class="pl-10 py-0 place-items-center">
                    <div class="pl-10 text-center font-bold text-xl underline underline-offset-2 font-sans-Timenew text-blue-700 ">PHIẾU XÉT NGHIỆM TẾ BÀO CỔ TỬ CUNG</div>
                 </div>

          </div>
          <div class="grid text-left text-italy text-md font-bold content-center font-sans-Timenew leading-5  pl-1 py-0">
              <span>Mã y tế:"Ma_Yte"</span>
              <span>STT:"MSTB"</span>
            </div>
      </div>
      <!--==============--->
      <div class="font-bold text-blue-800 font-sans-Timenew text-md">THÔNG TIN BỆNH NHÂN</div>
      <div class="grid grid-cols-4 leading-5">
          <div class="col-span-2  font-sans-Timenew">Họ tên: <span class="font-bold"> {{printCustommers['name']}}</span></div>
          <div class=" text-md font-sans-Timenew">Năm sinh: <span class="font-bold"> {{printCustommers['birthday']}}</span></div>
          <div class=" font-sans-Timenew ">Para: <span class="font-bold"> {{getbilltests['para']}}</span></div>
      </div>
      <div class=" font-sans-Timenew leading-6">Đia chỉ <span class="font-bold"> {{printCustommers['address']}}</span></div>
      <div class=" font-sans-Timenew leading-6">Chẩn đoán lâm sàng: <span class="font-bold"> {{getbilltests['diagnose']}}</span></div>
      <div class="grid grid-cols-3 font-sans-Timenew leading-6">
          <div class=" col-span-2">Bác sỹ lấy mẫu: <span class="font-bold" v-if="printDoctor"> {{printDoctor['name']}}</span></div>
          <div class="">Ngày lấy mẫu:</div>
      </div>
       <!--/==============--->
        <!--==============--->
        <div class="text-center font-bold text-md underline underline-offset-2 font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
        <div class="text-left font-bold text-sm  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
         <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
         </div>

         <div class="grid grid-cols-5">
           <div class=" col-span-2  text-left font-bold text-sm  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>

           <div class="col-span-3 flex flex-row" >
                    <div class="" v-for="eg11 in testElements" :key="eg11.id">
                      <span class="font-bold pr-4" v-if="eg11.element_group ==11">
                           <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg11.id" v-model="selectedArray"/>
                          <span class=" text-middle ml-1  font-sans-Timenew">{{eg11.name}}</span>
                      </span>
                    </div>
            </div>
         </div>
         <!--/==============--->
         <!--==============--->
         <div class="font-bold text-blue-800 font-sans-Timenew text-sm mt-0">KẾT QUẢ</div>

         <div class="grid grid-cols-3">
           <div class="" v-for="eg12 in testElements" :key="eg12.id">
                      <span class="flex flex-row font-bold pr-4" v-if="eg12.element_group ==12">
                          <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3 my-1" :value="eg12.id" v-model="selectedArray"/>
                          <span class=" text-middle ml-1  font-sans-Timenew">{{eg12.name}}</span>
                      </span>
              </div>
         </div>

         <div class="grid grid-cols-3 mt-1">
            <div>
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào do vi sinh</span>
              <div class="text-xs " v-for="eg13 in testElements" :key="eg13.id">
                      <span class="flex flex-row font-bold pl-2" v-if="eg13.element_group ==13">
                          <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg13.id" v-model="selectedArray"/>
                          <span class="text-middle ml-1 italic py-1  font-sans-Timenew leading-3">{{eg13.name}}</span>
                      </span>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Gai</span>
               <div class="text-xs" v-for="eg14 in testElements" :key="eg14.id">
                      <span class="flex flex-row font-bold pl-2" v-if="eg14.element_group ==14">
                           <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg14.id" v-model="selectedArray"/>
                            <span class="text-middle py-1 ml-1 font-sans-Timenew leading-3">{{eg14.name}}</span>
                      </span>
              </div>
            </div>


         </div>
         <div class="grid grid-cols-3 mt-1">
            <div class="text-xs">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Biến đổi tế bào khác</span>
              <div class="flex flex-col">
               <div class="" v-for="eg15 in testElements" :key="eg15.id">
                      <span class="flex flex-rơ font-bold pl-2 align-items-middle" v-if="eg15.element_group ==15">
                           <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg15.id" v-model="selectedArray"/>
                            <span class="align-middle text-xs font-sans-Timenew ml-1 py-1 leading-3">{{eg15.name}}</span>
                      </span>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào tuyến</span>
              <div class="flex flex-col leading-5">
                <div class="" v-for="eg16 in testElements" :key="eg16.id">
                      <span class="flex flex-row font-bold pl-2" v-if="eg16.element_group ==16">
                          <input type="checkbox" class="form-checkbox text-blue-800 h-3 w-3" :value="eg16.id" v-model="selectedArray"/>
                            <span class="text-middle text-xs font-sans-Timenew ml-1 leading-2">{{eg16.name}}</span>
                      </span>
                </div>
              </div>
            </div>
         </div>

         <div class="grid grid-cols-2">
            <div  class="text-center place-items-center">

               <img v-if="imageThinLeft"
                    class=" ml-10 w-80 max-h-52"
                    :src="pathThinLeft+imageThinLeft"
                    :alt="imageThinLeft"/>

                <img v-else
                    class="w-80 max-h-52 "
                    :src="pathThinLeft"
                    alt="imageThinLeft"/>
                </div>
            <div class="text-center">
               <img v-if="imageThinLeft"
                    class="w-80 max-h-52 "
                    :src="pathThinRight+imageThinLeft"
                    :alt="imageThinLeft"/>

                <img v-else
                    class="w-80 max-h-52 "
                    :src="pathThinRight"
                    alt="imageThinLeft"/>
              </div>

         </div>
         <div class="grid grid-cols-3">
           <div class="col-span-2">
             <div class="grid grid-cols-1">
               <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                  <div  v-for="eg9 in testElements" :key="eg9.id">
                      <span class="font-bold text-xs w-full mr-3" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                        <p v-if="kl!==null" class="uppercase text-red-800 font-sans-Timenew text-lg pl-2">- {{ketluan}}</p>
                      </span>
                  </div>
             </div>
              <div class="font-bold text-blue-800 font-sans-Timenew text-md underline underline-offset-2">ĐỀ NGHỊ:</div>
           </div>
           <div class="grid grid-cols-1 text-center">
             <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả:</span>
             <span class=" font-bold font-sans-Timenew text-md" style="margin-bottom:40px">BÁC SĨ ĐỌC KẾT QUẢ</span>
             <span class="font-bold font-sans-Timenew text-md">"tên Bác sỹ"</span>
             <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
             <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
           </div>
           </div>
           <div class="grid grid-cols-3 -mt-8">
             <div class="col-span-2">
               <div class="w-full flex flex-col font-bold">
                 <span class="font-sans-Timenew text-xs">Tầng 4-5-6-7 số 9-11-13-15 Trịnh Văn Cấn, P.Cầu Ông Lãnh, Q.1, TP.HCM</span>
                 <span class="font-sans-Timenew text-xs">Tel: +848 28 213 456 * F: +848 28 210 799 * W: www.taimuihongsg.com</span>
                 </div>

             </div>
             <div></div>
           </div>
  </div>
</template>

<script>
import { BeakerIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
export default {
    props:{
        getbilltests:Object,
        printCustommers:Object,
        printAddress:'',
        printOutsent:'',
        printDoctor:'',
        selectedArray:'',
        testElements:'',
        pathImageLeft:"",
        pathThinLeft:'',
        pathThinRight:'',
        imageThinLeft:'',
        ketluan:'',

    },
    components:{
      BeakerIcon,
      CheckIcon
    },
    data(){
      return{
        pathLogoSG:'/images/Logo/logoSG.png',
        pathLogoThin:'/images/Logo/Thinprep.jpg',
      }
    }
}
</script>