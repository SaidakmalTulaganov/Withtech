<?php

namespace App\Exports;

use App\Models\OrderSet;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersAdminExport implements FromCollection, WithHeadings, WithColumnWidths, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return OrderSet::all();
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 30,
            'C' => 30,
            'D' => 25,
            'E' => 40,
            'F' => 50,
            'G' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            'Номер заказа',
            'Покупатель',
            'Дата время оформления',
            'Статус заказа',
            'Способ оплаты',
            'Адрес доставки',
            'Общая сумма заказа',
        ];
    }

    public function map($order_set): array
    {
        return [
            $order_set->id,
            $order_set->user->surname.' '.$order_set->user->name,
            $order_set->order_datetime,
            $order_set->state->title,
            $order_set->payment_type,
            $order_set->delivery_address,
            $order_set->order_price,
        ];
    }
}
