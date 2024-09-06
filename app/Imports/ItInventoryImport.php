<?php

namespace App\Imports;

use App\Models\ItInventory;
use Maatwebsite\Excel\Concerns\ToModel;

class ItInventoryImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ItInventory([
            'name'        => $row[0],  // First column in the CSV/Excel
            'description' => $row[1],  // Second column in the CSV/Excel
        ]);
    }
}
