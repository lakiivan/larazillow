<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <SingleListingComponent v-for="listing in listings" :key="listing.id" :listing="listing" />
  </div>
</template>

<script setup>
import SingleListingComponent from '@/Pages/Listing/Index/Components/SingleListingComponent.vue'


defineProps ({
  listings: Array,
})
</script>