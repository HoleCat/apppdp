<?php

namespace App\Imports;

use App\clases\modelosgenerales\Codigocontable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CodigocontableImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        for ($i=0; $i < count($row); $i++) {
            if($row[$i] == "")
            {
                $row[$i] = null;
            }
        }
    
    
        return new Codigocontable([
            'empresa_id'=>$row[0],
            'codigo'=>$row[1],
            'descripcion'=>$row[2]
        ]); 
    
           
    }
}
