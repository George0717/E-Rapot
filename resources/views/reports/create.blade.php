@extends('layouts.app')
@section('title', 'Input Nilai')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">

<div class="rp-page">
    <div class="container-xl py-5">

        {{-- Page Header --}}
        <div class="rp-hero mb-5">
            <div class="rp-hero-inner">
                <div class="rp-hero-label">Manajemen Raport</div>
                <h1 class="rp-hero-title">Buat Raport Siswa</h1>
                <p class="rp-hero-sub">Lengkapi formulir penilaian gerakan siswa dengan teliti dan cermat</p>
            </div>
            <div class="rp-hero-deco" aria-hidden="true">
                <div class="rp-deco-ring rp-deco-ring--1"></div>
                <div class="rp-deco-ring rp-deco-ring--2"></div>
                <div class="rp-deco-ring rp-deco-ring--3"></div>
            </div>
        </div>

        @if(session('error'))
        <div class="alert rp-alert alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-exclamation-triangle-fill rp-alert-icon"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-4 align-items-start">

            {{-- Left Column: Grading Reference --}}
            <div class="col-lg-4">
                <div class="rp-card rp-ref-card">
                    <div class="rp-card-head">
                        <i class="bi bi-stars"></i>
                        <span>Referensi Penilaian</span>
                    </div>
                    <div class="rp-card-body">
                        <div class="rp-grade-list">
                            <div class="rp-grade-item" data-grade="A">
                                <div class="rp-grade-badge" style="--gc: #16a34a">A</div>
                                <div class="rp-grade-text">
                                    <strong>Sangat Baik</strong>
                                    <span>Istimewa</span>
                                </div>
                                <div class="rp-grade-bar" style="--gc: #16a34a"></div>
                            </div>
                            <div class="rp-grade-item" data-grade="B">
                                <div class="rp-grade-badge" style="--gc: #2563eb">B</div>
                                <div class="rp-grade-text">
                                    <strong>Baik</strong>
                                    <span>Memuaskan</span>
                                </div>
                                <div class="rp-grade-bar" style="--gc: #2563eb"></div>
                            </div>
                            <div class="rp-grade-item" data-grade="C">
                                <div class="rp-grade-badge" style="--gc: #0891b2">C</div>
                                <div class="rp-grade-text">
                                    <strong>Cukup</strong>
                                    <span>Standar</span>
                                </div>
                                <div class="rp-grade-bar" style="--gc: #0891b2"></div>
                            </div>
                            <div class="rp-grade-item" data-grade="D">
                                <div class="rp-grade-badge" style="--gc: #d97706">D</div>
                                <div class="rp-grade-text">
                                    <strong>Kurang</strong>
                                    <span>Perlu Perbaikan</span>
                                </div>
                                <div class="rp-grade-bar" style="--gc: #d97706"></div>
                            </div>
                            <div class="rp-grade-item" data-grade="E">
                                <div class="rp-grade-badge" style="--gc: #dc2626">E</div>
                                <div class="rp-grade-text">
                                    <strong>Tidak Baik</strong>
                                    <span>Perlu Bimbingan</span>
                                </div>
                                <div class="rp-grade-bar" style="--gc: #dc2626"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Form --}}
            <div class="col-lg-8">
                <div class="rp-card">
                    <form action="{{ route('reports.store') }}" method="POST" id="reportForm">
                        @csrf

                        {{-- Section: Informasi Dasar --}}
                        <div class="rp-form-section">
                            <div class="rp-section-head">
                                <div class="rp-section-num">01</div>
                                <div>
                                    <div class="rp-section-title">Informasi Dasar</div>
                                    <div class="rp-section-sub">Pilih siswa dan periode penilaian</div>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-sm-6">
                                    <label class="rp-label" for="student_id">
                                        <i class="bi bi-person-circle"></i> Nama Siswa
                                    </label>
                                    <select name="student_id"
                                        id="student_id"
                                        class="rp-select"
                                        {{ request('month') ? '' : 'disabled' }}
                                        required>
                                        <option value="">— Pilih Siswa —</option>
                                        @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="rp-label" for="month">
                                        <i class="bi bi-calendar-event"></i> Periode Penilaian
                                    </label>
                                    <input type="month" name="month" id="month"
                                        value="{{ request('month') }}"
                                        class="rp-input" required>
                                </div>
                                @if(!request('month'))
                                <small class="text-danger">
                                    Silakan pilih periode penilaian terlebih dahulu.
                                </small>
                                @endif
                            </div>
                        </div>

                        <div class="rp-divider"></div>

                        {{-- Section: Penilaian Gerakan --}}
                        <div class="rp-form-section">
                            <div class="rp-section-head">
                                <div class="rp-section-num">02</div>
                                <div>
                                    <div class="rp-section-title">Penilaian Gerakan</div>
                                    <div class="rp-section-sub">Berikan nilai untuk setiap gerakan</div>
                                </div>
                            </div>

                            @php
                            $className = strtolower(auth()->user()->smClass->name ?? '');
                            $isFlagClass = in_array($className, ['e', 'f']);
                            @endphp

                            <div class="row g-3 mt-1">

                                @if($isFlagClass)
                                @php
                                $subjects = [
                                'Basic Flag',
                                'Pengagungan',
                                'Praise Flag',
                                'Modern Dance'
                                ];
                                @endphp
                                @else
                                @php
                                $subjects = [
                                'Balet',
                                'Modern Dance',
                                'Tamborin'
                                ];
                                @endphp
                                @endif

                                @foreach($subjects as $subject)
                                <div class="col-sm-6">
                                    <label class="rp-label">
                                        <i class="bi bi-award"></i> {{ $subject }}
                                    </label>
                                    <div class="rp-grade-select-wrap">
                                        <select name="subjects[{{ $subject }}]"
                                            class="rp-select rp-grade-select"
                                            data-grade-input>
                                            <option value="A">A — Sangat Baik</option>
                                            <option value="B">B — Baik</option>
                                            <option value="C">C — Cukup</option>
                                            <option value="D">D — Kurang</option>
                                            <option value="E">E — Tidak Baik</option>
                                            <option value="-">Belum Belajar</option>
                                        </select>
                                        <div class="rp-grade-dot"></div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="rp-submit-row">
                            <a href="{{ url()->previous() }}" class="rp-btn-ghost">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="rp-btn-submit" id="submitBtn">
                                <i class="bi bi-check-circle-fill"></i>
                                <span class="btn-text">Simpan Raport</span>
                                <span class="btn-loader d-none">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                </span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .rp-page {
        font-family: 'DM Sans', sans-serif;
        background: #f4f2ee;
        min-height: 100vh;
    }

    /* ── Hero ──────────────────────────────────────── */
    .rp-hero {
        position: relative;
        background: linear-gradient(135deg, #1e1b4b 0%, #312e81 60%, #4338ca 100%);
        border-radius: 20px;
        padding: 52px 56px;
        overflow: hidden;
        color: #fff;
    }

    .rp-hero-inner {
        position: relative;
        z-index: 2;
    }

    .rp-hero-label {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #a5b4fc;
        background: rgba(165, 180, 252, .12);
        border: 1px solid rgba(165, 180, 252, .25);
        border-radius: 99px;
        padding: 4px 14px;
        margin-bottom: 16px;
    }

    .rp-hero-title {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 400;
        line-height: 1.15;
        margin-bottom: 10px;
    }

    .rp-hero-sub {
        font-size: 15px;
        color: #c7d2fe;
        margin: 0;
        max-width: 480px;
    }

    /* Decorative rings */
    .rp-hero-deco {
        position: absolute;
        right: -40px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
    }

    .rp-deco-ring {
        position: absolute;
        border-radius: 50%;
        border: 1.5px solid rgba(255, 255, 255, .1);
        transform: translate(-50%, -50%);
    }

    .rp-deco-ring--1 {
        width: 180px;
        height: 180px;
    }

    .rp-deco-ring--2 {
        width: 300px;
        height: 300px;
        border-color: rgba(255, 255, 255, .06);
    }

    .rp-deco-ring--3 {
        width: 440px;
        height: 440px;
        border-color: rgba(255, 255, 255, .04);
    }

    /* ── Alert ──────────────────────────────────────── */
    .rp-alert {
        border: none;
        border-left: 4px solid #ef4444;
        border-radius: 12px;
        background: #fff1f2;
        color: #991b1b;
        padding: 16px 20px;
    }

    .rp-alert-icon {
        font-size: 18px;
        color: #ef4444;
    }

    /* ── Cards ──────────────────────────────────────── */
    .rp-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e2db;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .05), 0 1px 3px rgba(0, 0, 0, .04);
        overflow: hidden;
        transition: box-shadow .25s;
    }

    .rp-card:hover {
        box-shadow: 0 6px 24px rgba(0, 0, 0, .08), 0 2px 6px rgba(0, 0, 0, .04);
    }

    .rp-card-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 18px 24px;
        background: #fafaf9;
        border-bottom: 1px solid #e5e2db;
        font-weight: 700;
        font-size: 14px;
        color: #374151;
        letter-spacing: .01em;
    }

    .rp-card-head i {
        color: #4338ca;
        font-size: 17px;
    }

    .rp-card-body {
        padding: 20px 24px;
    }

    /* ── Grade Reference List ───────────────────────── */
    .rp-grade-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .rp-grade-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid transparent;
        cursor: default;
        transition: background .2s, border-color .2s, transform .2s;
    }

    .rp-grade-item:hover {
        background: #f9fafb;
        border-color: #e5e7eb;
        transform: translateX(4px);
    }

    .rp-grade-badge {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--gc);
        color: #fff;
        font-weight: 800;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
    }

    .rp-grade-text {
        flex: 1;
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .rp-grade-text strong {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
    }

    .rp-grade-text span {
        font-size: 12px;
        color: #9ca3af;
        font-weight: 500;
    }

    .rp-grade-bar {
        width: 4px;
        height: 32px;
        background: var(--gc);
        border-radius: 4px;
        opacity: 0;
        transition: opacity .2s;
        flex-shrink: 0;
    }

    .rp-grade-item:hover .rp-grade-bar {
        opacity: .35;
    }

    /* ── Form Sections ──────────────────────────────── */
    .rp-form-section {
        padding: 32px 32px 0;
    }

    .rp-form-section:first-of-type {
        padding-top: 32px;
    }

    .rp-section-head {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 4px;
    }

    .rp-section-num {
        font-family: 'DM Serif Display', serif;
        font-size: 32px;
        line-height: 1;
        color: #e5e7eb;
        flex-shrink: 0;
        margin-top: -4px;
    }

    .rp-section-title {
        font-size: 17px;
        font-weight: 700;
        color: #111827;
    }

    .rp-section-sub {
        font-size: 13px;
        color: #9ca3af;
        font-weight: 400;
        margin-top: 2px;
    }

    .rp-divider {
        height: 1px;
        background: #f0ede8;
        margin: 28px 32px 0;
    }

    /* ── Labels & Inputs ────────────────────────────── */
    .rp-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        letter-spacing: .01em;
    }

    .rp-label i {
        color: #6366f1;
        font-size: 14px;
    }

    .rp-input,
    .rp-select {
        display: block;
        width: 100%;
        padding: 10px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: #111827;
        background: #fafaf9;
        border: 1.5px solid #e5e2db;
        border-radius: 10px;
        appearance: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }

    .rp-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='%236366f1' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 40px;
        cursor: pointer;
    }

    .rp-input:focus,
    .rp-select:focus {
        outline: none;
        border-color: #6366f1;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .12);
    }

    .rp-input:hover,
    .rp-select:hover {
        border-color: #a5b4fc;
        background: #fff;
    }

    /* Grade select color indicator */
    .rp-grade-select-wrap {
        position: relative;
    }

    .rp-grade-dot {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #d1d5db;
        pointer-events: none;
        transition: background .2s, transform .2s;
    }

    .rp-grade-select-wrap .rp-select {
        padding-left: 30px;
    }

    /* Grade color states via JS data-attr */
    .rp-grade-select[data-val="A"]+.rp-grade-dot {
        background: #16a34a;
        transform: translateY(-50%) scale(1.3);
    }

    .rp-grade-select[data-val="B"]+.rp-grade-dot {
        background: #2563eb;
        transform: translateY(-50%) scale(1.3);
    }

    .rp-grade-select[data-val="C"]+.rp-grade-dot {
        background: #0891b2;
        transform: translateY(-50%) scale(1.3);
    }

    .rp-grade-select[data-val="D"]+.rp-grade-dot {
        background: #d97706;
        transform: translateY(-50%) scale(1.3);
    }

    .rp-grade-select[data-val="E"]+.rp-grade-dot {
        background: #dc2626;
        transform: translateY(-50%) scale(1.3);
    }

    /* ── Submit Row ─────────────────────────────────── */
    .rp-submit-row {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
        padding: 24px 32px 32px;
        margin-top: 8px;
    }

    .rp-btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 18px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        background: transparent;
        border: 1.5px solid #e5e2db;
        border-radius: 10px;
        text-decoration: none;
        transition: all .2s;
    }

    .rp-btn-ghost:hover {
        color: #374151;
        border-color: #9ca3af;
        background: #f9fafb;
    }

    .rp-btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: transform .2s, box-shadow .2s, opacity .2s;
        box-shadow: 0 4px 14px rgba(79, 70, 229, .35);
    }

    .rp-btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, .4);
    }

    .rp-btn-submit:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(79, 70, 229, .3);
    }

    .rp-btn-submit.loading {
        opacity: .75;
        pointer-events: none;
    }

    /* ── Animations ─────────────────────────────────── */
    @keyframes rp-fade-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .rp-hero {
        animation: rp-fade-up .55s cubic-bezier(.16, 1, .3, 1) both;
    }

    .rp-card {
        animation: rp-fade-up .55s cubic-bezier(.16, 1, .3, 1) both;
    }

    .col-lg-4 .rp-card {
        animation-delay: .1s;
    }

    .col-lg-8 .rp-card {
        animation-delay: .15s;
    }

    /* ── Responsive ─────────────────────────────────── */
    @media (max-width: 991.98px) {
        .rp-hero {
            padding: 40px 32px;
        }

        .rp-hero-deco {
            display: none;
        }
    }

    @media (max-width: 575.98px) {
        .rp-hero {
            padding: 32px 24px;
            border-radius: 14px;
        }

        .rp-form-section {
            padding: 24px 20px 0;
        }

        .rp-divider {
            margin: 24px 20px 0;
        }

        .rp-submit-row {
            padding: 20px 20px 24px;
            flex-direction: column;
        }

        .rp-btn-ghost,
        .rp-btn-submit {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reportForm');
        const submitBtn = document.getElementById('submitBtn');

        // Grade select: update data-val for CSS dot coloring
        const gradeSelects = document.querySelectorAll('[data-grade-input]');
        gradeSelects.forEach(select => {
            const update = () => {
                select.setAttribute('data-val', select.value);
            };
            update();
            select.addEventListener('change', update);
        });

        // Submit loading state
        form.addEventListener('submit', function() {
            submitBtn.classList.add('loading');
            submitBtn.querySelector('.btn-text').textContent = 'Menyimpan...';
            submitBtn.querySelector('.btn-loader').classList.remove('d-none');
        });
    });
</script>

<script>
    document.getElementById('month').addEventListener('change', function() {
        let month = this.value;
        window.location.href = "?month=" + month;
    });
</script>

@endsection