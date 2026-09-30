<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineProps({ messages: Array })
</script>

<template>
  <Head title="Admin · Pesan" />
  <AuthenticatedLayout>
    <div class="mx-auto max-w-3xl space-y-4 px-4 py-8">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Pesan Masuk</h1>
        <Link :href="route('admin.projects.index')" class="text-sm text-indigo-600">← Projects</Link>
      </div>
      <div v-for="m in messages" :key="m.id" class="rounded-xl border p-4">
        <p class="font-medium">{{ m.name }} <span class="text-sm text-gray-500">· {{ m.email }}</span></p>
        <p class="mt-2 whitespace-pre-line text-sm">{{ m.body }}</p>
      </div>
      <p v-if="!messages.length" class="text-gray-500">Belum ada pesan.</p>
    </div>
  </AuthenticatedLayout>
</template>
