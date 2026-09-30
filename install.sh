#!/usr/bin/env bash
# Jalankan dari ROOT project Laravel + Breeze (Vue):
#   bash /path/ke/portfolio-kit/install.sh
set -e
KIT="$(cd "$(dirname "$0")" && pwd)"

[ -f artisan ] || { echo "Jalankan dari root project Laravel (folder yang ada file 'artisan')."; exit 1; }
[ -d resources/js/Pages ] || { echo "Breeze Vue belum terpasang. Jalankan: php artisan breeze:install vue"; exit 1; }

echo "→ Menyalin file..."
for d in app database routes resources; do cp -R "$KIT/$d" ./; done

CSS=resources/css/app.css
if ! grep -q "portfolio-kit: animasi" "$CSS"; then
  cat "$KIT/snippets/animation.css" >> "$CSS"
fi

# Dark mode
if [ -f tailwind.config.js ]; then
  if ! grep -q "darkMode" tailwind.config.js; then
    sed -i "0,/export default {/s//export default {\n    darkMode: 'class',/" tailwind.config.js
    echo "→ darkMode: 'class' ditambahkan ke tailwind.config.js"
  fi
else
  if ! grep -q "portfolio-kit: dark mode" "$CSS"; then
    cat "$KIT/snippets/darkmode-tw4.css" >> "$CSS"
    echo "→ @custom-variant dark ditambahkan (Tailwind 4)"
  fi
fi

# Script anti-kedip di <head>
BL=resources/views/app.blade.php
if ! grep -q "localStorage.theme" "$BL"; then
  SNIP="$(cat "$KIT/snippets/head-script.html")" perl -0pi -e 's/<head>/<head>\n$ENV{SNIP}/' "$BL"
  echo "→ Script dark mode ditambahkan ke app.blade.php"
fi

echo "→ Migrasi + seed..."
php artisan migrate --seed
php artisan storage:link || true

echo
echo "Selesai! Jalankan: composer run dev   (atau: php artisan serve & npm run dev)"
echo "Login admin: admin@example.com / password  → buka /admin/projects"
echo "PENTING: ganti password admin & nonaktifkan route register."
