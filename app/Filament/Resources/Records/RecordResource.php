<?php

namespace App\Filament\Resources\Records;

use App\Filament\Resources\Records\Pages;
use App\Models\Record;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Schema;

class RecordResource extends Resource
{
    protected static ?string $model = Record::class;
    protected static ?string $navigationLabel = 'Milieu Checks';
    protected static ?string $modelLabel = 'Check';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Forms\Components\Select::make('upload_id')
                ->relationship('upload', 'file_name')
                ->required(),
            \Filament\Forms\Components\TextInput::make('action')
                ->required()->maxLength(255),
            \Filament\Forms\Components\Textarea::make('description')
                ->columnSpanFull(),
            \Filament\Forms\Components\TextInput::make('employee_name')
                ->required()->maxLength(255),
            \Filament\Forms\Components\TextInput::make('duration')
                ->numeric()->suffix('uur'),
            \Filament\Forms\Components\TextInput::make('cost')
                ->numeric()->prefix('€'),
            \Filament\Forms\Components\DatePicker::make('date')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Datum')
                    ->date('d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('action')
                    ->label('Actie')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Omschrijving')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('employee_name')
                    ->label('Medewerker')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->label('Uren')
                    ->suffix(' uur')
                    ->sortable(),
                Tables\Columns\TextColumn::make('cost')
                    ->label('Kosten')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('upload.file_name')
                    ->label('Bestand')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('employee_name')
                    ->label('Medewerker')
                    ->options(
                        Record::query()
                            ->distinct()
                            ->pluck('employee_name', 'employee_name')
                    ),
                Filter::make('date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')
                            ->label('Van'),
                        \Filament\Forms\Components\DatePicker::make('until')
                            ->label('Tot'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn($q, $d) => $q->whereDate('date', '>=', $d))
                            ->when($data['until'], fn($q, $d) => $q->whereDate('date', '<=', $d));
                    }),
                Filter::make('cost')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('min_cost')
                            ->label('Min. kosten (€)')->numeric(),
                        \Filament\Forms\Components\TextInput::make('max_cost')
                            ->label('Max. kosten (€)')->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['min_cost'], fn($q, $v) => $q->where('cost', '>=', $v))
                            ->when($data['max_cost'], fn($q, $v) => $q->where('cost', '<=', $v));
                    }),
            ])
            ->defaultSort('date', 'desc')
            ->striped()
            ->paginated([25, 50, 100]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecords::route('/'),
            'create' => Pages\CreateRecord::route('/create'),
            'edit' => Pages\EditRecord::route('/{record}/edit'),
        ];
    }
}
