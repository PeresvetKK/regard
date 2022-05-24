const webpack = require('webpack');
const path = require('path');
const glob = require('glob');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  target: 'web',
  //Использование правильного пути
  context: path.resolve(__dirname, 'src'),
  //Точки входа в приложение (все js файлы, лежащие в папке src/js)
  //Пример объекта:
  // { index, projects, ... }
  entry: Object.assign(
    {},
    ...glob.sync('./src/js/*.js').map((jsFile) => ({
      [jsFile.replace('./src/js/', '').replace('.js', '')]: `${jsFile}`.replace('./src', '.')
    }))
  ),
  //Точки выхода в папке build
  output: {
    path: path.resolve(__dirname, 'build'),
    filename: 'js/[name].js'
  },
  module: {
    rules: [
      //Обработка файлов js
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: 'babel-loader'
      },
      //Обработка файлов scss | css
      {
        test: /\.(scss|css)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader
          },
          {
            loader: 'css-loader'
          },
          {
            loader: 'postcss-loader'
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
              sassOptions: { outputStyle: 'expanded' }
            }
          }
        ]
      },
      //Обработка файлов html
      {
        test: /\.(html)$/,
        use: 'html-loader'
      },
      //Обработка файлов шрифтов
      {
        test: /\.(woff(2)?|ttf|eot)(\?v=\d+\.\d+\.\d+)?$/,
        type: 'asset',
        generator: {
          filename: 'fonts/[name][ext]'
        }
      },
      //Обработка файлов изображений
      {
        test: /\.(gif|png|jpe?g|svg)$/i,
        type: 'asset',
        generator: {
          filename: 'img/[name][ext]'
        }
      }
    ]
  },
  plugins: [
    // Все импорты scss файлов в каждой входной точке объединяются в один css файл с таким же именем как и у входной точки и добавляются в папку build
    new MiniCssExtractPlugin({
      filename: 'css/[name].css'
    }),
    // Копирование css каталога в директорию src
    new MiniCssExtractPlugin({
      filename: '../src/css/[name].css'
    }),
    // Копирование всех шрифтов и страниц в билд (в проде минифицируется)
    new CopyWebpackPlugin({
      patterns: [
        {
          from: path.resolve('./src/fonts'),
          to: path.resolve('./build/fonts'),
          noErrorOnMissing: true
        }
      ]
    }),
    // Создание html шаблонов к которому подключаются одноименные файл стилей и файл скриптов (даже если их не существует)
    ...glob.sync('./src/*.html').map(
      (htmlFile) =>
        new HtmlWebpackPlugin({
          chunks: [htmlFile.replace('./src/', '').replace('.html', '')],
          inject: 'body',
          filename: path.basename(htmlFile),
          template: path.basename(htmlFile),
          xhtml: true
        })
    ),
    // Настройка Jquery
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery'
    })
  ]
};
