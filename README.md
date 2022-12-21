### <p align="center"><b>Perpustakaan WebApp Skuy Membaca</b></p>

------------

# Cara install Aplikasi Perpustakaan
## 💻 Clone Repository


- Clone aplikasi melalui link berikut :

        git clone https://github.com/ardinur03/vsga-website-poad.git

- Masuk ke direktori perpustakaan
        
        cd perpustakaan
   


## 💻 Install dependencies
bash
composer install
bash

## 🚀 Migrate Database & Data Dummy
- Perintah berikut akan mengenerate database dan Data dummy

        php artisan migrate --seed

Pastikan anda mengkonfigurasikan file .env

## 😎 User Login 
##### Super Admin :
- Kode User : 032201 
- Password : 12345678
##### Petugas :
- Kode User : 032202
- Password : 12345678
##### Member (Mahasiswa)  :
- NIP/NIM : 211511017
- Password : 12345678
##### Member (Dosen)  :
- NIP/NIM : 211511017
- Password : 12345678
#### *Note : Untuk page login dari semua role user sama*

## 📌 Teknologi WebApp

**Frontend:** Bootstrap 4.3, Admin Lte 3

**Backend:** PHP, Laravel 8

<p align="center"><b>Made with ❤️ by Ardi & Team</b></p>
