<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <Card>
        <div class="px-2 grid grid-cols-1 mb-2 bg-gray-200">
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
          <div class="flex justify-between mt-2">
           <Button  class="mb-1 float-right cursor-pointer"  >Nhập Kết quả <span class=" font-bold text-md">(9)</span> </Button>
            <div class=" bg-blue-100">
              <div class=" text-right">
                <div class="flex mb-2 text-right h-8 px-2 w-full">
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
              <form @submit.prevent="submitFile">
                <div class="flex flex-row">
                    <div class=" p-0 w-56">
                      <input type="file"
                        class=" px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                        @change="previewImage" ref="photo"/>
                    </div>
                    <div class="flex items-center mt-0">
                      <button class="px-2 py-1 text-white bg-gray-900  rounded">Upload File</button>
                    </div>
                </div>
              </form>
          </div>
        </div>
         <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-blue-300" v-for="(bill ,i) in billtests.data" :key="i">
            <td class="border-r-2 text-center"><input type="checkbox" class="w-3 h-3 cursor-pointer"/></td>
            <td class="border-r-2 text-center">{{i}}</td>
            <td class="border-r-2 text-center">{{bill.id}}</td>
            <td class="border-r-2">{{bill.custommer.name}}</td>
            <td class="border-r-2">{{bill.custommer.gender}}</td>
            <td class="border-r-2">{{bill.custommer.birthday}}</td>
            <td class="border-r-2">{{bill.ousent.name}}</td>
            <td class="border-r-2">
              <span v-for="(tn,i) in bill.testnames" :key="i">
                {{tn.name}},
              </span>
            </td>
             <td class="border-r-2">{{bill.hpv_code}}</td>
            <td class="border-r-2">{{bill.thinprep_code}}</td>
            <td class="border-r-2">Image</td>

            <td class="border-r-2 w-32">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                v-show="bill.result_status==1"
                  title="Edit"
                  class="text-green-800"
                    @click="editUser(bill)"
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
                <EditBtn v-if="bill.result_status ==1" disabled>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                      <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                </EditBtn>
                <EditBtn title="Nhập KQ" v-else class="" @click="addResult(bill)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-800" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z" />
                      <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />
                    </svg>
                </EditBtn>
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
        </div>
         <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave" :maxWidth="maxWidth">
            <template v-slot:title >
               <div class="flex justify-between text-blue-900 font-bold border-b-1 border-blue-200">
                <h3 v-show="!editMode" >Nhập kết quả ThinPrep </h3>
                <h3 v-show="editMode">Cập nhật kết quả ThinPrep</h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
            <template v-slot:content>
              <div v-if="viewOutsent == 6">
                  <div class="grid grid-cols-4 leading-6">
                    <div class="col-span-2  font-sans-Timenew italic underline underline_offset-1">Họ và tên (Name): <span class="font-bold">  {{name}}</span></div>
                    <div class="  font-sans-Timenew italic underline underline-offset-1">Test Id:<span ref="" class="font-bold">{{test_id}}</span> </div>
                    <div class="  font-sans-Timenew italic underline underline-offset-1">Mã Thinpred:<span ref="span_thin" class="font-bold">{{thinprep_code}}</span> </div>
                  </div>
                    <hr>
                <form
                    class="py-1 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"

                    @submit.prevent="saveResult(form)">
                <h1>form Sài Gòn</h1>
                <div class="text-center font-bold text-md underline underline-offset-2 font-sans-Timenew mt-2 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG (BETHESDA 2014)</div>
                  <div class="text-left font-bold text-md  font-sans-Timenew mt-2 text-blue-800">LOAI BỆNH PHẨM <span class="pl-5 text-red-600 mr-0 pr-0">Tế bào học nhúng dịch ThinPrep</span>
                  <span class="text-red-600 align-top ml-0 p-0">&reg;</span>
                  </div>
                  <div class="grid grid-cols-4">
                    <div class="text-left font-bold text-md  font-sans-Timenew mt-0 text-blue-800">TÍNH CHẤT BỆNH PHẨM </div>
                        <div class="col-span-3 flex flex-row" >
                          <div class="" v-for="eg11 in testElements" :key="eg11.id">
                            <span class="mr-8 font-bold" v-if="eg11.element_group ==11">
                              <input type="checkbox" class="form-checkbox text-pink-600 h-4 w-4" :value="eg11.id" v-model="form.element_id"/>
                              <span class="ml-1">{{eg11.name}}</span>
                            </span>
                          </div>
                        </div>
                  </div>
                  <!--/==============--->
                  <!--==============--->
                  <div class="font-bold text-blue-800 font-sans-Timenew text-md mt-0">KẾT QUẢ</div>
                    <div class="grid grid-cols-3">
                        <div class="" v-for="eg12 in testElements" :key="eg12.id">
                            <span class="mr-8 font-bold" v-if="eg12.element_group ==12">
                              <input type="checkbox" class="form-checkbox text-pink-600 h-4 w-4" :value="eg12.id" v-model="form.element_id"/>
                              <span class="ml-1">{{eg12.name}}</span>
                            </span>
                          </div>
                    </div>
                  <div class="grid grid-cols-3 mt-2">
                      <div>
                        <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào do vi sinh</span>
                        <div class="flex flex-col ml-4 leading-6">
                            <div class="" v-for="eg13 in testElements" :key="eg13.id">
                            <span class="mr-8 font-bold" v-if="eg13.element_group ==13">
                              <input type="checkbox" class="form-checkbox text-pink-600 h-4 w-4" :value="eg13.id" v-model="form.element_id"/>
                              <span class="ml-1">{{eg13.name}}</span>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-span-2">
                        <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào Gai</span>
                        <div class="flex flex-col leading-6">
                           <div class="" v-for="eg14 in testElements" :key="eg14.id">
                            <span class="mr-8 font-bold" v-if="eg14.element_group ==14">
                              <input type="checkbox" class="form-checkbox text-pink-600 h-4 w-4" :value="eg14.id" v-model="form.element_id"/>
                              <span class="ml-1">{{eg14.name}}</span>
                            </span>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="grid grid-cols-3 mt-2">
                      <div>
                        <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Biến đổi tế bào khác</span>
                        <div class="flex flex-col">
                           <div class="flex flex-col leading-6">
                           <div class="" v-for="eg15 in testElements" :key="eg15.id">
                            <span class="mr-8 font-bold" v-if="eg15.element_group ==15">
                              <input type="checkbox" class="form-checkbox text-pink-600 h-4 w-4" :value="eg15.id" v-model="form.element_id"/>
                              <span class="ml-1">{{eg15.name}}</span>
                            </span>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="col-span-2">
                        <span class="underline underline-offset-1 font-sans-Timenew font-bold text-sm uppercase text-blue-700">Tế bào tuyến</span>
                        <div class="flex flex-col leading-5">
                            <div class="" v-for="eg16 in testElements" :key="eg16.id">
                            <span class="mr-8 font-bold" v-if="eg16.element_group ==16">
                              <input type="checkbox" class="form-checkbox text-pink-600 h-4 w-4" :value="eg16.id" v-model="form.element_id"/>
                              <span class="ml-1">{{eg16.name}}</span>
                            </span>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="grid grid-cols-2">
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
                        <div  v-for="eg9 in testElements" :key="eg9.id">
                                <span class="font-bold text-xl" v-if="eg9.element_group ==9">{{eg9.name}}
                                  <span v-if="eg9.id == 26">
                                      <input  type="text" class="w-full rounded-md h-10" v-model="form.ketluan">
                                  </span>

                                </span>
                              </div>
                      </div>

                        <div class="font-bold text-blue-800 font-sans-Timenew text-md underline underline-offset-2">ĐỀ NGHỊ:</div>
                    </div>
                    </div>
                      <div class="mt-4 text-center mb-1" >
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateResult(form)">
                                Update
                              </button>
                        </span>
                 </div>
                </form>
              </div>

              <!--========================================-->

             <div v-if="viewOutsent == 1 || viewOutsent == 9">
                <h1>Form Tu du và Vigor</h1>
                 <div class="px-4 pb-0">
                    <div class="grid grid-cols-4 leading-6">
                        <div class="col-span-2  font-sans-Timenew italic underline underline_offset-1">Họ và tên (Name): <span class="font-bold">  {{name}}</span></div>
                        <div class="  font-sans-Timenew italic underline underline-offset-1">Test Id:<span ref="" class="font-bold">{{test_id}}</span> </div>
                        <div class="  font-sans-Timenew italic underline underline-offset-1">Mã Thinpred:<span ref="span_thin" class="font-bold">{{thinprep_code}}</span> </div>
                    </div>
                    <hr>
                    <form
                        class="py-1 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                        @submit.prevent="saveResult(form)">
                        <div>
                        <div class="text-center font-bold text-md font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
                        <div class="grid grid-cols-5 font-sans-Timenew leading-6">
                        <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
                        <div class="col-span-3 grid grid-cols-2" >
                          <div class="" v-for="eg1 in testElements" :key="eg1.id">
                            <span class="font-bold" v-if="eg1.element_group ==1">{{eg1.name}} - {{eg1.id}}
                              <input   type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg1.id" v-model="form.element_id"/>
                            </span>
                          </div>
                          </div>
                        </div>
                        <div class="grid grid-cols-1">
                          <div class="" v-for="eg2 in testElements" :key="eg2.id">
                              <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg2.element_group ==2">- {{eg2.name}}
                                <input  type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg2.id" v-model="form.element_id"/>
                              </span>
                          </div>
                        </div>
                        <div class="flex flex-cols-5">
                          <div class="" v-for="eg3 in testElements" :key="eg3.id">
                            <span class="text-left font-bold text-xs  font-sans-Timenew mr-5 " v-if="eg3.element_group == 3">+ {{eg3.name}}
                                  <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg3.id" v-model="form.element_id"/>
                            </span>
                        </div>
                        </div>
                        <div class="grid grid-cols-1">
                          <div class="" v-for="eg4 in testElements" :key="eg4.id">
                            <span class="text-left font-bold text-md  font-sans-Timenew text-blue-900" v-if="eg4.element_group == 4">- {{eg4.name}}
                                  <input  type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg4.id" v-model="form.element_id"/>
                            </span>
                        </div>
                        </div>
                        <div class="col-span-2">
                            <span class=" font-sans-Timenew font-bold text-sm  text-blue-700">+ TẾ BÀO GAI (Squamuos cell)</span>
                              <div class="grid grid-cols-2 leading-5 italic">
                                <div class="flex flex-col">
                                  <div v-for="(eg5, i) in testElements" :key="i">
                                    <span class="ml-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg5.element_group == 5">{{eg5.name}}
                                      <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg5.id" v-model="form.element_id"/>
                                      </span>
                                  </div>
                                </div>
                                <div class="flex flex-col">
                                  <div class="" v-for="eg6 in testElements" :key="eg6.id">
                                    <span class="pl-2 text-left font-bold text-xs  font-sans-Timenew " v-if="eg6.element_group == 6">{{eg6.name}}
                                      <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg6.id" v-model="form.element_id"/>
                                      </span>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="grid grid-cols-1 mt-2">
                            <div>
                              <span class=" font-sans-Timenew font-bold text-sm uppercase text-blue-700">+ Tế bào Tuyến (Glandular cell)</span>
                                <div class="grid grid-cols-1 leading-5 italic">
                                  <div class="flex flex-cols-3 ">

                                  <div v-for="eg7 in testElements" :key="eg7.id">
                                    <span class="text-left font-bold text-xs  font-sans-Timenew mr-5" v-if="eg7.element_group == 7">{{eg7.name}}
                                      <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg7.id" v-model="form.element_id"/>
                                      </span>
                                  </div>
                                </div>

                              </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-5 font-sans-Timenew leading-6 mt-3">
                          <div class="font-bold italic">Đề nghị (Suggestions)</div>
                          <div class="col-span-3" >
                            <div class="grid grid-cols-2">
                                <div  v-for="eg8 in testElements" :key="eg8.id">
                                  <span class="font-bold text-xs" v-if="eg8.element_group ==8">{{eg8.name}}
                                    <input type="checkbox" class="form-checkbox text-pink-600 h-3 w-3" :value="eg8.id" v-model="form.element_id"/>
                                  </span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 mt-2 text-center">
                            <div  class="text-center">
                              <img
                                  class="w-56 max-h-40 "
                                  :src="pathThinLeft"
                                  :alt="LogoThin"/>
                                </div>
                            <div class="text-center">
                              <img
                                  class="w-56 max-h-40 "
                                  :src="pathThinRight"
                                  :alt="LogoThin"/>
                              </div>
                        </div>
                        <div class="grid grid-cols-3">
                        <div class="col-span-2">
                            <div class="grid grid-cols-1">
                              <div  v-for="eg9 in testElements" :key="eg9.id">
                                <span class="font-bold text-xl" v-if="eg9.element_group ==9">{{eg9.name}}
                                  <span v-if="eg9.id == 26">
                                      <input  type="text" class="w-full rounded-md h-10" v-model="form.ketluan">
                                  </span>

                                </span>
                              </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="mt-4 text-center mb-1" >
                              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                  <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                      Save
                                    </button>
                                  </span>
                                  <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button wire:click.prevent="store()" type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                      v-show="editMode" @click.prevent="updateResult(form)">
                                      Update
                                    </button>
                                  </span>
                        </div>
                    </form>
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
import Checkbox from "@/Jetstream/Checkbox";

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
import FormTuduVigor from "./FormTuduVigor.vue";

export default defineComponent({

  name: "Nhập Kết quả",
  props: {
    billtests:'',
    testElements:'',
    ousents:''
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
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
    Checkbox,
    FormTuduVigor

  },
data(){
  return{
    element_id:[],
    checkedElement:[],
    ket_luan:[],
    ketluan:'',
    viewOutsent:'',
    name:'',
    test_id:'',
    thinprep_code:'',
    userEdit:'',
    showModal:'',
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",
    titleHeader:'Nhập kết quả',
    example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options: '',
        searchable: true,
        createTag: true,
    },

    form: this.$inertia.form({
          element_id:[1,4],
          ket_luan:[],
          bill_id:'',
          thin_code:'',
          hpv_code:'',
      },
        {
          resetOnSuccess: false,
        }
      ),
    }
  },
  methods:{
     created(){
   this.paymentmethods.forEach((value) => {
     this.pays.push({id:value.value, ref: 'test123' , val: 0 })
   });
   console.log(this.pays);
  },
          openModal(){
                this.showModal=true;
              },
          reset() {
              this.form = {
                element_id:[],
                ket_luan:'',
                bill_id:'',
                thin_code:'',
                hpv_code:'',
                }
            },
          closeModal(){
              this.showModal=false;
              this.editMode=false;
              this.reset();
              },
          updateResult(bill){
            //alert(123);
           // let kl = bill.results.map(({ result }) => result)

             //const ketluan = kl.slice(1)
             const data = {
              'ket_luan':bill.ketluan,
              'thin_code': bill.thinprep_code,
              'bill_id': bill.id,
              'element_id': bill.element_id,
              };
              //const data3 = {...bill, ...data2 }
           //const data = bill;
                data._method = 'PUT';
                this.$inertia.post('/dashboard/results/'+bill.id, data);
                this.reset();
                this.closeModal();
            },
          saveResult(data) {
            const data2 = {
              'ket_luan':this.form.ketluan,
              'thin_code': this.thinprep_code,
              'bill_id': this.test_id,
              };
                const data3 = {...data, ...data2 }
                    //this.$inertia.post('/dashboard/results',[{'form1':data, 'form2':thin_code}])
                    this.$inertia.post('/dashboard/results',data3)
                   // this.reset();
                    this.closeModal();
                },
          editUser(bill) {
              this.form = Object.assign({}, bill);
              //console.log(bill);
               this.viewOutsent= bill.ousent.id;
              this.name = bill.custommer.name;
              const elementChecked1 =bill.results;

             var ketluanFill = elementChecked1.find(obj => {
                      return obj.element_id ==26
                    })
            // console.log('Tessssssssssssssss',ketluanFill);

                let result = elementChecked1.map(({ element_id }) => element_id)

                this.form.ketluan = ketluanFill.result;
                this.form.element_id =result;
                this.editMode = true;
                this.showModal=true;
              },
          addResult(bill){
              const getBill = Object.assign({}, bill)
              this.viewOutsent= bill.ousent.id;
              this.name = getBill.custommer.name;
              this.thinprep_code = getBill.thinprep_code;
              this.test_id = getBill.id;
              this.showModal=true;
            },
  },
    computed: {
    breadcrumbs() {
      return [
        {
          label: "Nhập kết quả",
          class: "text-white",
        },
      ];
    },
   headers() {
      return [
        { name: "Select", class:'w-12  text-center' },
        { name: "#", class:'w-12 border-l-2 text-center' },
        { name: "Bill Id", class:'w-12 border-l-2 text-center' },
        { name: "Tên Bệnh nhân", class:'border-l-2' },
        { name: "Giới tính", class:'border-l-2 text-center' },
        { name: "Năm sinh", class:'border-l-2 text-center' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center' },
        { name: "Chỉ định XN", class:'border-l-2 text-center' },
        { name: "Mã HPV", class:'border-l-2 text-center' },
        { name: "Mã ThinPrep", class:'border-l-2 text-center' },
        { name: "Image", class:'border-l-2 text-center' },

        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-gray-300";
      },
      bgSave(){
        return "bg-gray-600 text-white";
      },
      bgEdit(){
        return "bg-green-500 text-white";
      },
      thin(){
        return this.thinprep_code;
      }
    },
    mounted() {
    if (this.edit) {
     // this.form.role_id=[1];
      // //this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      //this.form.element_id =[1,3];
      // this.form.username =this.user.data.username;
      // this.form.email = this.user.data.email;
      // this.form.phone = this.user.data.phone;
      // this.imageUrl = this.user.data.profile_photo_path;
    }
  },
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
