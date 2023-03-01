<?php

namespace App\Filament\Resources\CompanyCertificateResource\Pages;

use App\Filament\Resources\CompanyCertificateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyCertificates extends ListRecords
{
    protected static string $resource = CompanyCertificateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
