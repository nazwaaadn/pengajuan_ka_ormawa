<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            [
                'name' => 'Afriza',
                'email' => 'za@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Joko',
                'email' => 'joko@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hesty',
                'email' => 'kemahasiswaan@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'), // default password
                'role_id' => 'staff_kemahasiswaan',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Step1
            [
                'name' => 'MPM Polban',
                'email' => 'mpm@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('mpmpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BEM Polban',
                'email' => 'bem@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('bempolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknik Sipil',
                'email' => 'hmjts@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtspolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknik Mesin',
                'email' => 'hmjtm@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtmpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknik Elektro',
                'email' => 'hmjte@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtepolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Step 2
            [
                'name' => 'Teknik Kimia',
                'email' => 'hmjtk@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtkpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknik Refrigerasi dan Tata Udara',
                'email' => 'hmjtra@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtrapolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknik Komputer dan Informatika',
                'email' => 'hmjtki@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtkipolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teknik Konversi Energi',
                'email' => 'hmjtke@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtkepolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Akuntansi',
                'email' => 'hmjta@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjtapolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Administrasi Niaga',
                'email' => 'hmjan@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make(value: 'hmjanpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bahasa Inggris',
                'email' => 'hmjbi@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('hmjbipolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // UKM
            [
                'name' => 'Robotika	',
                'email' => 'ukm-robotika@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('robotikapolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Otomotif',
                'email' => 'ukm-otomotif@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('otomotifpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kewirausahaan',
                'email' => 'ukm-wirus@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('wiruspolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Step3
            [
                'name' => 'ELTRAS',
                'email' => 'ukm-eltras@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('eltraspolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Assalam',
                'email' => 'ukm-assalam@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('assalampolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PMK',
                'email' => 'ukm-pmk@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('pmkpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KMK',
                'email' => 'ukm-kmk@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('kmkpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kabayan',
                'email' => 'ukm-kabayan@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('kabayanpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PSM',
                'email' => 'ukm-psm@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('psm@polban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Musik dan Teater',
                'email' => 'ukm-musking@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('muskingpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UKBM',
                'email' => 'ukm-ukbm@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('ukbmpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UBSU',
                'email' => 'ukm-ubsu@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('ubsupolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
// da
            [
                'name' => 'USF',
                'email' => 'ukm-usf@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('usfpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bola Basket',
                'email' => 'ukm-basket@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('basketpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bola Voli',
                'email' => 'ukm-volly@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('vollypolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bulutangkis',
                'email' => 'ukm-bulutangkis@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('bulutangkispolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Catur',
                'email' => 'ukm-catur@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('caturpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bela Diri',
                'email' => 'ukm-beladiri@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('beladiripolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PPRPG-SAGA',
                'email' => 'ukm-saga@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('sagapolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'KSR',
                'email' => 'ukm-ksr@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('ksrpolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pramuka',
                'email' => 'ukm-pramuka@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('pramukapolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fellas',
                'email' => 'ukm-fellas@polban.ac.id',
                'email_verified_at' => now(),
                'password' => Hash::make('fellaspolban12345'), // default password
                'role_id' => 'mahasiswa',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->call(PengajuanSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(Dataketuaormawa::class);
        $this->call(TimelineSeeder::class);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
