<?php

namespace App\Exports;

use App\Models\System\Coding;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\BeforeSheet;

class CodingExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->getDelegate()->setRightToLeft(true);
            }
        ];
    }

    public function map($row): array
    {
        return [
            'ItemStock',
            '1',
            $row->code,
            $row->name,
            '',
            '',
            $row->unit,
            '',
            'TRUE',
            '',
            'FALSE',
            'FALSE',
            'TRUE',
            $row->store
        ];
    }

    public function headings(): array
    {
        return [
            'نوع قلم',
            'کالا/خدمت نوع',
            'کد کالا',
            'شرح کالا',
            'کالا/خدمت بارکد',
            'کالا/خدمت ایران کد',
            'واحد شمارش',
            'کالا/خدمت واحد فرعی',
            'کالا/خدمت نسبت واحد ها ثابت است',
            'کالا/خدمت نسبت واحد ها',
            'کالا/خدمت عامل ردیابی',
            'کالا/خدمت معاف از مالیات (فروش)',
            'کالا/خدمت قابل فروش',
            'انبار های مرتبط کالا کد انبار'
        ];
    }

    public function query()
    {
        return Coding::query()->whereBetween('created_at', [$this->start, $this->end]);
    }
}
