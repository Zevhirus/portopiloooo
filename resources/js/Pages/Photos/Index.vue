<script setup>
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import PortfolioLayout from '@/Layouts/PortfolioLayout.vue'

const props = defineProps({
  photos: { type: Array, default: () => [] },
})

const categories = computed(() => {
  const set = new Set(props.photos.map((p) => p.category))
  return ['Semua', ...Array.from(set)]
})

const active = ref('Semua')

const filtered = computed(() => {
  if (active.value === 'Semua') return props.photos
  return props.photos.filter((p) => p.category === active.value)
})
</script>

<template>
  <Head title="Hasil Foto · Aan Setiawan" />

  <PortfolioLayout>
    <div v-reveal class="flex items-center gap-4">
      <h1 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; ls foto/ --sort=terbaru
      </h1>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <p class="mt-4 max-w-lg text-[13px] leading-6 text-[#9ca3af]">
      Sebagian dokumentasi dari street, portrait, wisuda, dan yudisium photography.
    </p>

    <div class="mt-5 flex flex-wrap gap-2">
      <button
        v-for="cat in categories"
        :key="cat"
        type="button"
        @click="active = cat"
        class="rounded-full border px-3.5 py-1.5 font-mono text-[11.5px] transition-colors"
        :class="active === cat
          ? 'border-[#1f5c55] bg-[#10302e] text-[#5eead4]'
          : 'border-[#262b33] bg-[#14181e] text-[#9ca3af] hover:text-[#e6e8eb]'"
      >
        {{ cat }}
      </button>
    </div>

    <div class="mt-6 columns-2 gap-3.5 sm:columns-3">
      <div
        v-for="(p, i) in filtered"
        :key="p.id"
        v-reveal
        :class="['card-hover', `reveal-delay-${(i % 5) + 1}`, 'mb-3.5 break-inside-avoid overflow-hidden rounded-xl border border-[#1c2027] bg-[#14181e]']"
      >
        <img :src="p.image" :alt="p.category" class="block w-full object-cover" loading="lazy" />
        <div class="flex items-center justify-between px-3 py-2.5">
          <span class="text-[11px] font-medium">{{ p.category }}</span>
          <span v-if="p.exif" class="font-mono text-[9.5px] text-[#9ca3af]">{{ p.exif }}</span>
        </div>
      </div>
    </div>

    <p v-if="!filtered.length" class="mt-8 rounded-xl border border-dashed border-[#262b33] p-8 text-center text-sm text-[#9ca3af]">
      Belum ada foto dengan kategori ini.
    </p>
  </PortfolioLayout>
</template>
