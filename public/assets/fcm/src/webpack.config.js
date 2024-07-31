module.exports = {
  entry: './grid.js', // Your entry point file
  output: {
      filename: 'bundle.js', // Output bundled file name
      path: path.resolve(__dirname, 'dist'), // Output directory
  },
  module: {
      rules: [
          {
              test: /\.js$/, // Rule for JavaScript files
              exclude: /node_modules/, // Exclude node_modules folder
              use: {
                  loader: 'babel-loader', // Use Babel loader for transpiling (optional)
                  options: {
                      presets: ['@babel/preset-env'], // Babel presets (optional)
                  }
              }
          }
      ]
  }
};