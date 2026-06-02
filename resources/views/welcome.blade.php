<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VM Technical Studio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
                        url('https://images.unsplash.com/photo-1498050108023-c5249f4df085');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .section-padding {
            padding: 80px 0;
        }

        .service-card {
            transition: 0.3s;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .portfolio-card img {
            height: 250px;
            object-fit: cover;
        }

        footer {
            background: #212529;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">VM Technical Studio</a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Portfolio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero -->
<section id="home" class="hero d-flex align-items-center">
    <div class="container text-center">
        <h1 class="display-3 fw-bold">
            Building Digital Solutions
        </h1>

        <p class="lead mt-3">
            Web Development, Mobile Apps, and IT Solutions
        </p>

        <a href="#services" class="btn btn-primary btn-lg mt-3">
            Explore Services
        </a>
    </div>
</section>

<!-- About -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                     class="img-fluid rounded shadow">
            </div>

            <div class="col-md-6">
                <h2>About Us</h2>

                <p>
                    We provide innovative digital solutions for businesses,
                    helping them grow through modern technology and creative
                    design.
                </p>

                <p>
                    Our expertise includes web applications, mobile apps,
                    cloud systems, and custom software development.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- Services -->
<section id="services" class="section-padding bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2>Our Services</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <h4>Web Development</h4>
                        <p>
                            Responsive websites and web applications using
                            Laravel and modern frameworks.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <h4>Mobile Apps</h4>
                        <p>
                            Android and iOS applications built with Flutter.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <h4>IT Consulting</h4>
                        <p>
                            Technical guidance, system architecture, and
                            digital transformation services.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Portfolio -->
<section id="portfolio" class="section-padding">
    <div class="container">

        <div class="text-center mb-5">
            <h2>Portfolio</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card portfolio-card">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f"
                         class="card-img-top">

                    <div class="card-body">
                        <h5>Business Website</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card portfolio-card">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9"
                         class="card-img-top">

                    <div class="card-body">
                        <h5>Mobile Application</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card portfolio-card">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71"
                         class="card-img-top">

                    <div class="card-body">
                        <h5>Enterprise Solution</h5>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Contact -->
<section id="contact" class="section-padding bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2>Contact Us</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="/contact" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="name"
                               class="form-control"
                               placeholder="Your Name" required>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email"
                               class="form-control"
                               placeholder="Email Address" required>
                    </div>

                    <div class="mb-3">
                        <textarea name="message" class="form-control"
                                  rows="5"
                                  placeholder="Message" required></textarea>
                    </div>

                    <button class="btn btn-primary">
                        Send Message
                    </button>
                </form>

            </div>
        </div>

    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p class="mb-0">
            © {{ date('Y') }} VM Technical Studio. All Rights Reserved.
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>