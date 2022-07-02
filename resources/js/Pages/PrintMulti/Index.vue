<template>

    <template>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="container">
          {{arrSelect}}
          <button class="bg-blue-800 cursor-pointer py-2 px-3 rounded-lg text-white"  @click="printDiv">Print Me</button>
        <div class="container" >

          <div class="printMe" v-if="this.billtudus">
             <PrintviewTudu :getbilltests="this.billtudus" :testElements="testElements" :printCustommers="printCustommers"
                        :printOutsent="printOutsent" :printDoctor="printDoctor"
                        :pathImageLeft="pathImageLeft"
                        :pathThinLeft='pathThinLeft'
                        :pathThinRight='pathThinRight'
                        :selectedArray='selectedArray'
                        :ketluan='ketluan'
                        :currentDate='currentDate()'
                        :imageThinLeft='imgeLeft'
                        :imageThinRight='imageRight'
              />

          </div>
    </div>
    </div>

    </Card>
  </Container>

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

import PrintviewTudu from '@/Pages/PrinviewMulti/FormTudu'
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

  name: "Danh sách(Report)",
  props: {
    billtests:'',
    billtudus:'',
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
    PrintHPV,

  },
data(){
  return{
    sco:'',
    logo:'',
    testselect:[1],
    checkDPF:[''],
    checkPrint:[],
    billPrint:'',
    url: null,
    getbilltests:this.billtudus,
     printCustommers:'',
    //printName:'',
    //printAge:'',
    printAddress:'',
    printOutsent:'',
    printDoctor:'',
    printNameTest:'',
    selectedArray:[2,4,5,6],
    imgeLeft:'',
    imageRight:'',
    ketluan:'BT biên đổi do viêm',

    output: null,
    ousentFill:"",

    pathThinLeft:'/storage/imageThinLeft/',
    pathThinRight:'/storage/imageThinRight/',
    pathLogo:'/storage/Image_Ousent/',
    pathImageLeft:'/images/Logo/Thinprep.jpg',

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
    showModlPrintMulti:false,
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"4xl",

    }
  },


  computed: {

  },
  methods:{

      printDiv(){

          window.print();
      },

    formatDate(value) {
    if (value) {
        return moment(String(value)).format('DD/MM/YYYY hh:mm')}
    },
    currentDate() {
          const current = new Date();
          const date = ' '+`${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`;
          return date;
        },

    closeModalPrint(){
         this.showModlPrint = false;
    },



  }
});

</script>


<style media="print">
@media print {
  /* .noPrint :not(.printMe){
    display:none;
  }*/
     body {
    visibility: hidden;
  }
  .printMe {
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
         margin-top: -1cm;

      }
     @page :left {
         margin-left: 0.5cm;

      }

      @page :right {

         margin-right: 0.5cm;
      }
.page-break {page-break-before: always !important; }

}


</style>


