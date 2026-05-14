<?php

namespace App\Filament\Resources\CustomerInquiries;

use App\Filament\Resources\CustomerInquiries\Pages\CreateCustomerInquiry;
use App\Filament\Resources\CustomerInquiries\Pages\EditCustomerInquiry;
use App\Filament\Resources\CustomerInquiries\Pages\ListCustomerInquiries;
use App\Filament\Resources\CustomerInquiries\Schemas\CustomerInquiryForm;
use App\Filament\Resources\CustomerInquiries\Tables\CustomerInquiriesTable;
use App\Models\CustomerInquiry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustomerInquiryResource extends Resource
{
    protected static ?string $model = CustomerInquiry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Customer Inquiries';

    protected static string|\UnitEnum|null $navigationGroup = 'Customer Care';

    public static function form(Schema $schema): Schema
    {
        return CustomerInquiryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerInquiriesTable::configure($table);
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
            'index' => ListCustomerInquiries::route('/'),
            'create' => CreateCustomerInquiry::route('/create'),
            'edit' => EditCustomerInquiry::route('/{record}/edit'),
        ];
    }
}
