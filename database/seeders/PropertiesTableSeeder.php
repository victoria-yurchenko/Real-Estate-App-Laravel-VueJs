<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/properties.csv');
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        foreach ($data as $row) {
            $row = array_combine($header, $row); 
            Property::create([
                'name' => $row['name'],
                'bedrooms' => $row['bedrooms'],
                'bathrooms' => $row['bathrooms'],
                'storeys' => $row['storeys'],
                'garages' => $row['garages'],
                'price' => $row['price']
            ]);
        }
    }
}
