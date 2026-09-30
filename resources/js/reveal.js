// resources/js/reveal.js
//
// Directive v-reveal: elemen diberi class "reveal" (dari app.css) lalu
// otomatis dapat tambahan class "is-visible" begitu masuk area layar.
// Dipasang sekali secara global di app.js.

export const revealDirective = {
  mounted(el) {
    el.classList.add('reveal')

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          el.classList.add('is-visible')
          observer.unobserve(el)
        }
      },
      { threshold: 0.15 }
    )

    observer.observe(el)
  },
}
