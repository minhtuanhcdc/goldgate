<template>
  <div id="printMe" ref="printMe" class="px-0 my-0">
        <div class="grid grid-cols-3 mt-0 mb-2 pb-2 align-middle border-b-2 border-gray-400">
            <div class="m-0 p-0 flex flex-wrap justify-end brightness-100" v-if="getbilltests.ousent"><img class="w-40 object object-end mt-0 pt-0 pr-4" :src="logoPath+getbilltests.ousent['logo']"></div>
            <div class="col-span-2">
                <p class="uppercase font-sans-Timenew font-bold text-xl" v-if="getbilltests.ousent">{{getbilltests.ousent['name']}}</p>
                <div class="grid grid-cols-8 text-xl">
                    <div class="font-bold font-sans-Timenew">Địa chỉ: </div>
                    <div class="col-span-7 text-left ml-0 pl-0 font-sans-Timenew">
                        <p class="" v-if="getbilltests.ousent">{{getbilltests.ousent['address']}}</p>

                    </div>
                </div>
                <div class="grid grid-cols-8 text-lg mt-1" style="line-height:80%">
                    <div class="font-bold font-sans-Timenew">Hostline:</div>
                    <div class="col-span-7 text-left ml-0 pl-0 font-sans-Timenew" >
                        <p class="" v-if="getbilltests.ousent">{{getbilltests.ousent['logo']}}</p>

                    </div>

                </div>

            </div>
        </div>

    <div class="text-center font-bold text-2xl font-sans-Timenew mt-2 text-red-600">
        <P>PHIẾU TRẢ KẾT QUẢ XÉT NGHỆM E6/E7 mRNA HPV</P>
        <P class="leading-3">(<span class="mt-0 pl-0">APTIMA</span> <span class="ml-0 pl-0" style="vertical-align: super; font-size:16px ; padding:0px">&reg;</span> HPV Assay)</P>
    </div>
    <!--INFOMATION OF PATIENT==================-->
    <div>{{}}</div>
      <div style="border:none;" class="pb-0 font-sans-Timenew mb-0 leading-3"><span class="text-red-600 uppercase  underline font-bold text-lg">1. Thông tin mẫu:</span><span class="text-md italic">(Information)</span></div>
    <table class="table mt-0">
        <tr>
            <td class="py-0" >
                <div class="grid grid-cols-4 font-sans-Timenew text-md  m-0 mt-1 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Tên Bệnh Nhân: </span>
                                <p class="leading-3 italic text-md">(Full Name)</p>
                            </div>
                            <div>
                                <span class="font-bold text-xl"> {{printCustommers['name']}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Giới tính: </span>
                                <p class="leading-3 italic text-sm">(Sex)</p>
                            </div>
                            <div>
                                <span class="font-bold"> "Nữ" </span>
                                <p class="leading-3 italic text-sm">Female</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Năm sinh: </span>
                                <p class="leading-3 italic text-sm">(Date of birth)</p>
                            </div>
                            <div>
                                <span class="font-bold"> {{printCustommers['birthday']}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl p-0 m-0" style="border:none !important">
                    <div class="col-span-4  leading-3">
                        <div class="flex flex-row ">
                            <div class="leading-5  py-1">
                                <span class="font-bold mr-2">Địa chỉ: </span>
                                <p class="leading-3 italic text-sm">(Address)</p>
                            </div>
                            <div>
                                <span class="font-bold text-xl">  {{printCustommers['address']}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl m-0 p-0" style="border:none !important">
                    <div class="col-span-2  py-1">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Bác sĩ điều trị: </span>
                                <p class="leading-3 italic text-sm">(Medical Doctor)</p>
                            </div>
                            <div>
                                <span class="font-bold text-xl" v-if="printDoctor"> {{printDoctor['name']}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="leading-5  py-1">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Ngày gửi: </span>
                                <p class="leading-3 italic text-sm">(Date of sending)</p>
                            </div>
                            <div>
                                <span class="font-bold">
                                     {{formatDate(getbilltests['date_receive']) }}
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="leading-5  py-1">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Khoa: </span>
                                <p class="leading-3 italic text-sm">(Depart)</p>
                            </div>
                            <div>
                                <span class="font-bold"> "....." </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl m-0 p-0" style="border:none !important">
                    <div class="col-span-2">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Yêu cầu xét nghiệm: </span>
                                <p class="leading-3 italic text-sm">(Test Requesting)</p>
                            </div>
                            <div>
                                <span class="font-bold"> "Định týp HPV" </span>
                                 <p class="leading-3 italic text-sm">(HPV Genotyping)</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Mã bệnh nhân: </span>
                                <p class="leading-3 italic text-sm">(Partient ID)</p>
                            </div>
                            <div>
                                <span class="font-bold"> "....."</span>

                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex flex-row">
                            <div>
                                <span class="font-bold mr-2">Mã XN: </span>
                                <p class="leading-3 italic text-sm">(Lab Barcode)</p>
                            </div>
                            <div>
                                <span class="font-bold"> {{getbilltests['hpv_code']}} </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="grid grid-cols-4 font-sans-Timenew text-xl mt-0 p-0 " >
                    <div class="col-span-4" style="border:none !important">
                        <div class="flex flex-row" style="border:none !important">
                            <div class="pt-1">
                                <span class="font-bold mr-2">Phương pháp: </span>
                                <p class="leading-3 italic text-sm">(Analytical Method)</p>
                            </div>
                            <div class="">
                                <span class="font-bold text-red-600 text-lg"> APTIMA <span style="vertical-align: super; font-size:16px ; padding:0px">&reg;</span> HPV Assay. Approved by the FDA  </span>
                            </div>
                        </div>
                    </div>

                </div>
            </td>
        </tr>
    </table>
     <!--==================-->
     <!--===========================================================================-->
      <div style="border:none;border:none !important" class="pb-0 font-sans-Timenew"><span class="text-red-600  uppercase  underline font-bold text-lg">2. KẾT QUẢ:</span><span class="text-md italic">(Reporting result)</span></div>
     <table class="font-sans-Timenew " style="">
        <tr class="bg-black"><td class=" text-white font-sans-Timenew font-bold text-center" colspan="4">14 HPV high-risk</td></tr>
        <tr class="bg-gray-300 font-sans-Timenew font-bold">
            <td class="border-1  border-gray-900 text-blue-700 text-center text-xl" colspan="2">S/CO sample value</td>
            <td class="border-1  border-gray-900 text-center text-xl" colspan="2">S/CO analyte</td>
        </tr>
        <tr class=" font-sans-Timenew border-1">
            <td class=" text-red-700 text-center align-middle font-bold border-1  border-gray-900" colspan="2" width="50%">
                <div v-for="(sco, i) in getbilltests.resulthpvs" :key="i">
                     <span v-if="sco.element_id == 56" class="text-lg">{{sco.result}}</span>
                </div>
            </td>
            <td class="border-1  border-gray-900  text-center" colspan="2">
                <div class="text-left">
                    <span class=" mr-2 text-lg">Âm tính nếu <span class="ml-10">&lt;</span> 0.5 </span>
                    <p class="leading-3 italic text-md">(Negative)</p>
                </div>
                <div class="text-left">
                    <span class=" mr-2 text-lg">Dương tính nếu <span class="ml-4">&ge;</span> 0.5 </span>
                    <p class="leading-3 italic text-md">(Positive)</p>
                </div>
            </td>

        </tr>
        <tr class=" font-sans-Timenew ">
            <td class="border-1 border-gray-900" width="50%" colspan="2">
                <span class="mr-2 text-lg font-bold">Kết quả HPV </span>
                    <p class="leading-3 italic text-md">(HPV result)</p>
            </td>
            <td class=" border-1 border-gray-900 text-center" colspan="2">
                <div class="text-left ">
                    <div v-for="(sco, i) in getbilltests.resulthpvs" :key="i">
                        <div v-if="sco.element_id == 56">
                           <div v-if="sco.result >= 0.5">
                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                <p class="leading-3 italic text-md">(Positive)</p>
                           </div>
                           <div v-else>
                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                <p class="leading-3 italic text-md">(Negative)</p>
                           </div>
                        </div>
                    </div>

                </div>
            </td>
        </tr>
     </table>
    <div  class="pb-0 font-sans-Timenew mb-0 mt-3"><span class="text-red-600  uppercase  underline font-bold text-lg">3. KẾT Luận:</span><span class="text-md italic">(Reporting result)</span></div>

    <div v-for="(sco2, i) in getbilltests.resulthpvs" :key="i" class="mb-2 mt-0">
            <div v-if="sco2.element_id == 59">
                <div v-if="sco2.result >= 0.5">
                    <table>
                        <tr class="bg-black"><td class=" text-white font-sans-Timenew font-bold text-center border-1 border-gray-900" colspan="4">GT HPV 16, 18/45</td></tr>
                        <tr class="bg-gray-300 font-sans-Timenew font-bold">
                            <td class=" text-blue-700 text-center text-xl border-1 border-gray-900" width="25%">
                                <span>S/CO HPV 16 </span>
                                <p>sample value </p>
                            </td>
                            <td class=" text-center text-xl border-1 border-gray-900" width="25%">
                                <span>S/CO HPV 16 </span>
                                <p>analyte </p>
                            </td>
                            <td class="border-1 border-gray-900 text-blue-700 text-center text-xl" width="25%">
                                <span>S/CO HPV 18/45 </span>
                                <p>sample value </p>
                            </td>
                            <td class=" text-center text-xl border-1 border-gray-900" width="25%">
                                <span>S/CO HPV 18/45</span>
                                <p>analyte </p>
                            </td>
                        </tr>
                        <tr class=" font-sans-Timenew">
                            <td class="  text-center align-middle font-bold border-1 border-gray-900">
                                <div v-for="(sco16, i) in getbilltests.resulthpvs" :key="i">
                                    <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result>=1">
                                            <span  class="text-red-700 text-xl">{{sco16.result}}</span>
                                        </div>
                                        <div v-else>
                                                 <span  class="text-blue-700 text-xl">{{sco16.result}}</span>
                                        </div>

                                    </div>
                                </div>
                                </td>
                            <td class="  text-center border-1 border-gray-900">
                                <div class="text-left">
                                    <span class=" mr-2 text-lg">Âm tính nếu <span class="ml-10">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Negative)</p>
                                </div>
                                <div class="text-left">
                                    <span class=" mr-2 text-lg">Dương tính nếu <span class="ml-4">&ge;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Positive)</p>
                                </div>
                            </td>
                            <td class="text-center align-middle font-bold border-1 border-gray-900">
                                 <div v-for="(sco18, i) in getbilltests.resulthpvs" :key="i">
                                    <div v-if="sco18.element_id == 58">
                                        <div v-if="sco18.result>=1">
                                            <span  class="text-red-700 text-xl">{{sco18.result}}</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-xl">{{sco18.result}}</span>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td class="  text-center border-1 border-gray-900">
                                <div class="text-left">
                                    <span class=" mr-2 text-lg">Âm tính nếu <span class="ml-10">&lt;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Negative)</p>
                                </div>
                                <div class="text-left">
                                    <span class=" mr-2 text-lg">Dương tính nếu <span class="ml-4">&ge;</span> 1.00 </span>
                                    <p class="leading-3 italic text-md">(Positive)</p>
                                </div>
                            </td>

                        </tr>
                        <tr class=" font-sans-Timenew ">
                            <td class="border-1 border-gray-900">
                                <span class=" mr-2 text-lg font-bold">Kết quả HPV 16 </span>
                                    <p class="leading-3 italic text-md">(HPV 16 result)</p></td>
                            <td class="  text-center border-1 border-gray-900">
                                 <div class="text-left ">
                                    <div v-for="(sco16, i) in getbilltests.resulthpvs" :key="i">
                                        <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result >= 1">
                                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                                <p class="leading-3 italic text-md">(Positive)</p>
                                        </div>
                                        <div v-else>
                                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                                <p class="leading-3 italic text-md">(Negative)</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border-1 border-gray-900">
                                <span class="font-bold mr-2 text-lg">Kết quả HPV 18/45 </span>
                                    <p class="leading-3 italic text-md">(HPV 18/45result)</p></td>
                            <td class="  text-center border-1 border-gray-900">
                                <div class="text-left ">
                                    <div v-for="(sco18, i) in getbilltests.resulthpvs" :key="i">
                                        <div v-if="sco18.element_id == 58">
                                        <div v-if="sco18.result >= 1">
                                                <span class=" mr-2 text-lg font-bold text-red-700">Dương tính </span>
                                                <p class="leading-3 italic text-md">(Positive)</p>
                                        </div>
                                        <div v-else>
                                                <span class=" mr-2 text-lg text-blue-600 font-bold">Âm tính </span>
                                                <p class="leading-3 italic text-md">(Negative)</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>
                <div v-else>
                     <table class="font-sans-Timenew table" >
                        <tr class="bg-gray-300 font-sans-Timenew ">
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-xl" colspan="2">11 Orther HPV High-Risk</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-xl" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-xl" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900" style="">
                            <td class="font-bold text-red-700 text-center   border-black border-1 text-lg" colspan="2" width="" >Dương tính (Positive)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" width="" >Âm tính (Negative)</td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >Âm tính (Negative)</td>
                        </tr>

                    </table>
                </div>
        </div>
    </div>
    <div v-for="(sco2, i) in getbilltests.results" :key="i" class="mb-2 mt-0">
            <div v-if="sco2.element_id == 59">
                <div v-if="sco2.result >= 0.5">
                    <table class="font-sans-Timenew" >
                        <tr class="bg-gray-300 font-sans-Timenew border-1 border-gray-900">
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-xl" colspan="2">Genotype HPV 16</td>
                            <td class=" bg-gray-300 text-center font-bold border-black border-1 text-xl" colspan="2">Genotype HPV 18/45</td>
                        </tr>
                        <tr class=" font-sans-Timenew border-1 border-gray-900 " style="">
                            <td class="font-bold text-red-600 text-center  border-black border-1" colspan="2" width="50%" >
                                <div v-for="(sco16, i) in getbilltests.results" :key="i">
                                    <div v-if="sco16.element_id == 57">
                                        <div v-if="sco16.result>=1">
                                            <span  class="text-red-700 text-xl">Dương tính (Positive)</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-xl">Âm tính (Negative)</span>
                                        </div>

                                    </div>
                                    </div>
                            </td>
                            <td class="font-bold text-blue-600 text-center  border-black border-1" colspan="2" >
                                <div v-for="(sco18, i) in getbilltests.results" :key="i">
                                    <div v-if="sco18.element_id == 58">
                                        <div v-if="sco18.result>=1">
                                            <span  class="text-red-700 text-xl">Dương tính (Positive)</span>
                                        </div>
                                        <div v-else>
                                            <span  class="text-blue-700 text-xl">Âm tính (Negative)</span>
                                        </div>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div v-else>

                </div>
            </div>
    </div>
    <table class="font-sans-Timenew table" >
                        <tr class=" font-sans-Timenew">
                            <td class="text-center font-bold" colspan="2"  style="border:none !important" width="50%"></td>
                            <td class=" text-center " colspan="2"  style="border:none !important">
                                <p class="italic leading-3 text-lg" style="border:none">Ngày (date): <span>{{currentDate}}</span></p>
                                <p class="leading-3 text-lg font-bold" style="margin-bottom:80px; border:none">Trưởng Khoa GPB</p>
                                <span class="text-xl font-bold" style=" border:none">ThS. BS. HUỲNH GIANG CHÂU</span>
                            </td>
                        </tr>
    </table>
    </div>

</template>

<script>
import Table from '../../Components/Table.vue'
import moment from 'moment'
export default {
  components: { Table },
    props:{
        getbilltests:Object,
        printCustommers:Object,
        printAddress:'',
        printOutsent:'',
        printDoctor:'',
        selectedArray:'',
        testElements:'',
        logo:'',
        pathLogo:'',
        currentDate:'',

    },
    computed:{
        getSCo(){
            return this.sco.result
        }
    },

    data(){
        return{
            logoPath:'/storage/Image_Ousent/',
        }
    },
    methods:{
        formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY')}
    }
    }

    }


</script>

<style>

</style>