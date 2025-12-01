# WebApp Laundry - Manual Book

default aplikasi berada di DatabaseSeeder, dari **User** sampai **Menu**. Hal yang paling diperhatikan adalah bagaimana cara mengoperasikan Perizinan URL agar setiap Level (role) dapat mengakses Menu Navigasi yang sudah dibuat.
Terdapat setidaknya 10 daftar Navigasi yang tidak bisa dihapus, tetapi bisa di edit penamaannya, berikut adalah daftarnya:
|Nama Menu |URL|Kegunaan|
|-------------|------|--------|
| Level | /level | sebagai akses terhadap menu, penamaan juga berfungsi sebagai hirarki jabatan |
| User | /user | ini adalah akun-akun yang digunakan untuk login, setiap akun memiliki level. |
| Service | /service | Jenis layanan yang disediakan untuk pelanggan, atur harga dan deskripsinya |
| Customer | /customer | Simpan data pelanggan untuk menandakan setiap transaksi memiliki pelanggan |
| Menu | /menu | atur penamaan navigasi, bisa tambah tapi tidak bisa hapus dari baris 1 sampai 10 |
| Permission | /permission | atur menu yang dapat dibuka oleh setiap level |
| Transaction | /transaction | buat transaksi |
| Order | /order | riwayat transaksi |
| Pickup | /pickup | riwayat transaksi yang sudah diambil oleh pelanggan |
| Report | /report | berisi semua detail transaksi |

## Navigasi Menu

kamu mungkin tidak bisa melihat detail order dan print struk order, hal ini dikarenakan detail pesanan memiliki URL yang belum ditambahkan pada halaman menu, kamu bisa tambahkan url untuk print dengan nama /print dan detail dengan nama /detail, setelah itu atur masternya menjadi hidden;

## Tombol - Tombol

-   icon mata untuk melihat detail pesanan
-   Tambah data untuk menambahkan data baru
-   colom row untuk melakukan edit
