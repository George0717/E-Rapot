<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Faithful Dancer - Sekolah Minggu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --color-primary: #160F1A;
            --color-secondary: #777292;
            --color-accent: #C9B6C7;
            --color-highlight: #D26D6B;
            --color-bg: #FEFDFD;
        }

        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background: var(--color-bg);
            color: var(--color-primary);
            overflow-x: hidden;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 1.5rem 2rem;
            background: rgba(254, 253, 253, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(119, 114, 146, 0.1);
            transition: all 0.3s ease;
        }

        nav.scrolled {
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(22, 15, 26, 0.05);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--color-secondary);
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--color-highlight), var(--color-accent));
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--color-primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
        }

        .btn-outline {
            border: 2px solid var(--color-secondary);
            color: var(--color-secondary);
        }

        .btn-outline:hover {
            background: var(--color-secondary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(119, 114, 146, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(22, 15, 26, 0.3);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8rem 2rem 4rem;
            position: relative;
            overflow: hidden;

            background-image: url('/img/hero_image.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Overlay gelap agar teks kontras */
      .hero::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 1;

    background: linear-gradient(
        135deg,
        rgba(22, 15, 26, 0.65) 0%,     /* #160F1A */
        rgba(119, 114, 146, 0.55) 40%, /* #777292 */
        rgba(210, 109, 107, 0.45) 70%  /* #D26D6B */
    );
}

        /* Pastikan konten di atas overlay */
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
        }


        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-30px);
            }
        }

        .hero-content {
            max-width: 900px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
    font-size: 4rem;
    font-weight: 800;
    color: #FEFDFD;
    margin-bottom: 1.5rem;
    line-height: 1.2;

    text-shadow:
        0 4px 20px rgba(0, 0, 0, 0.5),
        0 2px 10px rgba(0, 0, 0, 0.3);
}



        .hero .subtitle {
    font-size: 1.4rem;
    color: #FEFDFD;
    margin-bottom: 3rem;

    opacity: 0.95;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
}


        /* About Section */
        .about {
            padding: 6rem 2rem;
            background: white;
            position: relative;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-highlight) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .section-title.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .about-content.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .about-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--color-secondary);
            margin-bottom: 1.5rem;
        }

        .about-image {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(22, 15, 26, 0.1);
        }

        .about-image img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        /* Coach Cards Section */
        .coaches {
            padding: 6rem 2rem;
            background: linear-gradient(180deg, var(--color-bg) 0%, rgba(201, 182, 199, 0.05) 100%);
        }

        .coaches-carousel {
            position: relative;
            overflow: hidden;
            margin-top: 3rem;
            padding: 2rem 0;
        }

        .coaches-track {
            display: flex;
            gap: 2rem;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0 2rem;
        }

        .coach-card {
            min-width: 320px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(22, 15, 26, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .coach-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 60px rgba(22, 15, 26, 0.15);
        }

        .coach-card-image {
            width: 100%;
            height: 350px;
            overflow: hidden;
            position: relative;
        }

        .coach-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .coach-card:hover .coach-card-image img {
            transform: scale(1.1);
        }

        .coach-card-content {
            padding: 1.5rem;
            text-align: center;
        }

        .coach-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 0.5rem;
        }

        .coach-position {
            font-size: 1rem;
            color: var(--color-secondary);
            font-weight: 500;
        }

        .carousel-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .carousel-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            border: none;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .carousel-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 24px rgba(22, 15, 26, 0.3);
        }

        .carousel-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .carousel-btn:disabled:hover {
            transform: scale(1);
            box-shadow: none;
        }

        /* Contact Section */
        .contact {
            padding: 6rem 2rem;
            background: white;
        }

        .contact-container {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .contact-container.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .contact-info h3 {
            font-size: 1.5rem;
            color: var(--color-primary);
            margin-bottom: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(201, 182, 199, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            background: rgba(201, 182, 199, 0.2);
            transform: translateX(8px);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--color-highlight) 0%, var(--color-accent) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .contact-text {
            flex: 1;
        }

        .contact-text p {
            font-size: 0.9rem;
            color: var(--color-secondary);
            margin-bottom: 0.25rem;
        }

        .contact-text a {
            font-size: 1.1rem;
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .contact-text a:hover {
            color: var(--color-highlight);
        }

        .contact-logo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-circle {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 50%, var(--color-highlight) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 60px rgba(22, 15, 26, 0.2);
            animation: pulse 3s ease-in-out infinite;
            position: relative;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 20px 60px rgba(22, 15, 26, 0.2);
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 25px 70px rgba(22, 15, 26, 0.3);
            }
        }

        .logo-circle::before {
            content: '';
            position: absolute;
            inset: 8px;
            border-radius: 50%;
            background: white;
        }

        .logo-text {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .logo-text h4 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-highlight) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-text p {
            font-size: 0.9rem;
            color: var(--color-secondary);
            margin-top: 0.5rem;
        }

        /* Footer */
        footer {
            background: var(--color-primary);
            color: white;
            padding: 3rem 2rem 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2rem;
        }

        .footer-about h4 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, white 0%, var(--color-accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-about p {
            color: var(--color-accent);
            line-height: 1.6;
        }

        .footer-links h5 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: var(--color-accent);
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            padding-left: 8px;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .social-link:hover {
            background: linear-gradient(135deg, var(--color-highlight) 0%, var(--color-accent) 100%);
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(210, 109, 107, 0.3);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--color-accent);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero .subtitle {
                font-size: 1.2rem;
            }

            .about-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .contact-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .nav-links {
                display: none;
            }

            .coach-card {
                min-width: 280px;
            }

            .logo-circle {
                width: 200px;
                height: 200px;
            }

            .logo-text h4 {
                font-size: 1.5rem;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav id="navbar">
        <div class="nav-container">
            <div style="font-weight: 700; font-size: 1.2rem; color: var(--color-primary);">Faithful Dancer</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#coaches">Coaches</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            @if (Route::has('login'))
            <div class="auth-buttons">
                @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Faithful Dancer<br>Sekolah Minggu</h1>
            <p class="subtitle">Mengembangkan bakat tari dengan iman dan kreativitas</p>
            <a href="#about" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2.5rem;">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title fade-in">Tentang Kami</h2>
            <div class="about-content fade-in">
                <div class="about-text">
                    <p>Faithful Dancer Sekolah Minggu adalah komunitas tari yang berfokus pada pengembangan bakat anak-anak muda dalam seni tari sambil memperkuat nilai-nilai iman mereka.</p>
                    <p>Kami percaya bahwa melalui tarian, anak-anak dapat mengekspresikan kreativitas mereka, membangun kepercayaan diri, dan memperdalam hubungan mereka dengan Tuhan.</p>
                    <p>Dengan bimbingan pelatih profesional yang berpengalaman, kami menciptakan lingkungan yang mendukung, menyenangkan, dan inspiratif bagi setiap peserta.</p>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1504609813442-a8924e83f76e?w=600&h=400&fit=crop" alt="Dancing kids">
                </div>
            </div>
        </div>
    </section>

    <!-- Coaches Section -->
    <section id="coaches" class="coaches">
        <div class="container">
            <h2 class="section-title fade-in">Tim Pelatih Kami</h2>
            <div class="coaches-carousel">
                <div class="coaches-track" id="coachesTrack">
                    <div class="coach-card">
                        <div class="coach-card-image">
                            <img src="img/cantik.jpeg" alt="Coach 1">
                        </div>
                        <div class="coach-card-content">
                            <h3 class="coach-name">Victoryta Belanesia Palit</h3>
                            <p class="coach-position">Head Coach Class D</p>
                        </div>
                    </div>
                    <div class="coach-card">
                        <div class="coach-card-image">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop" alt="Coach 2">
                        </div>
                        <div class="coach-card-content">
                            <h3 class="coach-name">Michael Chen</h3>
                            <p class="coach-position">Contemporary Dance Instructor</p>
                        </div>
                    </div>
                    <div class="coach-card">
                        <div class="coach-card-image">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop" alt="Coach 3">
                        </div>
                        <div class="coach-card-content">
                            <h3 class="coach-name">Emily Rodriguez</h3>
                            <p class="coach-position">Ballet & Classical Instructor</p>
                        </div>
                    </div>
                    <div class="coach-card">
                        <div class="coach-card-image">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop" alt="Coach 4">
                        </div>
                        <div class="coach-card-content">
                            <h3 class="coach-name">David Kim</h3>
                            <p class="coach-position">Hip Hop & Street Dance Coach</p>
                        </div>
                    </div>
                    <div class="coach-card">
                        <div class="coach-card-image">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=400&fit=crop" alt="Coach 5">
                        </div>
                        <div class="coach-card-content">
                            <h3 class="coach-name">Jessica Taylor</h3>
                            <p class="coach-position">Jazz & Modern Dance Specialist</p>
                        </div>
                    </div>
                    <div class="coach-card">
                        <div class="coach-card-image">
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=400&fit=crop" alt="Coach 6">
                        </div>
                        <div class="coach-card-content">
                            <h3 class="coach-name">Alex Martinez</h3>
                            <p class="coach-position">Youth Development Coach</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-nav">
                    <button class="carousel-btn" id="prevBtn">‹</button>
                    <button class="carousel-btn" id="nextBtn">›</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title fade-in">Hubungi Kami</h2>
            <div class="contact-container fade-in">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div class="contact-text">
                            <p>Email</p>
                            <a href="mailto:info@faithfuldancer.com">info@faithfuldancer.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div class="contact-text">
                            <p>Phone</p>
                            <a href="tel:+6281234567890">+62 812-3456-7890</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-text">
                            <p>Address</p>
                            <a href="#">Jl. Contoh No. 123, Jakarta</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">⏰</div>
                        <div class="contact-text">
                            <p>Class Schedule</p>
                            <a href="#">Minggu, 09:00 - 11:00 WIB</a>
                        </div>
                    </div>
                </div>
                <div class="contact-logo">
                    <div class="logo-circle">
                        <div class="logo-text">
                            <h4>Faithful<br>Dancer</h4>
                            <p>Sekolah Minggu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-about">
                <h4>Faithful Dancer Sekolah Minggu</h4>
                <p>Mengembangkan talenta tari anak-anak muda dengan fondasi iman yang kuat. Bergabunglah dengan kami untuk perjalanan yang penuh kreativitas dan inspirasi.</p>
                <div class="social-links">
                    <a href="#" class="social-link" title="Instagram">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" title="Facebook">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" title="YouTube">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" title="WhatsApp">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="footer-links">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#coaches">Coaches</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h5>Programs</h5>
                <ul>
                    <li><a href="#">Ballet Class</a></li>
                    <li><a href="#">Contemporary</a></li>
                    <li><a href="#">Hip Hop</a></li>
                    <li><a href="#">Jazz Dance</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Faithful Dancer Sekolah Minggu. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.section-title, .about-content, .contact-container').forEach(el => {
            observer.observe(el);
        });

        // Carousel functionality
        const track = document.getElementById('coachesTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentPosition = 0;
        const cardWidth = 320 + 32; // card width + gap

        function getVisibleCards() {
            const width = window.innerWidth;
            if (width < 768) return 1;
            if (width < 1024) return 2;
            return 3;
        }

        function updateCarousel() {
            const totalCards = track.children.length;
            const visibleCards = getVisibleCards();
            const maxPosition = Math.max(0, totalCards - visibleCards);

            currentPosition = Math.max(0, Math.min(currentPosition, maxPosition));
            track.style.transform = `translateX(-${currentPosition * cardWidth}px)`;

            prevBtn.disabled = currentPosition === 0;
            nextBtn.disabled = currentPosition >= maxPosition;
        }

        prevBtn.addEventListener('click', () => {
            if (currentPosition > 0) {
                currentPosition--;
                updateCarousel();
            }
        });

        nextBtn.addEventListener('click', () => {
            const totalCards = track.children.length;
            const visibleCards = getVisibleCards();
            const maxPosition = Math.max(0, totalCards - visibleCards);

            if (currentPosition < maxPosition) {
                currentPosition++;
                updateCarousel();
            }
        });

        window.addEventListener('resize', updateCarousel);
        updateCarousel();

        // Auto-scroll carousel
        let autoScrollInterval = setInterval(() => {
            const totalCards = track.children.length;
            const visibleCards = getVisibleCards();
            const maxPosition = Math.max(0, totalCards - visibleCards);

            if (currentPosition >= maxPosition) {
                currentPosition = 0;
            } else {
                currentPosition++;
            }
            updateCarousel();
        }, 4000);

        // Pause auto-scroll on hover
        track.addEventListener('mouseenter', () => {
            clearInterval(autoScrollInterval);
        });

        track.addEventListener('mouseleave', () => {
            autoScrollInterval = setInterval(() => {
                const totalCards = track.children.length;
                const visibleCards = getVisibleCards();
                const maxPosition = Math.max(0, totalCards - visibleCards);

                if (currentPosition >= maxPosition) {
                    currentPosition = 0;
                } else {
                    currentPosition++;
                }
                updateCarousel();
            }, 4000);
        });
    </script>
</body>

</html>