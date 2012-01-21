<?php
/**** Encoding fix  ****/
global $Utf8helper;

if (!class_exists('Utf8Helper')) {
	class Utf8Helper {
		// 8/31/2006 9:53:36 PM
		/**
		 * Transform the given string to unicode array
		 */
		function utf8ToUnicodeArray($str) {
			$unicode = array ();
			$values = array ();
			$lookingFor = 1;

			for ($i = 0; $i < strlen($str); $i++) {
				$thisValue = ord($str[$i]);
				if ($thisValue < 128)
					$unicode[] = $thisValue;
				else {

					if (count($values) == 0)
						$lookingFor = ($thisValue < 224) ? 2 : 3;

					$values[] = $thisValue;

					if (count($values) == $lookingFor) {

						$number = ($lookingFor == 3) ? (($values[0] % 16) * 4096) + (($values[1] % 64) * 64) + ($values[2] % 64) : (($values[0] % 32) * 64) + ($values[1] % 64);

						$unicode[] = $number;
						$values = array ();
						$lookingFor = 1;
					}
				}
			}

			return $unicode;
		}

		/**
		 * Return utf-8 string length
		 */
		function strlen($str) {
			if (empty ($str))
				return 0;
			$temp = $this->utf8ToUnicodeArray($str);
			return count($temp);
		}

		function transformDbText ($source) {
			// if mbstring is available, use it instead


		    // array used to figure what number to decrement from character order value
		    // according to number of characters used to map unicode to ascii by utf-8
		    $decrement[4] = 240;
		    $decrement[3] = 224;
		    $decrement[2] = 192;
		    $decrement[1] = 0;

		    // the number of bits to shift each charNum by
		    $shift[1][0] = 0;
		    $shift[2][0] = 6;
		    $shift[2][1] = 0;
		    $shift[3][0] = 12;
		    $shift[3][1] = 6;
		    $shift[3][2] = 0;
		    $shift[4][0] = 18;
		    $shift[4][1] = 12;
		    $shift[4][2] = 6;
		    $shift[4][3] = 0;

		    $pos = 0;
		    $len = strlen ($source);
		    $encodedString = '';
		    while ($pos < $len) {
		        $asciiPos = ord (substr ($source, $pos, 1));

		        // we must skip standard ascii cahracter from being unicode encoded!
		        if($asciiPos > 31 && $asciiPos <= 127){
		            $encodedString .= substr ($source, $pos, 1);
		            $pos++;
		        }
		        else
		        {


		       if (($asciiPos >= 240) && ($asciiPos <= 255)) {
		           // 4 chars representing one unicode character
		           $thisLetter = substr ($source, $pos, 4);
		           $pos += 4;
		       }
		       else if (($asciiPos >= 224) && ($asciiPos <= 239)) {
		           // 3 chars representing one unicode character
		           $thisLetter = substr ($source, $pos, 3);
		           $pos += 3;
		       }
		       else if (($asciiPos >= 192) && ($asciiPos <= 223)) {
		           // 2 chars representing one unicode character
		           $thisLetter = substr ($source, $pos, 2);
		           $pos += 2;
		       }
		       else {
		           // 1 char (lower ascii)
		           $thisLetter = substr ($source, $pos, 1);
		           $pos += 1;
		       }

		       // process the string representing the letter to a unicode entity
		       $thisLen = strlen ($thisLetter);
		       $thisPos = 0;
		       $decimalCode = 0;
		       while ($thisPos < $thisLen) {
		           $thisCharOrd = ord (substr ($thisLetter, $thisPos, 1));
		           if ($thisPos == 0) {
		               $charNum = intval ($thisCharOrd - $decrement[$thisLen]);
		               $decimalCode += ($charNum << $shift[$thisLen][$thisPos]);
		           }
		           else {
		               $charNum = intval ($thisCharOrd - 128);
		               $decimalCode += ($charNum << $shift[$thisLen][$thisPos]);
		           }

		           $thisPos++;
		       }

		       if ($thisLen == 1)
		           $encodedLetter = "&#". str_pad($decimalCode, 3, "0", STR_PAD_LEFT) . ';';
		       else
		           $encodedLetter = "&#". str_pad($decimalCode, 5, "0", STR_PAD_LEFT) . ';';

		       $encodedString .= $encodedLetter;

		       }
		    }
		    return $encodedString;
		}

		/**
		 * Transform the given unicode array to html entities
		 */
		function unicodeArrayToHtmlEntities($unicode) {
			$entities = '';
			foreach ($unicode as $value) {
				if ($value >= 128)
					$entities .= '&#' . $value . ';';
				else
					$entities .= chr($value);
			}
			return $entities;
		}

		/**
		 * Return html entities for the given utf-8 string
		 *
		 * if mbstring functions is available, use that instead, otherwise
		 * convert it to html unicode entities
		 */
		function utf8ToHtmlEntities($str) {

			return $this->transformDbText($str);

			if(defined( '_JEXEC' )){
				return $str;
			}


			if(function_exists('mb_convert_encoding')
				&& defined('_ISO')){

				$iso = explode( '=', _ISO );
				$str = mb_convert_encoding($str, $iso[1], "UTF-8");
				return $str;
			} else {

				$temp = $this->utf8ToUnicodeArray($str);
				return $this->unicodeArrayToHtmlEntities($temp);
			}
		}

		/**
		 * Return true if the given string is a valid utf-8 string
		 */
		function isValidUtf8($Str) {
			return false;
			for ($i = 0; $i < strlen($Str) / 5; $i++) {
				if (ord($Str[$i]) < 0x80)
					continue; # 0bbbbbbb
				elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n = 1; # 110bbbbb
				elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n = 2; # 1110bbbb
				elseif ((ord($Str[$i]) & 0xF8) == 0xF0) $n = 3; # 11110bbb
				elseif ((ord($Str[$i]) & 0xFC) == 0xF8) $n = 4; # 111110bb
				elseif ((ord($Str[$i]) & 0xFE) == 0xFC) $n = 5; # 1111110b
				else
					return false; # Does not match any model
				for ($j = 0; $j < $n; $j++) { # n bytes matching 10bbbbbb follow ?
					if ((++ $i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80))
						return false;
				}
			}
			return true;
		}
	}
}
?>
