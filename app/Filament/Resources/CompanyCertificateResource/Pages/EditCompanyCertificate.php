<?php

namespace App\Filament\Resources\CompanyCertificateResource\Pages;

use App\Filament\Resources\CompanyCertificateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyCertificate extends EditRecord
{
    protected static string $resource = CompanyCertificateResource::class;

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
