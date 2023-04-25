<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyCertificateResource\Pages;
use App\Filament\Resources\CompanyCertificateResource\RelationManagers;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\CompanyCertificate;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyCertificateResource extends Resource
{
    protected static ?string $model = CompanyCertificate::class;

    protected static ?string $navigationIcon = 'heroicon-s-shield-check';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')
                    ->label('Company')
                    ->options(Company::all()->pluck('name','id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('certificate_id')
                    ->label('Certificate')
                    ->options(Certificate::all()->pluck('name','id'))
                    ->required(),
                Forms\Components\TextInput::make('certificate_number')->required(),
                Forms\Components\TextInput::make('application_area')->required(),
                DatePicker::make('valid_from')->required(),
                DatePicker::make('valid_until')->required(),
                Forms\Components\Grid::make(4)
                    ->schema([
                        Forms\Components\Toggle::make('is_suspended')->helperText('Ukoliko je sertifikat trenutno suspendovan.'),
                        Forms\Components\Toggle::make('is_withdrawn')->helperText('Ukoliko je sertifikat povučen.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('certificate_number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('application_area'),
                Tables\Columns\TextColumn::make('company.name')->searchable(),
                Tables\Columns\TextColumn::make('certificate.name'),
                Tables\Columns\TextColumn::make('valid_from')->sortable(),
                Tables\Columns\TextColumn::make('valid_until')->sortable(),
                // 1 - validan, 2 - istekao, 3 - suspendovan, 4 - povucen
                Tables\Columns\IconColumn::make('status')
                    ->options([
                        'heroicon-o-x-circle' => fn ($status): bool => $status === 2 || $status === 4,
                        'heroicon-o-check-circle' => 1,
                        'heroicon-o-minus-circle' => 3,
                    ])
                    ->colors([
                        'success' => 1,
                        'danger' => 2,
                        'secondary' => 3,
                        'warning' => 4,
                    ])
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanyCertificates::route('/'),
            'create' => Pages\CreateCompanyCertificate::route('/create'),
            'edit' => Pages\EditCompanyCertificate::route('/{record}/edit'),
        ];
    }
}
