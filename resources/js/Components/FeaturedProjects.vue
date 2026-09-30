<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  projects: { type: Array, default: () => [] },
})

// tech_stack bisa berupa array (kalau model di-cast) atau string JSON
const stackOf = (p) => {
  if (Array.isArray(p.tech_stack)) return p.tech_stack
  try {
    return JSON.parse(p.tech_stack ?? '[]') || []
  } catch {
    return []
  }
}
</script>

<template>
  <section class="mt-9">
    <div class="flex items-center gap-4">
      <h3 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; ls proyek-pilihan/
      </h3>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
      <Link :href="route('projects.index')" class="font-mono text-xs text-[#9ca3af] hover:text-[#e6e8eb]">
        Lihat semua ↗
      </Link>
    </div>

    <div v-if="projects.length" class="mt-5 grid gap-4 md:grid-cols-3">
      <Link
        v-for="p in projects"
        :key="p.id"
        :href="route('projects.show', p.slug)"
        class="group flex flex-col rounded-xl border border-[#1c2027] bg-[#12161b] p-5 transition-colors hover:border-[#1f5c55]"
      >
        <img
          v-if="p.thumbnail"
          :src="p.thumbnail.startsWith('http') || p.thumbnail.startsWith('/') ? p.thumbnail : `/storage/${p.thumbnail}`"
          :alt="p.title"
          class="mb-4 h-32 w-full rounded-lg border border-[#262b33] object-cover"
        />
        <h4 class="text-sm font-semibold">{{ p.title }}</h4>
        <p class="mt-2 line-clamp-3 text-[13px] leading-6 text-[#9ca3af]">{{ p.description }}</p>
        <div v-if="stackOf(p).length" class="mt-3 flex flex-wrap gap-1.5">
          <span
            v-for="t in stackOf(p)"
            :key="t"
            class="rounded border border-[#262b33] bg-[#14181e] px-2 py-0.5 font-mono text-[10px] text-[#9ca3af]"
          >
            {{ t }}
          </span>
        </div>
        <span class="mt-4 font-mono text-[11px] text-[#5eead4]">Buka proyek ↗</span>
      </Link>
    </div>

    <p v-else class="mt-5 rounded-xl border border-dashed border-[#262b33] p-6 text-sm text-[#9ca3af]">
      Belum ada proyek unggulan. Tambahkan lewat halaman admin dan centang “featured”.
    </p>
  </section>
</template>
