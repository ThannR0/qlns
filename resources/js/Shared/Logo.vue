<template>
  <svg
    :width="size"
    :height="size"
    viewBox="0 0 200 200"
    xmlns="http://www.w3.org/2000/svg"
    :aria-label="ariaLabel"
    role="img"
    class="logo-t"
  >
    <defs>
      <linearGradient id="g1" x1="0%" x2="100%" y1="0%" y2="100%">
        <stop :offset="gradStops[0].offset" :stop-color="gradStops[0].color" />
        <stop :offset="gradStops[1].offset" :stop-color="gradStops[1].color" />
      </linearGradient>

      <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
        <feDropShadow dx="0" dy="6" stdDeviation="8" flood-opacity="0.25"/>
      </filter>

      <mask id="cut">
        <!-- mask to make the T have a negative-space notch -->
        <rect x="0" y="0" width="200" height="200" fill="white"/>
        <rect :x="90" :y="70" :width="20" :height="60" fill="black"/>
      </mask>
    </defs>

    <!-- background circle softly behind the letter -->
    <circle cx="100" cy="100" r="80" :fill="bgColor" opacity="0.08" />

    <!-- stylized T -->
    <g :filter="useShadow ? 'url(#shadow)' : null" transform="translate(0,0)">
      <path
        d="M35 50 H165 a8 8 0 0 1 8 8 v12 a8 8 0 0 1 -8 8 H116 v62 a12 12 0 0 1 -12 12 h-8 a12 12 0 0 1 -12 -12 V88 H35 a8 8 0 0 1 -8 -8 V58 a8 8 0 0 1 8 -8 z"
        :fill="useGradient ? 'url(#g1)' : primaryColor"
        :stroke="strokeColor"
        :stroke-width="strokeWidth"
        :mask="useNotch ? 'url(#cut)' : null"
        class="t-shape"
      />

      <!-- thin accent line to add depth -->
      <path
        d="M40 62 H160"
        :stroke="accentColor"
        stroke-width="4"
        stroke-linecap="round"
        class="accent"
        opacity="0.9"
      />
    </g>

    <!-- optional shine animation overlay -->
    <rect
      v-if="shimmer"
      x="-60"
      y="-60"
      width="80"
      height="320"
      :transform="`rotate(${shimmerAngle} 100 100)`"
      :fill="shimmerColor"
      class="shimmer"
    />
  </svg>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  size: { type: [Number, String], default: 160 },
  primaryColor: { type: String, default: '#0077B6' }, // teal-ish
  secondaryColor: { type: String, default: '#00B4D8' },
  accentColor: { type: String, default: '#ffffff' },
  strokeColor: { type: String, default: 'rgba(0,0,0,0.06)' },
  strokeWidth: { type: Number, default: 0 },
  bgColor: { type: String, default: '#002B5B' },
  useGradient: { type: Boolean, default: true },
  useShadow: { type: Boolean, default: true },
  useNotch: { type: Boolean, default: true },
  shimmer: { type: Boolean, default: true },
  shimmerColor: { type: String, default: 'rgba(255,255,255,0.12)' },
  shimmerAngle: { type: Number, default: -25 },
  ariaLabel: { type: String, default: 'Logo chữ T' }
})

const gradStops = computed(() => [
  { offset: '0%', color: props.primaryColor },
  { offset: '100%', color: props.secondaryColor }
])
</script>

<style scoped>
.logo-t {
  display: inline-block;
  transition: transform 220ms cubic-bezier(.2,.9,.2,1), filter 220ms;
  cursor: default;
}
.logo-t:hover {
  transform: scale(1.04) translateY(-2px);
  filter: drop-shadow(0 8px 18px rgba(7,10,25,0.12));
}
.t-shape {
  transition: transform 260ms cubic-bezier(.2,.9,.2,1), opacity 220ms;
  transform-origin: 100px 100px;
}
.logo-t:hover .t-shape {
  transform: translateY(-2px) scale(1.01);
}
.accent {
  mix-blend-mode: overlay;
}
/* shimmer animation */
.shimmer {
  animation: slide 1.6s linear infinite;
}
@keyframes slide {
  0% { transform: translateX(-220px) rotate(-25deg); opacity: 0 }
  10% { opacity: 0.35 }
  50% { opacity: 0.12 }
  90% { opacity: 0.35 }
  100% { transform: translateX(220px) rotate(-25deg); opacity: 0 }
}
</style>