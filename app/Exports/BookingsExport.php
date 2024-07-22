<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection() {
        return Booking::all();
    }

    public function headings(): array {
        return [
            'ID',
            'Nombre de Cliente',
            'Email',
            'Tour',
            'Hotel',
            'Creado el',
            'Actualizado el'
        ];
    }
}
