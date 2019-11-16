<?php
namespace App\Imports;

use App\Costo;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CostoImport implements ToModel, WithCustomCsvSettings, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return User|null
     */

    use Importable;

    protected $idRegistroUpload;
    private $rows = 0;

    public function __construct($idRegistroUpload)
    {
       $this->idRegistroUpload = $idRegistroUpload;
    }


    public function model(array $row)
    {
        ++$this->rows;
        if ($this->rows==1 ) {
            return null;         
        } 

        return new Costo([
           'idRegistroUpload' => $this->idRegistroUpload,
           'prod_nombre'    => $row[0],
           'u_nombre'    => $row[1],
           'nombrePlanta'    => $row[2],
           'costo'    => $row[3]       
        ]);
    }


    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'input_encoding' => 'ISO-8859-1'
        ];
    }    
    
    public function batchSize(): int
    {
        return 800;
    }
    
    public function chunkSize(): int
    {
        return 800;
    }

}