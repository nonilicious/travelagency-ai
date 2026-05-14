<?php

namespace App\Filament\Resources\CustomerInquiries\Pages;

use App\Filament\Resources\CustomerInquiries\CustomerInquiryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerInquiry extends CreateRecord
{
    protected static string $resource = CustomerInquiryResource::class;
}
