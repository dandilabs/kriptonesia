@extends('frontend.index')

@section('title', 'Upgrade Membership')

@section('content')
    <!-- Page Title -->
    <div class="page-title">
        <div class="breadcrumbs">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house"></i> Beranda</a></li>
                    <li class="breadcrumb-item active current">{{ Auth::user()->name }}</li>
                    <li class="breadcrumb-item active current">Membership</li>
                </ol>
            </nav>
        </div>

        <div class="title-wrapper">
            <h1>Tingkatkan Pengalaman Kripto Anda</h1>
            <p>Buka fitur premium dan maksimalkan potensi perdagangan Anda</p>
        </div>
    </div><!-- End Page Title -->

    <div class="membership-upgrade-page">
        <!-- Main Content -->
        <div class="container">
            <!-- Alert Messages -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if (session('message'))
                    <div class="alert-message success">
                        <div class="alert-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="alert-content">
                            {{ session('message') }}
                        </div>
                        <button class="alert-close">&times;</button>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert-message error">
                        <div class="alert-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="alert-content">
                            {{ session('error') }}
                        </div>
                        <button class="alert-close">&times;</button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Membership Card -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="membership-card">
                        <div class="card-header">
                            <div class="user-info">
                                <div class="user-avatar">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="user-details">
                                    <h3>Hello, {{ Auth::user()->name }}</h3>
                                    <p>Pilih paket Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('member.upgrade.process') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="product_id" class="form-label">Pilih Paket Membership</label>
                                    <div class="select-wrapper">
                                        <select id="product_id" class="form-select" name="product_id" required>
                                            @foreach ($products as $type => $group)
                                                <optgroup label="{{ ucfirst($type) }}">
                                                    @foreach ($group as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->name }} (${{ number_format($product->price_usd, 2) }} USDT)
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        <i class="bi bi-chevron-down select-arrow"></i>
                                    </div>
                                </div>
                                <div class="submit-btn-container">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                        <span>Tingkatkan Sekarang</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Global Styles */
    .membership-upgrade-page {
        font-family: 'Poppins', sans-serif;
        color: #2c3e50;
    }

    /* Hero Section */
    .membership-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
        color: white;
        margin-bottom: 60px;
        position: relative;
        overflow: hidden;
    }

    .membership-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://images.unsplash.com/photo-1639762681057-408e52192e55?q=80&w=2232&auto=format&fit=crop') center/cover;
        opacity: 0.15;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 25px;
    }

    .breadcrumb-container {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(5px);
        padding: 8px 20px;
        border-radius: 50px;
    }

    .breadcrumb {
        margin-bottom: 0;
        background: transparent;
        padding: 0;
    }

    .breadcrumb-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: white;
        font-weight: 500;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        color: rgba(255,255,255,0.6);
    }

    /* Alert Messages */
    .alert-message {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .alert-message.success {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .alert-message.error {
        background: #ffebee;
        color: #c62828;
    }

    .alert-icon {
        margin-right: 15px;
        font-size: 1.5rem;
    }

    .alert-content {
        flex: 1;
    }

    .alert-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s;
    }

    .alert-close:hover {
        opacity: 1;
    }

    /* Membership Card */
    .membership-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 50px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .membership-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }

    .card-header {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        padding: 25px 30px;
        color: white;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.5rem;
    }

    .user-details h3 {
        margin-bottom: 5px;
        font-weight: 600;
    }

    .user-details p {
        opacity: 0.9;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .card-body {
        padding: 30px;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 30px;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: #2c3e50;
    }

    .select-wrapper {
        position: relative;
    }

    .form-select {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        appearance: none;
        font-size: 1rem;
        background-color: white;
        transition: all 0.3s;
        cursor: pointer;
    }

    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        outline: none;
    }

    .select-arrow {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #667eea;
    }

    optgroup {
        font-weight: 600;
        color: #2c3e50;
        padding: 10px 0;
    }

    option {
        padding: 10px 15px;
        border-bottom: 1px solid #f5f5f5;
    }

    option:hover {
        background: #f5f5f5;
    }

    /* Submit Button */
    .submit-btn-container {
        text-align: center;
        margin-top: 20px;
    }

    .submit-btn {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .submit-btn:hover {
        background: linear-gradient(45deg, #5a6fd1, #6a42a1);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .submit-btn i {
        margin-left: 10px;
        transition: transform 0.3s;
    }

    .submit-btn:hover i {
        transform: translateX(5px);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .membership-card {
            margin-bottom: 30px;
        }

        .card-header, .card-body {
            padding: 20px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .form-select {
            padding: 12px 15px;
        }

        .submit-btn {
            padding: 12px 30px;
        }
    }
    </style>

    <script>
    // Simple animation for alerts
    document.querySelectorAll('.alert-close').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.style.opacity = '0';
            setTimeout(() => {
                this.parentElement.style.display = 'none';
            }, 300);
        });
    });
    </script>
@endsection
