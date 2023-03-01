<?php

namespace App\Filament\Resources\CompanyTypeResource\Pages;

use App\Filament\Resources\CompanyTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyType extends EditRecord
{
    protected static string $resource = CompanyTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
