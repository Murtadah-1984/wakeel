<?php

namespace App\Exports;

use App\Models\TelegramUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TelegramContactsExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of user data for export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TelegramUser::select('first_name', 'last_name', 'username', 'phone_number')->get();
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Username',
            'Phone Number',
        ];
    }
}
