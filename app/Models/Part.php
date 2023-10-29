<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit', 'price', 'code', 'collection', 'category_id', 'old_price', 'coil', 'price_updated_at', 'inquiry_id',
        'unit2', 'operator1', 'formula1', 'operator2', 'formula2', 'product_id', 'standard', 'percent_submit', 'weight',
        'name_en', 'show_datasheet', 'extract'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)->withPivot('value');
    }

    public function modells()
    {
        return $this->belongsToMany(Modell::class)->withPivot(['value', 'sort', 'value2']);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function parents()
    {
        return $this->belongsToMany(Part::class, 'part_child', 'parent_part_id', 'child_part_id')
            ->withPivot(['value', 'value2', 'sort']);
    }

    public function children()
    {
        return $this->
        belongsToMany(Part::class, 'part_child', 'child_part_id', 'parent_part_id')
            ->withPivot(['value', 'value2', 'sort']);
    }

    public function inquiryPrice()
    {
        return $this->belongsTo(InquiryPrice::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function contractProductAmounts()
    {
        return $this->hasMany(ContractProductAmount::class, 'contract_product_id');
    }
}
