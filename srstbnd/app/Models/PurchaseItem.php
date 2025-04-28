<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
    public function scopeDeleted($query)
    {
        return $query->whereNotNull('deleted_at');
    }
    public function scopeNotDeleted($query)
    {
        return $query->whereNull('deleted_at');
    }
    public function scopeWithTrashed($query)
    {
        return $query->withTrashed();
    }
    public function scopeOnlyTrashed($query)
    {
        return $query->onlyTrashed();
    }
    public function scopeWithDeleted($query)
    {
        return $query->withTrashed();
    }
    public function scopeWithoutTrashed($query)
    {
        return $query->withoutTrashed();
    }
    public function scopeWithCreatedBy($query)
    {
        return $query->with('createdBy');
    }
    public function scopeWithUpdatedBy($query)
    {
        return $query->with('updatedBy');
    }
    public function scopeWithDeletedBy($query)
    {
        return $query->with('deletedBy');
    }
    public function scopeWithPurchase($query)
    {
        return $query->with('purchase');
    }
    public function scopeWithProduct($query)
    {
        return $query->with('product');
    }       
}
