import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';

// Auto-register every enduser theme stylesheet so `@vite('...enduser/...')`
// calls resolve from the production manifest (they were previously unregistered,
// so in a built environment the CSS loaded late/not-at-all, causing the header
// to reflow "to and fro" on navigation and flaky first interactions).
const enduserCss = fs.existsSync('resources/css/enduser')
    ? fs.readdirSync('resources/css/enduser', { recursive: true })
        .filter((f) => typeof f === 'string' && f.endsWith('.css'))
        .map((f) => 'resources/css/enduser/' + f.replace(/\\/g, '/'))
    : [];

export default defineConfig({
    server: {
        // Bind to 127.0.0.1 (not IPv6 [::1]) so the browser can always reach the
        // dev server; and set a stable origin so @vite asset URLs resolve.
        host: '127.0.0.1',
        port: 5173,
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin.css',
                'resources/css/VehicleRegistration.css',
                'resources/css/style.css',
                'resources/js/script.js',
                ...enduserCss,
            ],
            refresh: true,
        }),
    ],
});
