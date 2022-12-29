<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Dosen;
use App\Models\Matkul;
use App\Models\DosenMatkul;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
       $faker->seed(123);
        $prodi =["Informatika","Sistem Informasi"];
       for ($i=0; $i < 10; $i++) { 
        Dosen::create([
            'nim' => $faker->unique()->numerify('20########'),
            'nama' => $faker->firstName.' '.$faker->lastName,
            'prodi'=>$faker->randomElement($prodi)
        ]);
       }
       Matkul::create([
        'nama' => 'PBM'
       ]);
       Matkul::create([
        'nama' => 'DataMining'
       ]);
       Matkul::create([
        'nama' => 'Framework'
       ]);

       DosenMatkul::create([
        'dosen_id' => '1',
        'matkul_id' =>'2'
       ]);
       DosenMatkul::create([
        'dosen_id' => '1',
        'matkul_id' =>'3'
       ]);
       DosenMatkul::create([
        'dosen_id' => '2',
        'matkul_id' =>'2'
       ]);
       DosenMatkul::create([
        'dosen_id' => '3',
        'matkul_id' =>'1'
       ]);
       DosenMatkul::create([
        'dosen_id' => '4',
        'matkul_id' =>'1'
       ]);
       DosenMatkul::create([
        'dosen_id' => '5',
        'matkul_id' =>'3'
       ]);
       DosenMatkul::create([
        'dosen_id' => '6',
        'matkul_id' =>'3'
       ]);
    }
}
