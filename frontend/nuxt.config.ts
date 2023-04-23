import { defineNuxtConfig } from "nuxt/config";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: ["@nuxtjs/tailwindcss"],
  typescript: {
    strict: true,
    typeCheck: true,
  },
  tailwindcss: {
    config: {
      theme: {
        colors: {
          primary: "#FD4556",
          secondary: "#BD3944",
          tertiary: "#53212B",
          milk: "#FFFBF5",
        },
      },
    },
  },
});
