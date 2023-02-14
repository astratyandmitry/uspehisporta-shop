const bundle = process.env.section ? process.env.section : 'full'
require(`${__dirname}/webpack.mix.${bundle}.js`)
