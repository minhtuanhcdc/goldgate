<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('users.create')" class="mb-1 justify-self-end"
           v-show="$page.props.user.can.create" >Add User</JetButton
          >
        </div>
        <Table :headers="headers" :addClass="addClass">
          <tr v-for="(user, i) in users.data" :key="i">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>
                <AppImage
                  class="mt-2"  
                  :image-url="`${user.profile_photo_path}`"
                  label="Image"
                />
            </td>
            <td>{{ user.username }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
            <td>
               <span v-for="(role,i) in user.permissionroles" :key="i" class="ml-2 bg-blue-500 px-1 rounded-lg text-white">
                  {{role.name}}  
              </span>
            
            </td>
            <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  :href="route('menupermision.edit',`${user.id }`)"
               
                  title="Cấp quyền Menu"
                  class="text-green-800"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                    />
                  </svg>
                </EditBtn>
                <EditBtn  v-show="$page.props.user.can.update" :href="route('users.edit', { user: user.id })" title="Edit">
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
                    ></path></svg
                ></EditBtn>
                <DeleteBtn
                 v-show="$page.props.user.can.delete"
                  :url="route('users.destroy', { user: user.id })"
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="user"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
          <!-- <CompSimplePage :prevUrl="users.links.prev" :nextUrl="users.links.next" /> -->
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
import CompSimplePage from "@/Components/SimplePage";
import AppImage from "@/Components/ImageView";
import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
  name: "Users",
  props: {
    users: {},
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    CompSimplePage,
    EditBtn,
    DeleteBtn,
    JetButton,
    AppImage
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "User",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Name" },
        { name: "Image" },
        { name: "Username" },
        { name: "Email" },
        { name: "Phone" },
        { name: "Roles" },
        { name: "Action", class: "text-right" },
      ];
    },
    addClass() {
      return "bg-gray-300";
    },
  },
});
</script>
