import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import svgLoader from 'vite-svg-loader';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.ts',
            ],
            refresh: true,
        }),

        vue({
            template: { transformAssetUrls }
        }),

        svgLoader({
            svgoConfig: {
                multipass: true,
            },
        }),
    ],

    resolve: {
        alias: {
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
            '@': '/resources',
            '@fonts': '/public/fonts',
            '@img': '/public/img',
            '@js': '/resources/js',
        },
    },

    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }

                    if (id.includes('resources')) {
                        return 'app';
                    }
                },
            },
        },
    },
});
