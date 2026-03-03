<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Raport {{ $periode }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #160F1A;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .periode {
            text-align: center;
            margin-bottom: 25px;
            color: #777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #777292;
            color: white;
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
        }

        td.nama {
            text-align: left;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: #f4f2f6;
        }
    </style>
</head>
<body>

<h1>FAITHFUL DANCER</h1>
<div class="periode">Rekap Raport - {{ $periode }}</div>

<table>
    <thead>
        <tr>
            <th>Nama Murid</th>

            @foreach($subjects as $subject)
                <th>{{ $subject }}</th>
            @endforeach

        </tr>
    </thead>
    <tbody>

        @foreach($reports as $report)
            <tr>
                <td class="nama">
                    {{ $report->student->name }}
                </td>

                @foreach($subjects as $subject)
                    <td>
                        {{
                            optional(
                                $report->details->firstWhere('subject', $subject)
                            )->grade ?? '-'
                        }}
                    </td>
                @endforeach

            </tr>
        @endforeach

    </tbody>
</table>

</body>
</html>