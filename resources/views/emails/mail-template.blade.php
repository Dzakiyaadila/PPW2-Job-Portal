<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Selamat Datang di Job Portal!</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #007bff; border-radius: 8px; background-color: #f4f9ff;">
        
        <h1 style="color: #007bff; text-align: center;">🎉 Selamat Datang, {{ $data['name'] ?? 'Pendaftar Baru' }}!</h1>
        <hr style="border: 0; border-top: 2px solid #007bff; margin-bottom: 20px;">
        
        <p>Terima kasih telah bergabung dengan Job Portal kami. Akun Anda telah berhasil dibuat.</p>
        
        <p style="font-weight: bold; margin-top: 20px;">Detail Akun Anda:</p>
        
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #fff; border: 1px solid #ddd;">
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #eee; font-weight: bold; width: 30%; background-color: #f1f1f1;">Nama Lengkap</td>
                <td style="padding: 12px; border-bottom: 1px solid #eee;">{{ $data['name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #eee; font-weight: bold; background-color: #f1f1f1;">Email Login</td>
                <td style="padding: 12px; border-bottom: 1px solid #eee;">{{ $data['email'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 12px; font-weight: bold; background-color: #f1f1f1;">Peran (Role)</td>
                <td style="padding: 12px;">{{ $data['role'] ?? 'User' }}</td>
            </tr>
            
            {{-- PERINGATAN KEAMANAN: Jangan pernah mengirim password plain text --}}
            @if(isset($data['login_link']))
            <tr>
                <td style="padding: 12px; font-weight: bold; background-color: #f1f1f1;">Halaman Login</td>
                <td style="padding: 12px;"><a href="{{ $data['login_link'] }}" style="color: #007bff; text-decoration: none; font-weight: bold;">Klik di sini untuk Login</a></td>
            </tr>
            @endif
        </table>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ $data['login_link'] ?? url('/login') }}" 
               style="background-color: #007bff; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;">
                Mulai Cari Pekerjaan!
            </a>
        </div>

        <p style="margin-top: 30px; font-size: 0.9em; color: #777; text-align: center;">
            Jika Anda tidak merasa mendaftar akun ini, abaikan email ini.
        </p>
    </div>
</body>
</html>