<template>
  <div>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
      <div class="container mx-auto">
        <nav class="p-4 flex items-center justify-between">
          <div class="text-lg font-medium">
            <Link :href="route('listing.index')">Listings</Link>
          </div>
          <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
            <Link :href="route('listing.index')">LaraZillow</Link>
          </div>
          <div>
            <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
          </div>
        </nav>
      </div>
    </header>

    <div v-if="$page.props.flash.success" class="success">{{ $page.props.flash.success }}</div>

    <slot>Default</slot>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

// $page.props.value.flash.success


</script>

<style scoped>
    .success {
      background-color: green;
      color: white;
    }
</style>