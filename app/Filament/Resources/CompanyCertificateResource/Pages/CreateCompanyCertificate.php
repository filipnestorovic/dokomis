<?php

namespace App\Filament\Resources\CompanyCertificateResource\Pages;

use App\Filament\Resources\CompanyCertificateResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyCertificate extends CreateRecord
{
    protected static string $resource = CompanyCertificateResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
