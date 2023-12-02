<?php

namespace App\Models\Tenant;

use Hyn\Tenancy\Abstracts\TenantModel;

class Item extends TenantModel
{
    protected $with = ['item_type', 'unit_type', 'currency_type', 'trademark', 'itemCategory', 'warehouses', 'printer'];
    protected $fillable = [
        'description',
        'item_type_id',
        'internal_id',
        'item_code',
        'item_code_gs1',
        'unit_type_id',
        'currency_type_id',
        'sale_unit_price',
        'purchase_unit_price',
        'included_igv',
        'has_isc',
        'system_isc_type_id',
        'description_sunat',
        'percentage',
        'detraction_state',
        'percentage_isc',
        'suggested_price',
        'sale_affectation_igv_type_id',
        'purchase_affectation_igv_type_id',
        'stock',
        'stock_min',
        'comision_state',
        'comision',
        'attributes',
        'trademark_id',
        'item_category_id',
        'warehouse_id',
        'printer_id',
        'establishment_id',
        'item_custom',
        'is_print_kitchen',
        'is_item_detail',
        'item_active',
        'company',
        'presentation',
        'pharmacological',
        'related_products_code',
        'observation',
        'internal_id_purchase',
        'is_generic',
        'withenamel',
        'colour',
        'measure',
        'painting',
        'order'
    ];

    public function getAttributesAttribute($value)
    {
        return (is_null($value)) ? null : (object)json_decode($value);
    }

    public function setAttributesAttribute($value)
    {
        $this->attributes['attributes'] = (is_null($value)) ? null : json_encode($value);
    }

    public function item_type()
    {
        return $this->belongsTo(ItemType::class);
    }

    public function trademark()
    {
        return $this->belongsTo(Trademarks::class);
    }

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    public function unit_type()
    {
        return $this->belongsTo(UnitType::class, 'unit_type_id');
    }

    public function printer()
    {
        return $this->belongsTo(Printer::class, 'printer_id');
    }

    public function currency_type()
    {
        return $this->belongsTo(CurrencyType::class, 'currency_type_id');
    }

    public function system_isc_type()
    {
        return $this->belongsTo(SystemIscType::class, 'system_isc_type_id');
    }

    public function kardex()
    {
        return $this->hasMany(Kardex::class);
    }

    public function inventory_kardex()
    {
        return $this->hasMany(InventoryKardex::class);
    }

    public function purchase_item()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function item_warehouse()
    {
        return $this->hasMany(ItemWarehouse::class);
    }

    public function item_list()
    {
        return $this->hasMany(ItemSupplie::class, 'item_id_parent')
            ->leftJoin('items', 'item_supplies.item_id_child', '=', 'items.id')
            ->leftJoin('supplies', 'item_supplies.supplie_id', '=', 'supplies.id')
            ->select('item_supplies.*', 'items.description AS description_item', 'supplies.description AS description_supplie');
    }

    public function item_details()
    {
        return $this->hasMany(ItemDetails::class, 'item_id');
        //->leftJoin('items', 'item_details.item_id', '=', 'items.id')
        //->select('item_supplies.*', 'items.description AS description_item', 'supplies.description AS description_supplie');
    }

    public function item_price_list()
    {
        return $this->hasMany(ItemPriceList::class);
    }

    public function sale_affectation_igv_type()
    {
        return $this->belongsTo(AffectationIgvType::class, 'sale_affectation_igv_type_id');
    }

    public function purchase_affectation_igv_type()
    {
        return $this->belongsTo(AffectationIgvType::class, 'purchase_affectation_igv_type_id');
    }

    public function warehouses()
    {
        return $this->hasMany(ItemWarehouse::class)->with('warehouse');
    }

    public function item_unit_types()
    {
        return $this->hasMany(ItemUnitType::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }

    public function audit()
    {
        return $this->morphMany(Audit::class, 'audit');
    }

    public function kitchen_order()
    {
        return $this->hasMany(KitchenOrder::class);
    }
}
