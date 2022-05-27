<?php

namespace App\Exports;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;

class ShipmentsExport implements FromCollection, WithHeadings, WithColumnWidths, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Shipment::all();
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 40,
            'C' => 40,
            'D' => 20,
            'E' => 20,
            'F' => 15,
            'G' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            'Номер партии',
            'Поставщик',
            'Товар',
            'Закупочная цена',
            'Цена для продаж',
            'Количество',
            'Дата время',
        ];
    }

    public function map($shipment): array
    {
        return [
            $shipment->id,
            $shipment->supplier->supplier_title,
            $shipment->product->product_title,
            $shipment->purchase_price,
            $shipment->selling_price,
            $shipment->count,
            $shipment->datetime,
        ];
    }
}
