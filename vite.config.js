import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/design-system.css',
        'resources/js/app.js',
        'resources/js/model-builder.js',
        'resources/js/pages/components-main.js',
        'resources/js/pages/alpine.js',
        'resources/js/pages/forms.js',
        'resources/js/pages/diagrams.js',
        'resources/js/pages/echarts.js',
        'resources/js/pages/tabulator.js',
        'resources/js/pages/apexcharts.js',
        'resources/packages/schema-editor/js/SchemaEditor.js',
        'resources/packages/schema-editor/scss/schema-editor.scss'
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
