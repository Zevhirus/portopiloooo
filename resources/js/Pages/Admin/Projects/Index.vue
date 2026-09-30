<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
defineProps({ projects: Array })
const remove = (p) => confirm(`Hapus "${p.title}"?`) && router.delete(route('admin.projects.destroy', p.id))
</script>

<template>
  <Head title="Admin · Projects" />
  <AuthenticatedLayout>
    <div class="mx-auto max-w-5xl px-4 py-8">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Projects</h1>
        <div class="flex gap-2">
          <Link :href="route('admin.messages.index')" class="rounded-lg border px-4 py-2 text-sm">Pesan</Link>
          <Link :href="route('admin.projects.create')" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white">+ Tambah</Link>
        </div>
      </div>
      <div class="mt-6 overflow-x-auto rounded-xl border">
        <table class="w-full text-left text-sm">
          <thead class="bg-gray-50 dark:bg-gray-900"><tr><th class="p-3">Judul</th><th class="p-3">Unggulan</th><th class="p-3"></th></tr></thead>
          <tbody>
            <tr v-for="p in projects" :key="p.id" class="border-t">
              <td class="p-3">{{ p.title }}</td>
              <td class="p-3">{{ p.is_featured ? '⭐' : '-' }}</td>
              <td class="space-x-3 p-3 text-right">
                <Link :href="route('admin.projects.edit', p.id)" class="text-indigo-600">Edit</Link>
                <button @click="remove(p)" class="text-red-500">Hapus</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
