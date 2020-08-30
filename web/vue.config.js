module.exports = {
    runtimeCompiler: true,
    devServer: {
        proxy: {
            // proxy all requests starting with /api to jsonplaceholder
            '^/api': {
                target: 'http://localhost/cap/api/public/api/',
                secure: false,
                changeOrigin: true,
                pathRewrite: {'^/api': ''},
            }
        }
    }
}
