<template>
  <Box>
    <div>
      <Link :href="route('listing.show',{listing: listing.id})">
        <div class="flex items-center gap-1">
          <ListingPrice :price="listing.price" class="text-2xl font-bold" />
          <div class="text-xs text-gray-500">
            <ListingPrice :price="monthlyPayment" />
          </div>
        </div>
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Link>
    </div>
  </Box>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/UI/ListingSpace.vue'
import ListingPrice from '@/Components/UI/ListingPrice.vue'
import {useMonthlyPayment} from '@/composables/useMonthlyPayment'

const props = defineProps ({
  listing: Object,
})

const {monthlyPayment} =  useMonthlyPayment(props.listing.price, 2.5, 25) 

</script>