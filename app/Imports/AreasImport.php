<?php

namespace App\Imports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AreasImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Area([
            'city_id' => $row['city_id'],
            'name' => $row['name'],
            'slug' => $row['slug'],
            'price' => 50
        ]);
    }
}
