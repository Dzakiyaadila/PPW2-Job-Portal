<!DOCTYPE html>
<html>
<head>
    <title>Data Pelamar</title>
    <style>
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
            background: #f8fafc; 
            padding: 20px; 
            color: #334155;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            margin-bottom: 30px;
        }
        .title {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .subtitle {
            color: #64748b;
            font-size: 14px;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th {
            background: #f1f5f9;
            color: #475569;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .table td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }
        .table tr:last-child td {
            border-bottom: none;
        }
        .table tr:hover {
            background: #f8fafc;
        }
        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        .btn {
            padding: 6px 16px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-accept {
            background: #10b981;
            color: white;
        }
        .btn-accept:hover {
            background: #0da271;
        }
        .btn-reject {
            background: #ef4444;
            color: white;
        }
        .btn-reject:hover {
            background: #dc2626;
        }
        .btn-view {
            background: #3b82f6;
            color: white;
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 6px;
            display: inline-block;
            font-size: 13px;
        }
        .btn-view:hover {
            background: #2563eb;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }
        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .back-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 class="title">Data Pelamar</h1>
            <p class="subtitle">Kelola daftar pelamar yang tersedia.</p>
        </div>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #a7f3d0;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="card">
            @if($applications->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>NAMA PELAMAR</th>
                            <th>LOWONGAN</th>
                            <th>CV</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $application)
                        <tr>                       
                            <td>
                                <strong>{{ $application->user->name }}</strong><br>
                                <small style="color: #64748b; font-size: 12px;">{{ $application->user->email }}</small>
                            </td>
                            <td>{{ $application->jobListing->title }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 space-x-2">
                                <a href="{{ route('download.cv', $application->id) }}"
                                class="inline-flex items-center rounded-md bg-green-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1 no-underline cursor-pointer transition">
                                    Download CV
                                </a>
                            </td>

                            <td>
                                @if($application->status == 'pending')
                                    <span class="status status-pending">Pending</span>
                                @elseif($application->status == 'accepted')
                                    <span class="status status-accepted">Diterima</span>
                                @else
                                    <span class="status status-rejected">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if($application->status == 'pending')
                                    <div class="actions">
                                        <form action="{{ route('applications.update', $application) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="accepted">
                                            <button type="submit" 
                                                    onclick="return confirm('Terima lamaran dari {{ $application->user->name }}?')"
                                                    class="btn btn-accept">
                                                Terima
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('applications.update', $application) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" 
                                                    onclick="return confirm('Tolak lamaran dari {{ $application->user->name }}?')"
                                                    class="btn btn-reject">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span style="color: #64748b; font-size: 13px;">
                                        @if($application->status == 'accepted')
                                            ✅ Sudah diterima
                                        @else
                                            ❌ Sudah ditolak
                                        @endif
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">📭</div>
                    <p style="font-size: 16px; margin-bottom: 8px;">Belum ada pelamar</p>
                    <p style="color: #94a3b8; font-size: 14px;">Saat belum ada user yang melamar ke lowongan.</p>
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div style="margin-top: 24px;">
            <a href="{{ route('jobs.index') }}" class="back-link">
                ← Kembali ke Daftar Lowongan
            </a>
            <a href="{{ route('applications.export', $application->id) }}" 
            class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-3 py-1 text-xs font-semibold text-white hover:bg-green-700 ml-1">
            ⬇ Download 
            </a>
        </div>
    </div>
</body>
</html>