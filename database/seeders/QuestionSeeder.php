<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $questions = [
        
            // =========================
            // SOAL 1
            // =========================
            [
                'question_text'     => 'Python adalah bahasa pemrograman yang terkenal karena...',

                'option_a'          => 'Sulit dipelajari',
                'option_b'          => 'Keterbacaan dan fleksibilitasnya',
                'option_c'          => 'Hanya untuk membuat game',
                'option_d'          => 'Tidak mendukung AI',
                'correct_answer'    => 'B',
                'explanation'       => 'Python terkenal karena sintaksnya mudah dibaca dan fleksibel digunakan di banyak bidang.',
                'is_practice'       => false,
                'target_class'      => '7',
            ],

            // =========================
            // SOAL 2
            // =========================
            [
                'question_text'     => 'Siapa pengembang Python?',

                'option_a'          => 'Bill Gates',
                'option_b'          => 'Elon Musk',
                'option_c'          => 'Guido van Rossum',
                'option_d'          => 'Mark Zuckerberg',
                'correct_answer'    => 'C',
                'explanation'       => 'Python dikembangkan oleh Guido van Rossum pada akhir 1980-an.',
                'is_practice'       => false,
                'target_class'      => '7',
            ],

            // =========================
            // SOAL 3
            // =========================
            [
                'question_text'     => 'Berikut yang BUKAN penggunaan Python adalah...',

                'option_a'          => 'Analisis data',
                'option_b'          => 'Pengembangan web',
                'option_c'          => 'Mengedit video manual',
                'option_d'          => 'Kecerdasan buatan',
                'correct_answer'    => 'C',
                'explanation'       => 'Python digunakan di banyak bidang teknologi, bukan untuk edit video manual.',
                'is_practice'       => false,
                'target_class'      => '7',
            ],

            // =========================
            // SOAL 4
            // =========================
            [
                'question_text'     => 'Edublock adalah...',

                'option_a'          => 'Bahasa pemrograman baru',
                'option_b'          => 'Sistem operasi',
                'option_c'          => 'Alat pemrograman berbasis blok visual',
                'option_d'          => 'Mesin database',
                'correct_answer'    => 'C',
                'explanation'       => 'Edublock membantu transisi dari block coding ke text coding.',
                'is_practice'       => false,
                'target_class'      => '7',
            ],

            // =========================
            // SOAL 5
            // =========================
            [
                'question_text'     => 'Fungsi tombol Run pada Edublock adalah...',

                'option_a'          => 'Menghapus program',
                'option_b'          => 'Menjalankan program',
                'option_c'          => 'Menutup aplikasi',
                'option_d'          => 'Mengganti tema',
                'correct_answer'    => 'B',
                'explanation'       => 'Tombol Run digunakan untuk menjalankan program.',
                'is_practice'       => false,
                'target_class'      => '7',
            ],

            // =========================
            // SOAL 6
            // =========================
            [
                'question_text'     => 'Fungsi print() adalah...',

                'option_a'          => 'Menerima input',
                'option_b'          => 'Menghapus data',
                'option_c'          => 'Menampilkan output',
                'option_d'          => 'Menyimpan file',
                'correct_answer'    => 'C',
                'explanation'       => 'print() digunakan untuk menampilkan hasil ke layar.',
                'is_practice' => false,
                'target_class' => '7',
            ],

            // =========================
            // SOAL 7
            // =========================
            [
                'question_text'     => 'Fungsi input() adalah...',

                'option_a'          => 'Menampilkan teks',
                'option_b'          => 'Mengambil masukan dari pengguna',
                'option_c'          => 'Mengulang program',
                'option_d'          => 'Menghapus variabel',
                'correct_answer'    => 'B',
                'explanation'       => 'input() digunakan menerima data dari user.'
            ],

            // =========================
            // SOAL 8
            // =========================
            [
                'question_text'     => 'Manakah nama variabel yang benar?',

                'option_a'          => '1nilai',
                'option_b'          => 'nama siswa',
                'option_c'          => 'nama_siswa',
                'option_d'          => 'nama@siswa',
                'correct_answer'    => 'C',
                'explanation'       => 'Variabel tidak boleh diawali angka, memakai spasi, atau simbol khusus.'
            ],

            // =========================
            // SOAL 9
            // =========================
            [
                'question_text'     => 'Operator untuk penjumlahan adalah...',

                'option_a'          => '-',
                'option_b'          => '*',
                'option_c'          => '+',
                'option_d'          => '/',
                'correct_answer'    => 'C',
                'explanation'       => 'Tanda + digunakan untuk operasi tambah.'
            ],

            // =========================
            // SOAL 10
            // =========================
            [
                'question_text'     => 'Hasil dari 10 % 3 adalah...',

                'option_a'          => '3',
                'option_b'          => '1',
                'option_c'          => '0',
                'option_d'          => '10',
                'correct_answer'    => 'B',
                'explanation'       => 'Operator modulus mengambil sisa pembagian. 10 dibagi 3 sisanya 1.'
            ],

            // =========================
            // SOAL 11
            // =========================
            [
                'question_text'     => 'Operator aritmatika digunakan untuk...',

                'option_a'          => 'Membandingkan data',
                'option_b'          => 'Mengulang program',
                'option_c'          => 'Operasi matematika',
                'option_d'          => 'Membuat list',
                'correct_answer'    => 'C',
                'explanation'       => 'Operator aritmatika digunakan untuk perhitungan matematika.'
            ],

            // =========================
            // SOAL 12
            // =========================
            [
                'question_text'     => 'nilai = 90 artinya...',

                'option_a'          => 'Membandingkan nilai',
                'option_b'          => 'Menyimpan 90 ke variabel nilai',
                'option_c'          => 'Menghapus nilai',
                'option_d'          => 'Menampilkan nilai',
                'correct_answer'    => 'B',
                'explanation'       => 'Tanda = digunakan untuk memasukkan nilai ke variabel.'
            ],

            // =========================
            // SOAL 13
            // =========================
            [
                'question_text'     => 'Tipe data Boolean memiliki nilai...',

                'option_a'          => 'Ya dan Tidak',
                'option_b'          => '1 dan 0',
                'option_c'          => 'True dan False',
                'option_d'          => 'Besar dan kecil',
                'correct_answer'    => 'C',
                'explanation'       => 'Boolean hanya memiliki dua nilai yaitu True dan False.'
            ],

            // =========================
            // SOAL 14
            // =========================
            [
                'question_text'     => 'Operator == berarti...',

                'option_a'          => 'Tidak sama dengan',
                'option_b'          => 'Sama dengan',
                'option_c'          => 'Lebih besar',
                'option_d'          => 'Penjumlahan',
                'correct_answer'    => 'B',
                'explanation'       => 'Operator == digunakan untuk membandingkan apakah dua nilai sama.'
            ],

            // =========================
            // SOAL 15
            // =========================
            [
                'question_text'     => 'Operator != berarti...',

                'option_a'          => 'Sama dengan',
                'option_b'          => 'Lebih kecil',
                'option_c'          => 'Tidak sama dengan',
                'option_d'          => 'Kurang dari sama dengan',
                'correct_answer'    => 'C',
                'explanation'       => 'Operator != berarti kedua nilai berbeda.'
            ],

            // =========================
            // SOAL 16
            // =========================
            [
                'question_text'     => 'Hasil dari 5 > 2 adalah...',

                'option_a'          => 'False',
                'option_b'          => 'True',
                'option_c'          => 'Error',
                'option_d'          => '5',
                'correct_answer'    => 'B',
                'explanation'       => '5 memang lebih besar dari 2 sehingga hasilnya True.'
            ],

            // =========================
            // SOAL 17
            // =========================
            [
                'question_text'     => 'Operator logika digunakan untuk...',

                'option_a'          => 'Operasi hitung',
                'option_b'          => 'Menggabungkan kondisi',
                'option_c'          => 'Membuat list',
                'option_d'          => 'Menampilkan output',
                'correct_answer'    => 'B',
                'explanation'       => 'Operator logika dipakai untuk menghubungkan beberapa kondisi.'
            ],

            // =========================
            // SOAL 18
            // =========================
            [
                'question_text'     => 'Percabangan digunakan untuk...',

                'option_a'          => 'Mengulang program',
                'option_b'          => 'Menyimpan data',
                'option_c'          => 'Mengambil keputusan',
                'option_d'          => 'Menghapus variabel',
                'correct_answer'    => 'C',
                'explanation'       => 'Percabangan membuat program bisa memilih aksi berdasarkan kondisi.'
            ],

            // =========================
            // SOAL 19
            // =========================
            [
                'question_text'     => 'Struktur dasar percabangan adalah...',

                'option_a'          => 'for',
                'option_b'          => 'while',
                'option_c'          => 'if',
                'option_d'          => 'range',
                'correct_answer'    => 'C',
                'explanation'       => 'if adalah dasar pengkondisian dalam Python.'
            ],

            // =========================
            // SOAL 20
            // =========================
            [
                'question_text'     => 'Bagian else akan dijalankan ketika...',

                'option_a'          => 'Kondisi benar',
                'option_b'          => 'Program error',
                'option_c'          => 'Kondisi salah',
                'option_d'          => 'Semua kondisi benar',
                'correct_answer'    => 'C',
                'explanation'       => 'else dijalankan jika kondisi pada if bernilai False.'
            ],

            // =========================
            // SOAL 21
            // =========================
            [
                'question_text'     => 'elif digunakan untuk...',

                'option_a'          => 'Mengulang data',
                'option_b'          => 'Menambah variabel',
                'option_c'          => 'Memeriksa kondisi tambahan',
                'option_d'          => 'Menghapus kondisi',
                'correct_answer'    => 'C',
                'explanation'       => 'elif digunakan jika ada lebih dari satu kondisi yang diperiksa.'
            ],

            // =========================
            // SOAL 22
            // =========================
            [
                'question_text'     => 'Manakah contoh percabangan yang benar?',

                'option_a'          => 'if nilai > 70',
                'option_b'          => 'if nilai > 70:',
                'option_c'          => 'nilai if > 70',
                'option_d'          => 'if: nilai > 70',
                'correct_answer'    => 'B',
                'explanation'       => 'Pada Python setelah kondisi if harus ada tanda titik dua (:).'
            ],

            // =========================
            // SOAL 23
            // =========================
            [
                'question_text'     => 'Looping digunakan untuk...',

                'option_a'          => 'Membandingkan data',
                'option_b'          => 'Menjalankan kode berulang',
                'option_c'          => 'Menyimpan file',
                'option_d'          => 'Menghapus data',
                'correct_answer'    => 'B',
                'explanation'       => 'Loop digunakan agar program bisa mengulang perintah secara otomatis.'
            ],

            // =========================
            // SOAL 24
            // =========================
            [
                'question_text'     => 'Perulangan yang cocok jika jumlah pengulangan sudah diketahui adalah...',

                'option_a'          => 'if',
                'option_b'          => 'else',
                'option_c'          => 'for',
                'option_d'          => 'input',
                'correct_answer'    => 'C',
                'explanation'       => 'for digunakan jika jumlah pengulangannya sudah jelas.'
            ],

            // =========================
            // SOAL 25
            // =========================
            [
                'question_text'     => 'Perulangan yang berjalan berdasarkan kondisi adalah...',

                'option_a'          => 'for',
                'option_b'          => 'while',
                'option_c'          => 'if',
                'option_d'          => 'print',
                'correct_answer'    => 'B',
                'explanation'       => 'while akan terus berjalan selama kondisi bernilai True.'
            ],

            // =========================
            // SOAL 26
            // =========================
            [
                'question_text'     => 'range(5) menghasilkan pengulangan sebanyak...',

                'option_a'          => '4',
                'option_b'          => '5',
                'option_c'          => '6',
                'option_d'          => 'Tak hingga',
                'correct_answer'    => 'B',
                'explanation'       => 'range(5) menghasilkan angka 0 sampai 4, jadi total 5 kali pengulangan.'
            ],

            // =========================
            // SOAL 27
            // =========================
            [
                'question_text'     => 'Nested loop adalah...',

                'option_a'          => 'Loop tanpa kondisi',
                'option_b'          => 'Loop di dalam loop',
                'option_c'          => 'Variabel di dalam list',
                'option_d'          => 'Percabangan bertingkat',
                'correct_answer'    => 'B',
                'explanation'       => 'Nested loop berarti ada perulangan di dalam perulangan lain.'
            ],

            // =========================
            // SOAL 28
            // =========================
            [
                'question_text'     => 'Pada nested loop, loop dalam akan...',

                'option_a'          => 'Berjalan sekali saja',
                'option_b'          => 'Tidak pernah selesai',
                'option_c'          => 'Selesai dahulu sebelum loop luar lanjut',
                'option_d'          => 'Menghentikan loop luar',
                'correct_answer'    => 'C',
                'explanation'       => 'Inner loop harus selesai dulu sebelum outer loop lanjut.'
            ],

            // =========================
            // SOAL 29
            // =========================
            [
                'question_text'     => 'List adalah...',

                'option_a'          => 'Operator logika',
                'option_b'          => 'Tempat menyimpan banyak data dalam satu variabel',
                'option_c'          => 'Percabangan',
                'option_d'          => 'Pengulangan',
                'correct_answer'    => 'B',
                'explanation'       => 'List digunakan untuk menyimpan banyak data sekaligus.'
            ],

            // =========================
            // SOAL 30
            // =========================
            [
                'question_text'     => 'Index pertama pada list adalah...',

                'option_a'          => '1',
                'option_b'          => '-1',
                'option_c'          => '0',
                'option_d'          => '10',
                'correct_answer'    => 'C',
                'explanation'       => 'Python memulai index list dari angka 0.'
            ],

            // =========================
            // SOAL 31
            // =========================
            [
                'question_text'     => 'Jika buah = ["apel", "mangga", "jeruk"], maka buah[1] adalah...',

                'option_a'          => 'apel',
                'option_b'          => 'mangga',
                'option_c'          => 'jeruk',
                'option_d'          => 'error',
                'correct_answer'    => 'B',
                'explanation'       => 'Index ke-1 berarti data kedua dalam list, yaitu mangga.'
            ],

            // =========================
            // SOAL 32
            // =========================
            [
                'question_text'     => 'Fungsi list dalam pemrograman adalah...',

                'option_a'          => 'Menampilkan output',
                'option_b'          => 'Menyimpan banyak data',
                'option_c'          => 'Mengulang program',
                'option_d'          => 'Membuat kondisi',
                'correct_answer'    => 'B',
                'explanation'       => 'List dipakai untuk menyimpan banyak nilai dalam satu variabel.'
            ],

            // =========================
            // SOAL 33
            // =========================
            [
                'question_text'     => 'Hasil dari 10 <= 5 adalah...',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '10',
                'option_d'          => 'Error',
                'correct_answer'    => 'B',
                'explanation'       => '10 tidak lebih kecil atau sama dengan 5 sehingga hasilnya False.'
            ],

            // =========================
            // SOAL 34
            // =========================
            [
                'question_text'     => 'Berikut yang termasuk operator perbandingan adalah...',

                'option_a'          => '+',
                'option_b'          => '*',
                'option_c'          => '>=',
                'option_d'          => '%',
                'correct_answer'    => 'C',
                'explanation'       => '>= adalah operator perbandingan yang berarti lebih besar atau sama dengan.'
            ],

            // =========================
            // SOAL 35
            // =========================
            [
                'question_text'     => 'Tujuan utama penggunaan looping adalah...',

                'option_a'          => 'Membuat program lebih panjang',
                'option_b'          => 'Menghindari penulisan kode berulang',
                'option_c'          => 'Menghapus variabel',
                'option_d'          => 'Membuat error',
                'correct_answer'    => 'B',
                'explanation'       => 'Looping membuat program lebih singkat dan efisien karena tidak perlu menulis kode berulang.'
            ],

            // =========================
            // SOAL 36
            // =========================
            [
                'question_text'     => 'Apa output dari kode berikut? print(2 + 3 * 2)',

                'option_a'          => '10',
                'option_b'          => '12',
                'option_c'          => '8',
                'option_d'          => '7',
                'correct_answer'    => 'C',
                'explanation'       => 'Perkalian dikerjakan lebih dulu. 3 x 2 = 6 lalu ditambah 2 menjadi 8.'
            ],

            // =========================
            // SOAL 37
            // =========================
            [
                'question_text'     => 'Apa hasil dari 15 // 2 ?',

                'option_a'          => '7.5',
                'option_b'          => '7',
                'option_c'          => '8',
                'option_d'          => '1',
                'correct_answer'    => 'B',
                'explanation'       => '// adalah pembagian bulat. Jadi 15 dibagi 2 hasil bulatnya 7.'
            ],

            // =========================
            // SOAL 38
            // =========================
            [
                'question_text'     => 'Manakah yang termasuk tipe data string?',

                'option_a'          => '15',
                'option_b'          => 'True',
                'option_c'          => '"Halo"',
                'option_d'          => '20.5',
                'correct_answer'    => 'C',
                'explanation'       => 'String adalah teks dan biasanya ditulis di dalam tanda kutip.'
            ],

            // =========================
            // SOAL 39
            // =========================
            [
                'question_text'     => 'Apa fungsi variabel dalam pemrograman?',

                'option_a'          => 'Menghapus program',
                'option_b'          => 'Menyimpan data',
                'option_c'          => 'Menutup aplikasi',
                'option_d'          => 'Membuat error',
                'correct_answer'    => 'B',
                'explanation'       => 'Variabel digunakan untuk menyimpan data agar bisa dipakai kembali.'
            ],

            // =========================
            // SOAL 40
            // =========================
            [
                'question_text'     => 'Perhatikan kode berikut: umur = 14. Apa isi variabel umur?',

                'option_a'          => '14',
                'option_b'          => 'umur',
                'option_c'          => '=',
                'option_d'          => 'Error',
                'correct_answer'    => 'A',
                'explanation'       => 'Variabel umur menyimpan nilai 14.'
            ],

            // =========================
            // SOAL 41
            // =========================
            [
                'question_text'     => 'Apa hasil dari 20 - 5 * 2 ?',

                'option_a'          => '30',
                'option_b'          => '10',
                'option_c'          => '20',
                'option_d'          => '15',
                'correct_answer'    => 'B',
                'explanation'       => 'Perkalian lebih dulu: 5 x 2 = 10, lalu 20 - 10 = 10.'
            ],

            // =========================
            // SOAL 42
            // =========================
            [
                'question_text'     => 'Operator > digunakan untuk...',

                'option_a'          => 'Kurang dari',
                'option_b'          => 'Lebih besar dari',
                'option_c'          => 'Tidak sama dengan',
                'option_d'          => 'Penjumlahan',
                'correct_answer'    => 'B',
                'explanation'       => '> digunakan untuk membandingkan apakah nilai kiri lebih besar.'
            ],

            // =========================
            // SOAL 43
            // =========================
            [
                'question_text'     => 'Apa hasil dari 8 < 3 ?',

                'option_a'          => 'True',
                'option_b'          => '8',
                'option_c'          => 'False',
                'option_d'          => '3',
                'correct_answer'    => 'C',
                'explanation'       => '8 tidak lebih kecil dari 3, maka hasilnya False.'
            ],

            // =========================
            // SOAL 44
            // =========================
            [
                'question_text'     => 'Manakah operator yang berarti lebih kecil atau sama dengan?',

                'option_a'          => '>=',
                'option_b'          => '<=',
                'option_c'          => '==',
                'option_d'          => '!=',
                'correct_answer'    => 'B',
                'explanation'       => '<= berarti lebih kecil atau sama dengan.'
            ],

            // =========================
            // SOAL 45
            // =========================
            [
                'question_text'     => 'Apa hasil dari True dan False?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => 'Error',
                'option_d'          => '1',
                'correct_answer'    => 'B',
                'explanation'       => 'Operator AND hanya menghasilkan True jika semua kondisi benar.'
            ],

            // =========================
            // SOAL 46
            // =========================
            [
                'question_text'     => 'Apa hasil dari True or False?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '0',
                'option_d'          => 'Error',
                'correct_answer'    => 'A',
                'explanation'       => 'OR akan menghasilkan True jika salah satu kondisi benar.'
            ],

            // =========================
            // SOAL 47
            // =========================
            [
                'question_text'     => 'if digunakan ketika...',

                'option_a'          => 'Ingin mengulang program',
                'option_b'          => 'Ingin membuat keputusan berdasarkan kondisi',
                'option_c'          => 'Ingin membuat list',
                'option_d'          => 'Ingin menghapus data',
                'correct_answer'    => 'B',
                'explanation'       => 'if digunakan untuk memeriksa kondisi tertentu.'
            ],

            // =========================
            // SOAL 48
            // =========================
            [
                'question_text'     => 'Apa output dari kode berikut jika nilai = 50? if nilai >= 75: print("Lulus") else: print("Tidak Lulus")',

                'option_a'          => 'Lulus',
                'option_b'          => '50',
                'option_c'          => 'Tidak Lulus',
                'option_d'          => 'Error',
                'correct_answer'    => 'C',
                'explanation'       => 'Karena 50 kurang dari 75 maka kondisi salah dan else dijalankan.'
            ],

            // =========================
            // SOAL 49
            // =========================
            [
                'question_text'     => 'Apa fungsi elif dalam percabangan?',

                'option_a'          => 'Mengulang kode',
                'option_b'          => 'Membuat kondisi tambahan',
                'option_c'          => 'Menghapus kondisi',
                'option_d'          => 'Menyimpan data',
                'correct_answer'    => 'B',
                'explanation'       => 'elif dipakai jika ada beberapa kondisi yang ingin diperiksa.'
            ],

            // =========================
            // SOAL 50
            // =========================
            [
                'question_text'     => 'Apa output dari range(3)?',

                'option_a'          => '1 2 3',
                'option_b'          => '0 1 2',
                'option_c'          => '0 1 2 3',
                'option_d'          => '1 2',
                'correct_answer'    => 'B',
                'explanation'       => 'range(3) menghasilkan angka mulai dari 0 sampai sebelum 3.'
            ],

            // =========================
            // SOAL 51
            // =========================
            [
                'question_text'     => 'Apa fungsi for dalam Python?',

                'option_a'          => 'Percabangan',
                'option_b'          => 'Pengulangan',
                'option_c'          => 'Input data',
                'option_d'          => 'Menghapus data',
                'correct_answer'    => 'B',
                'explanation'       => 'for digunakan untuk melakukan pengulangan sejumlah tertentu.'
            ],

            // =========================
            // SOAL 52
            // =========================
            [
                'question_text'     => 'Perhatikan kode berikut: for i in range(2): print("Halo"). Berapa kali Halo muncul?',

                'option_a'          => '1',
                'option_b'          => '2',
                'option_c'          => '3',
                'option_d'          => '4',
                'correct_answer'    => 'B',
                'explanation'       => 'range(2) berarti pengulangan dilakukan 2 kali.'
            ],

            // =========================
            // SOAL 53
            // =========================
            [
                'question_text'     => 'While loop akan berhenti ketika...',

                'option_a'          => 'Kondisi True',
                'option_b'          => 'Kondisi False',
                'option_c'          => 'Ada print',
                'option_d'          => 'Ada variabel',
                'correct_answer'    => 'B',
                'explanation'       => 'while hanya berjalan selama kondisi masih True.'
            ],

            // =========================
            // SOAL 54
            // =========================
            [
                'question_text'     => 'Apa kegunaan nested loop?',

                'option_a'          => 'Membuat pengulangan bertingkat',
                'option_b'          => 'Menghapus variabel',
                'option_c'          => 'Membuat input',
                'option_d'          => 'Menyimpan file',
                'correct_answer'    => 'A',
                'explanation'       => 'Nested loop dipakai saat ada pengulangan di dalam pengulangan.'
            ],

            // =========================
            // SOAL 55
            // =========================
            [
                'question_text'     => 'Apa output dari kode berikut? for i in range(3): print(i)',

                'option_a'          => '1 2 3',
                'option_b'          => '0 1 2',
                'option_c'          => '0 1 2 3',
                'option_d'          => '3',
                'correct_answer'    => 'B',
                'explanation'       => 'range(3) menghasilkan angka 0, 1, dan 2.'
            ],

            // =========================
            // SOAL 56
            // =========================
            [
                'question_text'     => 'List dalam Python ditulis menggunakan...',

                'option_a'          => '()',
                'option_b'          => '{}',
                'option_c'          => '[]',
                'option_d'          => '<>',
                'correct_answer'    => 'C',
                'explanation'       => 'List menggunakan tanda kurung siku [].'
            ],

            // =========================
            // SOAL 57
            // =========================
            [
                'question_text'     => 'Jika angka = [1,2,3], maka angka[0] adalah...',

                'option_a'          => '0',
                'option_b'          => '1',
                'option_c'          => '2',
                'option_d'          => '3',
                'correct_answer'    => 'B',
                'explanation'       => 'Index pertama list dimulai dari 0.'
            ],

            // =========================
            // SOAL 58
            // =========================
            [
                'question_text'     => 'Apa fungsi index pada list?',

                'option_a'          => 'Menghapus data',
                'option_b'          => 'Menentukan posisi data',
                'option_c'          => 'Mengulang data',
                'option_d'          => 'Menampilkan error',
                'correct_answer'    => 'B',
                'explanation'       => 'Index membantu mengambil data tertentu dalam list.'
            ],

            // =========================
            // SOAL 59
            // =========================
            [
                'question_text'     => 'Apa hasil dari 9 % 2 ?',

                'option_a'          => '4',
                'option_b'          => '1',
                'option_c'          => '0',
                'option_d'          => '2',
                'correct_answer'    => 'B',
                'explanation'       => '9 dibagi 2 sisanya 1.'
            ],

            // =========================
            // SOAL 60
            // =========================
            [
                'question_text'     => 'Apa hasil dari 4 * 5 + 2 ?',

                'option_a'          => '22',
                'option_b'          => '30',
                'option_c'          => '20',
                'option_d'          => '18',
                'correct_answer'    => 'A',
                'explanation'       => 'Perkalian lebih dulu: 4 x 5 = 20 lalu ditambah 2 menjadi 22.'
            ],

            // =========================
            // SOAL 61
            // =========================
            [
                'question_text'     => 'Apa hasil dari 12 / 3 ?',

                'option_a'          => '3',
                'option_b'          => '4',
                'option_c'          => '6',
                'option_d'          => '9',
                'correct_answer'    => 'B',
                'explanation'       => '12 dibagi 3 hasilnya 4.'
            ],

            // =========================
            // SOAL 62
            // =========================
            [
                'question_text'     => 'Apa output dari print("Python") ?',

                'option_a'          => 'print',
                'option_b'          => 'Python',
                'option_c'          => '"Python"',
                'option_d'          => 'Error',
                'correct_answer'    => 'B',
                'explanation'       => 'print() akan menampilkan isi di dalamnya.'
            ],

            // =========================
            // SOAL 63
            // =========================
            [
                'question_text'     => 'Manakah yang merupakan operator pembagian?',

                'option_a'          => '+',
                'option_b'          => '-',
                'option_c'          => '/',
                'option_d'          => '%',
                'correct_answer'    => 'C',
                'explanation'       => '/ digunakan untuk operasi pembagian.'
            ],

            // =========================
            // SOAL 64
            // =========================
            [
                'question_text'     => 'Apa fungsi tanda : setelah if?',

                'option_a'          => 'Penutup program',
                'option_b'          => 'Penanda awal blok kode',
                'option_c'          => 'Operator',
                'option_d'          => 'Komentar',
                'correct_answer'    => 'B',
                'explanation'       => 'Titik dua menandakan bahwa ada blok kode setelah if.'
            ],

            // =========================
            // SOAL 65
            // =========================
            [
                'question_text'     => 'Apa hasil dari 7 == 8 ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '7',
                'option_d'          => '8',
                'correct_answer'    => 'B',
                'explanation'       => '7 tidak sama dengan 8 sehingga hasilnya False.'
            ],

            // =========================
            // SOAL 66
            // =========================
            [
                'question_text'     => 'Apa hasil dari 7 != 8 ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '7',
                'option_d'          => 'Error',
                'correct_answer'    => 'A',
                'explanation'       => '7 memang tidak sama dengan 8 sehingga hasilnya True.'
            ],

            // =========================
            // SOAL 67
            // =========================
            [
                'question_text'     => 'Apa yang dimaksud output?',

                'option_a'          => 'Data yang dimasukkan',
                'option_b'          => 'Hasil yang ditampilkan program',
                'option_c'          => 'Variabel',
                'option_d'          => 'Pengulangan',
                'correct_answer'    => 'B',
                'explanation'       => 'Output adalah hasil yang muncul dari program.'
            ],

            // =========================
            // SOAL 68
            // =========================
            [
                'question_text'     => 'Apa yang dimaksud input?',

                'option_a'          => 'Data yang dimasukkan pengguna',
                'option_b'          => 'Hasil program',
                'option_c'          => 'Percabangan',
                'option_d'          => 'Looping',
                'correct_answer'    => 'A',
                'explanation'       => 'Input adalah data yang diberikan user ke program.'
            ],

            // =========================
            // SOAL 69
            // =========================
            [
                'question_text'     => 'Apa hasil dari 100 > 50 ?',

                'option_a'          => 'False',
                'option_b'          => 'True',
                'option_c'          => '100',
                'option_d'          => '50',
                'correct_answer'    => 'B',
                'explanation'       => '100 memang lebih besar dari 50.'
            ],

            // =========================
            // SOAL 70
            // =========================
            [
                'question_text'     => 'Apa tujuan penggunaan variabel?',

                'option_a'          => 'Menyimpan data agar bisa digunakan kembali',
                'option_b'          => 'Menghapus program',
                'option_c'          => 'Menghentikan looping',
                'option_d'          => 'Membuat error',
                'correct_answer'    => 'A',
                'explanation'       => 'Variabel membantu menyimpan data dalam program.'
            ],

            // =========================
            // SOAL 71
            // =========================
            [
                'question_text'     => 'Apa hasil dari 25 + 5 / 5 ?',

                'option_a'          => '6',
                'option_b'          => '26',
                'option_c'          => '30',
                'option_d'          => '5',
                'correct_answer'    => 'B',
                'explanation'       => 'Pembagian dikerjakan lebih dulu. 5 / 5 = 1 lalu 25 + 1 = 26.'
            ],

            // =========================
            // SOAL 72
            // =========================
            [
                'question_text'     => 'Manakah penulisan variabel yang salah?',

                'option_a'          => 'nama_siswa',
                'option_b'          => 'nilai1',
                'option_c'          => '1nilai',
                'option_d'          => 'umur',
                'correct_answer'    => 'C',
                'explanation'       => 'Variabel tidak boleh diawali angka.'
            ],

            // =========================
            // SOAL 73
            // =========================
            [
                'question_text'     => 'Apa hasil dari 6 <= 6 ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '6',
                'option_d'          => 'Error',
                'correct_answer'    => 'A',
                'explanation'       => '6 sama dengan 6 sehingga hasilnya True.'
            ],

            // =========================
            // SOAL 74
            // =========================
            [
                'question_text'     => 'Apa fungsi else pada percabangan?',

                'option_a'          => 'Menjalankan aksi jika kondisi salah',
                'option_b'          => 'Mengulang program',
                'option_c'          => 'Membuat variabel',
                'option_d'          => 'Menghapus data',
                'correct_answer'    => 'A',
                'explanation'       => 'else dijalankan ketika kondisi if tidak terpenuhi.'
            ],

            // =========================
            // SOAL 75
            // =========================
            [
                'question_text'     => 'Apa output dari kode berikut? if 5 > 3: print("Benar")',

                'option_a'          => 'Salah',
                'option_b'          => 'Benar',
                'option_c'          => '5 > 3',
                'option_d'          => 'Error',
                'correct_answer'    => 'B',
                'explanation'       => 'Karena 5 lebih besar dari 3 maka kondisi bernilai True.'
            ],

            // =========================
            // SOAL 76
            // =========================
            [
                'question_text'     => 'Apa hasil dari False or False ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '1',
                'option_d'          => 'Error',
                'correct_answer'    => 'B',
                'explanation'       => 'OR hanya menghasilkan False jika semua kondisi False.'
            ],

            // =========================
            // SOAL 77
            // =========================
            [
                'question_text'     => 'Apa hasil dari True and True ?',

                'option_a'          => 'False',
                'option_b'          => '0',
                'option_c'          => 'True',
                'option_d'          => 'Error',
                'correct_answer'    => 'C',
                'explanation'       => 'AND menghasilkan True jika semua kondisi benar.'
            ],

            // =========================
            // SOAL 78
            // =========================
            [
                'question_text'     => 'Apa hasil dari 3 * 3 + 1 ?',

                'option_a'          => '12',
                'option_b'          => '10',
                'option_c'          => '9',
                'option_d'          => '7',
                'correct_answer'    => 'B',
                'explanation'       => '3 x 3 = 9 lalu ditambah 1 menjadi 10.'
            ],

            // =========================
            // SOAL 79
            // =========================
            [
                'question_text'     => 'Apa fungsi range() pada looping?',

                'option_a'          => 'Menyimpan data',
                'option_b'          => 'Menentukan jumlah pengulangan',
                'option_c'          => 'Menghapus variabel',
                'option_d'          => 'Membuat input',
                'correct_answer'    => 'B',
                'explanation'       => 'range() membantu menentukan berapa kali loop berjalan.'
            ],

            // =========================
            // SOAL 80
            // =========================
            [
                'question_text'     => 'Apa hasil dari range(4)?',

                'option_a'          => '0 1 2 3',
                'option_b'          => '1 2 3 4',
                'option_c'          => '0 1 2 3 4',
                'option_d'          => '4',
                'correct_answer'    => 'A',
                'explanation'       => 'range(4) menghasilkan angka dari 0 sampai sebelum 4.'
            ],

            // =========================
            // SOAL 81
            // =========================
            [
                'question_text'     => 'Apa output dari print(4 + 4)?',

                'option_a'          => '44',
                'option_b'          => '8',
                'option_c'          => '4 + 4',
                'option_d'          => 'Error',
                'correct_answer'    => 'B',
                'explanation'       => 'Python akan menghitung 4 + 4 menjadi 8.'
            ],

            // =========================
            // SOAL 82
            // =========================
            [
                'question_text'     => 'Apa fungsi komentar dalam kode program?',

                'option_a'          => 'Dijalankan komputer',
                'option_b'          => 'Menjelaskan kode',
                'option_c'          => 'Menghapus error',
                'option_d'          => 'Membuat looping',
                'correct_answer'    => 'B',
                'explanation'       => 'Komentar membantu programmer memahami kode.'
            ],

            // =========================
            // SOAL 83
            // =========================
            [
                'question_text'     => 'Apa hasil dari 14 % 4 ?',

                'option_a'          => '2',
                'option_b'          => '3',
                'option_c'          => '4',
                'option_d'          => '0',
                'correct_answer'    => 'A',
                'explanation'       => '14 dibagi 4 sisanya 2.'
            ],

            // =========================
            // SOAL 84
            // =========================
            [
                'question_text'     => 'Apa hasil dari 9 >= 10 ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '9',
                'option_d'          => '10',
                'correct_answer'    => 'B',
                'explanation'       => '9 tidak lebih besar atau sama dengan 10.'
            ],

            // =========================
            // SOAL 85
            // =========================
            [
                'question_text'     => 'Apa hasil dari print("Halo" + " Dunia") ?',

                'option_a'          => 'Halo',
                'option_b'          => 'Dunia',
                'option_c'          => 'Halo Dunia',
                'option_d'          => 'Error',
                'correct_answer'    => 'C',
                'explanation'       => 'Teks dapat digabung menggunakan tanda +.'
            ],

            // =========================
            // SOAL 86
            // =========================
            [
                'question_text'     => 'Apa tujuan penggunaan list?',

                'option_a'          => 'Menyimpan banyak data',
                'option_b'          => 'Menghapus file',
                'option_c'          => 'Menghentikan looping',
                'option_d'          => 'Membuat gambar',
                'correct_answer'    => 'A',
                'explanation'       => 'List memudahkan penyimpanan banyak data dalam satu variabel.'
            ],

            // =========================
            // SOAL 87
            // =========================
            [
                'question_text'     => 'Jika data = ["A", "B", "C"], maka data[2] adalah...',

                'option_a'          => 'A',
                'option_b'          => 'B',
                'option_c'          => 'C',
                'option_d'          => 'Error',
                'correct_answer'    => 'C',
                'explanation'       => 'Index ke-2 berarti data ketiga dalam list.'
            ],

            // =========================
            // SOAL 88
            // =========================
            [
                'question_text'     => 'Apa output dari for i in range(1): print("Python") ?',

                'option_a'          => 'Tidak muncul',
                'option_b'          => 'Python',
                'option_c'          => 'Python Python',
                'option_d'          => 'Error',
                'correct_answer'    => 'B',
                'explanation'       => 'range(1) berarti pengulangan hanya 1 kali.'
            ],

            // =========================
            // SOAL 89
            // =========================
            [
                'question_text'     => 'Apa hasil dari 2 + 2 * 2 ?',

                'option_a'          => '8',
                'option_b'          => '6',
                'option_c'          => '4',
                'option_d'          => '2',
                'correct_answer'    => 'B',
                'explanation'       => 'Perkalian lebih dulu: 2 x 2 = 4 lalu ditambah 2 menjadi 6.'
            ],

            // =========================
            // SOAL 90
            // =========================
            [
                'question_text'     => 'Apa fungsi print dalam Python?',

                'option_a'          => 'Mengambil input',
                'option_b'          => 'Menampilkan output',
                'option_c'          => 'Menghapus data',
                'option_d'          => 'Mengulang program',
                'correct_answer'    => 'B',
                'explanation'       => 'print digunakan untuk menampilkan hasil ke layar.'
            ],

            // =========================
            // SOAL 91
            // =========================
            [
                'question_text'     => 'Apa hasil dari 30 / 5 + 1 ?',

                'option_a'          => '5',
                'option_b'          => '6',
                'option_c'          => '7',
                'option_d'          => '8',
                'correct_answer'    => 'C',
                'explanation'       => '30 dibagi 5 = 6 lalu ditambah 1 menjadi 7.'
            ],

            // =========================
            // SOAL 92
            // =========================
            [
                'question_text'     => 'Apa hasil dari 5 * (2 + 1) ?',

                'option_a'          => '15',
                'option_b'          => '10',
                'option_c'          => '8',
                'option_d'          => '6',
                'correct_answer'    => 'A',
                'explanation'       => 'Yang di dalam kurung dikerjakan lebih dulu: 2 + 1 = 3 lalu dikali 5 menjadi 15.'
            ],

            // =========================
            // SOAL 93
            // =========================
            [
                'question_text'     => 'Apa hasil dari 11 % 2 ?',

                'option_a'          => '5',
                'option_b'          => '1',
                'option_c'          => '0',
                'option_d'          => '2',
                'correct_answer'    => 'B',
                'explanation'       => '11 dibagi 2 sisanya 1.'
            ],

            // =========================
            // SOAL 94
            // =========================
            [
                'question_text'     => 'Apa hasil dari True and False ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '1',
                'option_d'          => '0',
                'correct_answer'    => 'B',
                'explanation'       => 'AND hanya bernilai True jika semua kondisi benar.'
            ],

            // =========================
            // SOAL 95
            // =========================
            [
                'question_text'     => 'Apa output dari kode berikut? print("Belajar Python")',

                'option_a'          => 'Belajar',
                'option_b'          => 'Python',
                'option_c'          => 'Belajar Python',
                'option_d'          => 'Error',
                'correct_answer'    => 'C',
                'explanation'       => 'print akan menampilkan teks yang ada di dalam tanda kutip.'
            ],

            // =========================
            // SOAL 96
            // =========================
            [
                'question_text'     => 'Apa hasil dari 50 < 20 ?',

                'option_a'          => 'True',
                'option_b'          => 'False',
                'option_c'          => '50',
                'option_d'          => '20',
                'correct_answer'    => 'B',
                'explanation'       => '50 tidak lebih kecil dari 20 sehingga hasilnya False.'
            ],

            // =========================
            // SOAL 97
            // =========================
            [
                'question_text'     => 'Apa output dari kode berikut? for i in range(2): print(i)',

                'option_a'          => '1 2',
                'option_b'          => '0 1',
                'option_c'          => '0 1 2',
                'option_d'          => '2',
                'correct_answer'    => 'B',
                'explanation'       => 'range(2) menghasilkan angka 0 dan 1.'
            ],

            // =========================
            // SOAL 98
            // =========================
            [
                'question_text'     => 'Jika nilai = [10,20,30], maka nilai[1] adalah...',

                'option_a'          => '10',
                'option_b'          => '20',
                'option_c'          => '30',
                'option_d'          => '1',
                'correct_answer'    => 'B',
                'explanation'       => 'Index ke-1 berarti data kedua dalam list.'
            ],

            // =========================
            // SOAL 99
            // =========================
            [
                'question_text'     => 'Apa fungsi operator == ?',

                'option_a'          => 'Mengurangi angka',
                'option_b'          => 'Membandingkan apakah dua nilai sama',
                'option_c'          => 'Menyimpan data',
                'option_d'          => 'Menghapus data',
                'correct_answer'    => 'B',
                'explanation'       => '== digunakan untuk mengecek apakah dua nilai sama.'
            ],

            // =========================
            // SOAL 100
            // =========================
            [
                'question_text'     => 'Mengapa looping penting dalam pemrograman?',

                'option_a'          => 'Agar kode lebih panjang',
                'option_b'          => 'Agar program bisa mengulang pekerjaan otomatis',
                'option_c'          => 'Agar variabel hilang',
                'option_d'          => 'Agar program error',
                'correct_answer'    => 'B',
                'explanation'       => 'Looping membantu program melakukan tugas berulang secara otomatis sehingga lebih efisien.'
            ],

        ];

        

        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
