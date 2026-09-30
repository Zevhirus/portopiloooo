<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ project: Object })
</script>

<template>
  <Link :href="route('projects.show', project.slug)"
    class="group overflow-hidden rounded-xl border transition hover:-translate-y-1 hover:shadow-lg dark:border-gray-800">
    <div class="aspect-video bg-gray-100 dark:bg-gray-900">
      <img v-if="project.thumbnail_url" :src="project.thumbnail_url" :alt="project.title"
        class="h-full w-full object-cover transition group-hover:scale-105" loading="lazy" />
    </div>
    <div class="p-5">
      <h3 class="text-lg font-semibold">{{ project.title }}</h3>
      <p class="mt-1 line-clamp-2 text-sm text-gray-600 dark:text-gray-400">{{ project.description }}</p>
      <div class="mt-3 flex flex-wrap gap-2">
        <span v-for="t in project.tech_stack" :key="t"
          class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs text-indigo-600 dark:bg-indigo-950 dark:text-indigo-300">{{ t }}</span>
      </div>
    </div>
  </Link>
</template>
