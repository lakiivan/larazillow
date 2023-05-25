<template>
  <div class="flex flex-col-reverse md:grid grid-cols-12">
    <Box v-if="listing.images.length" class="md:col-span-7 flex items-center">
      <div class="grid grid-cols-2 gap-1">
        <img
          v-for="image in listing.images" :key="image.id"
          :src="image.src"
        />
      </div>
    </Box>

    <EmptyState v-else class="md:col-span-7 flex items-center">No images</EmptyState>

    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>
          Basic info
        </template>

        <div class="flex items-center">
          <ListingPrice :price="listing.price" class="text-2xl font-bold" />
          <div class="text-xs text-gray-500">
            <ListingPrice :price="400" />
          </div>
        </div>

        <ListingSpace :listing="listing" />
        <ListingAddress :listing="listing" />
      </Box>
      <Box>
        <template #header>
          Monthly Payment
        </template>
        <div>
          <label class="label">Interest rate {{ interestRate }}</label>
          <input v-model.number="interestRate" type="range" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" min="0.1" max="30" step="0.1" />
          <label class="label">Duration ({{ duration }} years)</label>
          <input v-model.number="duration" type="range" class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" min="3" max="35" step="1" />
          <div class="text-gray-600 dark:text-gray-300 mt-2">
            <div class="text-gray-600">Your monthly payment</div>
            <ListingPrice :price="monthlyPayment" class="text-3xl" />
          </div>
          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Total Paid </div>
              <div>
                <ListingPrice :price="totalPaid" />
              </div>
            </div>
          </div>
          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Principal Paid </div>
              <div>
                <ListingPrice :price="listing.price" />
              </div>
            </div>
          </div>
          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Interest Paid </div>
              <div>
                <ListingPrice :price="totalInterest" />
              </div>
            </div>
          </div>
        </div>
      </Box>
      <MakeOffer 
        v-if="user && !offerMade"
        :listing-id="listing.id"
        :price="listing.price" 
        @offer-updated="offer = $event"
      />
      <OfferMade v-if="user && offerMade" :offer="offerMade" />
    </div>
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/UI/ListingSpace.vue'
import ListingPrice from '@/Components/UI/ListingPrice.vue'
import Box from '@/Components/UI/Box.vue'
import MakeOffer from '@/Pages/Listing/Show/Components/ListingShowComponentMakingOffer.vue'
import OfferMade from '@/Pages/Listing/Show/Components/ListingOfferMade.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'

import { ref } from 'vue'

import { useMonthlyPayment } from '@/composables/useMonthlyPayment'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const interestRate = ref(2.5)
const duration = ref(25)
const offer = ref(props.listing.price)

const props = defineProps ({
  listing: Object,
  offerMade: Object,
})

const {monthlyPayment, totalPaid, totalInterest} =  useMonthlyPayment(offer, interestRate, duration) 

const page = usePage()
const user = computed(
  () => page.props.user,
)

</script>