<script setup>
  import { ref, onMounted } from "vue";
  import { useAuthStore } from "../stores/auth";
  import axios from 'axios';

  const authStore = useAuthStore();
  const contacts = ref([]);

  const getContacts = async () => {
    let url = '/api/contacts';
    try {
      const response = await axios.get(url);
      contacts.value = response.data.contacts;
      console.log(contacts.value);
    } catch (error) {
      console.log(error);
    }
  };
  const deleteContact = async(id) => {
    const confirmed = confirm("Are you sure you want to delete this contact?");
    if (!confirmed) {
      return; // Do nothing if the user cancels the confirmation
    }
    let url = `/api/delete_contact/${id}`;
    await axios.delete(url).then(response => {
      if(response.data.code == 200){
        alert(response.data.message);
        getContacts();
      }
    }).catch(error =>{
      console.log(error)
    });
  }
  onMounted(async () => {
    await authStore.getUser();
    getContacts();
  });

</script>



<template>
  <div class="max-w-7xl mx-auto">
    <div v-if="authStore.user">
      <div class="relative overflow-x-auto mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                ID
              </th>
              <th scope="col" class="px-6 py-3">
                Name
              </th>
              <th scope="col" class="px-6 py-3">
                Email
              </th>
              <th scope="col" class="px-6 py-3">
                Designation
              </th>
              <th scope="col" class="px-6 py-3">
                Contact No.
              </th>
              <th scope="col" class="px-6 py-3">
                Actions
              </th>
            </tr>
          </thead>
          <tbody>
            <tr 
              v-for="contact in contacts" :key="contact.id"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            >
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ contact.id }}
              </th>
              <td class="px-6 py-4">
                {{ contact.name }}
              </td>
              <td class="px-6 py-4">
                {{ contact.email }}
              </td>
              <td class="px-6 py-4">
                {{ contact.designation }}
              </td>
              <td class="px-6 py-4">
                {{ contact.contact_no }}
              </td>
              <td class="px-6 py-4">
                <button
                  class="mr-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                  @click.prevent="deleteContact(contact.id)"
                >
                  Delete
                </button>
                <router-link :to="{ name: 'EditContact', params: {id: contact.id}}"
                  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                  @click.prevent="editContact(contact.id)"
                >
                  Edit
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div v-else>
      <h1>Go and login</h1>
    </div>
  </div>
</template>