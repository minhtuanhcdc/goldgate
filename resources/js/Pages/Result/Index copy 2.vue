<template>
  <app-layout title="Nhập Kết quả">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <!---
       :src="pathImage+`${ou.logo}`"
       src="/storage/image_Ousent/202205161136.jpg"
      --->
      <Card>
           <Button  class="mb-1 float-right cursor-pointer text-xs"  @click="addLaboGroup">+Import Image</Button>
        <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-blue-300" v-for="(bill ,i) in billtests.data" :key="i">
            <td class="border-r-2 text-center"><input type="checkbox" class="w-3 h-3 cursor-pointer"/></td>
            <td class="border-r-2 text-center">{{i}}</td>
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
            <td class="border-r-2"></td>

            <td class="text-center border-r-2 w-24">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
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

                  title="Edit"
                  class="text-green-800"

                  >
              <svg

                class="w-6 h-6 text-gray-200"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
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
                <EditBtn class="" @click="viewInputResult(bill)">
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
         <div class="flex">

         </div>
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
               <div class="px-4 pb-0">
                 <div class="grid grid-cols-4 leading-6">
                          <div class="col-span-2  font-sans-Timenew italic underline underline_offset-1">Họ và tên (Name):<span class="font-bold"> {{name}}</span></div>
                          <div class="  font-sans-Timenew italic underline underline-offset-1">Mã Thinpred:<span class="font-bold">{{form.thinprep_code}}</span> </div>
                    </div>
                   <form
                    class="py-1 px-2 sm:p-1 sm:px-2 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveResultThin(form)">

                    <div>
                       <!--==============--->
        <div class="text-center font-bold text-md font-sans-Timenew mt-1 text-red-600">KẾT QUẢ TẾ BÀO HỌC CỔ TỬ CUNG THEO HỆ THỐNG BETHESDA 2014</div>
        <div class="grid grid-cols-5 font-sans-Timenew leading-6">
          <div class="font-bold italic col-span-2">Đánh giá lam (Specimen evalueation)</div>
          <div class="font-bold text-center align-midle italic">Đạt (Satisfactory) <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i></div>
          <div class="font-bold text-center italic col-span-2">Không đạt (Unsatisfactory) <i class="fa fa-square-o"></i></div>
        </div>
        <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Bình thường <i class="fa fa-square-o"></i></div>
        <div class="text-left font-bold text-md  font-sans-Timenew text-blue-900"> - Biến đổi lành tính(Begin changes) <i class="py-1 mr-1 fa fa-check-square text-blue-800"></i></div>
        <div class="grid grid-cols-5 font-sans-Timenew leading-6 italic text-xs font-bold">
          <div class="" v-for="(el6,i) in testElement_6" :key="i">+ {{el6.name}}- {{el6.id}}
               <input type="checkbox" name='el6_id' :value="el6.id" v-model="form.element_code"/>
          </div>

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
               <span class="font-bold text-red-800 font-sans-Timenew text-md underline underline-offset-2">KẾT LUẬN (Conclution):</span>
               <span class="font-bold text-red-700 font-sans-Timenew text-xs uppercase">- Không tổn thương trong biểu mô hay ung thư</span>
               <span class="font-bold text-md font-sans-Timenew">- Tế bào cổ tử cung biến đổi do viêm</span>
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
                                v-show="editMode" @click.prevent="updateLaboGroup(form)">
                                Update
                              </button>
                            </span>
                    </div>
                </form>
              </div>
            </template>
        >
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
 import FormTudu from './FormTudu.vue'
 import FormSaigon from './FormSaigon.vue';
 import FormVigor from './FormVigor.vue';
 import FormGeneral from './FormGeneral.vue';
import Input from "../../Jetstream/Input.vue";


export default defineComponent({

  name: "Danh sách đơn vị gửi mẫu",
  props: {
    billtests:'',
    testElement_6:'',
     errors: Object,
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
    Link,
    Checkbox,
    FormTudu,
    FormSaigon,
    FormVigor,
    FormGeneral,
    Input
  },

data(){
  return{
    //element_code:'',
    viewOusent:'',
     checkedit:'',
     billtestShow:'',
     name:'',
     age:'',
   pathImage:'/storage/image_Ousent/',
     pathThinLeft:'/images/Thinprep/hLeft.jpg',
      pathThinRight:'/images/Thinprep/hRight.jpg',
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
    form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
         // name: "",
         // title: "",
          //slug: "",
          element_code:this.checkedit
          //description: this.edit ? this.article.data.description : "",
         // image: "",
        },
        {
          resetOnSuccess: false,
        }
      ),
    }
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
        { name: "Tên Bệnh nhân", class:'border-l-2' },
        { name: "Giới tính", class:'border-l-2 text-center' },
        { name: "Năm sinh", class:'border-l-2 text-center' },
        { name: "Đơn vị gửi mẫu", class:'border-l-2 text-center' },
        { name: "Chỉ định XN", class:'border-l-2 text-center' },
        { name: "Mã HPV", class:'border-l-2 text-center' },
        { name: "Mã ThinPrep", class:'border-l-2 text-center' },
        { name: "Image", class:'border-l-2 text-center' },
        { name: "Kết quả", class:'border-l-2 text-center' },
        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-blue-300";
      },
      bgSave(){
        return "bg-blue-900 text-white";
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
    viewInputResult(bill) {
        //console.log('Heheheheheheheehehehe:',bill);
        //console.log(b);
        var checked111=this.form = Object.assign({}, bill);
        this.checkededit= checked111.status;
        this.billtestShow=checked111;
        this.name=checked111.custommer.name;
        this.age=checked111.custommer.birthday;
        //this.editMode = false;

     this.showModal=true;
        },

    saveResultThin(data) {
      //alert(123);

       this.$inertia.post('/dashboard/results/',data)
    },
     updateResult(data){
      //console.log('hehehe',data.phon);
       data._method = 'PUT';
        //this.$inertia.post('/dashboard/users/'+data.id, data)
        this.reset();
        this.closeModal();
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
      addLaboGroup(){

            this.showModal = true;
            },
    //  openModalEdit(user) {

    //          this.userEdit=user;
    //          console.log('roles_ididididid:',this.userEdit.name);
    //           this.showModal = true;
    //             this.editMode=true;
    //         },




  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
