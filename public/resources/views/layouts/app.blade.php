<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Rak Digital') · Rak Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light dark;
            --bg: #ecf1ed;
            --surface: #ffffff;
            --field: #ecf1ed;
            --text: #14231d;
            --muted: #55655d;
            --border: #cfd8d2;
            --accent: #1d6b5a;
            --accent-text: #ffffff;
            --danger: #b3261e;
            --danger-bg: #fbe9e7;
            --success-bg: #dff1e8;
            --shadow: 0 8px 18px rgba(20, 35, 29, .18);
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #101714;
                --surface: #19231f;
                --field: #101714;
                --text: #e6efe9;
                --muted: #9db0a6;
                --border: #2d3b35;
                --accent: #3fae94;
                --accent-text: #08130f;
                --danger: #ff8a80;
                --danger-bg: #3a1c19;
                --success-bg: #17352b;
                --shadow: 0 8px 18px rgba(0, 0, 0, .5);
            }
        }

        * { box-sizing: border-box; }
        html { scroll-padding-top: 1rem; }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }
        a { color: inherit; }
        .wrap { width: min(1160px, 100% - 2.5rem); margin-inline: auto; }

        /* Header */
        .site-header { background: var(--surface); border-bottom: 1px solid var(--border); }
        .site-header .wrap { display: flex; align-items: center; justify-content: space-between; gap: 1rem; min-height: 4.5rem; }
        .brand { font-size: 1.6rem; font-weight: 700; text-decoration: none; letter-spacing: -.01em; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; justify-content: center;
            min-height: 2.75rem; padding: 0 1.1rem;
            border-radius: 10px; border: 1px solid var(--border);
            background: var(--surface); color: var(--text);
            font: inherit; font-weight: 600; text-decoration: none; cursor: pointer;
        }
        .btn:hover { border-color: var(--accent); }
        .btn-primary { background: var(--accent); color: var(--accent-text); border-color: var(--accent); }
        .btn-primary:hover { filter: brightness(1.08); }
        .btn-danger { color: var(--danger); border-color: var(--danger); }
        .btn-danger:hover { background: var(--danger-bg); }
        :focus-visible { outline: 3px solid var(--accent); outline-offset: 2px; }

        /* Flash & errors */
        .flash { margin: 1.25rem 0 0; padding: .8rem 1rem; border-radius: 10px; background: var(--success-bg); font-weight: 500; }

        main { padding: 1.5rem 0 3rem; }

        /* Controls */
        .controls { display: flex; flex-wrap: wrap; align-items: center; gap: .75rem; }
        .chips { display: flex; flex-wrap: wrap; gap: .5rem; flex: 1 1 100%; }
        .chip {
            display: inline-flex; align-items: center; min-height: 2.75rem; padding: 0 1.1rem;
            border-radius: 999px; border: 1px solid var(--border);
            background: var(--surface); text-decoration: none; font-weight: 500;
        }
        .chip:hover { border-color: var(--accent); }
        .chip.active { background: var(--accent); border-color: var(--accent); color: var(--accent-text); font-weight: 600; }

        .field, select.field, textarea.field {
            width: 100%; min-height: 2.75rem; padding: .55rem .85rem;
            border: 1px solid var(--border); border-radius: 10px;
            background: var(--field); color: var(--text); font: inherit;
        }
        textarea.field { min-height: 7rem; resize: vertical; }
        .search-row { display: flex; flex: 1 1 100%; gap: .75rem; flex-wrap: wrap; }
        .search-row .search { flex: 1 1 260px; }
        .search-row .sort { flex: 0 1 190px; }

        .count { margin: 1rem 0 1.1rem; color: var(--muted); }

        /* Book grid */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem 1.25rem; }
        .card { text-decoration: none; display: block; }
        .card .meta-title { margin: .7rem 0 0; font-weight: 600; }
        .card .meta-author { margin: 0; color: var(--muted); }
        .card .meta-info { margin: .25rem 0 0; color: var(--muted); font-size: .85rem; }

        .cover {
            position: relative; aspect-ratio: 2 / 3;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 1.1rem 1rem 1.1rem 1.5rem;
            background: var(--cover); color: #fff;
            border-radius: 6px 14px 14px 6px;
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform .15s ease;
        }
        .cover::before {
            content: ""; position: absolute; inset: 0 auto 0 0; width: 10px; background: var(--spine);
        }
        .card:hover .cover, .card:focus-visible .cover { transform: translateY(-4px); }
        .cover .cover-title { font-size: 1.3rem; font-weight: 700; line-height: 1.2; margin: 0; overflow-wrap: anywhere; }
        .cover .cover-author { font-size: .85rem; opacity: .92; margin: 0; }

        .empty { padding: 3rem 1rem; text-align: center; color: var(--muted); background: var(--surface); border: 1px dashed var(--border); border-radius: 14px; }

        /* Panels (detail & form) */
        .panel { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 1.75rem; box-shadow: var(--shadow); }
        .detail { display: grid; grid-template-columns: 190px 1fr; gap: 2rem; }
        .detail .cover { box-shadow: var(--shadow); }
        .detail h1 { margin: 0; font-size: 1.9rem; line-height: 1.2; }
        .detail .sub { margin: .4rem 0 1.25rem; color: var(--muted); }
        .badge { display: inline-block; padding: .1rem .7rem; border-radius: 999px; color: #fff; font-size: .8rem; font-weight: 600; background: var(--cover); }
        .actions { display: flex; flex-wrap: wrap; gap: .75rem; margin-top: 1.75rem; }
        .actions form { margin: 0; }

        h1.page-title { margin: 0 0 1.25rem; font-size: 1.6rem; }
        .form-group { margin-bottom: 1.1rem; }
        .form-group label { display: block; margin-bottom: .3rem; font-weight: 600; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .field.invalid { border-color: var(--danger); }
        .error { margin: .3rem 0 0; color: var(--danger); font-size: .9rem; }
        .hint { margin: .3rem 0 0; color: var(--muted); font-size: .85rem; }
        .form-actions { display: flex; justify-content: flex-end; gap: .75rem; margin-top: 1.25rem; }
        .form-panel { max-width: 640px; margin-inline: auto; }

        .site-footer { border-top: 1px solid var(--border); padding: 1.25rem 0 2rem; color: var(--muted); font-size: .9rem; }

        @media (max-width: 640px) {
            .wrap { width: min(1160px, 100% - 1.5rem); }
            .grid { grid-template-columns: repeat(2, 1fr); gap: 1.25rem .9rem; }
            .cover { padding: .8rem .7rem .8rem 1.2rem; }
            .cover .cover-title { font-size: 1.05rem; }
            .brand { font-size: 1.3rem; }
            .detail { grid-template-columns: 1fr; }
            .detail .cover { max-width: 190px; }
            .form-row { grid-template-columns: 1fr; }
            .search-row .sort { flex: 1 1 100%; }
            .panel { padding: 1.25rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .cover { transition: none; }
            .card:hover .cover { transform: none; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="wrap">
            <a href="{{ route('books.index') }}" class="brand">Rak Digital</a>
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah buku</a>
        </div>
    </header>

    <main class="wrap">
        @if (session('success'))
            <div class="flash" role="status">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap">Rak Digital · Aplikasi koleksi buku berbasis Laravel dan MariaDB.</div>
    </footer>
</body>
</html>
