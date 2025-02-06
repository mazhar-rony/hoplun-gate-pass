<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ticket_category_id',
        'item_code',
        'description',
        'uom',
        'is_active',
    ];

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    protected static function booted()
    {
        static::creating(function ($item) {
            // Generate a unique item code based on the category name and item count
            $ticketCategory = $item->ticketCategory;

            if ($ticketCategory) {
                // Get the number of items in this category
                $itemCount = $ticketCategory->items()->count() + 1;

                // Generate the item code as [Category Initials]-[Item Count]
                $item->item_code = strtoupper(Str::substr($ticketCategory->name, 0, 3)) . '-' . str_pad($itemCount, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
