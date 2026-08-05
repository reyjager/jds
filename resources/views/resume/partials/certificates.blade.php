{{-- resources/views/resume/partials/certificates.blade.php --}}
<div>
    <div class="section-heading">Certificates</div>
    <div class="cert-list">
        @foreach ([
            'Install and Configure Network Infrastructure',
            'SPARTA - Data Engineer',
            'Computing in Python and Data Mining',
            'Data Management',
            'Data-Driven Research',
            'Visualization Fundamentals',
            'Analytics Applications in Operation',
            'Data Engineering',
            'Data Science and Analytics Project Management',
            'Analytic Application in Finance and Risk',
            'Data Driven Policy Analysis',
            'Applied Analytics in Public Human Resource Management',
            'Applied Analytics in Public Finance and Budgeting',
            'CISCO Certified Network Associate Bootcamp',
            'Routers and Switches Basic to Advance Training',
            'Network and Database Application',
            'System Security Training',
            'PC Networks and Services',
        ] as $cert)
            <div class="cert-item">▪ {{ $cert }}</div>
        @endforeach
    </div>
</div>
