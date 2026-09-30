<script setup>
import { Head, Link } from '@inertiajs/vue3'
import PortfolioLayout from '@/Layouts/PortfolioLayout.vue'

const props = defineProps({ project: Object })

const stackOf = (p) => {
  if (Array.isArray(p.tech_stack)) return p.tech_stack
  try {
    return JSON.parse(p.tech_stack ?? '[]') || []
  } catch {
    return []
  }
}

const thumb = (p) =>
  p.thumbnail_url ??
  (p.thumbnail
    ? (p.thumbnail.startsWith('http') || p.thumbnail.startsWith('/') ? p.thumbnail : `/storage/${p.thumbnail}`)
    : null)
</script>

<template>
  <Head :title="project.title">
    <meta name="description" :content="project.description.slice(0, 150)" />
    <meta property="og:title" :content="project.title" />
    <meta v-if="thumb(project)" property="og:image" :content="thumb(project)" />
  </Head>

  <PortfolioLayout>
    <Link
      :href="route('projects.index')"
      class="font-mono text-xs text-[#9ca3af] transition-colors hover:text-[#5eead4]"
    >
      ← Semua proyek
    </Link>

    <article v-reveal class="mt-5 max-w-3xl">
      <h1 class="text-3xl font-extrabold tracking-tight md:text-4xl">{{ project.title }}</h1>

      <div v-if="stackOf(project).length" class="mt-4 flex flex-wrap gap-1.5">
        <span
          v-for="t in stackOf(project)"
          :key="t"
          class="rounded border border-[#1f5c55] bg-[#10302e] px-2.5 py-1 font-mono text-[11px] text-[#5eead4]"
        >
          {{ t }}
        </span>
      </div>

      <img
        v-if="thumb(project)"
        :src="thumb(project)"
        :alt="project.title"
        class="card-hover mt-6 w-full rounded-xl border border-[#1c2027] object-cover"
      />

      <p class="mt-6 whitespace-pre-line text-[15px] leading-7 text-[#9ca3af]">
        {{ project.description }}
      </p>

      <div class="mt-8 flex flex-wrap gap-3">
        <a
          v-if="project.demo_url"
          :href="project.demo_url"
          target="_blank"
          rel="noopener"
          class="rounded-lg border border-[#1f5c55] bg-[#10302e] px-4 py-2 text-sm font-medium text-[#5eead4] transition-colors hover:bg-[#154039]"
        >
          Live Demo ↗
        </a>
        <a
          v-if="project.repo_url"
          :href="project.repo_url"
          target="_blank"
          rel="noopener"
          class="rounded-lg border border-[#262b33] px-4 py-2 text-sm font-medium text-[#e6e8eb] transition-colors hover:border-[#5eead4] hover:text-[#5eead4]"
        >
          GitHub ↗
        </a>
      </div>
    </article>
  </PortfolioLayout>
</template>
