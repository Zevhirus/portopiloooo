<script setup>
import { Head } from '@inertiajs/vue3'
import PortfolioLayout from '@/Layouts/PortfolioLayout.vue'
import FeaturedProjects from '@/Components/FeaturedProjects.vue'
import {
  siJavascript,
  siTypescript,
  siPython,
  siReact,
  siNodedotjs,
  siLaravel,
  siDocker,
  siGit,
  siFigma,
} from 'simple-icons'

defineProps({ featured: { type: Array, default: () => [] } })

// tone: teal | gold | plain
const skills = [
  { icon: "{'}'}", label: 'Problem Solving', tone: 'teal' },
  { icon: '◎', label: 'Detail-Oriented', tone: 'plain' },
  { icon: '◆', label: 'Komposisi Visual', tone: 'gold' },
  { icon: '↘', label: 'Debugging', tone: 'plain' },
  { icon: '✎', label: 'Storytelling', tone: 'teal' },
  { icon: '▣', label: 'Terorganisir', tone: 'plain' },
]

const toneClass = {
  teal: 'border-[#1f5c55] bg-[#10302e] text-[#5eead4]',
  gold: 'border-[#6b5a1e] bg-[#2a2410] text-[#e2b93b]',
  plain: 'border-[#262b33] bg-[#14181e] text-[#e6e8eb]',
}

const pendidikan = [
  { tahun: '2016–2019', judul: 'SMPN 4 MASAMBA' },
  { tahun: '2019–2022', judul: 'SMAN 8 Luwu Utara', sub: 'MIPA' },
  { tahun: '2022–2026', judul: 'Administrasi Bisnis Sektor Publik', sub: 'Politeknik STIA LAN Makassar' },
]

const pengalaman = [
  { tahun: '2022–2023', judul: 'Frontend Developer Intern', sub: 'Sub Regional 5 Sulawesi' },
  { tahun: '2023–Now', judul: 'Freelance Photographer', sub: 'Event, Portrait & Street Photography' },
  { tahun: '2024–Now', judul: 'Open Source Contributor', sub: 'github.com/Zevhirus' },
  { tahun: '2025–Now', judul: 'Humas UPTD CPI', sub: 'UPTD CPI' },
]

const stack = [
  siJavascript,
  siTypescript,
  siPython,
  siReact,
  siNodedotjs,
  siLaravel,
  siDocker,
  siGit,
  siFigma,
]
</script>

<template>
  <Head title="Aan Setiawan · Developer & Fotografer" />

  <PortfolioLayout>
    <!-- Tentang + Hero -->
    <section class="grid gap-4 lg:grid-cols-[1fr_2fr]">
      <div v-reveal class="card-hover rounded-xl border border-[#1c2027] bg-[#12161b] p-5">
        <p class="font-mono text-[11px] text-[#5eead4]">&gt; cat about.txt</p>
        <h2 class="mt-3 text-base font-semibold">Tentang Saya</h2>
        <p class="mt-3 text-[13px] leading-6 text-[#9ca3af]">
          Seorang <b class="text-[#e6e8eb]">developer</b> sekaligus
          <b class="text-[#e6e8eb]">fotografer</b> asal Indonesia dengan pengalaman
          membangun aplikasi web dan mengabadikan momen lewat lensa. Terbiasa berpindah dari
          <b class="text-[#e6e8eb]">menulis kode</b> yang rapi ke
          <b class="text-[#e6e8eb]">mengatur komposisi</b> di lapangan dua kerajinan yang
          sama-sama soal detail, cahaya, dan struktur.
        </p>
      </div>

      <div v-reveal class="reveal-delay-1 relative overflow-hidden rounded-xl border border-[#1c2027] bg-[#12161b] p-6">
        <span class="pointer-events-none absolute -left-2 bottom-[-40px] select-none text-[200px] font-black leading-none text-white/[0.03]">Dv</span>

        <div class="relative flex flex-wrap items-center gap-6">
          <!-- Lensa f/1.8, sedikit mengambang + berputar pelan -->
          <div class="relative grid h-40 w-40 shrink-0 place-items-center rounded-full border border-[#262b33] animate-float">
            <div class="absolute inset-3 rounded-full border border-dashed border-[#e2b93b]/40 animate-spin-slow"></div>
            <div class="grid h-16 w-16 place-items-center rounded-full border-2 border-[#5eead4] font-mono text-xs text-[#5eead4] animate-glow-pulse">
              f/1.8
            </div>
          </div>

          <div class="min-w-[200px] flex-1">
            <p class="text-xs text-[#9ca3af]">Full-Stack Developer &amp; Fotografer</p>
            <h1 class="mt-2 text-4xl font-extrabold uppercase leading-[1.05] tracking-wide">
              Aan<br />Setiawan
            </h1>
            <p class="mt-2 text-sm text-[#9ca3af]">Kota, Indonesia</p>
          </div>

          <!-- Foto: taruh file di public/images/aan.jpg -->
          <div class="relative ml-auto">
            <img
              src="/images/aan.jpg"
              alt="Foto Aan Setiawan"
              class="h-36 w-28 rounded-lg border border-[#262b33] bg-[#1a1f26] object-cover"
            />
            <span class="absolute -bottom-3 -left-4 grid h-14 w-14 place-items-center rounded-full border border-[#262b33] bg-[#14181e] font-mono text-[9px] text-[#9ca3af]">
              yokoso
            </span>
          </div>
        </div>
      </div>
    </section>

    <!-- Skill chips -->
    <section class="mt-4 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-6">
      <div
        v-for="(s, i) in skills"
        :key="s.label"
        v-reveal
        :class="['card-hover', `reveal-delay-${(i % 5) + 1}`, 'flex items-center gap-2.5 rounded-lg border px-4 py-3.5 text-[13px]', toneClass[s.tone]]"
      >
        <span class="font-mono text-xs">{{ s.icon }}</span>
        <span class="font-medium">{{ s.label }}</span>
      </div>
    </section>

    <!-- Proyek Pilihan -->
    <FeaturedProjects :projects="featured" />

    <!-- Pendidikan & Pengalaman -->
    <div class="mt-9 flex items-center gap-4">
      <h3 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; ls pendidikan/
      </h3>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <section class="mt-5 grid gap-4 md:grid-cols-2">
      <ul v-reveal class="card-hover rounded-xl border border-[#1c2027] bg-[#12161b] p-5">
        <li
          v-for="(p, i) in pendidikan"
          :key="p.judul"
          class="grid grid-cols-[80px_1fr] gap-4 py-3"
          :class="i > 0 && 'border-t border-[#1c2027]'"
        >
          <span class="font-mono text-[11px] leading-4 text-[#e2b93b]">{{ p.tahun }}</span>
          <div>
            <p class="text-sm font-semibold">{{ p.judul }}</p>
            <p v-if="p.sub" class="mt-1 text-xs text-[#9ca3af]">{{ p.sub }}</p>
          </div>
        </li>
      </ul>

      <ul v-reveal class="reveal-delay-1 card-hover rounded-xl border border-[#1c2027] bg-[#12161b] p-5">
        <li
          v-for="(p, i) in pengalaman"
          :key="p.judul"
          class="grid grid-cols-[80px_1fr] gap-4 py-3"
          :class="i > 0 && 'border-t border-[#1c2027]'"
        >
          <span class="font-mono text-[11px] leading-4 text-[#e2b93b]">{{ p.tahun }}</span>
          <div>
            <p class="text-sm font-semibold">{{ p.judul }}</p>
            <p class="mt-1 text-xs text-[#9ca3af]">{{ p.sub }}</p>
          </div>
        </li>
      </ul>
    </section>

    <!-- Tech stack -->
    <div class="mt-9 flex items-center gap-4">
      <h3 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; npm list --global
      </h3>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <section class="mt-5 grid grid-cols-3 gap-3 sm:grid-cols-5 lg:grid-cols-9">
      <div
        v-for="(icon, i) in stack"
        :key="icon.slug"
        v-reveal
        :title="icon.title"
        :class="['card-hover', `reveal-delay-${(i % 5) + 1}`, 'flex h-16 flex-col items-center justify-center gap-1.5 rounded-lg border border-[#1c2027] bg-[#12161b]']"
      >
        <svg viewBox="0 0 24 24" class="h-5 w-5" :fill="`#${icon.hex}`">
          <path :d="icon.path" />
        </svg>
        <span class="font-mono text-[10px] text-[#9ca3af]">{{ icon.title }}</span>
      </div>
    </section>
  </PortfolioLayout>
</template>
