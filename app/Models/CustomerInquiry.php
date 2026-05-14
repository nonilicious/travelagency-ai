<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['customer_id', 'name', 'email', 'phone', 'destination_interest', 'travelers', 'preferred_start_date', 'preferred_end_date', 'budget', 'status', 'message'])]
class CustomerInquiry extends Model
{
    protected function casts(): array
    {
        return [
            'preferred_start_date' => 'date',
            'preferred_end_date' => 'date',
            'budget' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
