<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Office FST – Sign In</title>
    <meta name="description" content="Portal Login Fakultas Sains & Teknologi – Universitas Ibnu Sina Batam">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logouis.png') }}">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            /* FST Brand Colors */
            --maroon: #5C1A1C;
            --maroon-light: #7A2225;
            --maroon-dark: #3A0E10;
            --maroon-deep: #220A0B;
            --gold: #D4A017;
            --gold-light: #F0C84A;
            --gold-dark: #A87C10;
            --gold-pale: rgba(212, 160, 23, 0.15);
            --white: #ffffff;
            --off-white: rgba(255, 255, 255, 0.85);
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--maroon-deep);
            overflow: hidden;
            position: relative;
        }

        /* =============================================
           BUILDING BACKGROUND + OVERLAY
        ============================================= */
        .bg-building {
            position: fixed;
            inset: 0;
            z-index: 0;
            background-image: url("{{ asset('assets/img/gedunguis.JPG') }}");
            background-size: cover;
            background-position: center;
            animation: kenBurns 30s ease-in-out infinite alternate;
            transform-origin: center;
        }

        .bg-building::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(10, 4, 4, 0.78);
        }

        @keyframes kenBurns {
            0% {
                transform: scale(1.00) translate(0, 0);
            }

            33% {
                transform: scale(1.06) translate(-10px, -8px);
            }

            66% {
                transform: scale(1.04) translate(8px, -12px);
            }

            100% {
                transform: scale(1.08) translate(-5px, 5px);
            }
        }

        /* =============================================
           ANIMATED ORBS (Maroon/Gold tones)
        ============================================= */
        .bg-orbs {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            animation: floatOrb 10s ease-in-out infinite;
        }

        .orb-1 {
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(212, 160, 23, 0.25), transparent 70%);
            top: -180px;
            left: -120px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(92, 26, 28, 0.55), transparent 70%);
            bottom: -100px;
            right: -80px;
            animation-delay: 3s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 160, 23, 0.18), transparent 70%);
            top: 55%;
            left: 65%;
            animation-delay: 6s;
        }

        @keyframes floatOrb {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-25px) scale(1.04);
            }
        }

        /* =============================================
           CIRCUIT / TECH PARTICLES (SVG canvas)
        ============================================= */
        #techCanvas {
            position: fixed;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            opacity: 0.35;
        }

        /* =============================================
           LAYOUT
        ============================================= */
        .page-layout {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1100px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 60px;
        }

        /* Left Panel – Branding */
        .brand-panel {
            flex: 1;
            max-width: 400px;
            animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
            display: none;
            /* shown on wider screens */
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold-pale);
            border: 1px solid rgba(212, 160, 23, 0.35);
            border-radius: 100px;
            padding: 6px 14px 6px 8px;
            margin-bottom: 28px;
        }

        .brand-badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 8px var(--gold);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(0.85);
            }
        }

        .brand-badge span {
            font-size: 12px;
            font-weight: 600;
            color: var(--gold-light);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .brand-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 42px;
            font-weight: 700;
            color: var(--white);
            line-height: 1.1;
            letter-spacing: -1px;
            margin-bottom: 16px;
        }

        .brand-title span {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-desc {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.7;
            margin-bottom: 36px;
        }

        .brand-stats {
            display: flex;
            gap: 28px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--gold-light);
            letter-spacing: -0.5px;
        }

        .stat-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 2px;
        }

        /* =============================================
           LOGIN CARD
        ============================================= */
        .login-wrapper {
            width: 100%;
            max-width: 440px;
            animation: slideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
            animation-delay: 0.1s;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            background: rgba(58, 14, 16, 0.97);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 160, 23, 0.40);
            border-radius: 24px;
            padding: 44px 40px;
            box-shadow:
                0 32px 80px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(212, 160, 23, 0.20);
            position: relative;
            overflow: hidden;
        }

        /* Gold corner accent */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at top right, rgba(212, 160, 23, 0.18), transparent 70%);
            pointer-events: none;
        }

        .login-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), var(--gold-light), var(--gold), transparent);
            border-radius: 24px 24px 0 0;
        }

        /* === LOGO BAR === */
        .login-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .login-logo img {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            object-fit: contain;
            background: rgba(212, 160, 23, 0.1);
            padding: 6px;
            border: 1px solid rgba(212, 160, 23, 0.3);
            box-shadow: 0 0 16px rgba(212, 160, 23, 0.2);
        }

        .login-logo-text {
            display: flex;
            flex-direction: column;
        }

        .login-logo-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.2px;
            line-height: 1;
        }

        .login-logo-sub {
            font-size: 11.5px;
            color: var(--gold);
            margin-top: 3px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }

        /* Divider mini */
        .logo-divider {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, rgba(212, 160, 23, 0.35), transparent);
            margin-bottom: 24px;
        }

        /* === HEADER === */
        .login-header {
            margin-bottom: 28px;
        }

        .login-header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.4px;
            line-height: 1.2;
        }

        .login-header p {
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.45);
            margin-top: 6px;
        }

        /* === ALERTS === */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.14);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(212, 160, 23, 0.14);
            border: 1px solid rgba(212, 160, 23, 0.3);
            color: var(--gold-light);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === FORM === */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.65);
            margin-bottom: 7px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(212, 160, 23, 0.5);
            display: flex;
            align-items: center;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(212, 160, 23, 0.2);
            border-radius: 12px;
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            outline: none;
            transition: all 0.25s ease;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .form-input:focus {
            border-color: rgba(212, 160, 23, 0.6);
            background: rgba(212, 160, 23, 0.06);
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.12);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--gold);
        }

        /* Toggle password */
        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(212, 160, 23, 0.45);
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 4px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--gold);
        }

        .field-error {
            font-size: 12px;
            color: #fca5a5;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-input.is-invalid {
            border-color: rgba(239, 68, 68, 0.55);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        /* === REMEMBER / FORGOT === */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
            user-select: none;
        }

        .remember-label input[type="checkbox"] {
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 5px;
            border: 1.5px solid rgba(212, 160, 23, 0.35);
            background: rgba(212, 160, 23, 0.07);
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            position: relative;
        }

        .remember-label input[type="checkbox"]:checked {
            background: var(--gold);
            border-color: var(--gold);
        }

        .remember-label input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 1px;
            width: 5px;
            height: 9px;
            border: 2px solid var(--maroon-dark);
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .forgot-link {
            font-size: 13px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--gold-light);
        }

        /* === SUBMIT BUTTON === */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 50%, var(--gold-light) 100%);
            background-size: 200% 200%;
            background-position: 0% 50%;
            border: none;
            border-radius: 12px;
            color: var(--maroon-dark);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
            transition: all 0.35s ease;
            box-shadow: 0 6px 24px rgba(212, 160, 23, 0.4);
        }

        .btn-login:hover {
            background-position: 100% 50%;
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(212, 160, 23, 0.55);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login span {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login .spinner {
            width: 18px;
            height: 18px;
            border: 2.5px solid rgba(58, 14, 16, 0.35);
            border-top-color: var(--maroon-dark);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        .btn-login.loading .spinner {
            display: block;
        }

        .btn-login.loading .btn-text {
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* === FOOTER === */
        .login-card-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.3);
        }

        .login-card-footer strong {
            color: var(--gold);
            font-weight: 600;
        }

        /* =============================================
           RESPONSIVE
        ============================================= */
        @media (min-width: 900px) {
            .brand-panel {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }

            .login-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Building Background -->
    <div class="bg-building"></div>

    <!-- Warm Maroon/Gold Orbs -->
    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Tech Circuit Canvas -->
    <canvas id="techCanvas"></canvas>

    <!-- Page Layout -->
    <div class="page-layout">

        <!-- LEFT: Branding Panel (shown on larger screens) -->
        <div class="brand-panel">
            <div class="brand-badge">
                <div class="brand-badge-dot"></div>
                <span>Portal Akademik Aktif</span>
            </div>

            <h2 class="brand-title">
                Fakultas<br>
                <span>Sains &amp;<br>Teknologi</span>
            </h2>

            <p class="brand-desc">
                Sistem layanan penerbitan surat untuk mahasiswa FST. Proses pengajuan <strong
                    style="color:var(--gold-light)">Surat Kerja Praktek</strong> dan <strong
                    style="color:var(--gold-light)">Surat Penelitian</strong> secara digital.
            </p>

            <div class="brand-stats">
                <div class="stat-item">
                    <span class="stat-number">FST</span>
                    <span class="stat-label">Fakultas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">UIS</span>
                    <span class="stat-label">Universitas Ibnu Sina</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">2026</span>
                    <span class="stat-label">Tahun Aktif</span>
                </div>
            </div>
        </div>

        <!-- RIGHT: Login Card -->
        <div class="login-wrapper">
            <div class="login-card">

                <!-- Logo -->
                <div class="login-logo">
                    <img src="{{ asset('assets/img/logouis.png') }}" alt="Logo UIS FST">
                    <div class="login-logo-text">
                        <span class="login-logo-title">Office FST</span>
                        <span class="login-logo-sub">Universitas Ibnu Sina Batam</span>
                    </div>
                </div>

                <div class="logo-divider"></div>

                <!-- Header -->
                <div class="login-header">
                    <h1>Masuk ke Sistem ⚙️</h1>
                    <p>Gunakan kredensial akun Anda untuk melanjutkan</p>
                </div>

                <!-- Flash Messages -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login.submit') }}" id="loginForm" novalidate>
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" id="email" name="email"
                                class="form-input @error('email') is-invalid @enderror" placeholder="npm@uis.ac.id"
                                value="{{ old('email') }}" autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <div class="field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" id="password" name="password"
                                class="form-input @error('password') is-invalid @enderror"
                                placeholder="Masukkan password" autocomplete="current-password">
                            <button type="button" class="toggle-password" onclick="togglePassword()"
                                aria-label="Tampilkan password">
                                <svg id="eyeIcon" width="17" height="17" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="field-error">
                                <svg width="12" height="12" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="form-footer">
                        <label class="remember-label">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            Ingat saya
                        </label>
                        <a href="#" class="forgot-link">Lupa password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-login" id="submitBtn">
                        <span>
                            <div class="spinner"></div>
                            <span class="btn-text">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" style="margin-right:4px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Masuk ke Sistem
                            </span>
                        </span>
                    </button>

                    <!-- Link to Register -->
                    <div style="text-align:center; margin-top:16px; font-size:13px; color:rgba(255,255,255,0.45);">
                        Belum punya akun?
                        <a href="{{ route('register') }}"
                            style="color:var(--gold); font-weight:600; text-decoration:none; transition:color 0.2s;"
                            onmouseover="this.style.color='var(--gold-light)'"
                            onmouseout="this.style.color='var(--gold)'">
                            Daftar di sini
                        </a>
                    </div>

                </form>

            </div>

            <!-- Footer -->
            <div class="login-card-footer">
                &copy; {{ date('Y') }} <strong>FST</strong> &mdash; Universitas Ibnu Sina Batam.<br>
                <span style="font-size:11px; opacity:0.6;">Sistem Informasi Fakultas Sains &amp; Teknologi</span>
            </div>
        </div>

    </div>

    <script>
        // =============================================
        //  TECH CIRCUIT PARTICLE ANIMATION
        // =============================================
        (function() {
            const canvas = document.getElementById('techCanvas');
            const ctx = canvas.getContext('2d');
            let W, H, mouse = {
                x: -9999,
                y: -9999
            };

            function resize() {
                W = canvas.width = window.innerWidth;
                H = canvas.height = window.innerHeight;
            }
            resize();
            window.addEventListener('resize', resize);
            window.addEventListener('mousemove', e => {
                mouse.x = e.clientX;
                mouse.y = e.clientY;
            });

            // ── Node types: regular + "hub" (bigger, brighter)
            const TOTAL = 120;
            const nodes = [];
            for (let i = 0; i < TOTAL; i++) {
                const isHub = i < 10; // first 10 are hubs
                nodes.push({
                    x: Math.random() * window.innerWidth,
                    y: Math.random() * window.innerHeight,
                    vx: (Math.random() - 0.5) * (isHub ? 0.55 : 0.42),
                    vy: (Math.random() - 0.5) * (isHub ? 0.55 : 0.42),
                    r: isHub ? (Math.random() * 2.5 + 2.5) : (Math.random() * 1.5 + 0.8),
                    isHub,
                    pulse: Math.random() * Math.PI * 2,
                });
            }

            // ── Data pulses that travel along hot edges
            const pulses = [];

            function spawnPulse(n1, n2) {
                if (pulses.length > 40) return;
                pulses.push({
                    n1,
                    n2,
                    t: 0,
                    speed: 0.012 + Math.random() * 0.012
                });
            }
            setInterval(() => {
                const i = Math.floor(Math.random() * nodes.length);
                const j = Math.floor(Math.random() * nodes.length);
                if (i !== j) spawnPulse(i, j);
            }, 200);

            const GOLD = 'rgba(212,160,23,';
            const GOLDB = 'rgba(240,200,74,';
            const CON_DIST = 200;
            const REPEL = 100;

            function draw() {
                ctx.clearRect(0, 0, W, H);

                // Mouse-repel + update nodes
                nodes.forEach(n => {
                    const dx = n.x - mouse.x;
                    const dy = n.y - mouse.y;
                    const d = Math.sqrt(dx * dx + dy * dy);
                    if (d < REPEL) {
                        const force = (REPEL - d) / REPEL * 0.8;
                        n.vx += (dx / d) * force;
                        n.vy += (dy / d) * force;
                    }
                    // Damping
                    n.vx *= 0.98;
                    n.vy *= 0.98;
                    // Clamp speed
                    const spd = Math.sqrt(n.vx * n.vx + n.vy * n.vy);
                    const maxSpd = n.isHub ? 1.4 : 1.2;
                    if (spd > maxSpd) {
                        n.vx = n.vx / spd * maxSpd;
                        n.vy = n.vy / spd * maxSpd;
                    }

                    n.x += n.vx;
                    n.y += n.vy;
                    if (n.x < 0) n.x = W;
                    if (n.x > W) n.x = 0;
                    if (n.y < 0) n.y = H;
                    if (n.y > H) n.y = 0;
                    n.pulse += 0.12;
                });

                // ── Draw connections
                for (let i = 0; i < nodes.length; i++) {
                    for (let j = i + 1; j < nodes.length; j++) {
                        const dx = nodes[i].x - nodes[j].x;
                        const dy = nodes[i].y - nodes[j].y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < CON_DIST) {
                            const alpha = (1 - dist / CON_DIST) * 0.6;
                            ctx.strokeStyle = GOLD + alpha + ')';
                            ctx.lineWidth = (nodes[i].isHub || nodes[j].isHub) ? 1.2 : 0.6;
                            ctx.beginPath();
                            ctx.moveTo(nodes[i].x, nodes[i].y);
                            ctx.lineTo(nodes[j].x, nodes[j].y);
                            ctx.stroke();
                        }
                    }
                }

                // ── Draw data pulses
                for (let i = pulses.length - 1; i >= 0; i--) {
                    const p = pulses[i];
                    const n1 = nodes[p.n1],
                        n2 = nodes[p.n2];
                    const dx = n2.x - n1.x,
                        dy = n2.y - n1.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist > CON_DIST) {
                        pulses.splice(i, 1);
                        continue;
                    }
                    p.t += p.speed;
                    if (p.t >= 1) {
                        pulses.splice(i, 1);
                        continue;
                    }
                    const px = n1.x + dx * p.t;
                    const py = n1.y + dy * p.t;
                    ctx.beginPath();
                    ctx.arc(px, py, 2.5, 0, Math.PI * 2);
                    ctx.fillStyle = GOLDB + '0.9)';
                    ctx.shadowBlur = 10;
                    ctx.shadowColor = GOLD + '1)';
                    ctx.fill();
                    ctx.shadowBlur = 0;
                }

                // ── Draw nodes
                nodes.forEach(n => {
                    const glow = n.isHub ? (0.65 + Math.sin(n.pulse) * 0.2) : 0.75;
                    ctx.beginPath();
                    ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
                    ctx.fillStyle = GOLD + glow + ')';
                    ctx.shadowBlur = n.isHub ? 14 : 6;
                    ctx.shadowColor = GOLD + '0.9)';
                    ctx.fill();
                    // Hub ring
                    if (n.isHub) {
                        ctx.beginPath();
                        ctx.arc(n.x, n.y, n.r + 4 + Math.sin(n.pulse) * 3, 0, Math.PI * 2);
                        ctx.strokeStyle = GOLD + '0.35)';
                        ctx.lineWidth = 1.2;
                        ctx.stroke();
                        // Second outer ring for hubs
                        ctx.beginPath();
                        ctx.arc(n.x, n.y, n.r + 9 + Math.sin(n.pulse + 1) * 2, 0, Math.PI * 2);
                        ctx.strokeStyle = GOLD + '0.12)';
                        ctx.lineWidth = 0.8;
                        ctx.stroke();
                    }
                    ctx.shadowBlur = 0;
                });


                requestAnimationFrame(draw);
            }
            draw();
        })();

        // =============================================
        //  TOGGLE PASSWORD
        // =============================================
        let passwordVisible = false;

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            passwordVisible = !passwordVisible;
            input.type = passwordVisible ? 'text' : 'password';
            icon.innerHTML = passwordVisible ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }

        // =============================================
        //  LOADING ON SUBMIT
        // =============================================
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>

</body>

</html>
