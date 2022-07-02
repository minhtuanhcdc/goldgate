<template>

 <div class="" v-for="(td,i) in getbilltests" :key="i">

                      <div class="grid grid-cols-8 mx-0 py-0">
                          <div class="col-span-2 py-0">
                              <img
                                class="w-36"
                                :src="pathImageLeft"
                                :alt="LogoThin"
                              />
                          </div>
                          <div class="col-span-4 text-center mt-2">
                              <div class="pt-0 py-0 place-items-center flex flex-col">
                                    <div class="text-center font-bold text-lg font-sans-Timenew ">PHIẾU XÉT NGHIỆM TẾ BÀO</div>
                                    <div>
                                      <span class="text-center font-bold text-lg font-sans-Timenew ml-0 pl-0">PAP'S SMEAR - ThinPrep</span>
                                      <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>
                                    </div>
                                    <div class="text-center font-bold text-sm font-sans-Timenew ">REQUEST FOR COLLECTION OF SPECIMEN</div>
                                </div>
                          </div>
                          <div class="col-span-2 text-right text-italy text-sm font-bold font-sans-Timenew  mt-8 w-full">
                                <span class="p-0 m-0 w-full text-xs">Số(Number):{{td.thinprep_code}}</span>

                          </div>
                      </div>
                        <div class="grid grid-cols-4 leading-6 text-md">
                              <div class="col-span-2 font-sans-Timenew italic">Họ và tên (Name):<span class=" font-bold">{{td.custommer.name}}</span></div>
                              <div class="  font-sans-Timenew italic">Tuổi (Age):<span class="pl-2 font-bold">{{td.custommer.birthday}}</span></div>
                              <div class="  font-sans-Timenew italic">Para: <span class="pl-2 font-bold">{{td.para}}</span></div>
                          </div>
                          <div class="grid grid-cols-4 text-md">
                              <div class="col-span-3 font-sans-Timenew leading-6 italic">Đia chỉ(Address):<span class="pl-2 font-bold">{{td.custommer.address}}</span></div>
                              <div class=" font-sans-Timenew leading-6 italic">Điện thoại:<span class="pl-2 font-bold">{{td.custommer.phone}}</span></div>
                          </div>
                          <div class="font-sans-Timenew leading-6 italic text-md">Đơn vị gửi(Custommer):<span class="pl-2 font-bold">{{td.ousent.name}}</span></div>
                          <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic">
                              <div class="font-bold text-xs">IUD (Intra-Uterine Devices) <i class="text-lg fa fa-square-o mt-2"></i></div>
                              <div class="font-bold text-xs">Nội tiết (Hormone) <i class="fa fa-square-o mt-2"></i></div>
                              <div class="font-bold text-xs">Xạ (Radiation) <i class="fa fa-square-o mt-2"></i></div>
                              <div class="font-bold text-xs">Có thai (Pregnancy) <i class="fa fa-square-o mt-2"></i></div>
                          </div>
                          <div class="grid grid-cols-2 italic text-md">
                              <div class="font-sans-Timenew leading-6">Kinh chót(Last Menstrual Period):<span class="font-bold pl-2">{{td.kinhchot}}</span></div>
                              <div class="text-center font-sans-Timenew leading-6">Ngày gửi (Date sent):<span class="font-bold">{{formatDate(td.date_sent)}}</span></div>
                          </div>
                            <div class="grid grid-cols-2 italic text-md">
                              <div class="font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnose):<span class="font-bold pl-2">{{td.diagnose}}</span></div>
                              <div class="font-sans-Timenew leading-6">Bs. Chỉ định(Physician):<span class="font-bold pl-2" v-if="printDoctor"> {{td.doctor.name}}</span></div>
                          </div>
                      <div>
                          <div class="text-center font-bold text-md font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
                            <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                              <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                                <div class="col-span-3 grid grid-cols-2" >
                                  <div class="" v-for="eg1 in testElements" :key="eg1.id">
                                    <div class="font-bold " v-if="eg1.element_group == 1">{{eg1.name}}
                                      <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg1.id === x) !== -1" />
                                    </div>
                                  </div>
                            </div>
                            </div>
                            <div class="grid grid-cols-1">
                                  <div class="" v-for="eg2 in testElements" :key="eg2.id">
                                      <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">
                                        <span>- {{eg2.name}}</span>
                                       <input type="checkbox" disabled class="ml-1 text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg2.id === x) !== -1" />
                                      </div>
                                  </div>
                              </div>
                          <div class="flex flex-cols-5">
                              <div class="" v-for="eg3 in testElements" :key="eg3.id">
                                  <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                                     <input type="checkbox" disabled class="text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg3.id === x) !== -1" />
                                  </span>
                              </div>
                          </div>
                          <div class="grid grid-cols-1">
                              <div class="" v-for="eg4 in testElements" :key="eg4.id">
                                  <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg4.element_group == 4">+ {{eg4.name}}
                                     <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg4.id === x) !== -1" />
                                  </span>
                              </div>
                          </div>

                            <div class="col-span-2">
                                  <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                                  <div class="grid grid-cols-2 leading-5 italic">
                                    <div class="flex flex-col">
                                       <div class="" v-for="eg5 in testElements" :key="eg5.id">
                                      <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">{{eg5.name}}
                                           <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg5.id === x) !== -1" />
                                        </span>
                                </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="" v-for="eg6 in testElements" :key="eg6.id">
                                        <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                            <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg6.id === x) !== -1" />
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
                                            <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg7.id === x) !== -1" />
                                          </span>
                                        </div>
                                </div>
                                  </div>
                                </div>
                            </div>
                  <div class="font-bold mt-2 p-0 font-sans-Timenew">Đề nghị (Suggestions):</div>
                            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-0">
                              <div class="font-bold col-span-4">
                                <div class="flex flex-rows-2">
                                <div  v-for="eg8 in testElements" :key="eg8.id">
                                    <span class="font-bold text-xs w-full mr-3" v-if="eg8.element_group ==8 && eg8.element_group !==null ">{{eg8.name}}
                                            <input type="checkbox" disabled class="form-checkbox text-blue-800 h-3 w-3" :checked="td.results.map((x) =>+x.element_id).findIndex((x) => eg8.id === x) !== -1" />

                                    </span>
                                  </div>
                                  </div>
                              </div>
                            </div>
                            <div class="grid grid-cols-2 mt-2 text-center">
                                <div  class="text-center flex justify-center">
                                  <img v-if="td.thinprep_code"
                                      class="w-72 max-h-48 "
                                      :src="pathThinLeft+td.image_left.thinLeft"
                                      :alt="td.thinprep_code"/>

                                   <img v-else
                                      class="w-72 max-h-48 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>

                                  </div>
                               <div  class="text-center flex items-center">
                                  <img  v-if="td.thinprep_code"
                                      class="w-72 max-h-48 "
                                      :src="pathThinRight+td.image_left.thinRight"
                                      :alt="LogoThin"/>

                                       <img v-else
                                      class="w-72 max-h-48 "
                                      :src="pathImageLeft"
                                      alt="imageThinLeft"/>
                                </div>
                            </div>
                            <div class="grid grid-cols-3">
                              <div class="col-span-2">
                                <div class="grid grid-cols-1">
                                  <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
                                 <div  v-for="eg9 in testElements" :key="eg9.id">
                                    <span class="font-bold text-xs w-full mr-2" v-if="eg9.element_group ==9 && eg9.element_group !==null ">
                                      <span class="uppercase text-red-800 font-sans-Timenew text-lg pl-2 m-0" style="line-heigh:30%" v-if="td.results">
                                           {{td.results.find((result) => result.element_id === "26").result}}
                                        </span>

                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="grid grid-cols-1 text-center">
                                <span class="font-bold font-sans-Timenew text-md">Ngày đọc kết quả: {{currentDate}}</span>
                                <span class="mb-16 font-bold font-sans-Timenew text-md" style="margin-bottom:60px">BS/KTV đọc kết quả:</span>
                                <span class="font-bold font-sans-Timenew text-md" v-if="printDoctor">{{printDoctor['name']}}</span>
                                <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
                                <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
                              </div>
                            </div>
                        </div>
                        <div class="page-break"></div>
  </div>

</template>

<script>
import { CheckIcon } from '@heroicons/vue/solid'
import moment from 'moment'
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
        currentDate:'',


    },
    components:{
      CheckIcon
    },
    data(){
      return{
      test:[1, 2,3,4,5,6,7],

      }
    },
     methods:{

    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    },


  }
}
</script>