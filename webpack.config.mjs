import path from 'path'
import { fileURLToPath } from 'url'

import MiniCssExtractPlugin from 'mini-css-extract-plugin'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

const jsConfig = {
    entry: './my_expenses/static/js/main.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'my_expenses/static/js/dist'),
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                    },
                },
            },
        ],
    },
}

const scssConfig = {
    entry: './my_expenses/static/scss/main.scss',
    output: {
        path: path.resolve(__dirname, 'my_expenses/static/scss/dist'),
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
            },
        ],
    },
    plugins: [new MiniCssExtractPlugin({ filename: 'main.css' })],
}

export default [jsConfig, scssConfig]
