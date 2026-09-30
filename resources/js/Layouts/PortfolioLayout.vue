<script setup>
import { Link } from '@inertiajs/vue3'

const nav = [
  { label: 'Beranda', name: 'home' },
  { label: 'Proyek', name: 'projects.index', match: 'projects.*' },
  { label: 'Hasil Foto', name: 'photos.index' },
  { label: 'Sertifikat', name: 'certificates.index' },
  { label: 'Tentang', name: 'about' },
]

const isActive = (item) => route().current(item.match ?? item.name)
</script>

<template>
  <div class="min-h-screen bg-[#0d1014] font-sans text-[#e6e8eb] antialiased">
    <div class="mx-auto max-w-[1080px] px-5 py-10">

      <div class="flex items-center justify-between font-mono text-xs text-[#6b7280]">
        <span>// est. 2003 &nbsp;·&nbsp; portfolio v1</span>
        <span class="flex items-center gap-2 text-[#e6e8eb]">
          <span class="h-1.5 w-1.5 rounded-full bg-[#5eead4]"></span>
          Developer / Fotografer
        </span>
      </div>

      <nav class="mt-7 flex flex-wrap items-center gap-2 border-b border-[#1c2027] pb-5">
        <Link :href="route('home')" class="mr-3 text-sm font-semibold">✳ Portfolio</Link>
        <Link
          v-for="item in nav"
          :key="item.name"
          :href="route(item.name)"
          class="rounded-md border px-3 py-1.5 font-mono text-xs transition-colors"
          :class="isActive(item)
            ? 'border-[#1f5c55] bg-[#10302e] text-[#5eead4]'
            : 'border-transparent text-[#9ca3af] hover:text-[#e6e8eb]'"
        >
          {{ item.label }}
        </Link>
        <Link :href="route('contact')" class="ml-auto font-mono text-xs text-[#9ca3af] hover:text-[#e6e8eb]">
          Kontak ↗
        </Link>
      </nav>

      <main class="mt-8">
        <slot />
      </main>

      <footer class="mt-16 border-t border-[#1c2027] pt-5 font-mono text-xs text-[#6b7280]">
        © {{ new Date().getFullYear() }} Aan Setiawan
      </footer>
    </div>
  </div>
</template>
