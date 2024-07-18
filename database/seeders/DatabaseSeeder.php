<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\PersonalTrainer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();

        Kategori::create([
            'nama' => 'Member',
            'harga' => '150K',
            'masaaktif' => '1 bulan'
        ]);
        Kategori::create([
            'nama' => 'Member',
            'harga' => '400K',
            'masaaktif' => '3 bulan'
        ]);
        Kategori::create([
            'nama' => 'Member',
            'harga' => '750K',
            'masaaktif' => '6 bulan'
        ]);
        Kategori::create([
            'nama' => 'Member',
            'harga' => '10K',
            'masaaktif' => 'Pervisit',
            'keterangan' => 'Dengan syarat melakakukan pembayaran registrasi 25K'
        ]);
        Kategori::create([
            'nama' => 'Non Member',
            'harga' => '15K',
            'masaaktif' => 'Pervisit'
        ]);
        PersonalTrainer::create([
            'nama' => 'Anton',
            'kategori' => 'GYM & Muaythai',
            'nohp' => '081233491234'
        ]);
        PersonalTrainer::create([
            'nama' => 'Anton',
            'kategori' => 'GYM & Muaythai',
            'nohp' => '081233491234'
        ]);
        PersonalTrainer::create([
            'nama' => 'Anton',
            'kategori' => 'GYM & Muaythai',
            'nohp' => '081233491234'
        ]);
        PersonalTrainer::create([
            'nama' => 'Anton',
            'kategori' => 'GYM & Muaythai',
            'nohp' => '081233491234'
        ]);
    }
}
