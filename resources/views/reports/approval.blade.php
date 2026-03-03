@extends('layouts.app')

@section('title', 'Validasi Raport')

@section('content')

<div class="container">
    <h2 class="mb-4">Daftar Raport Menunggu Validasi</h2>

    @if($reports->count() > 0)

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Murid</th>
                    <th>Bulan</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->student->name }}</td>
                        <td>{{ $report->month }}</td>
                        <td>{{ $report->creator->name ?? '-' }}</td>
                        <td>

                            <form action="{{ route('reports.approve', $report) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form action="{{ route('reports.reject', $report) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <div class="alert alert-info">
            Tidak ada raport yang perlu divalidasi.
        </div>
    @endif
</div>

@endsection
