<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import PortfolioLayout from '@/Layouts/PortfolioLayout.vue'

const props = defineProps({
  projects: { type: Array, default: () => [] },
})

const stackOf = (p) => {
  if (Array.isArray(p.tech_stack)) return p.tech_stack
  try {
    return JSON.parse(p.tech_stack ?? '[]') || []
  } catch {
    return []
  }
}

// Kumpulkan semua tag unik dari seluruh proyek untuk jadi tombol filter
const tags = computed(() => {
  const set = new Set()
  props.projects.forEach((p) => stackOf(p).forEach((t) => set.add(t)))
  return ['Semua', ...Array.from(set)]
})

const active = ref('Semua')

const filtered = computed(() => {
  if (active.value === 'Semua') return props.projects
  return props.projects.filter((p) => stackOf(p).includes(active.value))
})

const thumbSrc = (p) =>
  p.thumbnail
    ? (p.thumbnail.startsWith('http') || p.thumbnail.startsWith('/') ? p.thumbnail : `/storage/${p.thumbnail}`)
    : null
</script>

<template>
  <Head title="Proyek · Aan Setiawan" />

  <PortfolioLayout>
    <div v-reveal class="flex items-center gap-4">
      <h1 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; ls proyek/
      </h1>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <!-- Filter tag -->
    <div class="mt-5 flex flex-wrap gap-2">
      <button
        v-for="tag in tags"
        :key="tag"
        type="button"
        @click="active = tag"
        class="rounded-md border px-3 py-1.5 font-mono text-xs transition-colors"
        :class="active === tag
          ? 'border-[#1f5c55] bg-[#10302e] text-[#5eead4]'
          : 'border-[#262b33] bg-[#14181e] text-[#9ca3af] hover:text-[#e6e8eb]'"
      >
        {{ tag }}
      </button>
    </div>

    <!-- Grid proyek -->
    <section v-if="filtered.length" class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
      <Link
        v-for="(p, i) in filtered"
        :key="p.id"
        :href="route('projects.show', p.slug)"
        v-reveal
        :class="['card-hover', `reveal-delay-${(i % 5) + 1}`, 'group flex flex-col overflow-hidden rounded-xl border border-[#1c2027] bg-[#12161b]']"
      >
        <div class="relative h-40 w-full overflow-hidden bg-[#181d24]">
          <img
            v-if="thumbSrc(p)"
            :src="thumbSrc(p)"
            :alt="p.title"
            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
          />
          <div v-else class="grid h-full place-items-center font-mono text-4xl font-black text-white/[0.06]">
            {{ p.title.slice(0, 2).toUpperCase() }}
          </div>
        </div>

        <div class="flex flex-1 flex-col p-5">
          <h3 class="text-sm font-semibold">{{ p.title }}</h3>
          <p class="mt-2 line-clamp-2 text-[13px] leading-6 text-[#9ca3af]">{{ p.description }}</p>

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
        </div>
      </Link>
    </section>

    <p v-else class="mt-8 rounded-xl border border-dashed border-[#262b33] p-8 text-center text-sm text-[#9ca3af]">
      Belum ada proyek dengan tag ini.
    </p>
  </PortfolioLayout>
</template>
