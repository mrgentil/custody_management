<?php

namespace App\Exports;

use App\Models\CUstomer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
class CustomersExport implements FromQuery, WithHeadings
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }



    public function query()
    {
        return $this->query->with(['categorie', 'createdBy'])
        ->select('id', 'name', 'first_name', 'last_name', 'function', 'category_id', 'created_by', 'adresse', 'phone', 'gender','avatar');
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Nom',
            'Post Nom',
            'Prénom',
            'Fonction',
            'Categorie',
            'Crée par',
            'Adresse',
            'Téléphone',
            'Genre',
            'Avatar',
        ];
    }
}
