const mix = require('laravel-mix')

mix
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
