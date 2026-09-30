<script setup>
import { Head } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import PortfolioLayout from '@/Layouts/PortfolioLayout.vue'

const props = defineProps({
  certificates: { type: Array, default: () => [] },
})

const categories = computed(() => {
  const set = new Set(props.certificates.map((c) => c.category).filter(Boolean))
  return ['Semua', ...Array.from(set)]
})

const active = ref('Semua')

const filtered = computed(() => {
  if (active.value === 'Semua') return props.certificates
  return props.certificates.filter((c) => c.category === active.value)
})

const thumbSrc = (c) =>
  c.thumbnail
    ? (c.thumbnail.startsWith('http') || c.thumbnail.startsWith('/') ? c.thumbnail : `/storage/${c.thumbnail}`)
    : null
</script>

<template>
  <Head title="Sertifikat · Aan Setiawan" />

  <PortfolioLayout>
    <div v-reveal class="flex items-center gap-4">
      <h1 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; ls sertifikat/ --sort=recent
      </h1>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <p class="mt-4 max-w-lg text-[13px] leading-6 text-[#9ca3af]">
      Kumpulan sertifikat pelatihan, lomba, magang, dan kegiatan lain sebagai bukti pengalaman dan kompetensi yang pernah didapatkan.
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

    <section v-if="filtered.length" class="mt-6 grid grid-cols-12 gap-4">
      <div
        v-for="(c, i) in filtered"
        :key="c.id"
        v-reveal
        :class="[
          'card-hover',
          `reveal-delay-${(i % 5) + 1}`,
          c.is_featured ? 'col-span-12 md:col-span-8' : 'col-span-12 md:col-span-4',
          'flex flex-col gap-3 rounded-xl border border-[#1c2027] bg-[#12161b] p-5',
        ]"
      >
        <div class="flex items-start justify-between">
          <span v-if="c.is_featured" class="font-mono text-[11px] text-[#5eead4]">featured</span>
          <span v-else class="font-mono text-[11px] text-[#5eead4]">{{ c.category }}</span>
          <span v-if="c.year" class="font-mono text-[11px] text-[#9ca3af]">{{ c.year }}</span>
        </div>

        <div
          class="overflow-hidden rounded-lg border border-[#1c2027] bg-[#181d24]"
          :class="c.is_featured ? 'aspect-video' : 'aspect-[4/3]'"
        >
          <img
            v-if="thumbSrc(c)"
            :src="thumbSrc(c)"
            :alt="c.title"
            class="h-full w-full object-cover"
          />
          <div v-else class="grid h-full place-items-center font-mono text-3xl font-black text-white/[0.06]">
            {{ c.title.slice(0, 2).toUpperCase() }}
          </div>
        </div>

        <h3 class="text-sm font-semibold leading-snug">{{ c.title }}</h3>
        <p class="text-xs text-[#9ca3af]">{{ c.issuer }}</p>
        <p v-if="c.description" class="line-clamp-3 text-[12.5px] leading-6 text-[#9ca3af]">
          {{ c.description }}
        </p>

        <a
          v-if="c.file_url"
          :href="c.file_url"
          target="_blank"
          rel="noopener"
          class="mt-1 self-start font-mono text-[11px] text-[#5eead4] hover:underline"
        >
          Lihat Sertifikat ↗
        </a>
      </div>
    </section>

    <p v-else class="mt-8 rounded-xl border border-dashed border-[#262b33] p-8 text-center text-sm text-[#9ca3af]">
      Belum ada sertifikat dengan kategori ini.
    </p>
  </PortfolioLayout>
</template>
