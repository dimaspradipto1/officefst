<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Office FST – Daftar Akun</title>
    <meta name="description" content="Daftar Akun Mahasiswa – Sistem Layanan Surat FST Universitas Ibnu Sina Batam">

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
            --maroon: #5C1A1C;
            --maroon-light: #7A2225;
            --maroon-dark: #3A0E10;
            --maroon-deep: #220A0B;
            --gold: #D4A017;
            --gold-light: #F0C84A;
            --gold-dark: #A87C10;
            --gold-pale: rgba(212, 160, 23, 0.15);
            --white: #ffffff;
        }

        html,
        body {
            width: 100%;
            min-height: 100vh;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--maroon-deep);
            overflow-x: hidden;
            position: relative;
            padding: 20px 0;
        }

        /* === BUILDING BACKGROUND === */
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

        /* === ORBS === */
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
            background: radial-gradient(circle, rgba(212, 160, 23, 0.18), transparent 70%);
            top: -180px;
            left: -120px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(92, 26, 28, 0.45), transparent 70%);
            bottom: -100px;
            right: -80px;
            animation-delay: 3s;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 160, 23, 0.12), transparent 70%);
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

        /* === CANVAS === */
        #techCanvas {
            position: fixed;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            opacity: 0.35;
        }

        /* === LAYOUT === */
        .page-layout {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 520px;
            padding: 20px;
        }

        /* === CARD === */
        .login-wrapper {
            width: 100%;
            animation: slideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
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
            padding: 40px 40px;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(212, 160, 23, 0.20);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at top right, rgba(212, 160, 23, 0.12), transparent 70%);
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

        /* === LOGO === */
        .login-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
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
        }

        .logo-divider {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, rgba(212, 160, 23, 0.35), transparent);
            margin-bottom: 22px;
        }

        /* === HEADER === */
        .login-header {
            margin-bottom: 24px;
        }

        .login-header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.4px;
            line-height: 1.2;
        }

        .login-header p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.45);
            margin-top: 5px;
        }

        /* === ALERT === */
        .alert {
            padding: 11px 15px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 9px;
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

        /* === FORM GRID === */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.65);
            margin-bottom: 6px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .required-star {
            color: var(--gold-light);
            margin-left: 2px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(212, 160, 23, 0.5);
            display: flex;
            align-items: center;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 14px 12px 40px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(212, 160, 23, 0.2);
            border-radius: 11px;
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-size: 13.5px;
            outline: none;
            transition: all 0.25s ease;
        }

        .form-select {
            padding-left: 40px;
            appearance: none;
            cursor: pointer;
        }

        .form-select option {
            background: #3A0E10;
            color: #fff;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .form-select.placeholder-active {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-input:focus,
        .form-select:focus {
            border-color: rgba(212, 160, 23, 0.6);
            background: rgba(212, 160, 23, 0.06);
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.12);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--gold);
        }

        /* Select arrow */
        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(212, 160, 23, 0.5);
            pointer-events: none;
        }

        /* Toggle password */
        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(212, 160, 23, 0.45);
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 3px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--gold);
        }

        .field-error {
            font-size: 11.5px;
            color: #fca5a5;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-input.is-invalid,
        .form-select.is-invalid {
            border-color: rgba(239, 68, 68, 0.55);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        /* === PASSWORD STRENGTH === */
        .pwd-strength {
            margin-top: 6px;
        }

        .pwd-bar {
            height: 3px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
            margin-bottom: 4px;
        }

        .pwd-fill {
            height: 100%;
            width: 0%;
            border-radius: 10px;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .pwd-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.35);
        }

        /* === SUBMIT === */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--gold-dark) 0%, var(--gold) 50%, var(--gold-light) 100%);
            background-size: 200%;
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
            margin-top: 8px;
        }

        .btn-login:hover {
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
            margin-top: 18px;
            text-align: center;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.3);
        }

        .login-card-footer a {
            color: var(--gold);
            font-weight: 600;
            text-decoration: none;
        }

        .login-card-footer a:hover {
            text-decoration: underline;
        }

        .copyright {
            margin-top: 14px;
            text-align: center;
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.25);
        }

        .copyright strong {
            color: var(--gold);
            font-weight: 600;
        }

        /* === RESPONSIVE === */
        @media (max-width: 520px) {
            .login-card {
                padding: 28px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: 1;
            }
        }
    </style>
</head>

<body>

    <div class="bg-building"></div>
    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <canvas id="techCanvas"></canvas>

    <div class="page-layout">
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
                    <h1>Daftar Akun Mahasiswa 🎓</h1>
                    <p>Lengkapi data berikut untuk mendaftar ke sistem layanan surat FST</p>
                </div>

                <!-- Flash Messages -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="#" id="registerForm" novalidate>
                    @csrf

                    <div class="form-grid">

                        <!-- Email UIS -->
                        <div class="form-group full">
                            <label class="form-label" for="email">
                                Email UIS <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input type="email" id="email" name="email"
                                    class="form-input @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email UIS" value="{{ old('email') }}" autocomplete="email"
                                    autofocus>
                            </div>
                            @error('email')
                                <div class="field-error">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama Mahasiswa -->
                        <div class="form-group full">
                            <label class="form-label" for="nama">
                                Nama Mahasiswa <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </span>
                                <input type="text" id="nama" name="nama"
                                    class="form-input @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan Nama Mahasiswa" value="{{ old('nama') }}">
                            </div>
                            @error('nama')
                                <div class="field-error">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- NPM -->
                        <div class="form-group">
                            <label class="form-label" for="npm">
                                NPM Mahasiswa <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2" />
                                    </svg>
                                </span>
                                <input type="text" id="npm" name="npm"
                                    class="form-input @error('npm') is-invalid @enderror"
                                    placeholder="Masukkan NPM Mahasiswa" value="{{ old('npm') }}">
                            </div>
                            @error('npm')
                                <div class="field-error">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="form-group">
                            <label class="form-label" for="nohp">
                                No HP Mahasiswa <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </span>
                                <input type="text" id="nohp" name="nohp"
                                    class="form-input @error('nohp') is-invalid @enderror"
                                    placeholder="Masukkan No HP" value="{{ old('nohp') }}">
                            </div>
                            @error('nohp')
                                <div class="field-error">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Prodi -->
                        <div class="form-group full">
                            <label class="form-label" for="prodi">
                                Program Studi <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </span>
                                <select id="prodi" name="prodi"
                                    class="form-select @error('prodi') is-invalid @enderror" id="prodiSelect">
                                    <option value="" disabled {{ old('prodi') ? '' : 'selected' }}>-- Pilih
                                        Prodi --</option>
                                    <option value="Teknik Industri"
                                        {{ old('prodi') == 'Teknik Industri' ? 'selected' : '' }}>Teknik
                                        Industri</option>
                                    <option value="Teknik Informatika"
                                        {{ old('prodi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik
                                        Informatika</option>
                                    <option value="Sistem Informasi"
                                        {{ old('prodi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem
                                        Informasi</option>
                                    <option value="Teknik Perkapalan"
                                        {{ old('prodi') == 'Teknik Perkapalan' ? 'selected' : '' }}>Teknik
                                        Perkapalan</option>
                                    <option value="Teknik Logistik"
                                        {{ old('prodi') == 'Teknik Logistik' ? 'selected' : '' }}>Teknik
                                        Logistik</option>
                                </select>
                                <span class="select-arrow">
                                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                            @error('prodi')
                                <div class="field-error">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group full">
                            <label class="form-label" for="password">
                                Password <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input type="password" id="password" name="password"
                                    class="form-input @error('password') is-invalid @enderror"
                                    placeholder="Buat password (min. 8 karakter)" autocomplete="new-password"
                                    oninput="checkStrength(this.value)">
                                <button type="button" class="toggle-password"
                                    onclick="togglePassword('password','eyeIcon1')" aria-label="Tampilkan password">
                                    <svg id="eyeIcon1" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Password strength bar -->
                            <div class="pwd-strength">
                                <div class="pwd-bar">
                                    <div class="pwd-fill" id="pwdFill"></div>
                                </div>
                                <span class="pwd-label" id="pwdLabel">Masukkan password</span>
                            </div>
                            @error('password')
                                <div class="field-error">
                                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group full">
                            <label class="form-label" for="password_confirmation">
                                Konfirmasi Password <span class="required-star">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-input" placeholder="Ulangi password Anda"
                                    autocomplete="new-password">
                                <button type="button" class="toggle-password"
                                    onclick="togglePassword('password_confirmation','eyeIcon2')"
                                    aria-label="Tampilkan konfirmasi">
                                    <svg id="eyeIcon2" width="16" height="16" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>{{-- end form-grid --}}

                    <!-- Submit -->
                    <button type="submit" class="btn-login" id="submitBtn">
                        <span>
                            <div class="spinner"></div>
                            <span class="btn-text">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" style="margin-right:4px">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Daftar Sekarang
                            </span>
                        </span>
                    </button>

                    <!-- Link to Login -->
                    <div style="text-align:center; margin-top:16px; font-size:13px; color:rgba(255,255,255,0.45);">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            style="color:var(--gold); font-weight:600; text-decoration:none; transition:color 0.2s;"
                            onmouseover="this.style.color='var(--gold-light)'"
                            onmouseout="this.style.color='var(--gold)'">
                            Masuk di sini
                        </a>
                    </div>

                </form>

            </div>

            <!-- Footer link -->

            <div class="copyright">
                &copy; {{ date('Y') }} <strong>FST</strong> &mdash; Universitas Ibnu Sina Batam
            </div>
        </div>
    </div>

    <script>
        // ── PARTICLE NETWORK
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

            const TOTAL = 120,
                nodes = [];
            for (let i = 0; i < TOTAL; i++) {
                const isHub = i < 10;
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

            const pulses = [];
            setInterval(() => {
                const i = Math.floor(Math.random() * nodes.length);
                const j = Math.floor(Math.random() * nodes.length);
                if (i !== j && pulses.length < 40) pulses.push({
                    n1: i,
                    n2: j,
                    t: 0,
                    speed: 0.012 + Math.random() * 0.012
                });
            }, 200);

            const GOLD = 'rgba(212,160,23,',
                GOLDB = 'rgba(240,200,74,',
                CON = 200,
                REP = 100;

            function draw() {
                ctx.clearRect(0, 0, W, H);
                nodes.forEach(n => {
                    const dx = n.x - mouse.x,
                        dy = n.y - mouse.y,
                        d = Math.sqrt(dx * dx + dy * dy);
                    if (d < REP) {
                        const f = (REP - d) / REP * 0.8;
                        n.vx += (dx / d) * f;
                        n.vy += (dy / d) * f;
                    }
                    n.vx *= 0.98;
                    n.vy *= 0.98;
                    const spd = Math.sqrt(n.vx * n.vx + n.vy * n.vy),
                        max = n.isHub ? 1.4 : 1.2;
                    if (spd > max) {
                        n.vx = n.vx / spd * max;
                        n.vy = n.vy / spd * max;
                    }
                    n.x += n.vx;
                    n.y += n.vy;
                    if (n.x < 0) n.x = W;
                    if (n.x > W) n.x = 0;
                    if (n.y < 0) n.y = H;
                    if (n.y > H) n.y = 0;
                    n.pulse += 0.12;
                });
                for (let i = 0; i < nodes.length; i++)
                    for (let j = i + 1; j < nodes.length; j++) {
                        const dx = nodes[i].x - nodes[j].x,
                            dy = nodes[i].y - nodes[j].y,
                            dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < CON) {
                            const a = (1 - dist / CON) * 0.6;
                            ctx.strokeStyle = GOLD + a + ')';
                            ctx.lineWidth = (nodes[i].isHub || nodes[j].isHub) ? 1.2 : 0.6;
                            ctx.beginPath();
                            ctx.moveTo(nodes[i].x, nodes[i].y);
                            ctx.lineTo(nodes[j].x, nodes[j].y);
                            ctx.stroke();
                        }
                    }
                for (let i = pulses.length - 1; i >= 0; i--) {
                    const p = pulses[i],
                        n1 = nodes[p.n1],
                        n2 = nodes[p.n2];
                    const dx = n2.x - n1.x,
                        dy = n2.y - n1.y,
                        dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist > CON) {
                        pulses.splice(i, 1);
                        continue;
                    }
                    p.t += p.speed;
                    if (p.t >= 1) {
                        pulses.splice(i, 1);
                        continue;
                    }
                    const px = n1.x + dx * p.t,
                        py = n1.y + dy * p.t;
                    ctx.beginPath();
                    ctx.arc(px, py, 2.5, 0, Math.PI * 2);
                    ctx.fillStyle = GOLDB + '0.9)';
                    ctx.shadowBlur = 10;
                    ctx.shadowColor = GOLD + '1)';
                    ctx.fill();
                    ctx.shadowBlur = 0;
                }
                nodes.forEach(n => {
                    const glow = n.isHub ? (0.65 + Math.sin(n.pulse) * 0.2) : 0.75;
                    ctx.beginPath();
                    ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
                    ctx.fillStyle = GOLD + glow + ')';
                    ctx.shadowBlur = n.isHub ? 14 : 6;
                    ctx.shadowColor = GOLD + '0.9)';
                    ctx.fill();
                    if (n.isHub) {
                        ctx.beginPath();
                        ctx.arc(n.x, n.y, n.r + 4 + Math.sin(n.pulse) * 3, 0, Math.PI * 2);
                        ctx.strokeStyle = GOLD + '0.35)';
                        ctx.lineWidth = 1.2;
                        ctx.stroke();
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

        // ── TOGGLE PASSWORD
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.innerHTML = show ?
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>` :
                `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
        }

        // ── PASSWORD STRENGTH
        function checkStrength(val) {
            const fill = document.getElementById('pwdFill');
            const label = document.getElementById('pwdLabel');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            const levels = [{
                    pct: '0%',
                    color: 'transparent',
                    text: 'Masukkan password'
                },
                {
                    pct: '25%',
                    color: '#ef4444',
                    text: 'Lemah'
                },
                {
                    pct: '50%',
                    color: '#f97316',
                    text: 'Cukup'
                },
                {
                    pct: '75%',
                    color: '#eab308',
                    text: 'Kuat'
                },
                {
                    pct: '100%',
                    color: '#22c55e',
                    text: 'Sangat Kuat ✓'
                },
            ];
            fill.style.width = levels[score].pct;
            fill.style.background = levels[score].color;
            label.textContent = levels[score].text;
            label.style.color = score > 0 ? levels[score].color : 'rgba(255,255,255,0.35)';
        }

        // ── LOADING ON SUBMIT
        document.getElementById('registerForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>

</body>

</html>
