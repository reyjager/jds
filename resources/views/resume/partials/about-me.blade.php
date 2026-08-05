{{-- resources/views/resume/partials/about-me.blade.php --}}
<div class="sidebar__section">
    <div class="sidebar__heading"><h2>About Me</h2></div>

    @foreach ([
        ['Height', "5'7\""],
        ['Weight', '75 Kg'],
        ['Birth Date', 'May 9, 1980'],
        ['Birthplace', 'General Santos City'],
        ['Nationality', 'Filipino'],
        ['Civil Status', 'Married'],
        ['Religion', 'Baptist'],
    ] as [$label, $value])
    <div class="about-row">
        <span class="about-label">{{ $label }}</span>
        <span class="about-value">{{ $value }}</span>
    </div>
    @endforeach
</div>
