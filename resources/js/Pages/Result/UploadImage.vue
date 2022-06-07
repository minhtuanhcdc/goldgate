<template>
  <app-layout title="Image list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>

      <Card>
          <div class="flex justify-end mb-2">

                <input @change="upload($event)"
                    type="file"
                    name="picture"
                    id="new-file"
                    class="custom-file-input"
                    aria-label="picture"
                    multiple
                    >

                <button class="bg-green-300 cursor-pointer py-1 px-2 rounded-sm" @click="submit" type="button" >Submit</button>


           </div>
        <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-blue-300" v-for="(img, i) in imageviews" :key="i">
            <td class="border-r-2">{{i+1}}</td>
            <td class="border-r-2">{{img.thinprep_code}}</td>
            <td class="border-r-2">
                <img
                  class="h-20 w-24 rounded-full"
                 :src="pathThinLeft+`${img.thinLeft}`"
                  alt=""
                />
            </td>
            <td class="border-r-2">
                <img
                  class="h-20 w-24 rounded-full"
                  :src="pathThinRight+`${img.thinRight}`"
                  alt=""
                />
            </td>
            <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editOu(ou)"
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

                  class="p-0 cursor-pointer text-red-700"
                  module-name="ou"
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
          label: "Đơn vị gửi mẫu",
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
       upload(event) {
                for (let file of event.target.files) {
                    try {
                        let reader = new FileReader();
                        reader.readAsDataURL(file); // Not sure if this will work in this context.
                        this.form.files.push(file);
                    } catch {}
                }
            },
            submit(){
                 this.form.post('/dashboard/images/',{
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
