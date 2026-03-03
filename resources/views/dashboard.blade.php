@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap');

    .dashboard-container {
        font-family: 'Outfit', sans-serif;
    }

    /* Stats Cards */
    .stat-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fb 100%);
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(160, 155, 185, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(210, 109, 107, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        transition: all 0.6s ease;
    }

    .stat-card:hover::before {
        transform: scale(1.3);
        top: -60%;
        right: -40%;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(210, 109, 107, 0.15);
        border-color: rgba(210, 109, 107, 0.2);
    }

    .stat-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #160F1A 0%, #2a1f35 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 24px rgba(22, 15, 26, 0.2);
        position: relative;
        z-index: 2;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #777292;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #160F1A 0%, #D26D6B 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Space Mono', monospace;
        position: relative;
        z-index: 2;
    }

    /* Filter Section */
    .filter-container {
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(160, 155, 185, 0.1);
        margin-bottom: 2rem;
    }

    .filter-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #160F1A;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-title::before {
        content: '⚙️';
        font-size: 1.25rem;
    }

    .custom-select {
        width: 100%;
        padding: 0.875rem 1.25rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.9375rem;
        color: #1F2937;
        background: white;
        transition: all 0.3s ease;
        font-family: 'Outfit', sans-serif;
        font-weight: 500;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1.5L6 6.5L11 1.5' stroke='%23777292' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 3rem;
        cursor: pointer;
    }

    .custom-select:hover {
        border-color: #D26D6B;
        background-color: #fafafa;
    }

    .custom-select:focus {
        outline: none;
        border-color: #D26D6B;
        box-shadow: 0 0 0 4px rgba(210, 109, 107, 0.1);
    }

    .apply-btn {
        width: 100%;
        padding: 0.875rem 1.5rem;
        background: linear-gradient(135deg, #160F1A 0%, #2a1f35 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9375rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(22, 15, 26, 0.2);
        font-family: 'Outfit', sans-serif;
        position: relative;
        overflow: hidden;
    }

    .apply-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .apply-btn:hover::before {
        left: 100%;
    }

    .apply-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(210, 109, 107, 0.3);
    }

    .apply-btn:active {
        transform: translateY(0);
    }

    /* Chart Container */
    .chart-container {
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(160, 155, 185, 0.1);
        position: relative;
        overflow: hidden;
    }

    .chart-container::before {
        content: '';
        position: absolute;
        top: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 182, 199, 0.05) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #160F1A;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .chart-title::before {
        content: '📈';
        font-size: 1.5rem;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .stat-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .stat-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .filter-container {
        animation: fadeInUp 0.6s ease forwards;
        animation-delay: 0.3s;
    }

    .chart-container {
        animation: fadeInUp 0.6s ease forwards;
        animation-delay: 0.4s;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-card {
            padding: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            font-size: 1.75rem;
        }

        .filter-container,
        .chart-container {
            padding: 1.5rem;
        }
    }
</style>

<div class="dashboard-container">

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <h3 class="stat-label">Jumlah Anggota</h3>
            <p class="stat-value">{{ $totalStudents }}</p>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <h3 class="stat-label">Raport Dibuat</h3>
            <p class="stat-value">{{ $totalReports }}</p>
        </div>

    </div>

    {{-- FILTER SECTION --}}
    <div class="filter-container">
        <h2 class="filter-title">Filter Analisis</h2>
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <select name="student_id" class="custom-select">
                <option value="">Semua Murid (Rata-rata)</option>
                @foreach($students as $student)
                <option value="{{ $student->id }}"
                    {{ request('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
                @endforeach
            </select>

            <select name="range" class="custom-select">
                <option value="3" {{ request('range', '3') == '3' ? 'selected' : '' }}>3 Bulan</option>
                <option value="6" {{ request('range', '3') == '6' ? 'selected' : '' }}>6 Bulan</option>
                <option value="9" {{ request('range', '3') == '9' ? 'selected' : '' }}>9 Bulan</option>
                <option value="12" {{ request('range', '3') == '12' ? 'selected' : '' }}>1 Tahun</option>
                <option value="all" {{ request('range', 'all') == 'all' ? 'selected' : '' }}>
                    Sepanjang Waktu
                </option>
            </select>

            <button type="submit" class="apply-btn">
                Terapkan Filter
            </button>

        </form>
    </div>

    {{-- CHART SECTION --}}
    <div class="chart-container">
        <h2 class="chart-title">Grafik Perkembangan Nilai</h2>
        <canvas id="analysisChart" height="100"></canvas>
    </div>

</div>

{{-- DATA CHART (JSON SAFE) --}}
<script id="chart-data" type="application/json">
{!! json_encode($chartData) !!}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const raw = document.getElementById('chart-data').textContent.trim();

    if (!raw) {
        console.log('Chart data kosong');
        return;
    }

    const chartData = JSON.parse(raw);

    if (!chartData.length) {
        console.log('Tidak ada data untuk chart');
        return;
    }

    const ctx = document.getElementById('analysisChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(item => item.month),
            datasets: [{
                label: 'Rata-rata Nilai',
                data: chartData.map(item => item.average),
                tension: 0.4,
                borderWidth: 3,
                borderColor: '#D26D6B',
                backgroundColor: 'rgba(210,109,107,0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    min: 1,
                    max: 5,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

});
</script>
@endsection



