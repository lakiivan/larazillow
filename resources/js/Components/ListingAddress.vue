<template>
  <span>
    {{ listing.code }} {{ listing.city }}, {{ listing.street }} {{ listing.street_nr }}, 
    Area {{ listing.area }}, beds {{ listing.beds }}, baths {{ listing.baths }}, 
    for ${{ listing.price }}
  </span>
</template>

<script setup>
defineProps({
  listing: Object,
})

</script>