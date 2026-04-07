<?php

namespace App\Imports;

use App\Models\Record;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class RecordsImport
{
    public function __construct(private int $uploadId)
    {
    }

    /**
     * Import records from an Excel file
     * 
     * @param string $filePath Path to the Excel file
     * @return void
     */
    public function import(string $filePath): void
    {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        if (empty($rows)) {
            return;
        }

        // Assume first row is headers
        $headers = array_map('strtolower', $rows[0] ?? []);

        // Process data rows
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            if (empty(array_filter($row))) {
                continue; // Skip empty rows
            }

            // Map columns - support both Dutch and English headers
            $rowData = array_combine($headers, $row);

            $action = $rowData['actie'] ?? $rowData['action'] ?? '';
            $date = $rowData['datum'] ?? $rowData['date'] ?? null;

            if (empty($action) && empty($date)) {
                continue; // Skip rows with no action or date
            }

            Record::create([
                'upload_id' => $this->uploadId,
                'action' => $action,
                'description' => $rowData['omschrijving'] ?? $rowData['description'] ?? null,
                'employee_name' => $rowData['medewerker'] ?? $rowData['employee_name'] ?? '',
                'duration' => $this->parseNumericField($rowData['uren'] ?? $rowData['duration'] ?? null),
                'cost' => $this->parseNumericField($rowData['kosten'] ?? $rowData['cost'] ?? null),
                'date' => $this->parseDate($date),
            ]);
        }
    }

    /**
     * Parse a date value from Excel
     */
    private function parseDate(mixed $value): string
    {
        if (!$value) {
            return now()->toDateString();
        }

        // Excel stores dates as numeric values
        if (is_numeric($value)) {
            try {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Exception $e) {
                return now()->toDateString();
            }
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return now()->toDateString();
        }
    }

    /**
     * Parse numeric field, handle null and string values
     */
    private function parseNumericField(mixed $value): ?float
    {
        if (empty($value) || !is_numeric($value)) {
            return null;
        }

        return (float) $value;
    }
}
