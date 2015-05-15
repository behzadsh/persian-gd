<?php namespace Quince\PersianGD;

use Quince\PersianGD\Contracts\StringDecorator;

class PersianStringDecorator implements StringDecorator {

	/**
	 * All persian characters with all types
	 *
	 * @var array
	 */
	protected $persianChars = [
		'آ' => ['ﺂ', 'ﺂ', 'آ'],
		'ا' => ['ﺎ', 'ﺎ', 'ا'],
		'ب' => ['ﺐ', 'ﺒ', 'ﺑ'],
		'پ' => ['ﭗ', 'ﭙ', 'ﭘ'],
		'ت' => ['ﺖ', 'ﺘ', 'ﺗ'],
		'ث' => ['ﺚ', 'ﺜ', 'ﺛ'],
		'ج' => ['ﺞ', 'ﺠ', 'ﺟ'],
		'چ' => ['ﭻ', 'ﭽ', 'ﭼ'],
		'ح' => ['ﺢ', 'ﺤ', 'ﺣ'],
		'خ' => ['ﺦ', 'ﺨ', 'ﺧ'],
		'د' => ['ﺪ', 'ﺪ', 'ﺩ'],
		'ذ' => ['ﺬ', 'ﺬ', 'ﺫ'],
		'ر' => ['ﺮ', 'ﺮ', 'ﺭ'],
		'ز' => ['ﺰ', 'ﺰ', 'ﺯ'],
		'ژ' => ['ﮋ', 'ﮋ', 'ﮊ'],
		'س' => ['ﺲ', 'ﺴ', 'ﺳ'],
		'ش' => ['ﺶ', 'ﺸ', 'ﺷ'],
		'ص' => ['ﺺ', 'ﺼ', 'ﺻ'],
		'ض' => ['ﺾ', 'ﻀ', 'ﺿ'],
		'ط' => ['ﻂ', 'ﻄ', 'ﻃ'],
		'ظ' => ['ﻆ', 'ﻈ', 'ﻇ'],
		'ع' => ['ﻊ', 'ﻌ', 'ﻋ'],
		'غ' => ['ﻎ', 'ﻐ', 'ﻏ'],
		'ف' => ['ﻒ', 'ﻔ', 'ﻓ'],
		'ق' => ['ﻖ', 'ﻘ', 'ﻗ'],
		'ک' => ['ﻚ', 'ﻜ', 'ﻛ'],
		'گ' => ['ﮓ', 'ﮕ', 'ﮔ'],
		'ل' => ['ﻞ', 'ﻠ', 'ﻟ'],
		'م' => ['ﻢ', 'ﻤ', 'ﻣ'],
		'ن' => ['ﻦ', 'ﻨ', 'ﻧ'],
		'و' => ['ﻮ', 'ﻮ', 'ﻭ'],
		'ه' => ['ﻪ', 'ﻬ', 'ﻫ'],
		'ی' => ['ﯽ', 'ﯿ', 'ﯾ'],
		'ك' => ['ﻚ', 'ﻜ', 'ﻛ'],
		'ي' => ['ﻲ', 'ﻴ', 'ﻳ'],
		'أ' => ['ﺄ', 'ﺄ', 'ﺃ'],
		'ؤ' => ['ﺆ', 'ﺆ', 'ﺅ'],
		'إ' => ['ﺈ', 'ﺈ', 'ﺇ'],
		'ئ' => ['ﺊ', 'ﺌ', 'ﺋ'],
		'ة' => ['ﺔ', 'ﺘ', 'ﺗ']
	];

	/**
	 * Character that no other character will joint after them
	 *
	 * @var array
	 */
	protected $detachChars = [
		'آ', 'ا', 'د', 'ذ', 'ر', 'ز', 'ژ', 'و', 'أ', 'إ', 'ؤ'
	];

	/**
	 * Character to be ignore in processing
	 *
	 * @var array
	 */
	protected $ignorelist = [
		'', 'ٌ', 'ٍ', 'ً', 'ُ', 'ِ', 'َ', 'ّ', 'ٓ', 'ٰ', 'ٔ', 'ﹶ',
		'ﹺ', 'ﹸ', 'ﹼ', 'ﹾ', 'ﹴ', 'ﹰ', 'ﱞ', 'ﱟ', 'ﱠ', 'ﱡ', 'ﱢ', 'ﱣ',
	];

	/**
	 * Character used for enclosing
	 *
	 * @var array
	 */
	protected $enclosingChars = [
		'>', ')', '}', ']', '<', '(', '{', '['
	];

	/**
	 * Enclosing character map for reversing
	 *
	 * @var array
	 */
	protected $enclosingMap = [
		')' => '(',
		'(' => ')',
		'}' => '{',
		'{' => '}',
		']' => '[',
		'[' => ']',
		'>' => '<',
		'<' => '>',
	];

	/**
	 * English characters
	 *
	 * @var array
	 */
	protected $englishChars = [
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
	];

	/**
	 * Numbers character
	 *
	 * @var array
	 */
	protected $numbers = [
		'٠', '١', '٢', '٣', '۴', '۵', '۶', '٧', '٨', '٩', '۴', '۵', '۶', '٤', '٥', '٦',
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
	];

	/**
	 * Number character map to convert
	 *
	 * @var array
	 */
	protected $numberMap = [
		'0' => '۰',
		'1' => '۱',
		'2' => '۲',
		'3' => '۳',
		'4' => '۴',
		'5' => '۵',
		'6' => '۶',
		'7' => '۷',
		'8' => '۸',
		'9' => '۹'
	];

	/**
	 * @var array
	 */
	protected $persianSymbols = [
		'،', '؟', 'ء'
	];

	/**
	 * Array of string character to be iterate
	 *
	 * @var array
	 */
	protected $iterative = [];

	/**
	 * Current character
	 *
	 * @var string
	 */
	protected $current = null;

	/**
	 * Next charcter
	 *
	 * @var string
	 */
	protected $next = null;

	/**
	 * Previous character
	 *
	 * @var string
	 */
	protected $prev = null;

	/**
	 * The output result
	 *
	 * @var string
	 */
	protected $output = '';

	/**
	 * The numbers output
	 *
	 * @var string
	 */
	protected $numberOutput = '';

	/**
	 * The english output
	 *
	 * @var string
	 */
	protected $englishOutput = '';

	/**
	 * @var string
	 */
	protected $eOutput = '';

	/**
	 * Decorate given (persian) string and prepare it for gd
	 *
	 * @param string $string
	 * @param bool   $persianNumbers
	 * @param bool   $rtl
	 * @return string
	 */
	public function decorate($string, $persianNumbers = true, $rtl = true)
	{
		$this->setStringIterative($string);

		for ($i = 0; $i < $this->stringLength(); $i++) {
			$this->setPointers($i);
			$this->process($i, $rtl, $persianNumbers);
		}

		if ($this->englishOutput != '') {
			$this->prepend($this->englishOutput);
		}

		return $this->output;
	}

	/**
	 * Set the characters pointer
	 *
	 * @param int $index
	 */
	protected function setPointers($index)
	{
		$this->setCurrent($this->getChar($index));

		// Check if the next character is in ignore list
		if ($this->shouldBeIgnored($this->getChar($index + 1))) {
			$this->setNext($this->getChar($index + 2));

			if ($index == 2) {
				$this->setPrev($this->getChar($index - 2));
			}
			if ($index != 2) {
				$this->setPrev($this->getChar($index - 1));
			}
		} // Check if previous character not in ignore list
		elseif (!$this->shouldBeIgnored($this->getChar($index - 1))) {
			$this->setNext($this->getChar($index + 1));
			if ($index != 0) {
				$this->setPrev($this->getChar($index - 1));
			}
		} else {
			if (!is_null($this->getChar($index + 1))) {
				$this->setNext($this->getChar($index + 1));
			} else {
				$this->setNext($this->getChar($index - 1));
			}

			if ($index != 0) {
				$this->setPrev($this->getChar($index - 2));
			}
		}
	}

	/**
	 * Process the character in given index
	 *
	 * @param int  $index
	 * @param bool $rtl
	 * @param bool $persianNumber
	 * @return bool
	 */
	protected function process($index, $rtl, $persianNumber)
	{
		if (!$this->shouldBeIgnored($this->current)) {
			if ($this->isPersianChar($this->current)) {
				$this->processPersianWord();
			} elseif ($rtl) {
				$this->processNonPersianWord($index, $persianNumber);
			} else {
				$this->processSymbolsAndOtherChars();
			}
		} else {
			$this->prepend($this->current);
		}

		$this->resetPointers();
	}

	/**
	 * Set current character
	 *
	 * @param string $current
	 */
	protected function setCurrent($current)
	{
		$this->current = $current;
	}

	/**
	 * Set the next character
	 *
	 * @param string $next
	 */
	protected function setNext($next)
	{
		$this->next = $next;
	}

	/**
	 * Set previous character
	 *
	 * @param string $prev
	 */
	protected function setPrev($prev)
	{
		$this->prev = $prev;
	}

	protected function processPersianWord()
	{
		if (is_null($this->prev) || $this->prev == ' ' || !$this->isPersianChar($this->prev)) {
			return $this->processPersianWordFirstChar();
		} elseif ($this->isPersianChar($this->prev) && $this->isPersianChar($this->next)) {
			return $this->processPersianWordMiddleChar();
		} elseif ($this->isPersianChar($this->prev) && !$this->isPersianChar($this->next)) {
			return $this->processPersianWordLastChar();
		}
	}

	/**
	 * @return bool
	 */
	protected function processPersianWordFirstChar()
	{
		// Next and previous character are not persian characters
		if (!$this->isPersianChar($this->next) && !$this->isPersianChar($this->prev)) {
			$this->prepend($this->current);
		} else {
			$this->prepend($this->getFirstJoint($this->current));
		}

		// continue the parent loop
		return true;
	}

	/**
	 * @return bool
	 */
	protected function processPersianWordMiddleChar()
	{
		if ($this->isDetachedChar($this->prev) && $this->isPersianChar($this->next)) {
			$this->prepend($this->getFirstJoint($this->current));
		} else {
			$this->prepend($this->getMiddleJoint($this->current));
		}

		// continue the parent loop
		return true;
	}

	/**
	 * @return bool
	 */
	protected function processPersianWordLastChar()
	{
		if ($this->isDetachedChar($this->prev)) {
			$this->prepend($this->current);
		} else {
			$this->prepend($this->getLastJoint($this->current));
		}

		// continue the parent loop
		return true;
	}

	/**
	 * @param $index
	 * @param $persianNumber
	 */
	protected function processNonPersianWord($index, $persianNumber)
	{
		// Check if current character is an enclosing character
		if ($this->isEnclosingChars($this->current)) {
			$this->reverseEnclosing($this->current);
		} // Check if current character is a number

		if ($this->isNumber($this->current)) {
			$this->processNumber($persianNumber);
		}

		if (!$this->isNumber($this->next)) {
			if (
				$this->isEnglishChar($this->current) ||
				($this->isSpaceOrDot($this->current) && $this->englishOutput != '' &&
				 !$this->isPersianChar($this->next))
			) {
				$this->englishOutput .= $this->current . $this->numberOutput;

				$this->setCurrent('');
			} else {
				if ($this->englishOutput != '') {
					if ($index + 1 == $this->stringLength()) {
						$this->setCurrent($this->current . $this->numberOutput);
					} else {
						$this->englishOutput .= $this->current . $this->numberOutput;
					}
				} else {
					$this->setCurrent($this->current . $this->numberOutput);
				}
			}

			$this->numberOutput = '';
		}

		if ($this->englishOutput != '' || $this->isFirstLoop($index)) {
			if (!$this->isPersianChar($this->current)) {
				if (
					!$this->isPersianChar($this->next) && $this->next != ' ' &&
					!$this->isEnclosingChars($this->next)
				) {
					$this->englishOutput .= $this->current;
				} else {
					if ($this->isEnglishChar($this->getChar($index + 2))) {
						$this->englishOutput .= $this->current;
					} else {
						if (
							$this->next == ' ' &&
							($this->isNumber($this->getChar($index + 2)) ||
							 $this->isEnglishChar($this->getChar($index + 2)))
						) {
							$this->englishOutput .= $this->current;
						} else {
							$this->prepend($this->englishOutput);
							$this->englishOutput = '';
						}
					}
				}
			} else {
				if ($this->numberOutput) {
					$this->englishOutput .= $this->numberOutput;
				} else {
					$this->prepend($this->englishOutput . $this->current);
					$this->englishChars = '';
				}
			}
		} else {
			if (
				$this->isNumber($this->current) && $this->next == '.' &&
				$this->isNumber($this->getChar($index + 2))
			) {
				$this->englishOutput = $this->current;
			} else {
				$this->prepend($this->current);
			}
		}
	}

	protected function processSymbolsAndOtherChars()
	{
		if (
			$this->isPersionSymbols($this->current) ||
			($this->isPersianChar($this->prev) && $this->isPersianChar($this->next)) ||
			($this->current == ' ' && $this->isPersianChar($this->next)) ||
			($this->current == ' ' && $this->isPersianChar($this->prev))
		) {
			if ($this->eOutput) {
				$this->prepend($this->eOutput);
				$this->eOutput = '';
			}

			$this->prepend($this->current);
		} else {
			$this->eOutput .= $this->current;

			if ($this->isPersianChar($this->next) || $this->next == '') {
				$this->prepend($this->eOutput);
				$this->eOutput = '';
			}
		}
	}

	/**
	 * @param $persianNumber
	 */
	protected function processNumber($persianNumber)
	{
		if ($persianNumber) {
			$this->numberOutput .= $this->persianizeNumbers($this->current);
		} else {
			$this->numberOutput = $this->current;
		}

		$this->setCurrent('');
	}

	/**
	 * Set the iterative string
	 *
	 * @param string $string
	 */
	protected function setStringIterative($string)
	{
		preg_match_all("/./u", $string, $match);
		$this->iterative = $match[0];
	}

	/**
	 * return count of string characters
	 *
	 * @return int
	 */
	protected function stringLength()
	{
		return count($this->iterative);
	}

	/**
	 * Get character with given index
	 *
	 * @param int $index
	 * @return string
	 */
	protected function getChar($index)
	{
		if (isset($this->iterative[$index])) {
			return $this->iterative[$index];
		}

		return null;
	}

	/**
	 * Check if charcter is in ignore list
	 *
	 * @param $char
	 * @return bool
	 */
	protected function shouldBeIgnored($char)
	{
		return in_array($char, $this->ignorelist);
	}

	/**
	 * Check if character is a persian character
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isPersianChar($char)
	{
		return array_key_exists($char, $this->persianChars);
	}

	/**
	 * Check if character is a detached character
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isDetachedChar($char)
	{
		return in_array($char, $this->detachChars);
	}

	/**
	 * Check if charcter is a enclosing character
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isEnclosingChars($char)
	{
		return in_array($char, $this->enclosingChars);
	}

	/**
	 * Check if character is a number
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isNumber($char)
	{
		return in_array($char, $this->numbers);
	}

	/**
	 * Check if charcter is an english character
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isEnglishChar($char)
	{
		return in_array(strtolower($char), $this->englishChars);
	}

	/**
	 * Check if charcter is space or dot
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isSpaceOrDot($char)
	{
		return ($char == ' ' || $char == '.');
	}

	/**
	 * Check if we are in first loop and current character is not empty
	 * and next character is nor persian neither space
	 *
	 * @param int $index
	 * @return bool
	 */
	protected function isFirstLoop($index)
	{
		return ($this->current != '' && $index == 0 && (!$this->isPersianChar($this->next) && $this->next != ' '));
	}

	/**
	 * Check if given character
	 *
	 * @param string $char
	 * @return bool
	 */
	protected function isPersionSymbols($char)
	{
		return in_array($char, $this->persianSymbols);
	}

	/**
	 * Prepend given string to output
	 *
	 * @param string $char
	 */
	protected function prepend($char)
	{
		$this->output = $char . $this->output;
	}

	/**
	 * Get first joint symbol of given character
	 *
	 * @param string $char
	 * @return string
	 */
	protected function getFirstJoint($char)
	{
		if (isset($this->persianChars[$char])) {
			return $this->persianChars[$char][2];
		}

		return $char;
	}

	/**
	 * Get middele joint symbol of given character
	 *
	 * @param string $char
	 * @return string
	 */
	protected function getMiddleJoint($char)
	{
		if (isset($this->persianChars[$char])) {
			return $this->persianChars[$char][1];
		}

		return $char;
	}

	/**
	 * Get last joint symbol of given character
	 *
	 * @param string $char
	 * @return string
	 */
	protected function getLastJoint($char)
	{
		if (isset($this->persianChars[$char])) {
			return $this->persianChars[$char][0];
		}

		return $char;
	}

	/**
	 * Reverse current enclosing character
	 *
	 * @param string $char
	 */
	protected function reverseEnclosing($char)
	{
		$this->setCurrent($this->enclosingMap[$char]);
	}

	/**
	 * Convert english numbers to persian one
	 *
	 * @param string $num
	 * @return string
	 */
	protected function persianizeNumbers($num)
	{
		if (array_key_exists($num, $this->numberMap)) {
			return $this->numberMap[$num];
		}

		return $num;
	}

	protected function resetPointers()
	{
		$this->prev = null;
		$this->next = null;
	}

}
