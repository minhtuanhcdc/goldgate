<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>

        <div class="text-right text-red-600 " v-if="errors">
            <p v-for="(er,i) in errors" :key="i">
              {{er}}
            </p>
        </div>
      <div class="grid grid-cols-1 mb-2">
        <div class="flex flex-1 justify-between">

            <button  class="cursor-pointe bg-blue-600 px-2 py-1 rounded-md hover:bg-blue-800 hover:text-gray-900 h-8 text-white"   @click="addCustommer">+ Add</button>
            <div class="flex flex-row">
             <a :href="route('downloadPDF',checkPrint)" class="bg-green-800 py-1 px-2 rounded-md text-white cursor-pointer h-8" target="blank" >Print PDF <span class="text-xs m-0 ">({{checkPrint?checkPrint.length:0}})</span></a>
            <button  class="ml-2 bg-green-600 px-2 py-0 rounded-md float-right cursor-pointer h-8 text-white">Export EXCEL<span class="text-xs ml-1">(1)</span></button>
            </div>

        <div class="flex flex-row border-solid border-1 border-gray-300 py-0 bg-green-200 h-8">

           <form @submit.prevent="submitFile">
             <div class="flex flex-row">
                <div>
                    <input type="file"
                      class="w-full px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                      @change="previewImage" ref="photo"/>
                </div>
                <div class="flex items-center mt-0">
                    <button class="px-2 py-1 text-white bg-gray-900 rounded " >Upload</button>
                </div>
              </div>
            </form>

        </div>
        </div>
      </div>
        <!---/////==================------->
        <!---==================------->
        <hr class="mb-2">
      <div class="grid grid-cols-7">
        <div class="col-span-2 ">
          <div class="flex flex-row">
              <div class="">
                    <span>ĐV gửi mẫu:</span>
                </div>
              <div class="col-span-2 w-52">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="ousentFill"
                      >
                        <option value="all">All</option>
                        <option
                          v-for="(ous,i) in ousents"
                          :key="i"
                          :value="ous.id"
                        >
                          {{ ous.name }}
                        </option>
                    </select>
              </div>
            </div>
        </div>
        <div class="col-span-2  mx-2">
          <div class="flex flex-grow">
            <div class="">
                  <span>BS đọc KQ(ĐV đọc KQ):</span>
                </div>
              <div class="col-span-2 w-52">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="readcodeFill"
                      >
                        <option value="all">All</option>
                        <option
                          v-for="(rcd,i) in readcodes"
                          :key="i"
                          :value="rcd.read_code"
                        >
                          {{ rcd.name }} ({{rcd.read_code}})
                        </option>
                    </select>
              </div>
              </div>
          </div>
        <div class="col-span-2">
          <div class="flex flex-row">
              <div class="flex flex-row">
                  <span>Từ:</span>

                      <div class="flex flex-row">

                          <jet-input
                          id="startDate"
                          type="date"
                          class="h-8 block w-full"
                          v-model="startDate"
                          autocomplete="startDate"/>
                      </div>

                </div>
              <div class="flex flex-row ml-2">
                  <span>Đến:</span>

                                  <jet-input
                                    id="endDate"
                                    type="date"
                                    class= "h-8 block w-full"
                                    v-model="endDate"
                                    autocomplete="endDate"
                                  />


              </div>
          </div>
        </div>
      <div class="col-span-1 text-right">
            <button @click="getPageFill" class="px-4 ml-2 py-2 justify-auto text-white font-bold bg-blue-400 rounded-md text-sm h-8">
                Fill
            </button>
            <button @click="refreshFill" class="px-2 mx-2 py-2 justify-auto text-white font-bold bg-yellow-400 rounded-md text-sm h-8">
                Refresh
            </button>
          </div>
      </div>
      <hr class="mt-2">
      <!---==================------->
      <div class="grid grid-cols-5 mt-2 my-1">
        <div>
        </div>
        <div></div>
        <div></div>
        <div class=" bg-blue-100">
              <div class=" text-right">
                <div class="flex mb-2 text-right h-8 px-2">
                            <jet-input
                              required
                              id="search"
                              type="text"
                              class="mt-1 block w-full h-8 mr-2"
                              autocomplete="search"
                              v-model="elementSearch"
                            />
                        <span class="justify-center justify-items-center mt-2 cursor-pointer">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                        </span>
                  </div>
                </div>
          </div>
        <div class="">
         <div class="p-0 text-right rounded-sm">
                <div class="flex flex-row justify-end">
                        <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="perPage:" />
                        <select
                          name="perPage"
                          id="perPage"
                          class="block py-0 w-24 form-input h-8 rounded-lg"
                          v-model="perPage"
                          @change="getfilePerpage"
                        >
                          <option value="1">1</option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="all">All</option>
                        </select>

                </div>
                </div>
          </div>
      </div>
      <!---//////////==================------->
      <Table :headers="headers" :addClass="addClass" id="exportMe">
          <tr class="hover:bg-gray-300 " v-for="(bill,i) in billtests.data" :key="i">
             <td><input type="checkbox" :value="bill.id" v-model="checkPrint"></td>
            <td class="border-r-2 text-center">{{bill.id}}</td>
             <td class="border-r-2">{{bill.custommer.name}}</td>
             <td class="border-r-2">
               <span v-if="bill.custommer.gender==0">Nữ</span>
               <span v-else>Nam</span>
               </td>
             <td class="border-r-2">{{bill.custommer.birthday}}</td>
              <td class="border-r-2 text-center">
                <span v-if="bill.custommer">{{bill.custommer.address}}</span>
                <span v-if="bill.custommer.district">{{bill.custommer.district.name}}</span>
                <span v-if="bill.custommer.province">{{bill.custommer.province.title}}. {{bill.custommer.province.name}}</span>
              </td>
            <td class="border-r-2 text-center" v-if="bill.phone!==null">{{bill.custommer.phone}}</td>
            <td class="border-r-2 text-center" v-else></td>
            <td class="border-r-2 text-center" >
              <span class="text-green-800 font-bold" v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
              </td>
              <td class="border-r-2 text-center">{{bill.thinprep_code}}</td>
              <td class="border-r-2 text-center">{{bill.hpv_code}}</td>
             <td class="border-r-2" ><span v-if="bill.doctor">{{bill.doctor.title}} {{bill.doctor.name}}</span></td>
            <td class="border-r-2" ><span v-if="bill.ousent">{{bill.ousent.name}}</span></td>
            <td class="border-r-2 text-center" ><span class="text-center">

                {{formatDate(bill.date_receive) }}
              </span></td>
            <td class="border-r-2" ><span>{{bill.read_code}}</span></td>
            <td class="border-r-2" >
              <span v-for="(rs,i) in bill.results" :key="i">
                <span v-if="rs.element_id ==26" class="text-red-600">
                    {{rs.result}},
                </span>
              </span>
            </td>

            <!-- <td class="text-center border-r-2">
                <EditBtn
                  title="View"
                  class="text-green-800"
                  v-if="bill.result_status == 1"
                  >
                 <svg
                  class="w-6 h-6 text-blue-800"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                  ></path>
                </svg>
                </EditBtn>
               <EditBtn
               v-else
                  title="View"
                  class="text-green-800">
              <svg
                class="w-6 h-6 text-gray-200"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
              </EditBtn>
            </td> -->
             <td class="border-r-2">{{bill.userupdate_id}}</td>
            <td class="border-r-2 w-32">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Print"
                  class="text-gray-600"
                    @click="printResult(bill)">
                 <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                  </svg>
                </EditBtn>
                <EditBtn
                  title="Edit"
                  class="text-blue-800"
                  @click="editCustommer(bill)"
                  >
                  <PencilIcon class="w-6 h-6"/>
                </EditBtn>
                <DeleteBtn
                  :url="route('custommers.destroy', bill.id )"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="el"
                />
              </div>
            </td>
          </tr>
      </Table>
         <div class="mt-4">
          <div class="flex">
              <Pagination :links="billtests.links"/>
          </div>
          </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
             <template v-slot:title >
               <div class="flex justify-between text-bold text-xl">
                <h3 v-show="!editMode">Add Bệnh Nhân </h3>
                <h3 v-show="editMode">Chỉnh sửa thông tin Bệnh nhân</h3>
                <button  @click.prevent="closeModal" class="text-white text-lg bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-1 pb-0 scrollable" :ref="'aKeyValue'" >
                   <form
                    class="py-0 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveCustommer(form)">
                    <div class="grid grid-cols-1">
                <!----Info Custommer================================================----->
                    <div class="bg-gray-100 p-2 border-solid border-2 border-blue-500 rounded-md">
                      <div class="w-full flex flex-row place-content-between">
                        <span class="text-gray-400 underline">Info Custommer</span>
                        <span v-show="editMode"  class="text-white  bg-blue-600 px-2 py-0 rounded-md cursor-pointer" @click="updateCustommer(form)">Update</span>
                      </div>
                      <div class="ml-4 grid grid-cols-4">
                              <div  class=" col-span-3 mr-2 h-8">
                                  <div class="grid grid-cols-4">
                                      <div class="col-span-1 pr-2 h-8">
                                        <!-- <jet-label for="name" class="text-right pr-1 text-bold text-lg text-blue-800 w-full" value="Tên bệnh nhân (name):" /> -->
                                       <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 h-6 leading-3">Tên bệnh nhân <span class=" h-8 m-0 font-normal text-base font-italic text-gray-400">(name)</span></div>
                                      </div>
                                  <div class="col-span-3">
                                    <jet-input
                                      id="name"
                                      type="text"
                                      class="mt-1 block w-full h-8"
                                      v-model="form.name"
                                      autocomplete="name"/>
                                  </div>
                                  </div>
                              </div>
                                <div class="">
                                  <div class="grid grid-cols-4">
                                     <div class="col-span-2 text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3"> Giới tính <span class="m-0 font-normal text-base font-italic text-gray-400">(gender)</span></div>
                                    <div class=" border-gray-300 rounded-md h-8 px-1 col-span-2 leading-4">
                                      <input :checked="true" type="radio" id="female" value="0" v-model="form.gender">
                                      <label for="one" class="ml-2">Nữ</label>
                                      <br>
                                      <input type="radio" id="man" value="1" v-model="form.gender">
                                      <label for="two" class="ml-2">Nam</label>
                                    </div>

                                  </div>
                                </div>
                          </div>
                      <div class="mt-2 ml-4 grid grid-cols-4">
                              <div  class="col-span-2 mr-2">
                                  <div class="grid grid-cols-4">
                                      <div class="">
                                          <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Năm sinh <span class="m-0 font-normal text-base font-italic text-gray-400">(Birthday )</span></div>
                                      </div>
                                  <div class="col-span-3">
                                      <jet-input

                                      validation="bail|required|number|between:1,2,value"
                                      id="birthday"
                                      type="text"
                                      class="mt-1 block w-full h-8"
                                      v-model="form.birthday"
                                      autocomplete="birthday"
                                    />
                                  </div>
                                  </div>
                              </div>
                              <div  class="col-span-2 mr-2">
                                  <div class="grid grid-cols-4">
                                      <div class="">
                                          <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Điện thoại <span class="m-0 font-normal text-base font-italic text-gray-400">(Phone )</span></div>
                                      </div>
                                  <div class="col-span-3">
                                      <jet-input

                                      id="birthday"
                                      type="text"
                                      class="mt-1 block w-full h-8"
                                      v-model="form.phone"
                                      autocomplete="birthday"
                                    />
                                  </div>
                                  </div>
                              </div>
                          </div>
                          <!---Address ====================================---->
                      <div class="mt-2 mr-4 grid grid-cols-1">
                            <div class="grid grid-cols-5">
                                      <div class="">
                                          <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Địa chỉ <span class="m-0 font-normal text-base font-italic text-gray-400">(Address)</span></div>
                                      </div>
                                  <div class="col-span-4">
                                      <jet-input
                                      required
                                      id="address"
                                      type="text"
                                      class="mt-1 block w-full h-8"
                                      v-model="form.address"
                                      autocomplete="address"
                                    />
                                  </div>
                            </div>
                      </div>
                      <div class="mt-2 ml-4 grid grid-cols-3">
                             <div class="">
                               <div class="grid grid-cols-5 mr-2">
                                    <div class="col-span-2">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Tỉnh/thành <span class="m-0 font-normal text-base font-italic text-gray-400">(Province)</span></div>
                                    </div>
                                    <div class="col-span-3">
                                          <select
                                            id="Province"
                                            class="block w-full form-input rounded-lg h-8 py-1"
                                            v-model="form.province_id">
                                            <option v-for="(pce, i) in provinces" :key="i" :value="pce.code">{{pce.name}}</option>
                                          </select>
                                    </div>
                                </div>
                             </div>
                             <div class="">
                               <div class="grid grid-cols-5 mr-2">
                                    <div class="col-span-2">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Quận/Huyện <span class="m-0 font-normal text-base font-italic text-gray-400">(District)</span></div>
                                    </div>
                                    <div class="col-span-3">
                                          <select
                                            name="district"
                                            id="district"
                                            class="block w-full form-input rounded-lg h-8 py-1"
                                            v-model="form.district_id">
                                            <option value="">--</option>
                                            <option v-for="(dst, i) in getdistricts" :key="i" :value="dst.code">{{dst.name}}</option>
                                          </select>
                                    </div>
                                </div>
                             </div>
                             <div class="">
                               <div class="grid grid-cols-5 mr-2">
                                    <div class="col-span-2">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Phường/Xã <span class="m-0 font-normal text-base font-italic text-gray-400">(Ward)</span></div>
                                    </div>
                                    <div class="col-span-3">
                                          <select
                                            name="ward"
                                            id="ward"
                                            class="block w-full form-input rounded-lg h-8 py-1"
                                            v-model="form.ward_id">
                                            <option value="12">--</option>
                                            <option v-for="(wd, i) in getwards" :key="i" :value="wd.id">{{wd.name}}</option>
                                          </select>
                                    </div>
                                </div>
                             </div>

                      </div>
                           <!---/Address ====================================---->
                    </div>
                  <!----/Info Custommer======================== grid========================----->
                <!----Info Indication OU================================================----->
                      <div class="mt-1 bg-gray-200 p-2 border-solid border-2 border-blue-500 rounded-md">
                         <div class="w-full flex flex-row place-content-between">
                          <span class="text-gray-400 underline">Thông tin ĐV gửi:</span>
                          <span v-show="editMode"  class="text-white  bg-blue-600 px-2 py-0 rounded-md cursor-pointer" @click="updateBill(form)">Update</span>
                          </div>

                        <div class="ml-4 grid grid-cols-2">
                             <div>
                                 <div class="mt-2 flex flex-row">
                                    <div class="w-48">
                                        <div class="text-left pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Đơn vị gửi mẫu: <span class="m-0 font-normal text-base font-italic text-gray-400">(Ousent)</span></div>
                                    </div>
                                    <div class="w-full">
                                         <select
                                          name="ou"
                                          id="ou"
                                          class="block py-1 w-full form-input rounded-lg ml-1 h-8"
                                          v-model="form.ousent_id">
                                      <option value="">--</option>
                                      <option v-for="(ou,i) in getOusents" :key="i" :value="ou.id">{{ou.name}}</option>
                                    </select>
                                    </div>
                                  </div>
                             </div>
                             <div>
                                <div class="mt-2 flex flex-row">
                                    <div class="w-52 pl-3 py-0">
                                        <div class="py-0 text-center pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Bác sỹ chỉ định: <span class="m-0 p-0 font-normal text-base font-italic text-gray-400">(doctor)</span></div>
                                    </div>
                                    <div class="w-full">
                                         <select
                                          name="doctor_id"
                                          id="doctor_id"
                                          class="block form-input rounded-lg w-full h-8 py-1"
                                          v-model="form.doctor_id">
                                      <option value="">--</option>
                                      <option v-for="(dot, i) in getdoctors" :key="i" :value="dot.id" class="text-lg">{{dot.name}} ({{dot.ousent.name}})</option>
                                    </select>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class=" grid grid-cols-1">

                                 <div class="mt-2 flex flex-row ml-0">
                                    <div class="w-48">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Chỉ định XN: <span class="m-0 font-normal text-base font-italic text-gray-400">(diagonose)</span></div>
                                    </div>
                                    <div class="w-full">

                                       <Multiselect
                                       class="rounded-sm h-6"
                                        v-model="form.testname_id"
                                         v-bind="example4"
                                        selected>
                                      </Multiselect>
                                    </div>
                                  </div>

                        </div>
                        <div class="ml-0 grid grid-cols-1">
                             <div>
                                 <div class="mt-2 flex flex-row">
                                    <div class="w-48">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Chẩn đoán: <span class="m-0 font-normal text-base font-italic text-gray-400">(diagonose)</span></div>
                                    </div>
                                    <div class="w-full">
                                       <jet-input

                                        id="diagonose"
                                        type="text"
                                        class="mt-1 block w-full h-8"
                                        v-model="form.diagnose"
                                        autocomplete="diagonose"
                                      />
                                    </div>
                                  </div>
                             </div>

                        </div>
                        <div class="ml-4 grid grid-cols-2">
                             <div>
                                 <div class="mt-2 flex flex-row">
                                    <div class="w-48">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Para: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                                    </div>
                                    <div class="w-full">
                                       <jet-input

                                        id="para"
                                        type="text"
                                        class="mt-1 block w-full h-8"
                                        v-model="form.para"
                                        autocomplete="para"
                                      />
                                    </div>
                                  </div>
                             </div>
                             <div>
                                 <div class="mt-2 flex flex-row">
                                    <div class="w-48">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Kinhcuoi: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                                    </div>
                                    <div class="w-full">
                                       <jet-input

                                        id="king"
                                        type="text"
                                        class="mt-1 block w-full h-8"
                                        v-model="form.kinhchot"
                                        autocomplete="king"
                                      />
                                    </div>
                                  </div>
                             </div>
                        </div>
                         <div class="ml-2 flex flex-row">
                              <div class="mt-2 w-1/2">
                                <div class="flex flex-row">
                                <jet-label for="sample_id" class="self-center text-right pr-1 text-bold text-lg text-blue-800 w-48 leading-3" value="Mã XN ĐV gửi:" />
                                <jet-input
                                  id="sample_code"
                                  type="text"
                                  class="mt-1 block w-full h-8"
                                  v-model="form.sample_code"
                                  autocomplete="sample_code"
                                />
                                </div>
                            </div>
                          <div class="w-1/2">

                              <div class="mt-2">
                                <div class="flex flex-row">
                                <jet-label for="date_re" class="self-center text-right pr-1 text-bold text-lg text-blue-800 w-48" value="Ngày lấy mẫu:" />
                                <jet-input

                                  id="date_ou"
                                  type="datetime-local"
                                  class="mt-1 block w-3/4"
                                  v-model="form.date_ou"
                                  autocomplete="date_re"
                                />
                                </div>
                          </div>
                          </div>
                        </div>

                  <!----/Info Indication OU================================================----->
                <!----Info Goldgate================================================----->
                        <div class="ml-2 flex flex-row">
                              <div class="mt-2 w-1/2">
                                <div class="flex flex-row">
                                <jet-label for="thinprep_code" class="text-right pr-1 text-bold text-lg text-blue-800 w-48" value="Mã ThinPrep:" />
                                <jet-input

                                  id="thinprep_code"
                                  type="text"
                                  class="mt-1 block w-full"
                                  v-model="form.thinprep_code"
                                  autocomplete="thinprep_code"
                                />
                                </div>

                            </div>
                              <div class="mt-2 w-1/2">
                                <div class="flex flex-row">
                                <jet-label for="hpv_code" class="text-right pr-1 text-bold text-lg text-blue-800 w-48" value="Mã HPV:" />
                                <jet-input
                                  id="hpv_code"
                                  type="text"
                                  class="mt-1 block w-full"
                                  v-model="form.hpv_code"
                                  autocomplete="hpv_code"
                                />
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 flex flex-row">
                             <div class=" w-1/2">
                              <div class="mt-2">
                                <div class="flex flex-row">
                                <jet-label for="date_re" class="text-center pr-1 text-bold text-lg text-blue-800 w-48" value="Ngày nhận mẫu:" />
                                <jet-input
                                  id="date_re"
                                  type="datetime-local"
                                  class="mt-1 block w-full"
                                  v-model="form.date_re"
                                  autocomplete="date_re"/>
                                </div>
                              </div>
                            </div>
                             <div class=" w-1/2">
                              <div class="mt-2">
                                <div class="flex flex-row">
                                <jet-label for="readsample" class="text-center pr-1 text-bold text-lg text-blue-800 w-48" value="Đơn vị đọc mẫu:" />
                                <jet-input
                                  id="readsample"
                                  type="text-local"
                                  class="mt-1 block w-full h-8"
                                  v-model="form.read_code"
                                  autocomplete="readsample"/>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                  <!----Info Indication================================================----->
                    <!-- <div class="mt-4">
                        <Checkbox :checked="checkededit" v-model="form.status"/><span class="ml-2 text-bold text-lg text-blue-800">Trạng thái</span>
                    </div>   -->
                    </div>
                    <div class="mt-1 text-center mb-1" >
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>

                    </div>
                </form>
              </div>
            </template>
        </DialogModal>
        <DialogModal :show="showModlPrint" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
             <template v-slot:content>
                <div class="text-right w-full flex-row justify-items-between" >

                    <button class="px-4 rounded-md mb-1 mr-1  bg-gray-800 text-white cursor-pointer text-md py-1 hover:bg-gray-600" type=""
                       @click="printDiv('printMe')" >Print</button>
                    <button  @click="closeModalPrint" class="text-white text-md bg-green-500 px-2 py-1 rounded-md hover:bg-green-300">Close</button>
                </div>
                <div v-for="(lan,i) in [1]" :key="i">
                <!-- <div>{{selectedArray['name']}}</div> -->
                <div v-if="printOutsent.id == 1">
                     <PrintviewTudu :getbilltests="getbilltests" :testElements="testElements" :printCustommers="printCustommers"
                        :printOutsent="printOutsent" :printDoctor="printDoctor"
                        :pathImageLeft="pathImageLeft"
                        :pathThinLeft='pathThinLeft'
                        :pathThinRight='pathThinLeft'
                        :selectedArray='selectedArray'
                        :ketluan='ketluan'
                         :currentDate='currentDate()'
                        :imageThinLeft='imgeLeft'/>
                </div>
                <div v-if="(printOutsent.id == 6)">
                        <PrintviewSaigon :getbilltests="getbilltests" :testElements="testElements" :printCustommers="printCustommers"
                          :printOutsent="printOutsent" :printDoctor="printDoctor" :selectedArray="selectedArray"
                          :pathImageLeft="pathImageLeft"
                          :pathThinLeft='pathThinLeft'
                          :pathThinRight='pathThinLeft'
                           :ketluan='ketluan'
                            :currentDate='currentDate()'
                          :imageThinLeft='imgeLeft'/>
                </div>
                <div v-if="printOutsent.id == 9">
                         <PrintviewVigor :getbilltests="getbilltests" :testElements="testElements" :printCustommers="printCustommers"
                          :printOutsent="printOutsent" :printDoctor="printDoctor" :selectedArray="selectedArray"
                          :pathThinLeft='pathThinLeft'
                          :ketluan='ketluan'
                           :pathImageLeft="pathImageLeft"
                          :pathThinRight='pathThinLeft'
                           :currentDate='currentDate()'
                          :imageThinLeft='imgeLeft'/>

                </div>
                <div v-if="printOutsent.id != 6 && printOutsent.id != 9 && printOutsent.id != 1">
                         <PrintviewGenaral :getbilltests="getbilltests" :testElements="testElements" :printCustommers="printCustommers"
                          :printOutsent="printOutsent" :printDoctor="printDoctor" :selectedArray="selectedArray"
                          :pathThinLeft='pathThinLeft'
                          :ketluan='ketluan'
                          :logo='logo'
                          :pathLogo='pathLogo'
                           :pathImageLeft="pathImageLeft"
                          :pathThinRight='pathThinLeft'
                          :imageThinLeft='imgeLeft'
                          :currentDate='currentDate()'
                          />

                </div>

                <div v-if="printOutsent.id == 13">
                         <PrintHPV :getbilltests="getbilltests" :testElements="testElements" :printCustommers="printCustommers"
                          :printOutsent="printOutsent" :printDoctor="printDoctor" :selectedArray="selectedArray"
                          :pathThinLeft='pathThinLeft'
                          :ketluan='ketluan'
                          :logo='logo'
                          :pathLogo='pathLogo'
                           :pathImageLeft="pathImageLeft"
                          :pathThinRight='pathThinLeft'
                          :imageThinLeft='imgeLeft'
                          :sco='sco'
                          :currentDate='currentDate()'/>

                </div>
        </div>
            </template>
        </DialogModal>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import Table from "@/Components/Table";
import Pagination from "@/Components/Pagination";

import AppImageView from "@/Components/ImageView";
import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import Modal from "@/Components/Modal";
import DialogModal from "@/Components/DialogModal";
import Button from "@/Jetstream/Button";
import Multiselect from "@vueform/multiselect";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import AppImage from "@/Components/Image";
import { Link } from "@inertiajs/inertia-vue3";
import Checkbox from '@/Jetstream/Checkbox';

import PrintviewTudu from '@/Pages/Prinview/FormTudu'
import PrintviewSaigon from '@/Pages/Prinview/FormSaigon'
import PrintviewVigor from '@/Pages/Prinview/FormVigor'
import PrintviewGenaral from '@/Pages/Prinview/FormGenaral'
import PrintHPV from '@/Pages/Prinview/FormHPV'

import { BeakerIcon } from '@heroicons/vue/solid'
import { PencilIcon } from '@heroicons/vue/solid'
import { CheckIcon } from '@heroicons/vue/solid'
import { useForm } from '@inertiajs/inertia-vue3'
import moment from 'moment'

export default defineComponent({

  name: "Danh sách bệnh nhân",
  props: {
    billtests:'',
    nametests:'',
    testElements:'',
    provinces:'',
    districts:'',
    wards:'',
    ousents:'',
    doctors:'',
    readcodes:'',
    custommer:"",
    filters:{},
    errors: Object,

  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    Pagination,
    EditBtn,
    DeleteBtn,
    JetButton,
    AppImage,
    Modal,
    DialogModal,
    Button,
    Multiselect,
    JetLabel,
    JetInput,
    AppImageView,
    Link,
    Checkbox,
    PrintviewTudu,
    PrintviewSaigon,
    PrintviewVigor,
    PrintviewGenaral,
     PencilIcon,
    CheckIcon,
    BeakerIcon,
    PrintHPV

  },
data(){
  return{
    sco:'',
    logo:'',
    testselect:[1],
    checkDPF:[''],
    checkPrint:[],
    url: null,
    getbilltests:'',
     printCustommers:'',
    //printName:'',
    //printAge:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',
    printNameTest:'',
    selectedArray:'',
    imgeLeft:'',
    ketluan:'',

    output: null,
    ousentFill:this.filters.ousentFill,
    pathThinLeft:'/storage/imageThinLeft/',
    pathLogo:'/storage/Image_Ousent/',
    pathImageLeft:'/images/Logo/Thinprep.jpg',
   // pathThinLeft:'/images/Thinprep/hLeft.jpg',
   // pathThinRight:'/images/Thinprep/hRight.jpg',
    pathThinRight:'/storage/imageThinRight/',
    getOusents:this.ousents,
    getdistricts:this.district,
    getwards:'',
    getdoctors:this.doctors,
    form_errors:[],

    name:'123',
    perPage:'',
    checkededit:'',
    pathImage:'/storage/image_Ousent/',
    userEdit:'',
    showModal:'',
    showModlPrint:false,
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",
    titleHeader:'Edit',
     example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options:this.nametests.data,
        searchable: true,
        createTag: true,
    },
    }
  },
setup() {
        const form = useForm({
            file: null,
        });

        return { form };
    },

  watch:{
     elementSearch:function(){
       //console.log(this.elementSearch);
       this.getelementSearch(this.elementSearch)
    },
    "form.province_id":function(value){

      // console.log(value);
      //alert(he-Province);
       this.getDistrictFill(value)
    },
    "form.district_id":function(value){
      //alert(value);
       this.getWardFill(value)
    },
    "form.ousent_id":function(value){
       this.getDoctorFill(value)
    },
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Danh sách gửi mẫu",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "Check", class:'w-12 text-center' },
        { name: "#", class:'w-12 text-center' },
        { name: "Tên khách hàng", class:'border-l-2 text-center w-52 px-2 font-normal' },
        { name: "Giới tính", class:'border-l-2 text-center w-8 px-2 font-normal' },
        { name: "Năm sinh", class:'border-l-2 text-center px-0 font-normal' },
        { name: "Địa chỉ", class:'border-l-2 text-center font-normal' },
        { name: "Điện thoại", class:'border-l-2 text-center px-1 font-normal' },
        { name: "Tên xét nghiệm", class:'border-l-2 text-center font-normal' },
        { name: "Mã Thinprep", class:'border-l-2 text-center font-normal' },
        { name: "Mã HPV", class:'border-l-2 text-center font-normal' },
        { name: "Bác sỹ chỉ định", class:'border-l-2 text-center font-normal' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Ngày nhận mẫu mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Đơn vị đọc", class:'border-l-2 text-center font-thin' },
        { name: "Kết quả", class:'border-l-2 text-center font-normal' },
        { name: "User create", class:'border-l-2 text-center font-normal' },
        { name: "Action", class: "text-right border-l-2 font-normal" },
      ];
    },
    addClass() {
      return "bg-blue-200 text-indigo-700";
      },
      bgSave(){
        return "bg-red-900 text-white";
      },
      bgEdit(){
        return "bg-green-600 text-white";
      },
    },
  mounted() {

  },
  methods:{
    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')}
    },
      editCustommer(bill) {
             this.form = Object.assign({}, bill);
              //console.log(bilForm);
              this.checkededit= this.form.status
              this.form.name=this.form.custommer.name;
              this.form.gender=this.form.custommer.gender;
              this.form.birthday=this.form.custommer.birthday;
              this.form.address=this.form.custommer.address;
              this.form.phone=this.form.custommer.phone;
              this.form.para=this.form.para;
              this.form.kinhchot=this.form.kinhchot;
              var result = this.form.testnames.map(function(a) {return a.id;});
              this.form.testname_id=result;
              this.editMode = true;
              this.showModal=true;
              },
     updateCustommer(bill){
        bill._method = 'PUT';
        this.$inertia.post('/dashboard/custommers/'+bill.id, bill);
        this.reset();
        this.closeModal();
    },
      updateBill(bill){
          this.$inertia.post('/dashboard/updatebill/',bill);
          this.closeModal();
        },
    currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },
    printDiv(divName){
          window.print();
      },
    closeModalPrint(){
         this.showModlPrint = false;
    },
    printResult(bill){
        this.getbilltests= bill;
        this.printCustommers = bill.custommer;
        this.printOutsent= bill.ousent;
        this.printDoctor = bill.doctor;


        if(bill.testnames){

           let rs =  bill.testnames.map(({ id }) => id)
            this.printNameTest= rs;
        }
        else{
          this.printNameTest='';
        }
        if(bill.ousent.logo){
          this.logo = bill.ousent.logo;
        }
        else{
          this.logo='';
        }
        if(bill.image_left){
          this.imgeLeft = bill.image_left.thinLeft;
        }
        else{
          this.imageLeft='';
        }
        const elementChecked1 = bill.results;
         let results = elementChecked1.map(({ element_id }) => element_id)


         //let keluanfill = elementChecked1.map(({result }) =>result)

          var ketluanFill = elementChecked1.find(obj => {
                      return obj.element_id ==26
                    })
          this.sco = bill.results.find(obj => {
                      return obj.element_id ==56
                    })

                      console.log('Heheheehehe',this.sco);

        //  var last = keluanfill.slice(-1)[0]
        if(ketluanFill){
            this.ketluan = ketluanFill.result;
        }

        this.selectedArray = results;
        this.printAddress=' '+ bill.custommer.address;
        this.showModlPrint = true;

    },
    getDoctorFill(doctor){
     const fillData = this.doctors.filter(function(el){
       return el.ousent_id == doctor;
     });
     //console.log(fillData);
     this.getdoctors = fillData;
      },
    getDistrictFill(province){
     // alert(province)
     const fillData = this.districts.filter(function(el){
       return el.province_id == province;
     });
     this.getdistricts = fillData;
      },
    getWardFill(district){
     const fillWards = this.wards.filter(function(el){
       return el.district_id == district;
     });
     this.getwards = fillWards;
      },
   scrollToView(element){
    var offset = element.offset().top;
    if(!element.is(":visible")) {
        element.css({"visibility":"hidden"}).show();
        var offset = element.offset().top;
        element.css({"visibility":"", "display":""});
    }

    var visible_area_start = $(window).scrollTop();
    var visible_area_end = visible_area_start + window.innerHeight;

    if(offset < visible_area_start || offset > visible_area_end){
         // Not in view so scroll to it
         $('html,body').animate({scrollTop: offset - window.innerHeight/3}, 1000);
         return false;
    }
    return true;
  },
    getelementSearch(data){
       this.$inertia.get('testelements?',
            {
              perPage:this.perPage,
              testName:this.testName,
              elementSearch:data
            },
            {
              preserveState:true,
              replace:true            }
            )
      },
    saveCustommer(data) {
      try {
          this.$inertia.post('/dashboard/custommers',data)
          this.closeModal();
      } catch (error) {
        console.log(error);
      }

    },
    getPageFill(){
        this.$inertia.get('custommers?',
            {
              //alert(ousentFill);
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              readcodeFill:this.readcodeFill,
              startDate:this.startDate,
              endDate:this.endDate,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    getfilePerpage(){
         this.$inertia.get('custommers?',
            {  //search:this.search,
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              readcodeFill:this.readcodeFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
     refreshFill(){
        this.$inertia.get('custommers?',
             {
              perPage:this.perPage,
              ousentFill:this.ousentFill,
              readcodeFill:this.readcodeFill
             },
            {
              preserveState:true,
              replace:true            }
            )
     },
    closeModal(){
      this.reset();
      this.showModal=false;
      this.editMode=false;
    },
    openModal(){
      this.showModal=true;
    },
     reset() {
          this.getOusents=this.ousents,
          this.imgeLeft=null,
            this.form = {

            name: null,
            birthday: null,
            //ousent_id: null,
            //doctor_id: null,
            kinhchot: null,
            phone: "",
            gender: '',
            address: "",
            //getdistricts:null,
            //province_id: null,
            //district_id:null,
           // ward_id:null,
            testname_id:[''],
            selected:[],
            diagnose:'',
                }
            },
    addCustommer(){
            this.showModal = true;
            },

   exportDomPDFSelect(){
       this.$inertia.get('/dashboard/downloadPDF?',
            {
              billId:this.checkPrint,
              //testName:this.testName,
             // elementSearch:data
            },
            {
              preserveState:true,
              replace:true            }
            )
      },
    exportDomPDF(){

          this.$inertia.get('/dashboard/tranbillids?',
            {
              billId:this.checkPrint,
             },
            {
              preserveState:true,
              replace:true            }
            )
    },
    exportPDF(){
          this.$inertia.get('/dashboard/printview?',
            {
              billId:this.checkPrint,
              //testName:this.testName,
             // elementSearch:data
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
    dowloadPDF(){
      this.$inertia.get('/dashboard/downloadPDF/');
    },
     printDocument() {
          //get table html
          const pdfTable = document.getElementById('exportMe');
          //html to pdf format
          var html = htmlToPdfmake(pdfTable.innerHTML);

          const documentDefinition = { content: html };
          pdfMake.vfs = pdfFonts.pdfMake.vfs;
          pdfMake.createPdf(documentDefinition).open();

    },
     printDocumentTest() {
          //get table html
          const pdfTable = document.getElementById('printTestMe');
          //html to pdf format
          var html = htmlToPdfmake(pdfTable.innerHTML);

          const documentDefinition = { content: html };
          pdfMake.vfs = pdfFonts.pdfMake.vfs;
          pdfMake.createPdf(documentDefinition).open();

    },

    submitFile() {
            if (this.$refs.photo) {
                this.form.file = this.$refs.photo.files[0];
            }
            //this.form.post('/dashboard/importWard/');
            this.form.post('/dashboard/importcustommers/');
            this.form.file = ""
        },
    previewImage(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },


  }
});
</script>

<style>
.modal-body {
    overflow-y: auto;
}
</style>
 <style src="@vueform/multiselect/themes/default.css"></style>

<style media="print">
@media print {
  /* .noPrint :not(.printMe){
    display:none;
  }*/
    body {
    visibility: hidden;
  }
  #printMe {
    visibility: visible;
    padding:0px;
    margin: 0px;
  }
  @page{
    size: a4;
   /* //margin: 0mm 0mm 0mm 0mm; */
    /*Chagen print here size: A5; landscape*/
    font-family: 'Times New Roman';
    /* font-size: 20px; */
   }
     @page :top {
         margin-top: 0.5cm;

      }
     @page :left {
         margin-left: 1cm;

      }

      @page :right {

         margin-right: 1cm;
      }

.page-break {page-break-before: always !important; }

}


</style>