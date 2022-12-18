<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        .btn-hover {
            transition: all 0.3s ease-in-out;
            background-color: #0bc02c;
        }
    </style>
</head>

<body>
    <div style="width: 100%; background-color: #f5f5f5; padding: 20px 0;">
        <div style="width: 600px; margin: 0 auto; background-color: #fff; padding: 20px;">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ asset('assets/logo/logo-app.svg') }}" alt="logo" style="width: 150px;">
            </div>
            <div style="text-align: center; margin-bottom: 20px;">
                <h1 style="font-size: 24px; font-weight: 600; margin-bottom: 0;">Laporan Transaksi</h1>
                <p style="font-size: 14px; margin-bottom: 0;">
                    {{ date('y F d', strtotime($borrowTransactions->borrow_date)) }}</p>
            </div>
            <div style="text-align: center; margin-bottom: 20px;">
                <p style="font-size: 14px; margin-bottom: 0;">Halo, {{ $member->member_name }}</p>
                <p style="font-size: 14px; margin-bottom: 0;">
                    Berikut adalah laporan transaksi anda pada tanggal
                    {{ date('y F d', strtotime($borrowTransactions->borrow_date)) }} s/d
                    {{ date('y F d', strtotime($borrowTransactions->return_date)) }}.
                </p>
            </div>
            <div style="text-align: center; margin-bottom: 20px;">
                {{-- download file pdf in storage path --}}
                <a href="{{ asset('storage/' . $documentFileName) }}" class="btn-hover"
                    style="display: inline-block; padding: 10px 20px; background-color: #02d729; text-decoration: none; color: #000; font-size: 14px; font-weight: 600; border-radius: 50px;">Download
                    Laporan</a>
            </div>
            <div style="text-align: center; margin-bottom: 20px;">
                <p style="font-size: 14px; margin-bottom: 0;">Terima kasih telah menggunakan layanan kami.</p>
            </div>
        </div>
    </div>
</body>

</html>
