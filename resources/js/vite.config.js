    // vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    outDir: 'public/build',
    assetsDir: '',
    manifest: true,
    rollupOptions: {
      input: {
        app: 'resources/js/app.js',
      },
    },
  },
});
