<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a id="readme-top"></a>
# Guestbook School App (Website)

<p align="center">
    <a href="https://github.com/agustheletter/SchoolApp-GuestBook">
        <img src="git-src/icon.png" alt="Product Logo" width="200">
    </a>
</p>

<!-- PROJECT TITLE -->
<br />
<div align="center">    
<h3 align="center">Website Buku Tamu Sekolah (Guestbook)</h3>
  <p align="center">
    Website Buku Tamu Sekolah adalah aplikasi Laravel dengan Admin LTE untuk mencatat dan mengelola kunjungan tamu secara digital, memungkinkan pendaftaran tamu serta pemilihan pegawai atau guru yang ingin ditemui.
    <br />
    <a href="https://github.com/agustheletter/SchoolApp-GuestBook"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/agustheletter/SchoolApp-GuestBook">View Demo</a>
    ·
    <a href="https://github.com/agustheletter/SchoolApp-GuestBook/issues">Report Bug</a>
    ·
    <a href="https://github.com/agustheletter/SchoolApp-GuestBook/issues">Request Feature</a>
  </p>
</div>

<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![License][license-shield]][license-url]

<!-- TABLE OF CONTENTS -->

<!-- 
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#about-the-project">About The Project</a></li>
    <li><a href="#built-with">Built With</a></li>
    <li><a href="#getting-started">Getting Started</a></li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details> 

-->


<!-- ABOUT THE PROJECT -->
## 🗒️ About The Project

[![Product Name Screen Shot][product-screenshot]](https://github.com/agustheletter/SchoolApp-GuestBook)

Aplikasi **Website Buku Tamu Sekolah** berbasis Laravel dan template Admin LTE ini dirancang untuk mempermudah pencatatan serta pengelolaan data kunjungan tamu secara digital di lingkungan sekolah. Sistem ini mencatat data tamu, baik orang tua siswa maupun tamu umum, serta menghubungkan mereka dengan pegawai atau guru yang akan ditemui. Selain itu, aplikasi ini menyediakan laporan dan statistik kunjungan untuk kebutuhan administrasi serta meningkatkan keamanan dengan validasi data tamu, memastikan proses kunjungan lebih terstruktur dan efisien.

### Fitur Utama:
1. **Manajemen Pengguna**
   - Autentikasi dan otorisasi pengguna berdasarkan peran.
  
2. **Manajemen Data Kunjungan**
   - Mencatat kunjungan tamu ke sekolah, baik orang tua siswa maupun tamu umum.
   - Menghubungkan kunjungan dengan pegawai/guru yang akan ditemui.
   - Menyediakan formulir digital untuk pencatatan buku tamu.

3. **Laporan & Statistik**
   - Menyediakan laporan jumlah dan jenis kunjungan dalam periode tertentu.
   - Analisis data kunjungan untuk keperluan administrasi sekolah.  

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 🚀 Built With

### ⌨️ Teknologi yang digunakan
* [![Laravel][Laravel.com]][Laravel-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![Tailwind][Tailwindcss.com]][Tailwindcss-url]
* [![MySQL][MySQL.com]][MySQL-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## 🔝 Getting Started

Cara instalasi aplikasi **Buku Tamu Sekolah** ini di lokal:

### ⚙️ Prerequisites
- PHP 8.0+
- Composer
- MySQL

### Installation
1. Clone repositori
   ```sh
   git clone https://github.com/agustheletter/SchoolApp-GuestBook.git
   cd SchoolApp-GuestBook
   ```

2. Install dependencies
   ```sh
   composer install
   ```

3. Buat file `.env` dan konfigurasi database
   ```sh
   cp .env.example .env
   ```
   Edit file `.env` dan sesuaikan dengan konfigurasi database MySQL Anda:
   ```env
   DB_DATABASE=nama_database
   DB_USERNAME=username_database
   DB_PASSWORD=password_database
   ```

4. Generate application key
   ```sh
   php artisan key:generate
   ```

5. Migrate database
   ```sh
   php artisan migrate --seed
   ```

6. Jalankan server lokal
   ```sh
   php artisan serve
   ```
   Akses aplikasi di `http://127.0.0.1:8000`

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->
## 🗺️ Roadmap

- [x] Structure Website [@akuadre](https://github.com/akuadre) 👨🏻‍💻
- [x] Backend Development [@akuadre](https://github.com/akuadre) 🧑🏻‍💻
- [x] Desain Website [@evliyasatari](https://github.com/evliyasatari) 🧑🏻‍🎨
- [x] Frontend Development [@evliyasatari](https://github.com/evliyasatari) 👩🏻‍💻

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- CONTRIBUTING -->
## 🧑🏻‍🚀 Contributing

1. Fork repository ini.
2. Buat branch baru: `git checkout -b fitur-baru`
3. Commit perubahan: `git commit -m "Menambahkan fitur baru"`
4. Push ke branch: `git push origin fitur-baru`
5. Buat Pull Request.

### Top contributors:

<a href="https://github.com/agustheletter/SchoolApp-GuestBook/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=agustheletter/schoolapp-guestbook" alt="contrib.rocks image" />
</a>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->
## 📒 License

Proyek ini menggunakan lisensi **MIT**. Lihat `LICENSE.txt` untuk detail lebih lanjut.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->
## 💻 Contact

- Adrenalin - [@akuadre](https://github.com/akuadre) - adrefocus@gmail.com
- Evliya - [@evliyasatari](https://github.com/evliyasatari) - evliyasatarii@gmail.com

Project Link: [https://github.com/agustheletter/SchoolApp-GuestBook](https://github.com/agustheletter/SchoolApp-GuestBook)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## 🎖️ Acknowledgments

- [Laravel](https://laravel.com)
- [Admin LTE](https://adminlte.io)
- [Choose an Open Source License](https://choosealicense.com)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
[contributors-shield]: https://img.shields.io/github/contributors/agustheletter/SchoolApp-GuestBook.svg?style=for-the-badge
[contributors-url]: https://github.com/agustheletter/SchoolApp-GuestBook/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/agustheletter/SchoolApp-GuestBook.svg?style=for-the-badge
[forks-url]: https://github.com/agustheletter/SchoolApp-GuestBook/network/members
[stars-shield]: https://img.shields.io/github/stars/agustheletter/SchoolApp-GuestBook.svg?style=for-the-badge
[stars-url]: https://github.com/agustheletter/SchoolApp-GuestBook/stargazers
[issues-shield]: https://img.shields.io/github/issues/agustheletter/SchoolApp-GuestBook.svg?style=for-the-badge
[issues-url]: https://github.com/agustheletter/SchoolApp-GuestBook/issues
[license-shield]: https://img.shields.io/github/license/agustheletter/SchoolApp-GuestBook.svg?style=for-the-badge
[license-url]: https://github.com/agustheletter/SchoolApp-GuestBook/blob/master/LICENSE.txt
[product-screenshot]: git-src/guestbook-user.png
[admin-screenshot]: git-src/icon.png
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[Tailwindcss.com]: https://img.shields.io/badge/TailwindCSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white
[Tailwindcss-url]: https://tailwindcss.com
[MySQL.com]: https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com

