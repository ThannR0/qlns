<template>
  <svg xmlns="http://www.w3.org/2000/svg"
       viewBox="0 0 200 200"
       width="200"
       height="200"
       role="img"
       aria-label="Logo TT">
       
    <defs>
      <!-- Gradient xanh biển hiện đại -->
      <linearGradient id="blueGrad" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0%" stop-color="#0099ff"/>
        <stop offset="100%" stop-color="#0055cc"/>
      </linearGradient>

      <!-- Ánh sáng phản chiếu -->
      <radialGradient id="lightGlow" cx="30%" cy="30%" r="70%">
        <stop offset="0%" stop-color="rgba(255,255,255,0.6)"/>
        <stop offset="100%" stop-color="rgba(255,255,255,0)"/>
      </radialGradient>

      <!--  Bóng đổ -->
      <filter id="softShadow" x="-50%" y="-50%" width="200%" height="200%">
        <feDropShadow dx="0" dy="6" stdDeviation="6" flood-color="#003366" flood-opacity="0.35"/>
      </filter>
    </defs>

    <!-- Hình lục giác nền -->
    <polygon points="100,10 190,55 190,145 100,190 10,145 10,55"
             fill="url(#blueGrad)"
             stroke="#003f7f"
             stroke-width="3"
             filter="url(#softShadow)" />

    <!-- Ánh sáng phản chiếu phía trên -->
    <circle cx="80" cy="60" r="70" fill="url(#lightGlow)" />

    <text x="100" y="120"
          font-family="Poppins, Arial, sans-serif"
          font-weight="900"
          font-size="68"
          fill="white"
          text-anchor="middle"
          dominant-baseline="middle"
          letter-spacing="-8"
          style="paint-order: stroke; stroke: #00aaff; stroke-width: 1;">
      TT
    </text>

    <!-- sáng mờ xung quanh logo -->
    <circle cx="100" cy="100" r="93" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2" />
  </svg>
</template>
