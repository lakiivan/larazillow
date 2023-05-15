<template>
  <IndexCompFilters :filters="filters" />
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <SingleListingComponent v-for="listing in listings.data" :key="listing.id" :listing="listing" />
  </div>
  <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
    <UiPagination :links="listings.links" />
  </div>
</template>

<script setup>
import UiPagination from '@/Components/UI/UiPagination.vue'
import SingleListingComponent from '@/Pages/Listing/Index/Components/SingleListingComponent.vue'
import IndexCompFilters from './Index/Components/IndexCompFilters.vue'

defineProps ({
  listings: Object,
  filters: Object,
})
</script>