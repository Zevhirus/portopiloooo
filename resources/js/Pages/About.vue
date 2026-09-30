<script setup>
import { Head } from '@inertiajs/vue3'
import PortfolioLayout from '@/Layouts/PortfolioLayout.vue'

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

const stackTags = ['Laravel', 'Vue 3', 'Inertia.js', 'Tailwind CSS', 'MySQL', 'Git', 'JavaScript', 'TypeScript', 'Python', 'React', 'Node.js', 'Docker']

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
</script>

<template>
  <Head title="Tentang Saya · Aan Setiawan" />

  <PortfolioLayout>
    <div v-reveal class="flex items-center gap-4">
      <h1 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; cat about.md
      </h1>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <!-- Bio -->
    <div v-reveal class="card-hover mt-5 rounded-xl border border-[#1c2027] bg-[#12161b] p-6">
      <h2 class="text-lg font-semibold">Tentang Saya</h2>
      <p class="mt-3 max-w-2xl text-[14px] leading-7 text-[#9ca3af]">
        Seorang <b class="text-[#e6e8eb]">developer</b> sekaligus
        <b class="text-[#e6e8eb]">fotografer</b> asal Indonesia dengan pengalaman
        membangun aplikasi web dan mengabadikan momen lewat lensa. Terbiasa berpindah dari
        <b class="text-[#e6e8eb]">menulis kode</b> yang rapi ke
        <b class="text-[#e6e8eb]">mengatur komposisi</b> di lapangan, dua kerajinan yang
        sama-sama soal detail, cahaya, dan struktur. Saat ini fokus mengembangkan aplikasi web
        dengan Laravel dan Vue, sambil tetap aktif mendokumentasikan acara lewat kamera.
      </p>
    </div>

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

    <!-- Tech stack -->
    <div class="mt-9 flex items-center gap-4">
      <h3 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; cat skills.json
      </h3>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <div v-reveal class="card-hover mt-5 flex flex-wrap gap-2 rounded-xl border border-[#1c2027] bg-[#12161b] p-5">
      <span
        v-for="t in stackTags"
        :key="t"
        class="rounded-md border border-[#262b33] bg-[#14181e] px-3 py-1.5 font-mono text-xs text-[#9ca3af]"
      >
        {{ t }}
      </span>
    </div>

    <!-- Pendidikan & Pengalaman -->
    <div class="mt-9 flex items-center gap-4">
      <h3 class="rounded-md border border-[#1f5c55] bg-[#10302e] px-3 py-1.5 font-mono text-sm text-[#5eead4]">
        &gt; ls riwayat/
      </h3>
      <div class="h-px flex-1 bg-[#1c2027]"></div>
    </div>

    <section class="mt-5 grid gap-4 md:grid-cols-2">
      <div>
        <p class="mb-2 font-mono text-[11px] text-[#9ca3af]">pendidikan/</p>
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
      </div>

      <div>
        <p class="mb-2 font-mono text-[11px] text-[#9ca3af]">pengalaman/</p>
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
      </div>
    </section>
  </PortfolioLayout>
</template>
