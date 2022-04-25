<?php

namespace App\Custom\PrintDoc;
use Illuminate\Support\Carbon;
use App\Custom\PrintDoc\SoldItem;
use App\Models\Doc;

/**
 * -------- Invoice -----------
 * Used in class PDFBuilder to manage Invoice data
 */
class Invoice
{
    // pre-defined data
    public string $selName;
    public string $selNameShort;
    public string $selAddress;
    public string $selTin;
    public string $selTel;
    public string $payMethod;
    public string $payBank;
    public string $payAccount;

    // data taken from $doc
    public string $name;
    public string $buyName;
    public string $buyAddress;
    public string $buyTin;
    public string $buyNameShort;
    public string $dateCreation;
    public string $dateDelivery;
    public string $datePayment;
    public string $docType;        // (1) education / others
    public $soldItems = array();

    public function __construct(Doc $doc)
    {
        // set pre-defined seller permanent data
        $this->payMethod = 'Bank transfer';
        $this->payBank = 'PKO BP';
        $this->payAccount = '00 1000 0000 9999 1111 2222 0000';
        $this->selName = 'John Xman';
        $this->selNameShort = 'Uniservice';
        $this->selAddress = 'Light Str. 2, Heights, 22-200 Abeersfeldy';
        $this->selTin = '111-222-33-44';
        $this->selTel = '999 999 999';

        // add data from doc
        foreach ($doc->items as $it) {
            if($it->itemtype->type == 'education') {
                $docType = 'education';
                break;
            }else{
                $docType = 'other';
            }
        }

        $this->name = $doc->name;
        $this->docType = $docType;
        $this->buyName = $doc->client->fname != '' ? $doc->client->fname.' '.$doc->client->name : $doc->client->name;
        $this->buyAddress = $doc->client->address;
        $this->buyNameShort = $doc->client->shortname;

        $this->dateCreation = $doc->gen;
        $this->dateDelivery = $doc->gen;
        $date = Carbon::create($this->dateCreation);
        $this->datePayment = "";
        if($doc->paygen != "")
        {
            $this->datePayment = $doc->paygen;
        } else {
            $this->datePayment = ($date->addDays(10))->format('Y-m-d');
        }

        $nip = $doc->client->nip;
        if($nip != '') {
            $this->buyTin = substr($nip,0,3).'-'.substr($nip,3,3).'-'.substr($nip,6,2).'-'.substr($nip,8,2);
        }else{
            $this->buyTin = $nip;
        }

        $this->soldItems = array();
        foreach ($doc->items as $a) {
            $this->soldItems[] = new SoldItem( $a->itemtype->name,
            $a->qty,
            $a->unitprice
            );
        }
    }
}
