<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
      <div class="grid grid-cols-1 mb-2">
        <div class="flex flex-1 justify-between">
           <Button  class="mb-1 float-right cursor-pointer bg-blue-600"  @click="addCustommer">+ Add</Button>
           <div>
           <Button  class="bg-indigo-800 px-2 py-1 float-right cursor-pointer">Import file</Button>
           <Button  class="bg-blue-400 px-2 py-1 float-right cursor-pointer">Export Excel</Button>
           </div>
        </div>
        <!-- <div class="grid grid-flow-col justify-items-right">
         
          <div class=" text-right ml-10">
             <div class="flex mb-2 text-right h-8 p-0 ">
                        <jet-input
                          required
                          id="name"
                          type="text"
                          class="mt-1 block w-full h-8 mr-2"
                          autocomplete="name"
                          v-model="elementSearch"
                        /> 
                    <span class="justify-center justify-items-center mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    </span>  
              </div>
            </div>
          <div class=" ml-0 text-right">
             <div class="grid grid-cols-2 mb-2 text-right h-8 p-0">
                <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="Tên Xét nghiệm" />
                  <select
                      name="testgroup"
                      id="testgroup"
                      class="block py-0 w-42 form-input h-8 rounded-lg"
                      v-model="testName"
                    >
                      <option value="all">All</option>
                      <option
                        v-for="(tn,i) in testNames"
                        :key="i"
                        :value="tn.id"
                      >
                        {{ tn.name }}
                      </option>
                  </select>
              </div>
            </div>
          <div class="mr-32 p-0 pt-0 flex">
            <Button class="py-1 bg-indigo-600" @click="getPageFill">
             <span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
              </svg>
            </span> 
            </Button>
              <button @click="refreshFill" class=" px-2 py-1 text-white font-bold bg-yellow-400 rounded-md text-sm">
                Refresh
              </button>
          </div>
    
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
        </div> -->
      </div>  
      <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-gray-300 " v-for="(bill,i) in billtests" :key="i">
            <td class="border-r-2 text-center">{{i+1}}</td>
             <td class="border-r-2">{{bill.custommer.name}}</td>
             <td class="border-r-2">{{bill.custommer.birtday}}</td>
             <td class="border-r-2 text-center">{{bill.custommer.address}}</td>
            <td class="border-r-2 text-center"></td>
            <td class="border-r-2" >
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
             <!-- <Pagination :links="custommers.links"/> -->
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
                                       <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0 h-6">Tên bệnh nhân <span class=" h-8 m-0 font-normal text-base font-italic text-gray-400">(name)</span></div>
                                      </div>
                                  <div class="col-span-3">
                                      <jet-input
                                      required
                                      id="name"
                                      name="name"
                                      type="text"
                                      class="mt-1 block w-full h-10"
                                      v-model="form.name"
                                      autocomplete="name"
                                    />
                                     <div class=" text-red-800" v-if="errors.name"> * {{ errors.name }}</div> 
                                  </div>
                                  </div>  
                              </div>
                                <div class="">
                                  <div class="grid grid-cols-4">
                                     <div class="col-span-2 text-right pr-1 text-bold text-lg text-blue-800 w-full m-0"> Giới tính <span class="m-0 font-normal text-base font-italic text-gray-400">(gender)</span></div>
                                    <div class="border-solid border-1 border-gray-300 rounded-md h-14 px-1 col-span-2">
                                      <input :checked="true" type="radio" id="female" value="false" v-model="form.gender">
                                      <label for="one" class="ml-2">Nữ</label>
                                      <br>
                                      <input type="radio" id="man" value="true" v-model="form.gender">
                                      <label for="two" class="ml-2">Nam</label>
                                    </div>
                                   
                                  </div>
                                </div>
                          </div>
                      <div class="mt-2 ml-4 grid grid-cols-4">
                              <div  class="col-span-2 mr-2">
                                  <div class="grid grid-cols-4">
                                      <div class="">
                                          <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Năm sinh <span class="m-0 font-normal text-base font-italic text-gray-400">(Birthday )</span></div>
                                      </div>
                                  <div class="col-span-3">
                                      <jet-input
                                    
                                      validation="bail|required|number|between:1,2,value"
                                      id="birthday"
                                      type="text"
                                      class="mt-1 block w-full h-10"
                                      v-model="form.birthday"
                                      autocomplete="birthday"
                                    />
                                  </div>
                                  </div>  
                              </div>
                              <div  class="col-span-2 mr-2">
                                  <div class="grid grid-cols-4">
                                      <div class="">
                                          <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Điện thoại <span class="m-0 font-normal text-base font-italic text-gray-400">(Phone )</span></div>
                                      </div>
                                  <div class="col-span-3">
                                      <jet-input
                                      required
                                      id="birthday"
                                      type="text"
                                      class="mt-1 block w-full h-10"
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
                                          <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Địa chỉ <span class="m-0 font-normal text-base font-italic text-gray-400">(Address)</span></div>
                                      </div>
                                  <div class="col-span-4">
                                      <jet-input
                                      required
                                      id="address"
                                      type="text"
                                      class="mt-1 block w-full h-10"
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
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Tỉnh/thành <span class="m-0 font-normal text-base font-italic text-gray-400">(Province)</span></div>
                                    </div>
                                    <div class="col-span-3">
                                          <select
                                         
                                            id="Province"
                                            class="block w-full form-input rounded-lg h-10 py-1"
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
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Quận/Huyện <span class="m-0 font-normal text-base font-italic text-gray-400">(District)</span></div>
                                    </div>
                                    <div class="col-span-3">
                                          <select
                                            name="district"
                                            id="district"
                                            class="block w-full form-input rounded-lg h-10 py-1"
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
                                        <div class="text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Phường/Xã <span class="m-0 font-normal text-base font-italic text-gray-400">(Ward)</span></div>
                                    </div>
                                    <div class="col-span-3">
                                          <select
                                            name="ward"
                                            id="ward"
                                            class="block w-full form-input rounded-lg h-10 py-1"
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
                                        <div class="text-left pr-1 text-bold text-lg text-blue-800 w-full m-0">Đơn vị gửi mẫu: <span class="m-0 font-normal text-base font-italic text-gray-400">(Ousent)</span></div>
                                    </div>
                                    <div class="w-full">
                                         <select
                                          name="ou"
                                          id="ou"
                                          class="block w-full form-input rounded-lg ml-1 h-10"
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
                                        <div class="py-0 text-center pr-1 text-bold text-lg text-blue-800 w-full m-0">Bác sỹ chỉ định: <span class="m-0 p-0 font-normal text-base font-italic text-gray-400">(doctor)</span></div>
                                    </div>
                                    <div class="w-full">
                                         <select
                                          name="doctor_id"
                                          id="doctor_id"
                                          class="block form-input rounded-lg w-full h-10 "
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
                                        <div class="text-left pr-1 text-bold text-lg text-blue-800 w-full m-0">Chẩn đoán: <span class="m-0 font-normal text-base font-italic text-gray-400">(diagonose)</span></div>
                                    </div>
                                    <div class="w-full">
                                       <jet-input
                                       
                                        id="diagonose"
                                        type="text"
                                        class="mt-1 block w-full h-10"
                                        v-model="form.diagonose"
                                        autocomplete="diagonose"
                                      />
                                    </div>
                                  </div>
                             </div>
                             <div>
                                <div class="mt-2 flex flex-row">
                                    <div class="w-52 pl-3 py-0">
                                        <div class="py-0 text-right pr-1 text-bold text-lg text-blue-800 w-full m-0">Chỉ định XN: <span class="m-0 p-0 font-normal text-base font-italic text-gray-400">(doctor)</span></div>
                                    </div>
                                    <div class="w-full">
                                         <select
                                          name="testname_id"
                                          id="testname_id"
                                          class="block form-input rounded-lg w-full h-10 "
                                          v-model="form.testname_id">
                                      <option value='1'>ThinPrep - Pap Smear</option>
                                      <option value='2'>HPV</option>
                                  
                                    </select>
                                    </div>
                                  </div>
                             </div>  
                        </div>                 
                         <div class="ml-2 flex flex-row">
                              <div class="mt-2 w-1/2">
                                <div class="flex flex-row">
                                <jet-label for="sample_id" class="self-center text-right pr-1 text-bold text-lg text-blue-800 w-48" value="Mã XN ĐV gửi:" />
                                <jet-input
                                 
                                  id="sample_code"
                                  type="text"
                                  class="mt-1 block w-full h-9"
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
 import Checkbox from '@/Jetstream/Checkbox'


export default defineComponent({
  
  name: "Thành phần xét nghiệm",
  props: {
    //testGroups:'',
    //testNames:'', 
    billtests:'',
    provinces:'',
    districts:'',
    wards:'',
    ousents:'',
    doctors:'',
    //filters:{},
    //testUnits:'', 
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
    Checkbox
 
  },
data(){
  return{
    //testGroup:this.filters.testGroup,
    //testName:this.filters.testName,
    //elementSearch:this.filters.elementSearch,
   // districts:'',
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
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",
    titleHeader:'Edit',
    example4: {
        mode: "tags",
        value: "value",
        label: "name",
        //options: this.roles.data,
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
        { name: "Tên khách hàng", class:'border-l-2' },
        { name: "Năm sinh", class:'border-l-2' },
        { name: "Địa chỉ", class:'border-l-2 text-center' },
        { name: "Điện thoại", class:'border-l-2 text-center px-1' },
        { name: "Chỉ định xét nghiệm", class:'border-l-2' },
        { name: "Bác sỹ chỉ định", class:'border-l-2' },
          { name: "Đơn vị gửi mẫu", class:'border-l-2' },
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
    // checkForm:function(e){
    //   alert(123);
    //   if(this.name && (this.name.length >=2)){
    //    alert(this.name.length);
    //   }
    //   this.form_errors =[];
    //   if(!this.name ){
    //     this.form_errors.push('Nhập tên');
    //   }
    // },
    getDoctorFill(doctor){
      console.log(this.doctors);
     const fillData = this.doctors.filter(function(el){
       return el.ousent_id == doctor;
     });
     console.log(fillData);
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
              perPage:this.perPage,
              testName:this.testName
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
                 testName:this.testName
               
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
