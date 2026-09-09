/**
 * SIMPEL BPVP Kendari - Instant Web Server Runner
 * Serves all static HTML pages and Laravel API simulators with full 9-role authentication.
 */

const http = require('http');
const fs = require('fs');
const path = require('path');
const url = require('url');

const PORT = process.env.PORT || 8000;

const MIME_TYPES = {
    '.html': 'text/html; charset=utf-8',
    '.js': 'text/javascript; charset=utf-8',
    '.css': 'text/css; charset=utf-8',
    '.json': 'application/json; charset=utf-8',
    '.png': 'image/png',
    '.jpg': 'image/jpeg',
    '.svg': 'image/svg+xml',
    '.ico': 'image/x-icon'
};

const server = http.createServer((req, res) => {
    const parsedUrl = url.parse(req.url, true);
    let pathname = parsedUrl.pathname;

    if (pathname === '/') {
        pathname = '/index.html';
    } else if (!path.extname(pathname)) {
        // If route like /dashboard or /pelatihan, look for .html file
        if (fs.existsSync(path.join(__dirname, pathname + '.html'))) {
            pathname = pathname + '.html';
        }
    }

    const filePath = path.join(__dirname, pathname);

    fs.readFile(filePath, (err, data) => {
        if (err) {
            res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
            res.end(`
                <div style="font-family: sans-serif; text-align: center; padding: 50px;">
                    <h2>404 - Halaman Tidak Ditemukan</h2>
                    <p><a href="/index.html">Kembali ke Halaman Login</a></p>
                </div>
            `);
            return;
        }

        const ext = path.extname(filePath).toLowerCase();
        const contentType = MIME_TYPES[ext] || 'application/octet-stream';

        res.writeHead(200, { 'Content-Type': contentType });
        res.end(data);
    });
});

server.listen(PORT, () => {
    console.log(`[SIMPEL Web Server] Berjalan di http://localhost:${PORT}`);
    console.log(`[Akun Demo] 9 Role Tersedia di http://localhost:${PORT}/index.html`);
});
