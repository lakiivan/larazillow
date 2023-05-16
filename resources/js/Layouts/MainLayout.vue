<template>
  <div>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
      <div class="container mx-auto w-full">
        <nav class="p-4 flex items-center justify-between">
          <div class="text-lg font-medium">
            <Link :href="route('listing.index')">Listings</Link>
          </div>
          <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
            <Link :href="route('listing.index')">LaraZillow</Link>
          </div>
          <div v-if="user" class="flex items-center gap-4">
            <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')">{{ user.name }}</Link>
            <Link :href="route('realtor.listing.create')" class="btn-primary">+ New Listing</Link>
            <div>
              <Link :href="route('logout')" method="delete" as="button">Logout</Link>
            </div>
          </div>
          <div v-else class="flex items-center gap-2">
            <Link :href="route('user-account.create')">Sign In</Link>
            <span> | </span>
            <Link :href="route('login')">Log In</Link>
          </div>
        </nav>
      </div>
    </header>

    <div v-if="$page.props.flash.success" class="success">{{ $page.props.flash.success }}</div>

    <slot>Default</slot>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

// $page.props.value.flash.success
const user = computed (
  () => usePage().props.user,
)

</script>

<style scoped>
    .success {
      background-color: green;
      color: white;
    }
</style>