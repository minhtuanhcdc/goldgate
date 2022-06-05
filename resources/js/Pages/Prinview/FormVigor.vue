<template>
<!-- <div>{{getbilltests}}</div> -->
    <div class="py-5 px-20 " id="printMe">
          <div>
            <div class="col-span-2 py-0">
                  <img
                    class="max-h-24 w-full"
                    :src="pathImageTop"
                    :alt="LogoThin"
                  />
              </div>
          </div>
          <div class="grid grid-cols-8 mx-0 py-0">
                    <div class="col-span-6 ">
                      <div class="text-center pl-40">
                          <div class="font-bold text-xl font-sans-Timenew">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                          <span class="font-bold text-xl font-sans-Timenew">PAP'S SMEAR - ThinPrep</span>
                      </div>
                    </div>
                    <div>
                      <span class="text-xs font-sans-Timenew font-bold mt-2">Số(Number):"12345678910"/2022</span>
                    </div>
          </div>

      <!--==============--->
      <div>
            <div class="grid grid-cols-4 leading-6 text-md">
                <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class=" font-bold">{{printCustommers['name']}}</span></div>
                <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{printCustommers['birthday']}}</span></div>
                <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{getbilltests['para']}}</span></div>
            </div>
            <div class="grid grid-cols-4 text-md">
                <div class="col-span-3 font-sans-Timenew leading-6 italic">Đia chỉ(Address):<span class="pl-2 font-bold">{{printCustommers['address']}}</span></div>
                <div class=" font-sans-Timenew leading-6 italic">Số điện thoại:<span class="pl-2 font-bold">???</span></div>
            </div>

            <div class="font-sans-Timenew leading-6 italic text-md">Đơn vị gửi(Custommer):<span class="pl-2 font-bold">{{printOutsent['name']}} </span></div>
            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic">
                <div class="font-bold">IUD (Intra-Uterine Devices) <i class="fa fa-square-o mt-2"></i></div>
                <div class="font-bold text-center">Nội tiết (Hormone) <i class="fa fa-square-o mt-2"></i></div>
                <div class="font-bold text-center">Xạ (Radiation) <i class="fa fa-square-o mt-2"></i></div>
                <div class="font-bold text-center">Có thai (Pregnancy) <i class="fa fa-square-o mt-2"></i></div>
            </div>

            <div class="grid grid-cols-2 italic text-md">
                <div class="font-sans-Timenew leading-6">Kinh chót(Last Menstrual Period):<span class="font-bold pl-2">{{getbilltests['kinhchot']}}</span></div>
                <div class="text-center font-sans-Timenew leading-6">Ngày gửi (Date sent):<span class="font-bold">??</span></div>
            </div>
              <div class="grid grid-cols-2 italic text-md">
                <div class="font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2">{{getbilltests['diagnose']}}</span></div>
                <div class="font-sans-Timenew leading-6">Bs. Chỉ định(Physician):<span class="font-bold pl-2"> {{printDoctor['name']}}</span></div>
            </div>
        <div>
              <div class="text-center font-bold text-xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

              <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                  <div class="col-span-3 grid grid-cols-2" >

                     <div class="" v-for="eg1 in testElements" :key="eg1.id">
                      <span class="font-bold flex " v-if="eg1.element_group ==1">{{eg1.name}}
                        <span class="bg-yellow-200" v-if="selectedArray">
                          <span v-if="selectedArray['id'] == eg1.id">
                             <CheckIcon class="border-1 border-blue-500 align-middle  h-5 w-5 text-blue-500"/>
                          </span>
                        </span>
                        <span class="">
                            <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                        </span>
                      </span>
                    </div>
            </div>
              </div>

               <div class="grid grid-cols-1">
                    <div class="" v-for="eg2 in testElements" :key="eg2.id">
                        <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">- {{eg2.name}}
                         <span v-if="selectedArray">
                          <span v-if="selectedArray['id'] == eg2.id">
                            <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                          </span>
                        </span>
                        <span v-else>
                            <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                        </span>
                        </span>
                    </div>
                </div>
            <div class="flex flex-cols-5">
                <div class="" v-for="eg3 in testElements" :key="eg3.id">
                    <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                            <span v-if="selectedArray">
                          <span v-if="selectedArray['id'] == eg3.id">
                            <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                          </span>
                        </span>
                        <span v-else>
                            <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                        </span>
                    </span>
                </div>
            </div>
             <div class="grid grid-cols-1">
                <div class="" v-for="eg4 in testElements" :key="eg4.id">
                    <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg4.element_group == 4">- {{eg4.name}}
                      <span v-if="selectedArray">
                          <span v-if="selectedArray['id'] == eg4.id">
                            <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                          </span>
                        </span>
                      <span v-else>
                            <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                        </span>
                    </span>
                </div>
            </div>

              <div class="col-span-2">
                    <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                    <div class="grid grid-cols-2 leading-5 italic">
                      <div class="flex flex-col">
                         <div v-for="(eg5, i) in testElements" :key="i">
                            <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">{{eg5.name}}
                              <span v-if="selectedArray">
                                  <span v-if="selectedArray['id'] == eg5.id">
                                    <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                                  </span>
                                </span>
                                <span v-else>
                                  <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                                </span>
                          </span>
                  </div>
                      </div>
                      <div class="flex flex-col">
                        <div class="" v-for="(eg6, i) in testElements" :key="i">
                          <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                <span v-if="selectedArray">
                                    <span v-if="selectedArray['id'] == eg6.id">
                                      <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                                    </span>
                                  </span>
                                  <span v-else>
                                     <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                                  </span>
                            </span>
                        </div>
                      </div>

                    </div>
                </div>

              <div class="grid grid-cols-1 mt-2">
                  <div>
                    <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Tuyến</span>
                    <div class="flex flex-row leading-5">
                       <div v-for="eg7 in testElements" :key="eg7.id">
                         <div v-if="eg7.element_group == 7">
                          <span class="text-left font-bold text-xs ml-4 mr-6  font-sans-Timenew" >{{eg7.name}}
                              <span v-if="selectedArray">
                                <span v-if="selectedArray['id'] == eg7.id">
                                  <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                                </span>
                              </span>
                              <span v-else>
                                 <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                              </span>
                            </span>
                          </div>
                  </div>
                    </div>
                  </div>
              </div>

              <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-2">
                <div class="font-bold m-0 p-0">Đề nghị (Suggestions):</div>
                <div class="font-bold col-span-3">
                  <div class="flex">
                   <div  v-for="eg8 in testElements" :key="eg8.id">
                      <span class="font-bold text-xs w-full mr-3" v-if="eg8.element_group ==8 && eg8.element_group !==null ">{{eg8.name}}
                            <span v-if="selectedArray">
                              <span v-if="selectedArray['id'] == eg8.id">
                                <i class="py-1 mr-1 fa fa-check-square text-blue-800 "></i>
                              </span>
                            </span>
                            <span v-else>
                               <CheckIcon class="inline-block align-middle rounded-sm border-1 border-black  h-3 w-3 text-white"/>
                            </span>
                      </span>
                    </div>
                    </div>
                </div>

              </div>
              <div class="grid grid-cols-2 mt-2 text-center">
                  <div  class="text-center">
                    <img
                        class="w-80 max-h-48 "
                        :src="pathThinLeft"
                        :alt="LogoThin"/>
                      </div>
                  <div class="text-center">
                    <img
                        class="w-80 max-h-48 "
                        :src="pathThinRight"
                        :alt="LogoThin"/>
                    </div>

              </div> -->

              <div class="grid grid-cols-3">
                <div class="col-span-2">
                  <div class="grid grid-cols-1">
                    <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                    <span class="font-bold text-red-700 font-sans-Timenew text-xs uppercase">- Không tổn thương trong biểu mô hay ung thư</span>
                    <span class="font-bold text-md font-sans-Timenew">- Tế bào cổ tử cung biến đổi do viêm</span>
                  </div>
                </div>
                <div class="grid grid-cols-1 text-center">
                  <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả:</span>
                  <span class="mb-16 font-bold font-sans-Timenew text-md">BS/KTV đọc kết quả:</span>
                  <span class="font-bold font-sans-Timenew text-md">??</span>
                  <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
                  <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
                </div>

                </div>
        </div>
      </div>
       <div class="py-0">
                  <img
                    class="max-h-12 w-full"
                    :src="pathImageFooter"
                    :alt="LogoThin"
                  />
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

    },
    components:{
      BeakerIcon,
      CheckIcon
    },
    data(){
      return{
        pathImageTop:'/images/Logo/vigor.jpg',
        pathImageFooter:'/images/Logo/vigorFooter.jpg',
      }
    }
}
</script>