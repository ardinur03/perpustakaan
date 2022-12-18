<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_events = [
            [
                'event_name' => 'Info Buku Terbaru',
                'event_description' => 'Buku terbaru realease',
                'event_start_date' => '2022-01-01 00:00:00',
                'event_end_date' => '2022-01-01 00:00:00',
            ],
            [
                'event_name' => 'kampusku Membaca',
                'event_description' => 'Gerakan rutinan membaca buku di pagi hari di kampus',
                'event_start_date' => '2022-12-14 07:30:00',
                'event_end_date' => '2022-12-14 08:00:00',
            ],
            [
                'event_name' => 'Pekan Buku Gratis',
                'event_description' => 'Buku gratis untuk mahasiswa untuk memperingati hari buku nasional',
                'event_start_date' => '2022-12-15 07:30:00',
                'event_end_date' => '2022-12-15 08:00:00',
            ],
            [
                'event_name' => 'Pekan Buku Terpopuler',
                'event_description' => 'Buku terpopuler yang dipinjam mahasiswa',
                'event_start_date' => '2022-12-16 07:30:00',
                'event_end_date' => '2022-12-16 08:00:00',
            ],
            [
                'event_name' => 'Sosialisasi Pentingnya Membaca Buku',
                'event_description' => 'Buku gratis untuk mahasiswa',
                'event_start_date' => '2022-12-20 07:30:00',
                'event_end_date' => '2022-12-20 08:00:00',
            ],
            [
                'event_name' => 'Baca Buku dapat stiker',
                'event_description' => 'dengan membaca buku pada periode tertentu, maka akan mendapatkan stiker',
                'event_start_date' => '2022-12-18 07:30:00',
                'event_end_date' => '2022-12-18 08:00:00',
            ],
            [
                'event_name' => 'Penerimaan Buku Jurusan Teknik Informatika',
                'event_description' => 'Peminjaman buku jurusan teknik informatika dapat dilakukan di perpustakaan',
                'event_start_date' => '2022-12-19 07:30:00',
                'event_end_date' => '2022-12-22 12:00:00',
            ],
            [
                'event_name' => 'Gerakan 1 hari 1 buku',
                'event_description' => 'Gerakan membaca buku 1 hari 1 buku',
                'event_start_date' => '2022-12-17 07:30:00',
                'event_end_date' => '2022-12-17 17:00:00',
            ],
            [
                'event_name' => 'Event Buku terlaris tahun 2022',
                'event_description' => 'Buku terlaris tahun 2022',
                'event_start_date' => '2022-12-21 07:30:00',
                'event_end_date' => '2022-12-21 08:00:00',
            ],
        ];

        foreach ($data_events as $data_event) {
            \App\Models\Event::create($data_event);
        }
    }
}
