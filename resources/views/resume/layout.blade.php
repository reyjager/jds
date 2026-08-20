{{--
    resources/views/resume/layout.blade.php

    Assembles the structural resume from separate component partials:
      partials/hero.blade.php          -> photo + name/title
      partials/contact.blade.php       -> phone/email/location/license
      partials/skills.blade.php        -> programming, frameworks, data eng, other
      partials/education.blade.php     -> 3 education entries
      partials/about-me.blade.php      -> personal info rows
      partials/objective.blade.php     -> objective paragraph
      partials/experience.blade.php    -> 4 job entries
      partials/certificates.blade.php  -> certificate grid

    Still structure-only: gray/navy placeholder blocks, no real text.
--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume </title>
    <style>
        :root {
            --navy: #1f3a5f;
            --mint: #a9d8c8;
            --sidebar-bg: #eef0ee;
            --main-bg: #ffffff;
            --block: #d9dcd9;
            --block-dark: #c3c7c3;
            --block-navy-light: rgba(255, 255, 255, 0.25);
            --block-navy-lighter: rgba(255, 255, 255, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: sans-serif;
            background: #f4f4f4;
        }

        .resume {
            max-width: 1040px;
            margin: 24px auto;
            background: var(--main-bg);
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
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
            overflow: hidden;
        }

        .hero__photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero__text {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .bar {
            border-radius: 4px;
            background: var(--block-navy-light);
            padding: 4px 10px;
        }

        .bar--title {
            font-size: 28px;
            font-weight: 700;
            color: var(--mint);
            background: transparent;
        }

        .bar--subtitle {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            background: transparent;
            letter-spacing: 2px;
        }

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
            width: 20px;
            text-align: center;
            flex-shrink: 0;
            font-size: 13px;
        }

        .contact-text {
            font-size: 12px;
            color: #333;
            word-break: break-all;
        }

        .line {
            height: 10px;
            border-radius: 3px;
            background: var(--block);
        }

        .line--full {
            width: 100%;
        }

        .line--80 {
            width: 80%;
        }

        .line--65 {
            width: 65%;
        }

        .line--50 {
            width: 50%;
        }

        .line--40 {
            width: 40%;
        }

        .chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .chip {
            padding: 3px 8px;
            border-radius: 8px;
            background: var(--block);
            font-size: 11px;
            color: #333;
            white-space: nowrap;
        }

        .block-stack {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .edu-entry {
            display: flex;
            flex-direction: column;
            gap: 2px;
            margin-bottom: 10px;
        }

        .edu-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--navy);
        }

        .edu-school {
            font-size: 11px;
            color: #555;
        }

        .edu-date {
            font-size: 11px;
            color: #888;
            font-style: italic;
        }

        .about-row {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 11px;
            padding: 2px 0;
            border-bottom: 1px dotted #ddd;
        }

        .about-label {
            color: #888;
            white-space: nowrap;
        }

        .about-value {
            color: #333;
            font-weight: 600;
            text-align: right;
        }

        .block-stack h3 {
            margin: 0 0 4px;
            font-size: 12px;
            color: #555;
        }

        .sidebar__heading h2 {
            margin: 0 0 8px;
            font-size: 13px;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ---------- MAIN ---------- */
        .main {
            padding: 32px 40px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .section-heading {
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--navy);
            padding-bottom: 4px;
            margin-bottom: 12px;
        }

        .objective-text {
            margin: 0;
            font-size: 13px;
            color: #444;
            line-height: 1.6;
            font-style: italic;
        }

        .objective-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .entry {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding-left: 16px;
            border-left: 3px solid var(--navy);
            margin-bottom: 18px;
        }

        .entry__title {
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
        }

        .entry__subtitle {
            font-size: 12px;
            color: #888;
            font-style: italic;
        }

        .entry__bullets {
            margin: 4px 0 0 0;
            padding-left: 16px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .entry__bullets li {
            font-size: 12px;
            color: #444;
            line-height: 1.5;
        }

        .cert-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 24px;
        }

        .cert-item {
            font-size: 12px;
            color: #444;
            line-height: 1.4;
        }

    </style>
</head>
<body>

    <div class="resume">

        @include('resume.partials.hero')

        <div class="body">

            <div class="sidebar">
                @include('resume.partials.contact')
                @include('resume.partials.skills')
                @include('resume.partials.education')
                @include('resume.partials.about-me')
            </div>

            <div class="main">
                @include('resume.partials.objective')
                @include('resume.partials.experience')
                @include('resume.partials.certificates')
            </div>

        </div>

    </div>

</body>
</html>
