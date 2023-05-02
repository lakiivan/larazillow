<template>
  <div class="flex flex-col-reverse md:grid grid-cols-12">
    <Box class="col-span-12 md:col-span-7 flex items-center w-full">
      <div class="w-full text-center font-medium text-gray-500">
        No images
      </div>
    </Box>
    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>
          Basic info
        </template>
        <ListingPrice :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" />
        <ListingAddress :listing="listing" />
      </Box>
      <Box>
        <template #header>
          Offer
        </template>
        Make an offer
      </Box>
    </div>
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/UI/ListingSpace.vue'
import ListingPrice from '@/Components/UI/ListingPrice.vue'
import Box from '@/Components/UI/Box.vue'

defineProps ({
  listing: Object,
})
</script>