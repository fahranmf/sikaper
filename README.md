
<p align="center">
  <img src="https://github.com/user-attachments/assets/2fc402b7-01fc-4789-b0fd-32d7337c4a86" alt="Gausah Nanya Kalo Bukan Wita" width="1500" height="300"/>
</p>

<p align="center">
  <img width="400" alt="IMG_4706" src="https://github.com/user-attachments/assets/2caceb49-08b3-48c5-9903-b9777eade364" />
  <img width="400" alt="IMG_4708-removebg-preview" src="https://github.com/user-attachments/assets/eb90f717-d24f-43e9-a5d7-b8209f10d170" />
</p>


---
1. Clone Project dari GitHub

   ```
   git clone https://github.com/fahranmf/sikaper.git
   ```
   
2. Pindah directory

   ```
   cd sikaper
   ```
   
3. Install Dependency PHP

   ```
   composer install
   ```
   
4. Install Dependency Frontend

   ```
   npm install
   ```
   
5. Copy env

   ```
   cp .env.example .env
   ```
   
6. Ubah env

   ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_sikaper
    DB_USERNAME=root
    DB_PASSWORD=
   ```
   
8. Generate Laravel Key

   ```
   php artisan key:generate
   ```
   
9. Start Laragon jangan lupa, abis itu jalankan migrasi
   
   ```
   php artisan migrate
   ```
   
   pilih *yes*, lalu

   ```
   php artisan db:seed
   ```
   

10. Jalankan Storage Link

    ```
    php artisan storage:link
    ```
    
11. Jalankan Dev Server Laravel + Vite

    ```
    php artisan serve
    ```
    
    lalu

    ```
    npm run dev
    ```
    
---
<p align="center">
    <img src="https://github.com/user-attachments/assets/d1a7ea3d-68d6-45ba-96c2-bd3f6d044a30" alt="Gausah Nanya Kalo Bukan Wita" width="1500" height="300"/>
</p>


