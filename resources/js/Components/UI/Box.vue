<template>
  <div class="border border-gray-200 dark:border-gray-800 rounded-md p-4 shadow-sm dark:text-gray-300 mt-2 ml-1 mr-1">
    <div class="text-gray-500 font-medium mb-1">
      <slot name="header" />
    </div>
    <slot />
  </div>
</template>