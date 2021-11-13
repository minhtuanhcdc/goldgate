<template>
  <app-layout title="Add Category">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <form @submit.prevent="saveRole">
          <!--Name--->+
          <div class="grid grid-cols-2">
            <div class="">
              <jet-label for="name" value="Tên quyền" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                autocomplete="name"
              />
              <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <!--Username--->
            <div class="ml-4">
              <jet-label for="display_name" value="Display name" />
              <jet-input
                id="display_name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.display_name"
                autocomplete="display_name"
              />
              <jet-input-error :message="form.errors.display_name" class="mt-2" />
            </div>
          </div>

          <!--Status--->
          <div class="mt-4 container">
            <h2>Permission Menu</h2>
            <div
              class="mt-1 card bg-gray-200"
              v-for="permission in permissions.data"
              :key="permission.id"
            >
              <div
                class="card-header bg-blue-300 py-2 px-4"
                v-show="permission.parent_id == 0"
              >
                <Checkbox
                  v-model:checked="form.status"
                  @click="checkAll()"
                  :value="permission.id"
                />

                <span class="ml-2">{{ permission.name }}</span>
              </div>
              <div class="card-body grid grid-cols-5">
                <div
                  v-for="chilePermission in permissions.data"
                  :key="chilePermission.id"
                >
                  <div class="py-1" v-if="permission.id == chilePermission.parent_id">
                    <Checkbox
                      :checked="selected"
                      class="form-checkbox text-pink-600 h-4 w-4"
                      id="menuselected.id"
                      v-model:checkedChile="form.menuselected"
                      :value="chilePermission.id"
                    />
                    <span class="ml-1">{{ chilePermission.name }}</span>
                  </div>
                </div>
              </div>
            </div>
            <!--Item 2--->
          </div>

          <!--Action--->
          <div class="text-right mt-2">
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              <span v-if="edit">Updated.</span>
              <span v-else>Saved.</span>
            </jet-action-message>
            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              <span v-if="edit">Update</span>
              <span v-else>Save</span>
            </jet-button>
          </div>
        </form>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import AppTable from "@/Components/Table";

import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import CompSimplePage from "@/Components/SimplePage";
import AppImage from "@/Components/Image";
import Checkbox from "@/Jetstream/Checkbox";
import { strSlug } from "@/helpers.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Banner from "@/Jetstream/Banner";

export default {
  name: "Add Role",
  props: {
    edit: Boolean,
    role: Object,
    permissions: "",
  },
  components: {
    AppLayout,
    Container,
    Card,
    Breadcrumb,
    AppImage,
    DeleteBtn,
    CompSimplePage,
    AppTable,
    JetButton,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
    ClassicEditor,
    Checkbox,
    Banner,
  },
  data() {
    return {
      checkededit: "",
      selected: false,
      form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
          name: "",
          display_name: "",
          menuselected: [],
          status: [],
        },
        {
          resetOnSuccess: false,
        }
      ),
    };
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Role",
          url: route("roles.index"),
        },
        {
          label: `${this.edit ? "Edit" : "Add"} Role`,
        },
      ];
    },
  },
  watch: {},
  methods: {
    saveRole() {
      this.edit
        ? this.form.put(route("roles.update", { id: this.role.data.id }))
        : this.form.post(route("roles.store"));
    },
    checkAll() {
      this.selected = !this.selected;
      for (let $i = 3; $i <= 5; $i++) {
        this.form.menuselected.push($i);
      }
    },
  },
  mounted() {
    if (this.edit) {
      this.form.name = this.role.data.name;
      this.form.display_name = this.role.data.display_name;
      this.form.status = this.role.data.status;
    }
  },
};
</script>
