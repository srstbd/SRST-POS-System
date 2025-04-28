<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div
      :class="{ hidden: !isSidebarOpen, 'lg:block': true }"
      class="lg:w-64 bg-blue-800 text-white p-4"
    >
      <div class="text-2xl font-semibold mb-8">POS System</div>
      <ul>
        <li class="mb-4">
          <NuxtLink to="/dashboard" class="hover:bg-blue-600 px-4 py-2 rounded"
            >Dashboard</NuxtLink
          >
        </li>
        <li class="mb-4">
          <NuxtLink to="/pos" class="hover:bg-blue-600 px-4 py-2 rounded"
            >POS Screen</NuxtLink
          >
        </li>
        <!-- Add more menu items -->
      </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-white">
      <!-- Header -->
      <header class="bg-white shadow-md p-4 flex items-center justify-between">
        <button
          @click="toggleSidebar"
          class="lg:hidden bg-blue-500 text-white p-2 rounded"
        >
          ☰
        </button>
        <div class="text-xl font-semibold">Welcome to the POS System</div>
        <div>
          <button class="bg-blue-500 text-white py-2 px-4 rounded">
            Logout
          </button>
        </div>
      </header>

      <!-- Page Content -->
      <main class="p-6">
        <NuxtPage />
      </main>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isSidebarOpen: false,
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
  },
};
</script>

<style scoped>
/* Add any custom styles here */
</style>
