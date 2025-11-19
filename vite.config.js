import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/home.js',
        'resources/js/model-builder.js',
        'resources/js/model-builder-app.js',
        'resources/js/retejs-demo.js',
        'resources/js/schema-editor.js'
      ],
      refresh: true,
    }),
    tailwindcss(),
    viteStaticCopy({
      targets: [
        { src: 'node_modules/@tabler/icons/icons/outline/*.svg', dest: 'icons/tabler/outline' },
        { src: 'node_modules/@tabler/icons/icons/filled/*.svg', dest: 'icons/tabler/filled' },
      ],
    }),
  ],
});
