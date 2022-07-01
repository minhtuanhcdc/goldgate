<template>
  <app-layout title="Image list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>

      <Card>
          <div class="flex justify-between mb-2">
              <div class="bg-gray-200 border-1 border-gray-800 px-2 py-1 rounded-lg">
                <label class="mr-2 text-blue-700 font-bold">Upload Image Left</label>
                  <input @change="uploadLeft($event)"
                    type="file"
                    name="pictureLeft"
                    id="new-file"
                    class="custom-file-input"
                    aria-label="picture"
                    multiple
                    >
                <button class="bg-blue-900 cursor-pointer py-1 px-2 rounded-sm hover:bg-blue-500 hover:text-gray-900 text-white" @click="submitLeft" type="button" >Submit</button>
              </div>
               <div class="bg-gray-300 border-1 border-gray-800 px-2 py-1 rounded-lg">
                <label class="mr-2 text-green-700 font-bold">Upload Image Right</label>
                  <input @change="uploadRight($event)"
                    type="file"
                    name="pictureRight"
                    id="new-file"
                    class="custom-file-input"
                    aria-label="picture"
                    multiple
                    >
                <button class="bg-blue-900 cursor-pointer py-1 px-2 rounded-sm hover:bg-green-500 hover:text-gray-900 text-white" @click="submitRight" type="button" >Submit</button>
              </div>
           </div>
           <hr>
    <div class="flex justify-between mt-2 my-1">
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
        <Table :headers="headers" :addClass="addClass">

          <tr class="hover:bg-blue-300" v-for="(imageview, i) in imageviews.data" :key="i">
            <td class="border-r-2">{{imageview.id}}</td>
            <td class="border-r-2">{{imageview.thinprep_code}}</td>
            <td class="border-r-2 text-center">
              <div class="flex justify-center">
                <img
                  class="h-16 w-16 rounded-sm"
                 :src="pathThinLeft+`${imageview.thinLeft}`"
                  alt=""
                />
                <span class="rouded-md bg-red-500 h-4 w-4 ml-4 text-white cursor-pointer text-xs">X</span>
              </div>
            </td>
            <td class="border-r-2 text-center">
              <div class="flex justify-center">
                <img
                  class="h-16 w-16"
                  :src="pathThinRight+`${imageview.thinRight}`"
                  alt=""
                />
              </div>
            </td>

            <td class="text-center">28/06/2022</td>
            <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editOu(imageview)"
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
                    :url="route('images.destroy', imageview.id)"
                  class="p-0 cursor-pointer text-red-700"
                   module-name="imageview"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
         <div class="flex">
            <!-- <template v-for="(link, i) in ousents.links" :key="i" >
             <div v-if="link.url === null" v-html="link.label" class="mb-1 mr-1 px-3 py-2 text-gray-400 text-sm leading-4 border rounded"></div>
             <Link v-else :href="link.url" v-html="link.label" class="mb-1 mr-1 px-3 py-2 text-gray-400 text-sm leading-4 border rounded
             focus:text-indigo-500 focus:border-indigo-500
             hover:bg-red-400"
             :class="{'bg-blue-500 text-white' : link.active}"
             />
           </template> -->
         </div>
        </div>


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
import { useForm } from '@inertiajs/inertia-vue3'
import Label from "../../Jetstream/Label.vue";

export default defineComponent({

  name: "Image Thinprep",
  props: {
    imageviews:'',
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

    Link


  },
    Label,
//   setup() {
//         const form = useForm({
//             images:'',
//         });

//         return { form };
//     },
data(){
  return{
   pathThinLeft:'/storage/imageThinLeft/',
   pathThinRight:'/storage/imageThinRight/',
    userEdit:'',
    showModal:'',
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"2xl",
    titleHeader:'Edit',

 form: new useForm({contract_id: 5, files: []})

    }
  },

  computed: {
    breadcrumbs() {
      return [
        {
          label: "List Image Thinprep",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Mã Thinprep", class:'border-l-2 text-center' },
        { name: "ImageLeft", class:'border-l-2 text-center' },
        { name: "ImageRigt", class:'border-l-2 text-center' },
        { name: "Date Upload", class:'border-l-2 text-center' },
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
        return "bg-green-600 text-white";
      },
    },

  methods:{
       uploadLeft(event) {
                for (let file of event.target.files) {
                    try {
                        let reader = new FileReader();
                        reader.readAsDataURL(file); // Not sure if this will work in this context.
                        this.form.files.push(file);
                    } catch {}
                }
            },
      submitLeft(){
                 this.form.post('/dashboard/images/',{
                preserveScroll:true
            });
      },
       uploadRight(event) {
                for (let file of event.target.files) {
                    try {
                        let reader = new FileReader();
                        reader.readAsDataURL(file); // Not sure if this will work in this context.
                        this.form.files.push(file);
                    } catch {}
                }
            },
      submitRight(){
                 this.form.post('/dashboard/imagesRight/',{
                preserveScroll:true
            });
      },

    // submitFile() {

    //         console.log('Chiiiiiiiiiiiiiiiiiiiiiiieuuuuuuu', this.$refs.photo.files.lenght);
    //         if (this.$refs.photo) {
    //             for(let index = 0; index <this.$refs.photo.files.lenght; index++){
    //                 const file = this.$refs.photo.files[index]
    //                   this.form.images = file
    //             }

    //         }
    //         this.form.post('/dashboard/images/',{
    //             preserveScroll:true
    //         });

    //     },
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
            username: null,
            }
        },
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
