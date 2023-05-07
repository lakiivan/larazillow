<template>
  <form @submit.prevent="login">
    <div class="w-1/2 mx-auto ">
      <div class="mt-2">
        <div class="ml-2 mt-2 mr-2 gap-2">
          <label class="label" for="email">E-mail (username)</label>
          <input id="email" v-model="form.email" class="input" type="text" name="email" />
          <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
        </div>
        <div class="ml-2 mt-2 mr-2 gap-2">
          <label class="label" for="password">Password</label>
          <input id="password" v-model="form.password" class="input" type="password" name="password" />
          <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
        </div>
        <div class="ml-2 mt-2 mr-2 gap-2">
          <button class="btn-primary w-full" type="submit">Login</button>
          <div class="mt-2 text-center">
            <Link :href="route('user-account.create')" class="text-sm text-gray-500">Need an Account? Click here</Link>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'


const form = useForm({
  email: null,
  password: null,
})

const login = () => form.post(route('login.store'))

</script>