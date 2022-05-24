/* eslint-disable no-undef */
const { merge } = require('webpack-merge');
const webpack = require('webpack');
const common = require('./webpack.common.js');

// Создание сервера
module.exports = merge(common, {
  devtool: 'source-map',
  mode: 'development',
  devServer: {
    open: true
  },
  plugins: [new webpack.HotModuleReplacementPlugin()]
});
