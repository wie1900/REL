<?php

namespace App\Custom\PrintDoc;

/**
 * -------- NumWordsConverter -----------
 * Returns payment number in words (english version)
 */
class NumWordsConverter
{
	private $enterNumber;
    private $beforeComma;
    private $afterComma;

    function __construct($enterNumber)
    {
        $this->enterNumber = number_format($enterNumber,2,'.','');
        $this->setPointParts();
    }

	// returns the part before comma in words
    public function getWords()
    {
    	$forString = '';

    	switch(strlen($this->beforeComma)){
    		case 0:
	    		$forString = '';
	    		break;
    		case 1:
    			$forString = $this->addOnesDigits($this->beforeComma);
    			break;
    		case 2:
    			$forString = $this->addTwoDigits($this->beforeComma);
    			break;
			case 3:
				$forString = $this->addHundreds($this->beforeComma);
				$forString .= ' '.$this->addTwoDigits(substr($this->beforeComma,1,2));
				break;
			case 4:
				$forString = $this->addThousandsOncesDigits($this->beforeComma);
				$forString .= ' '.$this->addHundreds(substr($this->beforeComma,1,3));
				$forString .= ' '.$this->addTwoDigits(substr($this->beforeComma,2,2));
				break;
			case 5:
				$forString = $this->addThousandsTwoDigits($this->beforeComma);
				$forString .= ' '.$this->addHundreds(substr($this->beforeComma,2,3));
				$forString .= ' '.$this->addTwoDigits(substr($this->beforeComma,3,2));
				break;
			default:
				$forString = "";
    	}
        return $forString;
    }

    // returns the part after comma
    public function getParts()
    {
    	return $this->afterComma;
    }

    // splits the number at '.' and sets to the parts: beforeComma and afterComma
    private function setPointParts()
    {
    	$arr = array();
    	if(strpos($this->enterNumber,'.')) {
    		$arr = explode(".",$this->enterNumber);
    		$this->beforeComma = $arr[0];
    		$this->afterComma = $arr[1];
        }else{
    		$this->beforeComma = $this->enterNumber;
    		$this->afterComma = '00';
    	}
    }

    // add units
    private function addOnesDigits($enterNumber)
    {
    	switch($enterNumber){
    		case 0: return ''; break;
			case 1: return 'one'; break;
			case 2: return 'two'; break;
			case 3: return 'three'; break;
			case 4: return 'four'; break;
			case 5: return 'five'; break;
			case 6: return 'six'; break;
			case 7: return 'seven'; break;
			case 8: return 'eight'; break;
			case 9: return 'nine'; break;
			default: return 'zero'; break;
    	}
    }

    // add 2 digits
    private function addTwoDigits($enterNumber)
    {
    	switch(substr($enterNumber,0,1)){
    		case 0:
    			return $this->addOnesDigits(substr($enterNumber,1,1));
    			break;

    		case 1:
	    		switch(substr($enterNumber,1,1)){
	    			case 0: return 'ten'; break;
	    			case 1: return 'eleven'; break;
	    			case 2: return 'twelve'; break;
	    			case 3: return 'thirteen'; break;
	    			case 4: return 'fourteen'; break;
	    			case 5: return 'fifteen'; break;
	    			case 6: return 'sixteen'; break;
	    			case 7: return 'seventeen'; break;
	    			case 8: return 'eighteen'; break;
	    			case 9: return 'nineteen'; break;
	    			default: return 'zero'; break;
	    		}
    			break;

    		case 2:
    			$forReturn = 'twenty';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 3:
    			$forReturn = 'thirty';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 4:
    			$forReturn = 'forty';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 5:
    			$forReturn = 'fifty';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 6:
    			$forReturn = 'sixty';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 7:
    			$forReturn = 'seventy';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 8:
    			$forReturn = 'eighty';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;

    		case 9:
    			$forReturn = 'ninety';
    			if(substr($enterNumber,1,1)!=0) $forReturn .= '-'.$this->addOnesDigits(substr($enterNumber,1,1));
    			return $forReturn;
    			break;
			default: return ''; break;
    	}
    }

    // add hundreds
    private function addHundreds($enterNumber)
    {
    	switch(substr($enterNumber,0,1)){
    		case 0: return ''; break;
			case 1: return 'one hundred'; break;
			case 2: return 'two hundred'; break;
			case 3: return 'three hundred'; break;
			case 4: return 'four hundred'; break;
			case 5: return 'five hundred'; break;
			case 6: return 'six hundred'; break;
			case 7: return 'seven hundred'; break;
			case 8: return 'eight hundred'; break;
			case 9: return 'nine hundred'; break;
			default: return ''; break;
    	}
    }

    // add tousends
    private function addThousandsOncesDigits($enterNumber)
    {
    	switch(substr($enterNumber,0,1)){
    		case 0: return ''; break;
			case 1: return 'one thousand'; break;
			case 2: return 'two thousand'; break;
			case 3: return 'three thousand'; break;
			case 4: return 'four thousand'; break;
			case 5: return 'five thousand'; break;
			case 6: return 'six thousand'; break;
			case 7: return 'seven thousand'; break;
			case 8: return 'eight thousand'; break;
			case 9: return 'nine thousand'; break;
			default: return ''; break;
    	}
    }

    // add 2 digit tousends
    private function addThousandsTwoDigits($enterNumber)
    {
    	// adjusts suffixes dependly on unit or more tousends
    	// adjusts suffixes - separation on teens and more

    	$forReturn = $this->addTwoDigits(substr($enterNumber,0,2));
    	if(substr($enterNumber,0,1)>1 && substr($enterNumber,1,1) > 1 && substr($enterNumber,1,1) < 5) $forReturn = $forReturn.' '.'thousand';
    	else $forReturn .= ' '.'thousand';

    	return $forReturn;
    }
}

