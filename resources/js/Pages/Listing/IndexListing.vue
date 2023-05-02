<template>
  <div v-for="listing in listings" :key="listing.id">
    <div>
      <Link :href="route('listing.show',{listing: listing.id})">
        {{ listing.city }}, {{ listing.street }} {{ listing.street_nr }}, for ${{ listing.price }}
      </Link>
    </div>
    <div>
      <Link :href="route('listing.edit',{listing: listing.id})">Edit</Link>
    </div>
    <div>
      <Link :href="route('listing.show',{listing: listing.id})" method="DELETE" as="button">DELETE</Link>
    </div>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
defineProps ({
  listings: Array,
})
</script>