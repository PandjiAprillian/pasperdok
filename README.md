# PasPerDok (Pasien Perawat dan Dokter)

Web ini adalah adalah web sederhana dengan 4 role, yaitu pasien, perawat, dokter dan admin. Dengan tabel
yang sudah saling berelasi. Dan juga menggunakan package *laravel permission* dari [spatie.be](https://spatie.be/docs/laravel-permission/v4/introduction).

- Pasien bisa memilih penyakit yang di derita dan juga menuliskan keluhan yang di alami oleh pasien.
- Perawat bisa melihat pasien pasien dimana tempat ruangan perawat tersebut bekerja
- Dokter bisa melihat siapa saja pasien yang terdaftar ke dokter yang bersangkutan, karena ketika pasien memilih penyakit akan terhubung ke dokter spesialis yang memang di bidang penyakit tersebut. Lalu dokter juga bisa memutuskan apakah si pasien tersebut harus di rawat inap atau tidak, jika di rawat inap, maka dokter bisa memilih kamar untuk ditempati oleh pasien. (Jumlah maksimal pasien untuk 1 kamar hanya 2 orang).
- Admin bisa melihat dan melakukan CRUD terhadap semua data, dari data pasien, perawat, dokter, penyakit, ruangan, dan data admin itu sendiri, tetapi untuk edit dan delete admin hanya bisa dilakukan oleh admin yang login saja. Dalam artian, admin lain tidak bisa menghapus atau mengedit data admin lain, hanya dirinya sendiri.

* untuk email dan password admin, bisa di dilihat di bagian `database/seeders/AdminSeeder.php`

 ##### Web ini dibuat menggunakan [Laravel 8](https://laravel.com/docs/8.x)
