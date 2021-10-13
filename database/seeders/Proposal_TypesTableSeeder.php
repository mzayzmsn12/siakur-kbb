<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Proposal_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $proposal_type = [
          [
              'jenis_bantuan' => 'Rehab Sedang Ruang Kelas',
          ],
          [
              'jenis_bantuan' => 'Rehab Ruang Kantor',
          ],
          [
              'jenis_bantuan' => 'Pembangunan Laboratorium',
          ],
          [
              'jenis_bantuan' => 'MCK',
          ],
          [
              'jenis_bantuan' => 'Pemagaran',
          ],
          [
              'jenis_bantuan' => 'Pavingblock',
          ],
          [
              'jenis_bantuan' => 'Lapangan Upacara',
          ],
          [
              'jenis_bantuan' => 'Lapangan Basket',
          ],
          [
              'jenis_bantuan' => 'Meubeler Kelas',
          ],
          [
              'jenis_bantuan' => 'Meubeler Kantor',
          ],
          [
              'jenis_bantuan' => 'Personal Computer',
          ],
          [
              'jenis_bantuan' => 'Laptop',
          ],
      ];
    }
}
