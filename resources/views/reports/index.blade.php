@extends('layouts.app')

@section('title', 'Rekapan Raport')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        padding: 0.6rem 0.9rem;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
        transform: scale(1.05);
    }


    .page-container {
        min-height: 100vh;
        padding: 2rem 1rem;
    }

    .main-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .header-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        color: #ffffff;
    }

    .header-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.875rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: fadeIn 0.8s ease-out;
    }

    .btn-create {
        background: #ffffff;
        color: #667eea;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        background: #f8f9ff;
    }

    .filter-card {
        background: #f8f9ff;
        border-radius: 16px;
        padding: 1.5rem;
        margin: 1.5rem;
        border: 2px solid #e8eaff;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    @media (min-width: 640px) {
        .filter-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 768px) {
        .filter-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .filter-select {
        background: #ffffff;
        border: 2px solid #e0e7ff;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: #374151;
        transition: all 0.2s ease;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23667eea'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1.25rem;
        padding-right: 2.5rem;
    }

    .filter-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .table-container {
        margin: 1.5rem;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        background: #ffffff;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
    }

    .table-header {
        background: linear-gradient(135deg, #f8f9ff 0%, #e8eaff 100%);
    }

    .table-header th {
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 0.875rem;
        color: #4c51bf;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        white-space: nowrap;
    }

    .table-body tr {
        border-bottom: 1px solid #f3f4f6;
        transition: all 0.2s ease;
    }

    .table-body tr:hover {
        background: #fafbff;
        transform: scale(1.01);
    }

    .table-body td {
        padding: 1.25rem 1.5rem;
        color: #374151;
        font-size: 0.95rem;
    }

    .student-name {
        font-weight: 600;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .student-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.8125rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-approved {
        background: #d1fae5;
        color: #065f46;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .status-approved .status-dot {
        background: #10b981;
    }

    .status-pending .status-dot {
        background: #f59e0b;
    }

    .status-rejected .status-dot {
        background: #ef4444;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        background: #fafbff;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    .empty-text {
        color: #9ca3af;
        font-size: 1.125rem;
        font-weight: 500;
    }

    /* ===== MODAL STYLES ===== */
    .report-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
    }

    .report-modal.show {
        display: flex;
    }

    .report-modal-content {
        background: #ffffff;
        border-radius: 16px;
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideUp 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 28px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .icon-wrapper {
        width: 44px;
        height: 44px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .modal-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
        letter-spacing: -0.3px;
    }

    .btn-close {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: all 0.2s ease;
    }

    .btn-close:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: rotate(90deg);
    }

    .modal-body {
        flex: 1;
        overflow-y: auto;
        padding: 28px;
        background: #f8f9fa;
    }

    .report-content {
        background: white;
        border-radius: 12px;
        padding: 24px;
        min-height: 300px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    #reportDetailContent {
        background: white;
        border-radius: 12px;
        padding: 24px;
        min-height: 300px;
    }

    .loading-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 300px;
        gap: 16px;
    }

    .spinner {
        width: 48px;
        height: 48px;
        border: 4px solid #e9ecef;
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .loading-spinner p {
        color: #6c757d;
        font-size: 14px;
        margin: 0;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 20px 28px;
        background: white;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        font-family: inherit;
    }

    .btn:active {
        transform: translateY(1px);
    }

    .btn-secondary {
        background: #e9ecef;
        color: #495057;
    }

    .btn-secondary:hover {
        background: #dee2e6;
    }

    .btn-print {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-print:hover {
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        transform: translateY(-2px);
    }

    .btn-pdf {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .btn-pdf:hover {
        box-shadow: 0 4px 12px rgba(245, 87, 108, 0.4);
        transform: translateY(-2px);
    }

    .modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 1rem 0.5rem;
        }

        .header-section {
            padding: 1.5rem 1rem;
        }

        .header-title {
            font-size: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .filter-card {
            margin: 1rem;
            padding: 1rem;
        }

        .table-container {
            margin: 1rem;
            overflow-x: auto;
        }

        .data-table {
            min-width: 600px;
        }

        .table-header th,
        .table-body td {
            padding: 1rem;
            font-size: 0.875rem;
        }

        .student-avatar {
            width: 35px;
            height: 35px;
            font-size: 0.875rem;
        }

        .report-modal-content {
            width: 95%;
            max-height: 95vh;
            border-radius: 12px;
        }

        .modal-header {
            padding: 20px;
        }

        .modal-header h3 {
            font-size: 18px;
        }

        .icon-wrapper {
            width: 38px;
            height: 38px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            flex-direction: column;
            padding: 16px 20px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .header-title {
            font-size: 1.25rem;
        }

        .btn-create {
            width: 100%;
            justify-content: center;
        }

        .table-header th,
        .table-body td {
            padding: 0.75rem;
        }
    }

    @media print {
        .report-modal {
            display: block !important;
            position: static;
            background: none;
        }

        .modal-header,
        .modal-footer {
            display: none !important;
        }

        .report-modal-content {
            box-shadow: none;
            max-height: none;
        }

        .modal-body {
            padding: 0;
            background: white;
        }
    }
</style>

<div class="page-container">
    <div class="container mx-auto" style="max-width: 1200px;">
        <div class="main-card">

            <!-- HEADER -->
            <div class="header-section">
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                        <h2 class="header-title">
                            <span>📊</span>
                            <span>Rekapan Raport Bulanan</span>
                        </h2>
                        <a href="{{ route('reports.create') }}" class="btn-create">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Buat Raport
                        </a>
                    </div>
                </div>
            </div>

            <!-- FILTER -->
            <form method="GET" class="filter-card">
                <div class="filter-grid">
                    <select name="month" class="filter-select">
                        @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                        @endforeach
                    </select>

                    <select name="year" class="filter-select">
                        @foreach(range(now()->year - 2, now()->year + 1) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn-filter" id="submit">
                        <span>🔍 Filter Data</span>
                    </button>
                </div>
            </form>

            <!-- TABLE -->
            <div class="table-container">
                <table class="data-table">
                    <thead class="table-header">
                        <tr>
                            <th>Nama Murid</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @forelse($reports as $report)
                        <tr onclick="openReportModal({{ $report->id }})" style="cursor:pointer;">

                            <td>
                                <div class="student-name">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($report->student->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $report->student->name }}</span>
                                </div>
                            </td>

                            <td>
                               {{ \Carbon\Carbon::parse($report->month)->format('F Y') }}
                            </td>

                            <td>
                                @if($report->status == 'approved')
                                <span class="status-badge status-approved">
                                    <span class="status-dot"></span>
                                    Approved
                                </span>
                                @elseif($report->status == 'pending')
                                <span class="status-badge status-pending">
                                    <span class="status-dot"></span>
                                    Pending
                                </span>
                                @else
                                <span class="status-badge status-rejected">
                                    <span class="status-dot"></span>
                                    Rejected
                                </span>
                                @endif
                            </td>

                            <td style="text-align:center;">
                                <button
                                    onclick="event.stopPropagation(); confirmDelete({{ $report->id }})"
                                    class="btn-delete"
                                    data-url="{{ route('reports.destroy', $report->id) }}">
                                    🗑️
                                </button>

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <div class="empty-icon">📭</div>
                                    <p class="empty-text">Tidak ada raport untuk periode ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- MODAL DETAIL RAPORT -->
<div id="reportModal" class="report-modal">
    <div class="report-modal-content">
        <div class="modal-header">
            <div class="header-content">
                <div class="icon-wrapper">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                        <polyline points="10 9 9 9 8 9" />
                    </svg>
                </div>
                <h3>Detail Raport Siswa</h3>
            </div>
            <button onclick="closeReportModal()" class="btn-close" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                </svg>
            </button>
        </div>

        <div class="modal-body">
            <div id="reportDetailContent">
                <div class="loading-spinner">
                    <div class="spinner"></div>
                    <p>Memuat data raport...</p>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button onclick="closeReportModal()" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
                Tutup
            </button>
            <button onclick="printReport()" class="btn btn-print">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                </svg>
                Print
            </button>
            <a id="pdfLink" href="#" target="_blank" class="btn btn-pdf">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                    <path d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                    <path d="M3 14.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                </svg>
                Download PDF
            </a>
        </div>
    </div>
</div>

<script>
    function openReportModal(id) {
        const modal = document.getElementById('reportModal');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';

        // Show loading
        document.getElementById('reportDetailContent').innerHTML = `
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p>Memuat data raport...</p>
            </div>
        `;

        fetch('/reports/' + id + '/detail')
            .then(response => response.text())
            .then(html => {
                document.getElementById('reportDetailContent').innerHTML = html;
                document.getElementById('pdfLink').href = '/reports/' + id + '/pdf';
            })
            .catch(error => {
                document.getElementById('reportDetailContent').innerHTML = `
                    <div style="text-align:center; padding:2rem; color:#ef4444;">
                        <p>❌ Gagal memuat data</p>
                        <p style="font-size:0.875rem; margin-top:0.5rem;">Silakan coba lagi</p>
                    </div>
                `;
            });
    }

    function closeReportModal() {
        const modal = document.getElementById('reportModal');
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }

    function printReport() {
        var content = document.getElementById('reportDetailContent').innerHTML;
        var printWindow = window.open('', '', 'width=900,height=700');
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Raport</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 30px; }
                    table { width:100%; border-collapse: collapse; margin-top:20px; }
                    th, td { border:1px solid #ddd; padding:8px; }
                    th { background:#f4f4f4; }
                </style>
            </head>
            <body>` + content + `</body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    // Close modal on outside click
    document.getElementById('reportModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeReportModal();
        }
    });

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('reportModal');
            if (modal.classList.contains('show')) {
                closeReportModal();
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {

    const button = document.querySelector(`button[onclick*="${id}"]`);
    const url = button.getAttribute('data-url');

    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data raport tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteReport(url, button);
        }
    });
}

function deleteReport(url, button) {

    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {

        if (response.status === 204 || response.ok) {
            return true;
        }

        throw new Error('Gagal');
    })
    .then(() => {

        const row = button.closest('tr');

        row.style.transition = "all 0.3s ease";
        row.style.opacity = "0";
        row.style.transform = "scale(0.95)";

        setTimeout(() => {
            row.remove();
        }, 300);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            timer: 1500,
            showConfirmButton: false
        });

    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Data tidak bisa dihapus'
        });
    });
}


</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const monthSelect = document.querySelector('select[name="month"]');
    const yearSelect  = document.querySelector('select[name="year"]');
    const pdfLink     = document.getElementById('pdfLink');

    function updatePdfLink() {
        const month = monthSelect.value;
        const year  = yearSelect.value;

        pdfLink.href = `/reports/pdf?month=${month}&year=${year}`;
    }

    // Set saat halaman load
    updatePdfLink();

    // Update saat filter berubah
    monthSelect.addEventListener('change', updatePdfLink);
    yearSelect.addEventListener('change', updatePdfLink);

});
</script>
@endsection