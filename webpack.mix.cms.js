const mix = require('laravel-mix')

mix
  .sass('resources/domain/cms/sass/app.scss', 'public/assets/cms/css')
  .js('resources/domain/cms/js/app.js', 'public/assets/cms/js')

  // Libs
  .js('resources/domain/cms/js/libs/onleave.js', 'public/assets/cms/js/libs/onleave.js')
  .js('resources/domain/cms/js/libs/fixable.js', 'public/assets/cms/js/libs/fixable.js')

  // Static
  .copy('node_modules/jquery-form/src/jquery.form.js', 'public/assets/cms/js/libs/jquery.form.js')
  .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/assets/cms/webfonts')
  .copy('resources/domain/cms/images', 'public/assets/cms/images')

  .options({
    terser: {
      extractComments: false,
    }
  })

  .version()

if (!mix.inProduction()) {
  mix.options({
    processCssUrls: false,
    watchOptions: { ignored: /node_modules/ }
  })
}
