<?php

namespace App\Imports;

use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\ImportFailed;


class UsersImport implements ToModel,WithChunkReading,ShouldQueue,WithEvents
{
    use Importable; 

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    // public function uniqueBy()
    // {
    //     return 'email';
    // }
    
    // public function onError(\Throwable $e)
    // {
    //     // Handle the exception how you'd like.
    // }

    public function __construct(User $importedBy)
    {
        $this->importedBy = $importedBy;
    }
    
    public function model(array $row)
    {
        
        // dd($row['0']);
        return new User([
            'name'     => $row[0],
            'email'    => $row[1], 
            'password' => Hash::make($row[2]),
        ]);
    }
    
    // public function rules(): array
    // {
    //     return [
    //         '1' => 'unique:users,email',
    //     ];
    // }
    public function chunkSize(): int
    {
        return 1000;
    }

    public function headingRow(): int
    {
        return 2;
    }

    

    public function registerEvents(): array
    {
        
  
        return [
            ImportFailed::class => function(ImportFailed $event) {
                $this->importedBy->notify(new ImportHasFailedNotification($event));
            },
        ];
    }
}
