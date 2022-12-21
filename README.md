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
- Kode Super Admin : 032201 atau neisya@ardinur.tech
- Password : 12345678
##### Petugas :
- Kode Petugas : 032202 atau info@ardinur.tech
- Password : 12345678
##### Member (Mahasiswa)  :
- NIM : 211511017 atau kevin@ardinur.tech
- Password : 12345678
##### Member (Dosen)  :
- NIP : 738371571335747777 atau madya@ardinur.tech
- Password : 12345678
#### *Note : Untuk page login dari semua role user sama, untuk inputan ada 2 yaitu Email/NIP/NIM & Password*

## 📌 Teknologi WebApp

**Frontend:** Bootstrap 4.3, Admin Lte 3

**Backend:** PHP, Laravel 8

<p align="center"><b>Made with ❤️ by Ardi & Team</b></p>
