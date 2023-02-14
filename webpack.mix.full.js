const mix = require('laravel-mix')

require('laravel-mix-purgecss')

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

  .js('resources/domain/shop/js/app.js', 'public/assets/shop/js')
  .js('resources/domain/shop/js/modules/product/app.js', 'public/assets/shop/js/product.js')
  .js('resources/domain/shop/js/modules/filter/app.js', 'public/assets/shop/js/filter.js')
  .js('resources/domain/shop/js/modules/basket/app.js', 'public/assets/shop/js/basket.js')
  .sass('resources/domain/shop/sass/app.scss', 'public/assets/shop/css')
  .sass('resources/domain/shop/sass/error.scss', 'public/assets/shop/css/error.css')

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
