<?php

namespace App\Custom\PrintDoc;
use App\Custom\PrintDoc\Invoice;
use App\Models\Doc;

use TCPDF;
use TCPDF_FONTS;

class PDFBuilder extends TCPDF
{
    private Invoice $inv;
    private $fontreg;
    private $fontbold;
    private $fontita;
    private $localUrl;

    private float $count;
    private $wix = array();
    private float $totalValue;
    private int $cellHeight;

    private string $outStr;
    private string $renOutStr;

    public function __construct(Doc $doc)
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->inv = new Invoice($doc);
        $this->setBasics();
        $this->addMainDataBox();
        $this->addSellerBox();
        $this->addBuyerBox();
        $this->addBankData();
        $this->addSoldItems();
        $this->addSummary();
        $this->addSignatureFields();

        $this->SetCompression(TRUE);
    }

    public function save(string $path)
    {
        $this->Output($path.$this->outStr,'F');
        rename($path.$this->outStr, $path.$this->renOutStr);
    }

    public function show()
    {
        $this->Output($this->outStr);
    }

    private function setBasics()
    {
        // For invoice names with missing zero before 1-place numbers
        // add zero before the number, if it hasn't
        $invArr = explode('/', $this->inv->name);
        (strlen($invArr[0]) < 2) ? $this->inv->name = '0'.$this->inv->name : $this->inv->name = $this->inv->name;

        $this->outStr = substr($this->inv->dateCreation,0,8).'_'.substr($this->inv->name,0,2).'__Uniservice__'.$this->inv->buyNameShort.'__.pdf';
        $this->renOutStr = substr($this->inv->dateCreation,0,8).'('.substr($this->inv->name,0,2).')_Uniservice_('.$this->inv->buyNameShort.').pdf';

        $this->localUrl = '/resources';

        // height index
        $this->wix = array(12,63,10,8,15,16,14,14,16);

        TCPDF_FONTS::addTTFfont(base_path().$this->localUrl.'/fonts/SourceSansPro-Regular.ttf', 'TrueTypeUnicode', true, 96);
        TCPDF_FONTS::addTTFfont(base_path().$this->localUrl.'/fonts/SourceSansPro-Semibold.ttf', 'TrueTypeUnicode', true, 96);
        TCPDF_FONTS::addTTFfont(base_path().$this->localUrl.'/fonts/SourceSansPro-Italic.ttf', 'TrueTypeUnicode', true, 96);

        $this->fontreg = 'sourcesanspro';
        $this->fontbold = 'sourcesansprosemib';
        $this->fontita = 'sourcesansproi';

        // set document properties
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        $this->SetAuthor('UniService');
        $this->SetTitle('Invoice no '.$this->inv->name);
        $this->SetSubject('Invoice no '.$this->inv->name);
        $this->SetProtection(array('modify','copy'), null, "pathpass", 0, null);
        $this->SetProtection(array('modify'), null, "pathpass", 0, null);

        // set margins
        $this->SetMargins(22,25,22);
        $this->SetLineWidth(0.1);

        // add a page
        $this->AddPage();
    }

    private function addMainDataBox()
    {
        // add firm logo
        $this->Image(base_path().$this->localUrl.'/img/uni_service.jpg',22.2,15,35);

        // Invoice description
        $this->SetFont($this->fontbold, '', 24, '', 'false');
        $this->Cell(0, 21.1, "Invoice", 0, true, 'C');

        // 3 Boxes for Invoice add. infos
        $this->SetFont($this->fontbold,'',12);
        $this->SetXY(133,20.5);
        $this->Cell(56,12.3,'','LTRB',1,'C');
        $this->SetXY(133,21);
        $this->Cell(56,12,'No '.$this->inv->name,'',1,'C');
        $this->SetFont($this->fontreg,'',9);
        $this->SetXY(134.3,38);
        $this->Cell(56,12,'Created','',1,'C');

        $this->SetFont($this->fontbold,'',12);
        $this->SetXY(133,35);
        $this->Cell(56,12.3,'','LTRB',1,'C');
        $this->SetXY(134.3,33.5);
        $this->Cell(56,12,$this->inv->dateCreation,'',1,'C');
        $this->SetFont($this->fontreg,'',9);
        $this->SetXY(134.3,52.5);
        $this->Cell(56,12,'Delivered','',1,'C');

        $this->SetFont($this->fontbold,'',12);
        $this->SetXY(133,49.5);
        $this->Cell(56,12.3,'','LTRB',1,'C');
        $this->SetXY(134.3,48);
        $this->Cell(56,12,$this->inv->dateDelivery,'',1,'C');
    }

    private function addSellerBox()
    {
                // Seller box
                $this->SetXY(21,68);
                $this->Cell(82,22,'','LTRB',1,'C');

                $this->SetFont($this->fontbold, '', 9, '', 'false');
                $this->SetY(70);
                $this->Cell(22,4.6,'Seller:',0,1,'R');
                $this->Cell(22,4.6,'Address:',0,1,'R');
                $this->Cell(22,4.6,'Tax Id. No:',0,1,'R');
                $this->Cell(22,4.6,'Tel.:',0,1,'R');

                $this->SetXY(44.5,70);
                $this->SetFont($this->fontreg, '', 9, '', 'false');
                $this->Cell(35,4.6,$this->inv->selName,0,2,'L');
                $this->Cell(35,4.6,$this->inv->selAddress,0,2,'L');
                $this->Cell(35,4.6,$this->inv->selTin,0,2,'L');
                $this->Cell(35,4.6,$this->inv->selTel,0,2,'L');
    }

    private function addBuyerBox()
    {
        // Buyer box
        $this->SetXY(107,68);
        $this->Cell(82,22,'','LTRB',1,'C');

        $this->setCellHeightRatio(1.4);
        $this->SetXY(124.5,70);
        $this->SetFont($this->fontreg,'',9);
        $this->MultiCell(63,4.6,$this->inv->buyName,0,'L');

        $h_adres = $this->GetY();
        $this->SetX(124.5);
        $this->MultiCell(63,4.6,$this->inv->buyAddress,0,'L');
        $this->SetX(124.5);

        $h_nip = $this->GetY();
        $this->Cell(63,4.6,$this->inv->buyTin,0,2,'L');

        // Buyer - bigger box by longer description
        $this->SetXY(102,70);
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(22,4.6,'Purchaser:',0,2,'R');

        $this->SetXY(102,$h_adres);
        $this->Cell(22,4.6,'Address:',0,2,'R');
        $this->SetXY(102,$h_nip);

        if($this->inv->buyTin !=''){
            $this->Cell(22,4.6,'Tax Id. No:',0,2,'R');
        } else{
            $this->Cell(22,4.6,'',0,2,'R');
        }
    }

    private function addBankData()
    {
        // Bank box
        $this->SetXY(21,94.3);
        $this->Cell(168,12,'','LTRB',1,'C');

        $this->SetY(96.3);
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(28.9,4.6,'Payment method:',0,1,'R');
        $this->Cell(28.9,3.2,'Bank:',0,1,'R');

        $this->SetXY(51.3,96.3);
        $this->SetFont($this->fontreg,'',9);
        $this->Cell(35,4.6,$this->inv->payMethod,0,2,'L');
        $this->Cell(35,3.2,$this->inv->payBank,0,2,'L');

        $this->SetXY(72,96.3);
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(28.9,4.6,'Payment till:',0,2,'R');
        $this->Cell(28.9,3.2,'Bank account no:',0,1,'R');

        $this->SetXY(101.3,96.3);
        $this->SetFont($this->fontreg,'',9);
        $this->Cell(55,4.6,$this->inv->datePayment,0,2,'L');
        $this->Cell(100,3.2,$this->inv->payAccount,0,2,'L');
    }

    private function addSoldItems()
    {
        // soldItems headers box
        $header = array();
        $header[] = "No";
        $header[] = "Subject";
        $header[] = "Qty.";
        $header[] = "U.I.";
        $header[] = "Netto price";
        $header[] = "Netto Value";
        $header[] = "VAT  rate";
        $header[] = "VAT value";
        $header[] = "Brutto value";

        $this->SetFont($this->fontbold,'',9);

        // solditems box
        $this->SetFillColor(240,240,240);
        $pocz = 21;

        $this->SetXY(21.1,110.5);

        for($i=0;$i<count($header);$i++) {
            if($i>3) {
                    $this->setCellHeightRatio(0.9);
                    $this->SetCellPaddings(1,1.3,1,1);
                    $this->MultiCell($this->wix[$i],3,$header[$i],'LTR','C',true);
                } else {
                    $this->setCellHeightRatio(1);
                    $this->SetCellPaddings(1,3,1,0);
                    $this->MultiCell($this->wix[$i],8,$header[$i],'LTR','C',true);
                }
            $pocz += $this->wix[$i];
            $this->SetXY($pocz,110.5);
        }

        // solditems box
        $this->SetLineWidth(0.1);
        $this->count = 1;
        $this->SetFont($this->fontreg,'',8);
        $this->totalValue = 0;
        $this->cellHeight = 4.2;

        foreach ($this->inv->soldItems as $a) {
            $this->SetXY(21.1,114.4+($this->count*$this->cellHeight));
            $this->setCellPaddings(0,1,0,0);
            $this->Cell($this->wix[0]-0.1,$this->cellHeight,$this->count,'LTRB',0,'C');
            $this->setCellPaddings(3,0,1,0);
            $this->Cell($this->wix[1],$this->cellHeight,$a->name,'LTRB',0,'L');
            $this->setCellPaddings(1,0,1.5,0);
            $this->Cell($this->wix[2],$this->cellHeight,number_format($a->amount,2,'.',''),'LTRB',0,'R');
            $this->Cell($this->wix[3],$this->cellHeight,'','LTRB',0,'C');
            $this->setCellPaddings(1,0,3,0);
            $this->Cell($this->wix[4],$this->cellHeight,''.number_format($a->price,2,'.',''),'LTRB',0,'R');
            $wartosc = number_format($a->amount * $a->price,2,'.','');

            $this->Cell($this->wix[5],$this->cellHeight,''.$wartosc,'LTRB',0,'R');
            $this->Cell($this->wix[6],$this->cellHeight,'ex.','LTRB',0,'C');
            $this->Cell($this->wix[7],$this->cellHeight,'0.00','LTRB',0,'C');
            $this->Cell($this->wix[8],$this->cellHeight,''.$wartosc,'LTRB',0,'R');
            $this->count++;
            $this->totalValue += $a->amount * $a->price;
        }
    }

    private function addSummary()
    {
        // table Summary - RAZEM
        $this->SetXY(21.1 + $this->wix[0]-0.1 + $this->wix[1] + $this->wix[2] + $this->wix[3],114.4+($this->count*$this->cellHeight));
        $this->setCellPaddings(1,1,2,1);
        $this->SetFont($this->fontbold,'',8);
        $this->SetFillColor(240,240,240);
        $this->Cell($this->wix[4],$this->cellHeight,'TOTAL:','LTRB',0,'R',true);
        $this->setCellPaddings(1,1,3,0);
        $this->SetFont($this->fontreg,'',8);
        $this->Cell($this->wix[5],$this->cellHeight,''.number_format($this->totalValue,2,'.',''),'LTRB',0,'R');
        $this->Cell($this->wix[6],$this->cellHeight,'x','LTRB',0,'C');
        $this->Cell($this->wix[7],$this->cellHeight,'0.00','LTRB',0,'C');
        $this->SetFont($this->fontbold,'',8);
        $this->Cell($this->wix[8],$this->cellHeight,''.number_format($this->totalValue,2,'.',''),'LTRB',0,'R',true);

        $this->count++;

        // table Summary:
        $this->SetXY(21.1 + $this->wix[0]-0.1 + $this->wix[1] + $this->wix[2] + $this->wix[3],114.4+($this->count*$this->cellHeight));
        $this->setCellPaddings(1,1,2,1);
        $this->SetFont($this->fontbold,'',8);
        $this->SetFillColor(240,240,240);
        $this->Cell($this->wix[4],$this->cellHeight,'Incl.:','LTRB',0,'R',true);
        $this->setCellPaddings(1,1,3,1);
        $this->SetFont($this->fontreg,'',8);
        $this->Cell($this->wix[5],$this->cellHeight,''.number_format($this->totalValue,2,'.',''),'LTRB',0,'R');
        $this->Cell($this->wix[6],$this->cellHeight,'ex.','LTRB',0,'C');
        $this->Cell($this->wix[7],$this->cellHeight,'0.00','LTRB',0,'C');
        $this->Cell($this->wix[8],$this->cellHeight,''.number_format($this->totalValue,2,'.',''),'LTRB',0,'R');

        $this->count += 2;

        $this->SetXY(21.1 + 2,114.4+($this->count*$this->cellHeight));
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(22,$this->cellHeight,'Total:','',0,'L');
        $this->SetFont($this->fontreg,'',9);
        $this->Cell(26,$this->cellHeight,''.number_format($this->totalValue,2,'.','').' USD','',0,'R');

        $this->SetXY(21.1 + 12 + 27 + 28,114.4+($this->count*$this->cellHeight));
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(17,$this->cellHeight,'Paid:','',0,'L');
        $this->SetFont($this->fontreg,'',9);
        $this->Cell(18,$this->cellHeight,'0.00 USD','',0,'L');

        $this->SetXY(21.1 + 14 + 27 + 30 + 18 + 26,114.4 + ($this->count*$this->cellHeight));
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(32,$this->cellHeight,'Left to pay:','',0,'L');
        $this->SetFont($this->fontreg,'',9);
        $this->Cell(18,$this->cellHeight,''.number_format($this->totalValue,2,'.','').' USD','',0,'L');

        $this->count +=1.5;

        $this->SetXY(21.1 + 2,114.4+($this->count*$this->cellHeight));
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(15,$this->cellHeight,'In words:','',0,'L');
        $this->SetFont($this->fontita,'',9);

        $amount = new NumWordsConverter($this->totalValue);

        $this->Cell(151.1,$this->cellHeight,$amount->getWords().' USD '.$amount->getParts().'/'.'100','',0,'L');

        $this->count +=1.5;

        $this->SetXY(21.1 + 2,114.4+($this->count*$this->cellHeight));
        $this->SetFont($this->fontbold,'',9);
        $this->Cell(15,$this->cellHeight,'Notes:','',0,'L');
        $this->SetFont($this->fontita,'',9);

        // different note for education / other services
        if($this->inv->docType == 'education') {
            $this->Cell(151.1,$this->cellHeight,'Basis for VAT exemption: Article 43. paragraph 1 point 28 VAT Act','',0,'L');
        } else {
            $this->Cell(151.1,$this->cellHeight,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -','',0,'L');
        }
    }

    private function addSignatureFields()
    {
        $this->count +=15;
        $this->setCellHeightRatio(1.2);
        $this->SetFont($this->fontita,'',8);
        $this->setCellPaddings(7,1,7,1);
        $this->SetXY(21,114.4+($this->count*$this->cellHeight));
        $this->MultiCell(168/2,12,'First and last name of invoice recipient','','C');
        $this->SetXY(21+(168/2),114.4+($this->count*$this->cellHeight));
        $this->MultiCell(168/2,12,'First and last name of person authorised to issue the invoice','','C');
        $this->count-=1.5;
        $this->SetXY(21+(168/2),114.4+($this->count*$this->cellHeight));
        $this->SetFont($this->fontbold,'',12);
        $this->MultiCell(168/2,12,$this->inv->selName,'','C');
    }
}
