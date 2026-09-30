<script setup>
import { computed } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'

const MAX = 1000

const form = useForm({
  name: '',
  email: '',
  message: '',
})

const remaining = computed(() => MAX - form.message.length)

const submit = () => {
  form.post('/contact', {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}

const channels = [
  { label: 'Email', value: 'jellyfish.env@gmail.com', href: 'mailto:jellyfish.env@gmail.com' },
  { label: 'GitHub', value: 'github.com/Zevhirus', href: 'https://github.com/Zevhirus' },
  { label: 'Instagram', value: '@jelly_fish.env', href: 'https://www.instagram.com/jelly_fish.env/' },
]

const inputClass =
  'peer w-full rounded-xl border border-slate-300 bg-white px-4 pb-2.5 pt-6 text-[15px] text-slate-900 ' +
  'placeholder-transparent outline-none transition ' +
  'hover:border-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/15 ' +
  'dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100 dark:hover:border-slate-600 ' +
  'dark:focus:border-indigo-400 dark:focus:ring-indigo-400/20'

const labelClass =
  'pointer-events-none absolute left-4 top-2 text-xs font-medium text-slate-500 transition-all ' +
  'peer-placeholder-shown:top-4 peer-placeholder-shown:text-[15px] peer-placeholder-shown:font-normal ' +
  'peer-focus:top-2 peer-focus:text-xs peer-focus:font-medium peer-focus:text-indigo-600 ' +
  'dark:text-slate-400 dark:peer-focus:text-indigo-400'
</script>

<template>
  <section class="relative overflow-hidden">
    <!-- latar lembut, tidak mengganggu konten -->
    <div
      aria-hidden="true"
      class="pointer-events-none absolute inset-x-0 -top-24 h-[420px] bg-[radial-gradient(60%_60%_at_50%_0%,rgba(99,102,241,0.14),transparent)] dark:bg-[radial-gradient(60%_60%_at_50%_0%,rgba(129,140,248,0.18),transparent)]"
    />

    <div class="relative mx-auto grid max-w-5xl gap-14 px-6 py-16 md:py-24 lg:grid-cols-5 lg:gap-16">
      <!-- Kolom kiri: ajakan + kanal kontak -->
      <div class="lg:col-span-2">
        <Link
          href="/"
          class="group mb-8 inline-flex items-center gap-2 rounded-lg text-sm font-medium text-slate-600 transition hover:text-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-indigo-500 dark:text-slate-400 dark:hover:text-indigo-400"
        >
          <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5 motion-reduce:transition-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.61l4.16 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.61 9.25h10.64A.75.75 0 0117 10z" clip-rule="evenodd" />
          </svg>
          Kembali ke beranda
        </Link>

        <h1 class="text-4xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white sm:text-5xl">
          Ada proyek atau ide? Ceritakan ke saya.
        </h1>
        <p class="mt-5 max-w-sm text-base leading-relaxed text-slate-600 dark:text-slate-400">
          Tulis singkat apa yang ingin kamu bangun, siapa pengguna nya, dan kapan targetnya. Saya baca setiap pesan
          dan balas langsung.
        </p>

        <p class="mt-8 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3.5 py-1.5 text-sm font-medium text-emerald-700 ring-1 ring-emerald-600/15 dark:bg-emerald-400/10 dark:text-emerald-300 dark:ring-emerald-400/20">
          <span class="relative flex h-2 w-2">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-60 motion-reduce:animate-none" />
            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500" />
          </span>
          Terbuka untuk proyek baru
        </p>

        <dl class="mt-10 divide-y divide-slate-200 border-y border-slate-200 dark:divide-slate-800 dark:border-slate-800">
          <div v-for="c in channels" :key="c.label" class="flex items-baseline justify-between gap-4 py-4">
            <dt class="text-sm text-slate-500 dark:text-slate-400">{{ c.label }}</dt>
            <dd>
              <a
                :href="c.href"
                class="rounded text-sm font-medium text-slate-900 underline-offset-4 hover:text-indigo-600 hover:underline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 dark:text-slate-100 dark:hover:text-indigo-400"
              >
                {{ c.value }}
              </a>
            </dd>
          </div>
        </dl>

        <p class="mt-6 text-sm text-slate-500 dark:text-slate-400">Biasanya dibalas dalam 1 hari kerja.</p>
      </div>

      <!-- Kolom kanan: form -->
      <div class="lg:col-span-3">
        <form
          @submit.prevent="submit"
          novalidate
          class="rounded-3xl border border-slate-200 bg-white p-6 shadow-xl shadow-indigo-900/5 dark:border-slate-800 dark:bg-slate-900/60 dark:shadow-none sm:p-9"
        >
          <!-- Notifikasi sukses -->
          <div
            v-if="form.recentlySuccessful"
            role="status"
            class="mb-6 flex items-start gap-3 rounded-xl bg-emerald-50 p-4 text-sm text-emerald-800 ring-1 ring-emerald-600/15 dark:bg-emerald-400/10 dark:text-emerald-200 dark:ring-emerald-400/20"
          >
            <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.7-9.3a1 1 0 00-1.4-1.4L9 10.6 7.7 9.3a1 1 0 00-1.4 1.4l2 2a1 1 0 001.4 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p><strong class="font-semibold">Pesan terkirim.</strong> Terima kasih, saya akan membalas ke email kamu secepatnya.</p>
          </div>

          <div class="space-y-5">
            <!-- Nama -->
            <div>
              <div class="relative">
                <input id="name" v-model="form.name" type="text" autocomplete="name" placeholder="Nama"
                  :aria-invalid="!!form.errors.name" :class="[inputClass, form.errors.name && '!border-red-500']" />
                <label for="name" :class="labelClass">Nama</label>
              </div>
              <p v-if="form.errors.name" class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ form.errors.name }}</p>
            </div>

            <!-- Email -->
            <div>
              <div class="relative">
                <input id="email" v-model="form.email" type="email" autocomplete="email" placeholder="Email"
                  :aria-invalid="!!form.errors.email" :class="[inputClass, form.errors.email && '!border-red-500']" />
                <label for="email" :class="labelClass">Email</label>
              </div>
              <p v-if="form.errors.email" class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ form.errors.email }}</p>
            </div>

            <!-- Pesan -->
            <div>
              <div class="relative">
                <textarea id="message" v-model="form.message" rows="6" :maxlength="MAX" placeholder="Pesan"
                  :aria-invalid="!!form.errors.message"
                  :class="[inputClass, 'resize-y', form.errors.message && '!border-red-500']" />
                <label for="message" :class="labelClass">Pesan</label>
              </div>
              <div class="mt-1.5 flex items-start justify-between gap-4">
                <p v-if="form.errors.message" class="text-sm text-red-600 dark:text-red-400">{{ form.errors.message }}</p>
                <span v-else />
                <span class="text-xs tabular-nums text-slate-400" :class="remaining < 50 && '!text-amber-600'">
                  {{ remaining }}
                </span>
              </div>
            </div>
          </div>

          <div class="mt-7 flex flex-col-reverse items-stretch gap-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-slate-500 dark:text-slate-400">Data kamu hanya dipakai untuk membalas pesan ini.</p>
            <button
              type="submit"
              :disabled="form.processing"
              class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/25 transition hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-60 motion-reduce:transition-none"
            >
              <svg v-if="form.processing" class="h-4 w-4 animate-spin motion-reduce:animate-none" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-25" />
                <path d="M22 12a10 10 0 00-10-10" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
              </svg>
              {{ form.processing ? 'Mengirim…' : 'Kirim pesan' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>
