<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi OAuth2 SSO Server</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100">
    <div class="max-w-5xl mx-auto px-6 py-10 space-y-8">
        <h1 class="text-3xl font-bold border-b pb-4">📘 Dokumentasi Endpoint OAuth2 – SSO Server</h1>

        <section>
            <h2 class="text-xl font-semibold mb-2">1. Authorization Endpoint</h2>
            <p><code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">GET /oauth/authorize</code></p>
            <ul class="list-disc ml-6 mt-2 text-sm">
                <li><strong>client_id</strong> (required)</li>
                <li><strong>redirect_uri</strong> (required)</li>
                <li><strong>response_type</strong> = <code>code</code></li>
                <li><strong>state</strong> (recommended)</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">2. Token Endpoint</h2>
            <p><code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">POST /oauth/token</code></p>
            <ul class="list-disc ml-6 mt-2 text-sm">
                <li>grant_type = <code>authorization_code</code></li>
                <li>client_id, client_secret</li>
                <li>code</li>
                <li>redirect_uri</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">3. User Info Endpoint</h2>
            <p><code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">GET /api/user</code></p>
            <p class="text-sm mt-2">Authorization: <code>Bearer {access_token}</code></p>
            <p class="text-sm mt-2">Response:</p>
            <pre class="bg-gray-100 dark:bg-gray-800 p-3 rounded text-sm">
{
    "id": 1,
    "name": "Budi Santoso",
    "email": "budi@example.com",
    "role": "admin"
}
            </pre>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">4. Refresh Token (Opsional)</h2>
            <p><code class="bg-gray-200 dark:bg-gray-700 px-2 py-1 rounded">POST /oauth/token</code></p>
            <ul class="list-disc ml-6 mt-2 text-sm">
                <li>grant_type = <code>refresh_token</code></li>
                <li>refresh_token</li>
                <li>client_id, client_secret</li>
            </ul>
        </section>

        <section>
            <h2 class="text-xl font-semibold mb-2">5. Catatan Keamanan</h2>
            <ul class="list-disc ml-6 mt-2 text-sm text-red-500">
                <li>Selalu gunakan HTTPS</li>
                <li>Validasi parameter <code>state</code> di client</li>
                <li>Jangan simpan token di localStorage</li>
                <li>Gunakan access token jangka pendek</li>
            </ul>
        </section>

        <footer class="pt-6 mt-10 border-t text-sm text-gray-500 dark:text-gray-400">
            Dokumentasi ini berlaku untuk SSO berbasis Laravel Passport
        </footer>
    </div>
</body>

</html>
