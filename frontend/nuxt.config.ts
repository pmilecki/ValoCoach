import { defineNuxtConfig } from 'nuxt/config'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: ['@nuxtjs/tailwindcss', 'nuxt-vitest'],

  typescript: {
    strict: true,
    typeCheck: true,
  },

  tailwindcss: {
    config: {
      content: ['./pages/**/*.{html,js}', './components/**/*.{html,js}'],
      theme: {
        colors: {
          primaryRed: '#FD4556',
          secondaryRed: '#BD3944',
          tertiaryRed: '#53212B',
          milk: '#FFFBF5',
        },
      },
    },
  },

  vite: {
    define: {
      'process.env.DEBUG': false,
    },
  },

  devtools: {
    enabled: true,
  },
})
