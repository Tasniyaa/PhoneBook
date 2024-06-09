<script setup>
import { onMounted } from "vue";
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

onMounted(async () => {
  await authStore.getUser();
});
</script>
<template>
  <div class="max-w-7xl mx-auto">
    <div v-if="authStore.user">
      <h1>Dashboard</h1>
    </div>
    <div v-else>
      <h1>Go and login</h1>
    </div>
  </div>
</template>