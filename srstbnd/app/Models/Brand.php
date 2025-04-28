<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
   use SoftDeletes;
   protected $fillable = [
      'name',
      'description',
      'status',
      'created_by',
      'updated_by',
   ];
   protected $casts = [
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
      'deleted_at' => 'datetime',
   ];
   protected $hidden = [
      'created_by',
      'updated_by',
   ];
   public function products()
   {
      return $this->hasMany(Product::class);
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
}
