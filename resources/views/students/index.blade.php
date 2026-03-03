@extends('layouts.app')

@section('title', 'Anggota Murid')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap');

    .students-container {
        font-family: 'Outfit', sans-serif;
    }

    /* Info Alert Box */
    .info-alert {
        background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        border: 2px solid #93C5FD;
        border-radius: 16px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease forwards;
    }

    .info-alert::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .info-alert-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        border-radius: 12px;
        color: white;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .info-alert-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1E40AF;
        margin-bottom: 0.5rem;
    }

    .info-alert-text {
        font-size: 0.9375rem;
        color: #1E3A8A;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    .info-alert-text strong {
        color: #1E40AF;
        font-weight: 600;
    }

    /* Form Add Student */
    .form-container {
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(160, 155, 185, 0.1);
        animation: fadeInUp 0.6s ease forwards;
        animation-delay: 0.1s;
        position: relative;
        overflow: hidden;
    }

    .form-container::before {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(210, 109, 107, 0.08) 0%, transparent 70%);
        border-radius: 50%;
    }

    .form-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #160F1A;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .form-title::before {
        content: '➕';
        font-size: 1.25rem;
    }

    .custom-input {
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
    }

    .custom-input:hover {
        border-color: #D26D6B;
        background-color: #fafafa;
    }

    .custom-input:focus {
        outline: none;
        border-color: #D26D6B;
        box-shadow: 0 0 0 4px rgba(210, 109, 107, 0.1);
    }

    .custom-input::placeholder {
        color: #9CA3AF;
    }

    .submit-btn {
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
        z-index: 1;
    }

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .submit-btn:hover::before {
        left: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(210, 109, 107, 0.3);
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    /* Table Container */
    .table-container {
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(160, 155, 185, 0.1);
        overflow: hidden;
        animation: fadeInUp 0.6s ease forwards;
        animation-delay: 0.2s;
    }

    .table-header {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, #160F1A 0%, #2a1f35 100%);
        border-bottom: 2px solid rgba(210, 109, 107, 0.2);
    }

    .table-header-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #FEFDFD;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-header-title::before {
        content: '👥';
        font-size: 1.5rem;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead {
        background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
    }

    .custom-table thead th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.875rem;
        font-weight: 600;
        color: #160F1A;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #E5E7EB;
    }

    .custom-table thead th:last-child {
        text-align: center;
    }

    .custom-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #F3F4F6;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(210, 109, 107, 0.03) 0%, rgba(201, 182, 199, 0.03) 100%);
        transform: scale(1.01);
    }

    .custom-table tbody td {
        padding: 1rem 1.5rem;
        font-size: 0.9375rem;
        color: #1F2937;
    }

    .table-number {
        font-weight: 700;
        color: #777292;
        font-family: 'Space Mono', monospace;
    }

    .table-name {
        font-weight: 500;
        color: #160F1A;
    }

    .delete-btn {
        background: none;
        border: none;
        color: #EF4444;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.2s ease;
        font-family: 'Outfit', sans-serif;
    }

    .delete-btn:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
    }

    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
        color: #9CA3AF;
    }

    .empty-state-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 1rem;
        font-weight: 500;
    }

    /* Badge for role info */
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.375rem 0.75rem;
        background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
        color: #78350F;
        font-size: 0.8125rem;
        font-weight: 600;
        border-radius: 8px;
        margin-top: 0.5rem;
    }

    .role-badge::before {
        content: '👑';
        font-size: 1rem;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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

    /* Responsive */
    @media (max-width: 768px) {
        .info-alert {
            padding: 1.25rem;
        }

        .form-container {
            padding: 1.5rem;
        }

        .table-header {
            padding: 1.25rem 1.5rem;
        }

        .table-header-title {
            font-size: 1.125rem;
        }

        .custom-table thead th,
        .custom-table tbody td {
            padding: 0.875rem 1rem;
        }

        .custom-table {
            font-size: 0.875rem;
        }

        /* Stack table on mobile */
        .table-container {
            overflow-x: auto;
        }

        .custom-table {
            min-width: 500px;
        }
    }

    @media (max-width: 640px) {
        .info-alert-text {
            font-size: 0.875rem;
        }

        .form-title {
            font-size: 1rem;
        }

        .custom-input {
            font-size: 0.875rem;
        }

        .submit-btn {
            font-size: 0.875rem;
        }
    }
</style>

<div class="students-container">

    {{-- INFO ALERT --}}
    <div class="mb-6">
        <div class="info-alert">
            <div class="info-alert-icon">ℹ️</div>
            <div class="info-alert-title">Informasi Penting</div>
            <div class="info-alert-text">
                Data <strong>Anggota</strong> digunakan sebagai dasar pembuatan raport.
                <br><br>

                @if($user->role === 'ketua_kelas')
                    Sebagai <strong>Ketua Kelas</strong>, Anda memiliki hak untuk menambah, mengubah,
                    dan menghapus data murid.
                    <span class="role-badge">Ketua Kelas</span>
                @else
                    Anda hanya dapat melihat data murid.
                    Perubahan data hanya dapat dilakukan oleh <strong>Ketua Kelas</strong>.
                @endif
            </div>
        </div>
    </div>

    {{-- FORM ADD STUDENT (KETUA KELAS ONLY) --}}
    @if($user->role === 'ketua_kelas')
    <div class="form-container mb-6">
        <h2 class="form-title">Tambah Murid Baru</h2>
        <form method="POST" action="{{ route('students.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf

            <div class="md:col-span-2">
                <input type="text" 
                       name="name" 
                       placeholder="Masukkan nama murid..." 
                       class="custom-input" 
                       required>
            </div>

            <button type="button" class="submit-btn" id="addStudentBtn">
    Tambah Murid
</button>
        </form>
    </div>
    @endif

    {{-- TABLE --}}
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-header-title">Daftar Murid</h2>
        </div>

        <div style="overflow-x: auto;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">No</th>
                        <th>Nama Murid</th>
                        @if($user->role === 'ketua_kelas')
                            <th style="width: 120px;">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td class="table-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="table-name">{{ $student->name }}</td>

                            @if($user->role === 'ketua_kelas')
                            <td style="text-align: center;">
                                <form method="POST" action="{{ route('students.destroy', $student) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
        class="delete-btn delete-button"
        data-name="{{ $student->name }}">
    🗑️ Hapus
</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $user->role === 'ketua_kelas' ? '3' : '2' }}" class="empty-state">
                                <div class="empty-state-icon">📭</div>
                                <div class="empty-state-text">Belum ada data murid</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {

            const studentName = this.dataset.name;
            const form = this.closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Murid " + studentName + " akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const addButton = document.getElementById('addStudentBtn');
    const form = addButton.closest('form');

    addButton.addEventListener('click', function () {

        const nameInput = form.querySelector('input[name="name"]');
        const studentName = nameInput.value.trim();

        if (!studentName) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: 'Nama murid harus diisi terlebih dahulu.'
            });
            return;
        }

        Swal.fire({
            title: 'Tambah Murid?',
            text: "Murid " + studentName + " akan ditambahkan ke kelas.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#160F1A',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Tambahkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });

});
</script>
@endsection