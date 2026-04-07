<?php

namespace App\Imports;

use App\Models\Record;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RecordsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct(private int $uploadId)
    {
    }

    public function model(array $row): Record
    {
        return new Record([
            'upload_id' => $this->uploadId,
            'action' => $row['actie'] ?? $row['action'] ?? '',
            'description' => $row['omschrijving'] ?? $row['description'] ?? null,
            'employee_name' => $row['medewerker'] ?? $row['employee_name'] ?? '',
            'duration' => $row['uren'] ?? $row['duration'] ?? null,
            'cost' => $row['kosten'] ?? $row['cost'] ?? null,
            'date' => $this->parseDate($row['datum'] ?? $row['date'] ?? null),
        ]);
    }

    private function parseDate(mixed $value): string
    {
        if (!$value)
            return now()->toDateString();

        // Excel slaat datums soms op als getal
        if (is_numeric($value)) {
            return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                ->format('Y-m-d');
        }

        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    public function rules(): array
    {
        return [
            'actie' => 'nullable|string',
            'action' => 'nullable|string',
        ];
    }
}
