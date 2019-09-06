const path = require('path'),
  settings = require('./settings');
module.exports = {
  entry: {
    App: `../${settings.themeFolderName}/js/index.js`
  },
  devtool: "source-map",
  output: {
    path: path.resolve(__dirname, "dist"),
    filename: "main.js"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }
    ]
  },
  mode: settings.developmentMode
}