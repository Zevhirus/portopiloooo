<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({ project: Object })
const p = props.project

const form = useForm({
  _method: p ? 'put' : 'post',
  title: p?.title ?? '',
  description: p?.description ?? '',
  tech_stack: p?.tech_stack?.join(', ') ?? '',
  demo_url: p?.demo_url ?? '',
  repo_url: p?.repo_url ?? '',
  is_featured: p?.is_featured ?? false,
  thumbnail: null,
})

// Upload file butuh POST + _method spoofing untuk update
const submit = () => form.post(
  p ? route('admin.projects.update', p.id) : route('admin.projects.store'),
  { forceFormData: true },
)
const input = 'mt-1 w-full rounded-lg border px-3 py-2 dark:bg-gray-900'
</script>

<template>
  <Head :title="p ? 'Edit Project' : 'Tambah Project'" />
  <AuthenticatedLayout>
    <form @submit.prevent="submit" class="mx-auto max-w-2xl space-y-4 px-4 py-8">
      <h1 class="text-2xl font-bold">{{ p ? 'Edit' : 'Tambah' }} Project</h1>

      <div><label class="text-sm">Judul</label><input v-model="form.title" :class="input" />
        <p class="text-sm text-red-500">{{ form.errors.title }}</p></div>

      <div><label class="text-sm">Deskripsi</label><textarea v-model="form.description" rows="5" :class="input" />
        <p class="text-sm text-red-500">{{ form.errors.description }}</p></div>

      <div><label class="text-sm">Tech stack (pisahkan koma)</label><input v-model="form.tech_stack" placeholder="Laravel, Vue, MySQL" :class="input" /></div>
      <div><label class="text-sm">Demo URL</label><input v-model="form.demo_url" :class="input" /><p class="text-sm text-red-500">{{ form.errors.demo_url }}</p></div>
      <div><label class="text-sm">Repo URL</label><input v-model="form.repo_url" :class="input" /><p class="text-sm text-red-500">{{ form.errors.repo_url }}</p></div>

      <div>
        <label class="text-sm">Thumbnail (maks 2MB)</label>
        <img v-if="p?.thumbnail_url && !form.thumbnail" :src="p.thumbnail_url" class="mt-2 h-32 rounded-lg" />
        <input type="file" accept="image/*" @input="form.thumbnail = $event.target.files[0]" class="mt-1 block text-sm" />
        <p class="text-sm text-red-500">{{ form.errors.thumbnail }}</p>
      </div>

      <label class="flex items-center gap-2 text-sm"><input type="checkbox" v-model="form.is_featured" /> Tampilkan di Home</label>

      <button :disabled="form.processing" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-white disabled:opacity-50">Simpan</button>
    </form>
  </AuthenticatedLayout>
</template>
