<div style="font-family: 'Segoe UI', sans-serif; max-width: 800px; margin:auto;">

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white; padding: 20px; border-radius: 10px 10px 0 0;">

        <h4 style="margin:0;">
            {{ $report->student->name }}
        </h4>

        <p style="margin: 8px 0 0 0;">
            📅 {{ \Carbon\Carbon::parse($report->month)->translatedFormat('F Y') }}
        </p>

        <p style="margin: 5px 0 0 0;">
            Status: 
            <strong>{{ strtoupper($report->status) }}</strong>
        </p>
    </div>

    <!-- Table -->
    <div style="background:white; border:1px solid #eee; border-top:none; border-radius: 0 0 10px 10px;">
        <table width="100%" style="border-collapse: collapse;">
            <thead>
                <tr style="background:#f1f3f5;">
                    <th style="padding:12px; text-align:left;">Mata Pelajaran</th>
                    <th style="padding:12px; text-align:center; width:100px;">Nilai</th>
                </tr>
            </thead>
            <tbody>

                @forelse($report->details as $detail)
                    <tr>
                        <td style="padding:12px; border-top:1px solid #eee;">
                            {{ $detail->subject }}
                        </td>
                        <td style="padding:12px; text-align:center; border-top:1px solid #eee;">
                            <span style="background:#667eea; color:white; padding:6px 12px; border-radius:6px;">
                                {{ $detail->grade }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="padding:20px; text-align:center; color:#999;">
                            Tidak ada detail nilai.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>