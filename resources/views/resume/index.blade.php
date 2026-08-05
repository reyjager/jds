{{--
    resume-structure.blade.php
    Pure structural / wireframe layout of the uploaded resume.
    No real text content — only placeholder blocks, shapes and
    background colors that mirror the original layout's geometry:

    ┌─────────────────────────────────────────────┐
    │  HERO (dark navy)                            │
    │  [photo circle]   [title bar] [subtitle bar] │
    ├───────────────────┬───────────────────────────┤
    │ SIDEBAR (light)    │ MAIN (white)              │
    │ - contact rows     │ - objective block         │
    │ - skills blocks    │ - experience timeline     │
    │ - education blocks │ - certificate list        │
    │ - about-me rows    │                           │
    └───────────────────┴───────────────────────────┘
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume Structure</title>
    <style>
        :root {
            --navy: #1f3a5f;
            --mint: #a9d8c8;
            --sidebar-bg: #eef0ee;
            --main-bg: #ffffff;
            --block: #d9dcd9;
            --block-dark: #c3c7c3;
            --block-navy-light: rgba(255,255,255,0.25);
            --block-navy-lighter: rgba(255,255,255,0.15);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: sans-serif;
            background: #f4f4f4;
        }

        .resume {
            max-width: 950px;
            margin: 24px auto;
            background: var(--main-bg);
            box-shadow: 0 0 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        /* ---------- HERO ---------- */
        .hero {
            background: var(--navy);
            display: flex;
            align-items: center;
            gap: 28px;
            padding: 28px 36px;
        }

        .hero__photo {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: var(--block-navy-light);
            flex-shrink: 0;
        }

        .hero__text {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .bar {
            height: 14px;
            border-radius: 4px;
            background: var(--block-navy-light);
        }

        .bar--title { height: 26px; width: 55%; background: var(--mint); opacity: .5; }
        .bar--subtitle { width: 40%; background: var(--block-navy-lighter); }

        /* ---------- BODY LAYOUT ---------- */
        .body {
            display: grid;
            grid-template-columns: 30% 70%;
        }

        /* ---------- SIDEBAR ---------- */
        .sidebar {
            background: var(--sidebar-bg);
            padding: 28px 22px;
            display: flex;
            flex-direction: column;
            gap: 26px;
        }

        .sidebar__section {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar__heading {
            height: 12px;
            width: 55%;
            border-radius: 3px;
            background: var(--block-dark);
            margin-bottom: 4px;
        }

        .sidebar__row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .icon {
            width: 14px;
            height: 14px;
            border-radius: 3px;
            background: var(--block-dark);
            flex-shrink: 0;
        }

        .line {
            height: 10px;
            border-radius: 3px;
            background: var(--block);
        }

        .line--full { width: 100%; }
        .line--80 { width: 80%; }
        .line--65 { width: 65%; }
        .line--50 { width: 50%; }
        .line--40 { width: 40%; }

        .chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .chip {
            height: 10px;
            width: 42px;
            border-radius: 8px;
            background: var(--block);
        }

        .block-stack {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* ---------- MAIN ---------- */
        .main {
            padding: 32px 40px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .section-heading {
            height: 14px;
            width: 30%;
            border-radius: 3px;
            background: var(--block-dark);
            margin-bottom: 12px;
        }

        .objective-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .entry {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-left: 16px;
            border-left: 3px solid var(--block);
            margin-bottom: 18px;
        }

        .entry__title { height: 12px; width: 35%; background: var(--block-dark); border-radius: 3px; }
        .entry__subtitle { height: 10px; width: 45%; background: var(--block); border-radius: 3px; }
        .entry__bullets { display: flex; flex-direction: column; gap: 6px; margin-top: 4px; }

        .cert-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 24px;
        }
    </style>
</head>
<body>

    <div class="resume">

        {{-- HERO --}}
        <div class="hero">
            <div class="hero__photo"></div>
            <div class="hero__text">
                <div class="bar bar--title"></div>
                <div class="bar bar--subtitle"></div>
            </div>
        </div>

        <div class="body">

            {{-- SIDEBAR --}}
            <div class="sidebar">

                {{-- contact --}}
                <div class="sidebar__section">
                    <div class="sidebar__row"><div class="icon"></div><div class="line line--65"></div></div>
                    <div class="sidebar__row"><div class="icon"></div><div class="line line--80"></div></div>
                    <div class="sidebar__row"><div class="icon"></div><div class="line line--50"></div></div>
                    <div class="sidebar__row"><div class="icon"></div><div class="line line--65"></div></div>
                </div>

                {{-- license / id line --}}
                <div class="sidebar__section">
                    <div class="line line--80"></div>
                </div>

                {{-- skills --}}
                <div class="sidebar__section">
                    <div class="sidebar__heading"></div>
                    <div class="block-stack">
                        <div class="line line--40"></div>
                        <div class="chip-row">
                            <div class="chip"></div><div class="chip"></div><div class="chip"></div>
                            <div class="chip"></div><div class="chip"></div>
                        </div>
                    </div>
                    <div class="block-stack">
                        <div class="line line--40"></div>
                        <div class="chip-row">
                            <div class="chip"></div><div class="chip"></div><div class="chip"></div>
                        </div>
                    </div>
                    <div class="block-stack">
                        <div class="line line--40"></div>
                        <div class="line line--full"></div>
                        <div class="line line--80"></div>
                    </div>
                    <div class="block-stack">
                        <div class="line line--40"></div>
                        <div class="line line--full"></div>
                        <div class="line line--full"></div>
                        <div class="line line--65"></div>
                    </div>
                </div>

                {{-- education --}}
                <div class="sidebar__section">
                    <div class="sidebar__heading"></div>
                    <div class="block-stack">
                        <div class="line line--80"></div>
                        <div class="line line--65"></div>
                        <div class="line line--40"></div>
                    </div>
                    <div class="block-stack">
                        <div class="line line--80"></div>
                        <div class="line line--50"></div>
                    </div>
                    <div class="block-stack">
                        <div class="line line--80"></div>
                        <div class="line line--65"></div>
                        <div class="line line--40"></div>
                    </div>
                </div>

                {{-- about me --}}
                <div class="sidebar__section">
                    <div class="sidebar__heading"></div>
                    <div class="sidebar__row"><div class="line line--40"></div><div class="line line--40"></div></div>
                    <div class="sidebar__row"><div class="line line--40"></div><div class="line line--40"></div></div>
                    <div class="sidebar__row"><div class="line line--40"></div><div class="line line--40"></div></div>
                    <div class="sidebar__row"><div class="line line--40"></div><div class="line line--40"></div></div>
                    <div class="sidebar__row"><div class="line line--40"></div><div class="line line--40"></div></div>
                    <div class="sidebar__row"><div class="line line--40"></div><div class="line line--40"></div></div>
                </div>

            </div>

            {{-- MAIN --}}
            <div class="main">

                {{-- objective --}}
                <div>
                    <div class="section-heading"></div>
                    <div class="objective-box">
                        <div class="line line--full"></div>
                        <div class="line line--80"></div>
                    </div>
                </div>

                {{-- experience --}}
                <div>
                    <div class="section-heading"></div>

                    <div class="entry">
                        <div class="entry__title"></div>
                        <div class="entry__subtitle"></div>
                        <div class="entry__bullets">
                            <div class="line line--full"></div>
                            <div class="line line--full"></div>
                            <div class="line line--80"></div>
                            <div class="line line--full"></div>
                        </div>
                    </div>

                    <div class="entry">
                        <div class="entry__title"></div>
                        <div class="entry__subtitle"></div>
                        <div class="entry__bullets">
                            <div class="line line--80"></div>
                        </div>
                    </div>

                    <div class="entry">
                        <div class="entry__title"></div>
                        <div class="entry__subtitle"></div>
                        <div class="entry__bullets">
                            <div class="line line--full"></div>
                            <div class="line line--65"></div>
                        </div>
                    </div>

                    <div class="entry">
                        <div class="entry__title"></div>
                        <div class="entry__subtitle"></div>
                        <div class="entry__bullets">
                            <div class="line line--80"></div>
                            <div class="line line--65"></div>
                            <div class="line line--50"></div>
                        </div>
                    </div>
                </div>

                {{-- certificates --}}
                <div>
                    <div class="section-heading"></div>
                    <div class="cert-list">
                        @for ($i = 0; $i < 16; $i++)
                            <div class="line line--80"></div>
                        @endfor
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>
</html>