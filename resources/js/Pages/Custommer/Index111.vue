<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
      <div class="grid grid-cols-1 mb-2">
        <div class="flex flex-1 justify-between">
           <button  class="cursor-pointe bg-blue-600 px-2 py-1 rounded-md hover:bg-blue-800 hover:text-gray-900 h-8 text-white"   @click="addCustommer">+ Add</button>
           <div>
           <Button  class="bg-yellow-400 px-2 py-1 float-right cursor-pointer">Export PDF <span class="text-xs ml-1">(2)</span></Button>
           <Button  class="bg-green-400 px-2 py-1 float-right cursor-pointer">Export EXCEL<span class="text-xs ml-1">(1)</span></Button>
           </div>

        <div class="flex flex-row border-solid border-1 border-gray-300 py-0 bg-green-200">

           <button  class="cursor-pointe bg-blue-600 px-2 py-1 rounded-md hover:bg-blue-800 hover:text-gray-900 h-8 text-white text-md">Import file</button>
          <input class="w-42 my-0 rounded-sm text-xs cursor-pointer" type="file" />

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
                  <span>Bác sỹ CĐ:</span>
                </div>
              <div class="col-span-2 w-52">
                    <select
                        name="testgroup"
                        id="testgroup"
                        class="block py-0 w-full form-input h-8 rounded-lg text-md"
                        v-model="doctorFill"
                      >
                        <option value="all">All</option>
                        <option
                          v-for="(dtr,i) in doctors"
                          :key="i"
                          :value="dtr.id"
                        >
                          {{ dtr.name }}
                        </option>
                    </select>
              </div>
              </div>
          </div>
        <div class="col-span-2">
          <div class="flex flex-row">
          <div>Ngày nhận mẫu</div>
          <div class="mx-2">Từ</div>
          <div class="">Đến</div>
          </div>
        </div>
        <div class="items-center">
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
        <div></div>
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
                          v-model="perpageFill"
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
      <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-gray-300 " v-for="(bill,i) in billtests.data" :key="i">
            <td class="border-r-2 text-center">{{i+1}}</td>
             <td class="border-r-2">{{bill.custommer.name}}</td>
             <td class="border-r-2">
               <span v-if="bill.custommer.gender==0">Nữ</span>
               <span v-else>Nam</span>

               </td>
             <td class="border-r-2">{{bill.custommer.birthday}}</td>
             <td class="border-r-2 text-center">{{bill.custommer.address}},&nbsp
               <span v-if="bill.ward!==null">{{bill.ward.name}}</span>,&nbsp
               <span v-if="bill.district!==null">{{bill.district.name}}</span>,&nbsp
               <span v-if="bill.province!==null">{{bill.province.name}}</span>
              </td>
            <td class="border-r-2 text-center" v-if="bill.phone!==null">{{bill.phone.phone}}</td>
            <td class="border-r-2 text-center" v-else></td>
            <td class="border-r-2 text-center" >
              <span v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
              </td>
            <td class="border-r-2" >{{bill.doctor.title}} {{bill.doctor.name}}</td>
            <td class="border-r-2" >{{bill.ousent.name}}</td>
            <td class="text-center border-r-2">
                <EditBtn
                  title="View"
                  class="text-green-800"
                  v-if="bill.status == 1"
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
            </td>
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
                  class="text-green-800"
                  @click="editCustommer(bill)"
                  >
                   <svg
                    class="w-6 h-6 text-blue-800 cursor-pointer"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    ></path></svg>
                </EditBtn>
                <DeleteBtn
                  :url="route('custommers.destroy',bill.id)"
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
                   @submit="checkForm"
                    class="py-0 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveCustommer(form)">
                    <div class="grid grid-cols-1">
                <!----Info Custommer================================================----->
                    <div class="bg-gray-100 p-2 border-solid border-2 border-blue-500 rounded-md"><span class="text-gray-400 underline">Info Custommer</span>
                      <div class="ml-4 grid grid-cols-4">
                              <div  class=" col-span-3 mr-2 h-8">
                                  <div class="grid grid-cols-4">
                                      <div class="col-span-1 pr-2 h-8">
                                        <!-- <jet-label for="name" class="text-right pr-1 text-bold text-lg text-blue-800 w-full" value="Tên bệnh nhân (name):" /> -->
                                       <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 h-6 leading-3">Tên bệnh nhân <span class=" h-8 m-0 font-normal text-base font-italic text-gray-400">(name)</span></div>
                                      </div>
                                  <div class="col-span-3">
                                      <jet-input
                                      required
                                      id="name"
                                      name="name"
                                      type="text"
                                      class="mt-1 block w-full h-8"
                                      v-model="form.name"
                                      autocomplete="name"
                                    />
                                     <div class=" text-red-800" v-if="errors.name"> * {{ errors.name }}</div>
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
                                      required
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
                                            <option value="1">Hà Nội </option>
                                            <option value="2">Tp.HCM</option>
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
                                            <option v-for="(dst, i) in getdistricts" :key="i" :value="dst.id">{{dst.name}}</option>

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
                      <div class="mt-1 bg-gray-200 p-2 border-solid border-2 border-blue-500 rounded-md"><span class="text-gray-400 underline">Thông tin ĐV gửi:</span>
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
                                      <option v-for="(ou,i) in ousents" :key="i" :value="ou.id">{{ou.name}}</option>
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
                                      <option v-for="(dot, i) in getdoctors" :key="i" :value="dot.id" class="text-lg">{{dot.name}}</option>
                                    </select>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div class="ml-4 grid grid-cols-2">
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
                                        v-model="form.diagonose"
                                        autocomplete="diagonose"
                                      />
                                    </div>
                                  </div>
                             </div>
                             <div>
                                 <div class="mt-2 flex flex-row">
                                    <div class="w-48">
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">Chỉ định XN: <span class="m-0 font-normal text-base font-italic text-gray-400">(diagonose)</span></div>
                                    </div>
                                    <div class="w-full">
                                        <select

                                          name="testname_id"
                                          id="testname_id"
                                          class="block form-input rounded-lg w-full h-8 text-xs "
                                          v-model="form.testname_id">
                                      <option value='1'>ThinPrep-Pap Smear</option>
                                      <option value='2'>HPV</option>

                                    </select>
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
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 leading-3">King: <span class="m-0 font-normal text-base font-italic text-gray-400"></span></div>
                                    </div>
                                    <div class="w-full">
                                       <jet-input

                                        id="king"
                                        type="text"
                                        class="mt-1 block w-full h-8"
                                        v-model="form.king"
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
                      </div>
                  <!----/Info Indication OU================================================----->
                <!----Info Goldgate================================================----->
                      <div class="mt-1 bg-gray-200 p-2 border-solid border-2 border-blue-500 rounded-md"><span class="text-gray-400 underline">Thông tin XN GoldGate:</span>

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
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateCustommer(form)">
                                Update
                              </button>
                            </span>
                    </div>
                </form>
              </div>
            </template>
        </DialogModal>
        <DialogModal :show="showModlPrint" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
             <template v-slot:content>
                <div class="text-right w-full flex-row justify-items-between">
                      <button class="rounded-md mb-1 ml-2  bg-gray-800 text-white cursor-pointer text-md px-2 py-1 hover:bg-gray-600" type=""
                       @click="printData('printMe')" >Print test</button>
                       <button  @click.prevent="closeModalPrint" class="text-white text-md bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
                </div>

              <div class="py-4 px-40 " ref="printMe" id="printMe">

                <div>{{getbilltests}}</div>
                <div class="grid grid-cols-8 mx-0 py-0">
                    <div class="col-span-2 py-0">
                        <img
                          class="w-36"
                          :src="pathImageLeft"
                          :alt="LogoThin"
                        />
                    </div>
                    <div class="col-span-4 text-center mt-4">
                        <div class="pt-0 py-0 place-items-center flex flex-col">
                              <span class="text-center font-bold text-2xl font-sans-Timenew ">PHIẾU XÉT NGHIỆM TẾ BÀO</span>
                              <div>
                                <span class="text-center font-bold text-2xl font-sans-Timenew ml-0 pl-0">PAP'S SMEAR - ThinPrep</span>
                                <span class="align-top ml-0 p-0 text-md font-bold">&reg;</span>
                              </div>
                              <span class="text-center font-bold text-md font-sans-Timenew ">REQUEST FOR COLLECTION OF SPECIMEN</span>
                          </div>
                    </div>
                    <div class="col-span-2 text-left text-italy text-sm font-bold font-sans-Timenew  mt-8 w-full">
                          <span class="p-0 m-0 w-full text-xs">Số(Number):{{getbilltests['thinprep_code']}}/2022</span>
                    </div>
                </div>
            <!--==============--->

            <div class="grid grid-cols-4 leading-6">
                <div class="col-span-2 font-bold font-sans-Timenew italic">Họ và tên (Name):{{printName}}</div>
                <div class="font-bold text-md font-sans-Timenew italic">Tuổi (Age):{{printAge}}</div>
                <div class=" font-bold font-sans-Timenew italic">Para: </div>
            </div>
            <div class="grid grid-cols-4">
                <div class="col-span-3 font-bold font-sans-Timenew leading-6 italic">Đia chỉ(Address):{{printAddress}}</div>
                <div class="font-bold font-sans-Timenew leading-6 italic">Số điện thoại:</div>
            </div>

            <div class="font-bold font-sans-Timenew leading-6 italic">Đơn vị gửi(Custommer): {{ printOutsent}}</div>
            <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic">
                <div class="font-bold">IUD (Intra-Uterine Devices) <i class="fa fa-square-o mt-2"></i></div>
                <div class="font-bold text-center">Nội tiết (Hormone) <i class="fa fa-square-o mt-2"></i></div>
                <div class="font-bold text-center">Xạ (Radiation) <i class="fa fa-square-o mt-2"></i></div>
                <div class="font-bold text-center">Có thai (Pregnancy) <i class="fa fa-square-o mt-2"></i></div>
            </div>

            <div class="grid grid-cols-2 italic">
                <div class="font-bold font-sans-Timenew leading-6">Kinh chót(Last Menstrual Period):</div>
                <div class="font-bold text-center font-sans-Timenew leading-6">Ngày gửi (Date sent):</div>
            </div>
              <div class="grid grid-cols-2 italic">
                <div class="font-bold font-sans-Timenew leading-6">Chẩn đoán lâm sàng(Clinical diagnossis):</div>
                <div class="font-bold font-sans-Timenew leading-6">Bs. Chỉ định(Physician):{{printDoctor}}</div>
            </div>
            <!--/==============--->
              <!--==============--->
              <div class="text-center font-bold text-xl font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>

              <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                <div class="font-bold text-center align-midle italic">Đạt (Satisfactory) <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i></div>
                <div class="font-bold text-center italic col-span-2">Không đạt (Unsatisfactory) <i class="fa fa-square-o"></i></div>
              </div>
              <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Bình thường <i class="fa fa-square-o"></i></div>
              <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Biến đổi lành tính(Begin changes) <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i></div>
              <div class="grid grid-cols-5 font-sans-Timenew leading-6 italic text-xs">
                <div class="font-bold">+ Trichomonas vaginalis<i class="fa fa-square-o "></i></div>
                <div class="font-bold text-center">+ Candida spp <i class="fa fa-square-o"></i></div>
                <div class="font-bold text-center">+ Antinomyces spp <i class="fa fa-square-o"></i></div>
                <div class="font-bold text-center">+ Herpes siplex virus <i class="fa fa-square-o "></i></div>
                <div class="font-bold text-center">+ Khác (Other) <i class="fa fa-square-o"></i></div>
                </div>
                <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Bất thường tế bào biểu mô <i class="fa fa-square-o"></i></div>
              <!--/==============--->
              <!--==============--->
              <div class="col-span-2">
                    <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">TẾ BÀO GAI (Squamuos cell)</span>
                    <div class="grid grid-cols-2 leading-5 italic">
                      <div class="flex flex-col">
                          <span class="ml-3 font-bold font-sans-Timenew text-sm" v-for="(e, i) in 3" :key="i">* Element-{{i}} <i class="fa fa-square-o mr-2"> </i></span>
                      </div>
                      <div class="flex flex-col">
                        <span class="ml-3 font-bold font-sans-Timenew text-sm" v-for="(e, i) in 3" :key="i">* Element-{{i}} <i class="fa fa-square-o mr-2"> </i></span>
                      </div>

                    </div>
                  </div>

              <div class="grid grid-cols-1 mt-2">
                  <div>
                    <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Tuyến</span>
                    <div class="grid grid-cols-3 leading-5">
                      <span class="ml-3 font-bold italic font-sans-Timenew text-sm" v-for="(e, i) in 3" :key="i"> * fdfadsf Element-{{i}} <i class="fa fa-square-o mr-2"> </i></span>
                    </div>
                  </div>
              </div>
              <!------KET LUẬN------------------->
              <div class="grid grid-cols-4 font-sans-Timenew leading-6 italic mt-2">
                <div class="font-bold">Đề nghị (Suggestions):</div>
                <div class="font-bold flex flex-col">
                  <div class="grid grid-cols-3">
                      <span class="col-span-2 mr-0 pr-0">*  Phết lại (Pap's)</span>
                      <span class="ml-0 pl-0 text-left" > <i class="fa fa-square-o"></i></span>
                  </div>
                  <div class="grid grid-cols-3">
                      <span class="col-span-2 mr-0 pr-0">* Nạo kênh (Edocervical curettage)</span>
                      <span class="ml-0 pl-0 text-left text-middle" > <i class="fa fa-square-o"></i></span>
                  </div>
                </div>
                <div class="font-bold flex flex-col">
                  <div class="grid grid-cols-3">
                      <span class="col-span-2 mr-0 pr-0">* Soi CTC (Colposcopy)</span>
                      <span class="ml-0 pl-0 text-left" > <i class="fa fa-square-o"></i></span>
                  </div>
                  <div class="grid grid-cols-3">
                      <span class="col-span-2 mr-0 pr-0">* Nạo lòng (Endometrial)</span>
                      <span class="ml-0 pl-0 text-left text-middle" > <i class="fa fa-square-o"></i></span>
                  </div>
                </div>
                <div class="font-bold flex flex-col">
                  <div class="grid grid-cols-3">
                      <span class="col-span-2 mr-0 pr-0">* Bấm sinh thiết (Biopsies)</span>
                      <span class="ml-0 pl-0 text-left" > <i class="fa fa-square-o"></i></span>
                  </div>
                </div>
              </div>
              <!------/KET LUẬN------------------->

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

              </div>
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
                  <span class="font-bold font-sans-Timenew text-md">"tên Bác sỹ"</span>
                  <span class="font-bold font-sans-Timenew text-md">KHOA GIẢI PHẨU BỆNH</span>
                  <span class="font-bold font-sans-Timenew text-md">BỆNH VIỆN TỪ DŨ</span>
                </div>
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


export default defineComponent({

  name: "Danh sách bệnh nhân",
  props: {

    billtests:'',
    provinces:'',
    districts:'',
    wards:'',
    ousents:'',
    doctors:'',
    nametests:'',
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


  },
data(){
  return{

    getbilltests:'',
    printName:'',
    printAge:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',


    ousentFill:this.filters.ousentFill,
    pathImageLeft:'/images/Logo/Thinprep.jpg',
    pathThinLeft:'/images/Thinprep/hLeft.jpg',
    pathThinRight:'/images/Thinprep/hRight.jpg',
    getdistricts:'',
    getwards:'',
    getdoctors:'',
    form_errors:[],

    name:'',
    perPage:'',
    checkededit:'',
    pathImage:'/storage/image_Ousent/',
    userEdit:'',
    showModal:'',
    showModlPrint:false,
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"6xl",
    titleHeader:'Edit',
     example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options: this.nametests.data,
        searchable: true,
        createTag: true,
    },
    form: this.$inertia.form({
         // "_method": this.edit ? 'PUT' : "",bỉ
        name: "",
        birthday: "",
        ousent_id: "",
        phone: "",
        gender: '',
        address: "",
        province_id: "",
        district_id:'',
        ward_id:'',
        testname_id:[''],
        selected:[]
      },
        {
          resetOnSuccess: false,
        }
      ),
    }
  },
  watch:{
     elementSearch:function(){
       //console.log(this.elementSearch);
       this.getelementSearch(this.elementSearch)
    },
    "form.province_id":function(value){
      // console.log(value);
       this.getDistrictFill(value)
    },
    "form.district_id":function(value){
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
        { name: "#", class:'w-12 text-center' },
        { name: "Tên khách hàng", class:'border-l-2 text-center w-52 px-2 font-serif' },
        { name: "Giới tính", class:'border-l-2 text-center w-8 px-2 font-serif' },
        { name: "Năm sinh", class:'border-l-2 text-center px-0' },
        { name: "Địa chỉ", class:'border-l-2 text-center' },
        { name: "Điện thoại", class:'border-l-2 text-center px-1' },
        { name: "Chỉ định xét nghiệm", class:'border-l-2 text-center' },
        { name: "Bác sỹ chỉ định", class:'border-l-2 text-center' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center font-thin' },
        { name: "Kết quả", class:'border-l-2 text-center' },
        { name: "Action", class: "text-right border-l-2" },
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
    if (this.edit) {

       //this.checkededit=this.labogroups.data.status==1? true:false;
      //this.form.role_id=[1];
      // //this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      // this.form.name =' this.user.data.name';
      // this.form.username =this.user.data.username;
      // this.form.email = this.user.data.email;
      // this.form.phone = this.user.data.phone;
      // this.imageUrl = this.user.data.profile_photo_path;
    }
  },
  methods:{
     printData(printMe){
     window.print(printMe);
    },
    //  printData(printpage) {
    //         var headstr = "<html><head><title></title></head><body>";
    //         var footstr = "</body>";
    //         var newstr = document.all.item(printpage).innerHTML;
    //         var oldstr = document.body.innerHTML;
    //         document.body.innerHTML = headstr + newstr + footstr;
    //         window.print();
    //         document.body.innerHTML = oldstr;
    //         return false;
    //     },
    //  printDiv(divName){

    //       setTimeout(function() {
    //             var printContents = document.getElementById(divName).innerHTML;
    //             var originalContents = document.body.innerHTML;
    //               document.body.innerHTML = printContents;

    //                 window.print();
    //                 //window.location.reload()
    //               document.body.innerHTML = originalContents;

    //       }, 0);

		// },
    closeModalPrint(){
         this.showModlPrint = false;
    },
    printResult(bill){
        this.getbilltests= bill;
        this.printName= bill.custommer.name;
        this.printAge= bill.custommer.birthday;
        this.printOutsent= bill.ousent.name;
        this.printDoctor=' '+ bill.doctor.name;
        this.printAddress=' '+ bill.custommer.address+' '+bill.ward.name+', '+bill.district.name+', ' + bill.province.name;
        this.showModlPrint = true;

    },
    getDoctorFill(doctor){
      //console.log(this.doctors);
     const fillData = this.doctors.filter(function(el){
       return el.ousent_id == doctor;
     });
     //console.log(fillData);
     this.getdoctors = fillData;
      },
    getDistrictFill(province){
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
              //perPage:this.perPage,
              ousentFill:this.ousentFill,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
      getfilePerpage(){
         this.$inertia.get('custommers?',
            {  //search:this.search,
                perpageFill:this.perpageFill,
               ousentFill:this.ousentFill,

            },
            {
              preserveState:true,
              replace:true            }

            )
     },
     refreshFill(){
        this.$inertia.get('custommers?',

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
            this.form = {
                name: null,
                status: null,
                }
            },
    addCustommer(){

            this.showModal = true;
            },
    editCustommer(ctm) {
        var checked111=this.form = Object.assign({}, el);
        this.checkededit= checked111.status
        this.editMode = true;

     this.showModal=true;
        },

    updateCustommer(data){
       data._method = 'PUT';

        this.$inertia.post('/dashboard/custommers/'+data.id, data)
        this.reset();
        this.closeModal();
    }

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
 @media print{
   #printMe{
     display: block;
     padding-left:0px;
   }


   @page{
     margin-left:60px;
     margin-right:60px;
   }
 }
</style>