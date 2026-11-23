<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rak Digital') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- CSS Kustom Rak Digital -->
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
            .brand { font-size: 1.6rem; font-weight: 700; text-navigation: none; text-decoration: none; letter-spacing: -.01em; }

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

            /* Controls & Filters */
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
            .search-row { display: flex; flex: 1 1 100%; gap: .75rem; flex-wrap: wrap; }
            .search-row .search { flex: 1 1 260px; }
            .search-row .sort { flex: 0 1 190px; }

            .count { margin: 1rem 0 1.1rem; color: var(--muted); }

            /* Book Grid & Cards */
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
                content: ""; position: absolute; inset: 0 auto 0 0; width: 10px; background: var(--spine); z-index: 1;
            }
            .card:hover .cover, .card:focus-visible .cover { transform: translateY(-4px); }
            .cover .cover-title { font-size: 1.3rem; font-weight: 700; line-height: 1.2; margin: 0; overflow-wrap: anywhere; }
            .cover .cover-author { font-size: .85rem; opacity: .92; margin: 0; }
            .cover .cover-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
            .cover.has-image { padding: 0; }

            .flash { margin: 1.25rem 0 0; padding: .8rem 1rem; border-radius: 10px; background: var(--success-bg); font-weight: 500; }
            main { padding: 1.5rem 0 3rem; }
            .site-footer { border-top: 1px solid var(--border); padding: 1.25rem 0 2rem; color: var(--muted); font-size: .9rem; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <header class="site-header">
            <div class="wrap">
                <a href="{{ route('books.index') }}" class="brand">Rak Digital</a>
                
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah buku</a>
                    
                    @auth
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Keluar</button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>

        <main class="wrap">
            @if (session('success'))
                <div class="flash" role="status">{{ session('success') }}</div>
            @endif

            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <footer class="site-footer">
            <div class="wrap">Rak Digital · Aplikasi koleksi buku berbasis Laravel.</div>
        </footer>
    </body>
</html>