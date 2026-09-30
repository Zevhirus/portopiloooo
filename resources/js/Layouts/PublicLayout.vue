<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const dark = ref(false)
const open = ref(false)
const links = [
  { name: 'Home', route: 'home' },
  { name: 'About', route: 'about' },
  { name: 'Projects', route: 'projects.index' },
  { name: 'Contact', route: 'contact' },
]

onMounted(() => (dark.value = document.documentElement.classList.contains('dark')))

function toggleDark() {
  dark.value = !dark.value
  document.documentElement.classList.toggle('dark', dark.value)
  try { localStorage.theme = dark.value ? 'dark' : 'light' } catch (e) {}
}
</script>

<template>
  <div class="flex min-h-screen flex-col bg-white text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <header class="sticky top-0 z-20 border-b bg-white/80 backdrop-blur dark:border-gray-800 dark:bg-gray-950/80">
      <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
        <Link :href="route('home')" class="text-lg font-bold">NamaKamu<span class="text-indigo-500">.dev</span></Link>

        <ul class="hidden items-center gap-6 md:flex">
          <li v-for="l in links" :key="l.route">
            <Link :href="route(l.route)"
              :class="route().current(l.route + '*') ? 'text-indigo-500' : 'hover:text-indigo-500'"
              class="text-sm font-medium transition">{{ l.name }}</Link>
          </li>
          <li><button @click="toggleDark" class="rounded-lg border px-2 py-1 text-sm dark:border-gray-700">{{ dark ? '☀️' : '🌙' }}</button></li>
        </ul>

        <button class="md:hidden" @click="open = !open" aria-label="Menu">☰</button>
      </nav>

      <ul v-if="open" class="space-y-2 border-t px-4 py-3 md:hidden dark:border-gray-800">
        <li v-for="l in links" :key="l.route">
          <Link :href="route(l.route)" class="block py-1" @click="open = false">{{ l.name }}</Link>
        </li>
        <li><button @click="toggleDark" class="text-sm">{{ dark ? '☀️ Light' : '🌙 Dark' }}</button></li>
      </ul>
    </header>

    <main class="flex-1"><slot /></main>

    <footer class="border-t py-6 text-center text-sm text-gray-500 dark:border-gray-800">
      © {{ new Date().getFullYear() }} NamaKamu. Dibuat dengan Laravel, Inertia, Vue &amp; Tailwind.
    </footer>
  </div>
</template>
