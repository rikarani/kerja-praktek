# Daftar Isi

- [Prerequisites](#prerequisites)
- [Tahap Instalasi](#tahap-instalasi)
- [Cara Dapatin Google Drive API Credentials](#cara-dapatin-google-drive-api-credentials)

# Prerequisites

> [!NOTE]
> Instalasi PHP dan MySQL bisa dipersingkat dengan install XAMPP, tapi cek versi PHP dari XAMPP untuk memastikan
> kompatibilitas dengan Laravel 12.

1. **PHP** : Pastikan PHP sudah terinstall di komputer. Project ini pake Laravel 12 yang butuh PHP versi 8.2 atau yang
   lebih baru.

2. **MySQL** : Pastikan MySQL sudah terinstall di komputer Anda. Laravel membutuhkan MySQL untuk menyimpan data
   aplikasi.

3. **Composer** : _Dependency manager_ untuk PHP yang digunakan untuk mengelola dependensi aplikasi
   Laravel.

4. **Google Cloud Account** : Anda perlu memiliki akun Google Cloud untuk menggunakan Google Drive API. Pastikan Anda
   sudah memiliki akun Google Cloud dan sudah membuat project di Google Cloud Console.

5. **Google Drive API Credentials** : Anda perlu membuat kredensial untuk Google Drive API di Google Cloud Console.
   Pastikan Anda sudah membuat kredensial untuk Google Drive API dan mendapatkan Client ID dan Client Secret yang
   diperlukan untuk mengakses Google Drive API.

6. **Node.js dan npm** : Node.js buat javascript runtime, sedaangkan npm (Node Package Manager) buat mengelola _package_
   JavaScript yang dibutuhkan untuk frontend.

7. **Git** : supaya tinggal clone aja projectnya

8. **IDE atau Code Editor** : Ini bebas aja sih, boleh pake VSCode, PhpStorm, Sublime Text, atau bahkan Notepad++.

9. **Browser** : ini yang paling penting.

# Tahap Instalasi

1. Clone repository ini ke komputer Anda menggunakan perintah berikut di terminal atau command prompt :
   ```bash
   git clone https://github.com/rikarani/kerja-praktek.git
   ```

2. Masuk ke direktori project yang sudah di-clone :
   ```bash
   cd kerja-praktek
    ```

3. Install dependensi laravel :
   ```bash
   composer install
   ```

4. Install dependensi frontend :
    ```bash
    npm install
    ```

5. copy file `.env.example` menjadi `.env` :
    - kalo di windows pake command ini
   ```bash
   copy .env.example .env
   ```

    - kalo di linux atau macOS pake command ini
    ```bash
    cp .env.example .env
    ```

6. Generate APP_KEY untuk laravel :
   ```bash
   php artisan key:generate
   ```

7. Konfigurasi file `.env`
    - Default password untuk user
    ```env
    APP_DEFAULT_PASSWORD=
    ```
    - Faker Locale
    ```env
    APP_FAKER_LOCALE=
    ```
    - Koneksi Database disesuaikan aja dengan komputer masing-masing
    ```env
    DB_CONNECTION=mysql
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
   ```
    - Google Drive API Credentials, cara dapatinnya bisa cek [di sini](#cara-dapatin-google-drive-api-credentials)
   ```env
   GOOGLE_DRIVE_CLIENT_ID=
   GOOGLE_DRIVE_CLIENT_SECRET=
   GOOGLE_DRIVE_REFRESH_TOKEN=
   GOOGLE_DRIVE_FOLDER=
   ```

8. Jalankan migrasi sekalian ama seedernya :
   ```bash
   php artisan migrate --seed
   ```

9. Jalankan server laravel :
    ```bash
    php artisan serve
    ```

10. Jalankan server frontend :
    ```bash
    npm run dev
    ```

11. Buka browser dan akses aplikasi di `http://localhost:8000`

# Cara Dapatin Google Drive API Credentials

1. Buka [Google Cloud Console](https://console.cloud.google.com/).

2. Buat project baru atau pilih project yang sudah ada.
   ![Bikin Project Baru](public/images/docs/step-2.png)

3. Masuk ke bagian "APIs & Services".
   ![APIs & Services](public/images/docs/step-3.png)

4. Klik "Enable APIs and Services".
   ![Enable APIs and Services](public/images/docs/step-4.png)

5. Scroll kebawah dikit nanti ketemu "Google Drive API", klik aja.
   ![Google Drive API](public/images/docs/step-5.png)

6. Klik "Enable" buat aktifin Google Drive API.
   ![Enable Google Drive API](public/images/docs/step-6.png)

7. Lanjut ke Tab "Credentials", kemudian klik "Create Credentials" dan pilih "OAuth client ID".
   ![Credentials Tab](public/images/docs/step-7.png)

8. Untuk pertama kali, biasanya diminta buat atur _Consent Screen_ terlebih dahulu. Klik aja "Configure consent screen",
   kemudia klik "Get started".
   ![OAuth Consent Screen](public/images/docs/step-8.png)
   ![Get Started](public/images/docs/step-9.png)

9. Step 1, isi nama aplikasi dan email support, lalu klik "Next".
   ![OAuth Consent Screen Step 1](public/images/docs/step-10.png)

10. Step 2, pilih "External", lalu klik "Next".
    ![OAuth Consent Screen Step 2](public/images/docs/step-11.png)

11. Step 3, Masukkan Email buat Contact Information, terus klik "Next".
    ![OAuth Consent Screen Step 3](public/images/docs/step-12.png)

12. Terakhir, centang checkbox, klik "Continue", lalu klik "Create".
    ![OAuth Consent Screen Step 4](public/images/docs/step-13.png)

13. Setelah selesai setup consent screen, klik "Create OAuth client".
    ![Create OAuth Client](public/images/docs/step-14.png)

14. Untuk "Application type", pilih "Web application".
    ![Create OAuth Client Form](public/images/docs/step-15.png)

15. Bagian "Name" bisa diisi sesuai keinginan, misalnya "Aplikasi Kerja Praktek".
    ![OAuth Client Name](public/images/docs/step-16.png)

16. Di bagian "Authorized JavaScript origins", klik "Add URI" dan masukkan `http://localhost:8000`.
    ![Authorized JavaScript Origins](public/images/docs/step-17.png)

17. Di bagian "Authorized redirect URIs", klik "Add URI" dan masukkan `http://localhost:8000/auth/google/callback`.
    ![Authorized Redirect URIs](public/images/docs/step-18.png)

18. Kalo dah selesai, nanti akan muncul pop-up yang berisi Client ID dan Client Secret.
    ![Client ID and Client Secret](public/images/docs/step-19.png)

19. Taruh Client ID dan Client Secret di file `.env`.
    ![Client ID and Client Secret in .env](public/images/docs/step-20.png)

20. Nah untuk dapetin _Refresh Token_ tuh tinggal buka URL `http://localhost:8000/token`, nanti langsung redirect ke
    milih akun google
    ![Get Refresh Token](public/images/docs/step-21.jpeg)

21. Kalo muncul gini, lanjutkan aja
    ![Allow Access](public/images/docs/step-22.jpeg)

22. Centang aja semua _permission_ yang diminta, trus klik "Lanjutkan"
    ![Permission](public/images/docs/step-23.jpeg)

23. Setelah itu bakal muncul halaman yang isinya banyak data. Karna yang dibutuhkan cuma "refresh_token", langsung aja
    copas trus taruh di file `.env`
    ![Refresh Token](public/images/docs/step-24.jpeg)

24. Nanti hasil akhirnya kek gini, untuk value "GOOGLE_DRIVE_FOLDER" mah disesuaikan aja dengan nama folder yang udah
    dibuat di google drive buat nampung dokumentasi kegiatan
    ![Refresh Token in .env](public/images/docs/step-25.jpeg)
