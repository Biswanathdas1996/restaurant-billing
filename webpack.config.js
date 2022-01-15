const path = require("path");
const HtmlWebpackPlugin = require("html-webpack-plugin");

module.exports = {
  target: "web",
  entry: {
    index: path.join(__dirname, "src/index.js"),
  },
  plugins: [
    new HtmlWebpackPlugin({
      template: path.join(__dirname, "src/index.php"),
      chunks: ["index"],
      filename: "index.php",
    }),
  ],
  mode: "development",

  devServer: {
    // Specifying a host to use
    host: "localhost",

    // Specifying a port number
    port: 3100,

    // This is the key to our approach
    // With a backend on http://localhost/PROJECTNAME/
    // we will use this to enable proxying
    proxy: {
      // Star(*) defines all the valid requests
      "*": {
        // Specifying the full path to the dist folder
        // Replace "webpack-devserver-php" with your project folder name
        target: `http://localhost:3100/OflineResturent/dist`,
      },
    },

    // Bundle files will be available in the browser under this path
    publicPath: path.resolve(__dirname, "dist"),

    // It writes generated assets to the dist folder
    writeToDisk: true,
  },
};
