import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/app/ganadegasof.scss',
                'resources/sass/app/login/styles.scss',
                'resources/sass/app/register/styles.scss',
                'resources/sass/app/layouts/styles.scss',
                'resources/sass/app/wellcome/styles.scss',
                'resources/sass/app/finca/stylefrontpagefinca.scss',
                'resources/sass/app/finca/formcreatefinca.scss',
                'resources/sass/app/finca/stylewelcomefarm.scss',
                'resources/sass/app/home/homestyle.scss',
                'resources/sass/app/finca/homefinca.scss',
                'resources/sass/app/finca/homefincapersonal.scss',
                'resources/sass/app/animal/uprebano.scss',
                'resources/js/app.js',
                'resources/js/finca/createfincaform.js',
                'resources/js/finca/welcomefincaform.js',
                'resources/js/finca/homefincainventario.js',
                'resources/js/finca/inventario.js',
                'resources/js/finca/homefincamifinca.js',
                'resources/js/finca/rebano.js',
                'resources/js/finca/homefincarebano.js',
                'resources/js/finca/personal.js',
                'resources/js/finca/homefincapersonal.js',
                'resources/sass/app/animal/homeanimal.scss',
                'resources/js/animal/createanimal.js',
                'resources/js/animal/homeanimal.js',
                'resources/js/animal/uprebano.js',
            ],
            refresh: true,
        }),
    ],
});
