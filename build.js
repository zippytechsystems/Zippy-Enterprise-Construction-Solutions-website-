const esbuild = require('esbuild');

async function buildReactApp() {
  console.log('Building React JS bundle for Zippy Enterprises...');
  try {
    await esbuild.build({
      entryPoints: ['src/index.jsx'],
      bundle: true,
      minify: true,
      sourcemap: false,
      outfile: 'assets/js/react-app.bundle.js',
      define: {
        'process.env.NODE_ENV': '"production"'
      },
      loader: {
        '.js': 'jsx',
        '.jsx': 'jsx'
      }
    });
    console.log('✓ Success: Production React bundle created at assets/js/react-app.bundle.js');
  } catch (err) {
    console.error('Build error:', err);
    process.exit(1);
  }
}

buildReactApp();
