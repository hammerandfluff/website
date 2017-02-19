/**
 * This file contains the webpack configuration.
 */

// Include dependencies
const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require("extract-text-webpack-plugin");

// Paths
const assets = path.resolve( __dirname, '../wp-content/themes/hnf/assets' );

// Export config.
module.exports = {
	context: assets,
	entry: {
		main: [
			'./js/src/hammerandfluff.js',
			'./css/src/hammerandfluff.scss'
		]
	},
	output: {
		path: assets,
		filename: 'js/dist/[name].bundle.js'
	},
	devtool: 'source-map',
	module: {
		rules: [
			{
				test: /\.js$/,
				use: 'babel-loader',
				exclude: [ /node_modules/ ]
			},
			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({
					fallback: 'style-loader',
					use: [ 'css-loader', 'sass-loader' ]
				})
			}
		]
	},
	plugins: [
		new ExtractTextPlugin( {
			filename: 'css/dist/[name].css',
			allChunks: true
		} )
	]
};
