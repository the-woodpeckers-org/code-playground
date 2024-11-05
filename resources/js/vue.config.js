module.exports = {
    devServer: {
      proxy: {
        '/api': {
          target: 'https://provinces.open-api.vn',
          changeOrigin: true,
          pathRewrite: { '^/api': '' }
        }
      }
    }
  };