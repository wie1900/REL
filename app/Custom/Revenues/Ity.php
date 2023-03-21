<?php

namespace App\Custom\Revenues;

/**
 * -------- ity -----------
 * class for collecting item data in RevController
 */
class Ity {
    public int $id;
    public int $typeId;
    public $qty;
    public $unitprice;
    public string $comp;
    public $v;

    public function __construct($id, int $typeid, $qty, $unitprice)
    {
        $this->id = $id;
        $this->typeId = $typeid;
        $this->qty = $qty;
        $this->unitprice = $unitprice;
        $this->v = 0;
        $this->comp = $this->typeId.$this->qty.$this->unitprice;
    }
}
