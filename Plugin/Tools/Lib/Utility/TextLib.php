<?php
App::uses('String', 'Utility');

/**
 * TODO: extend the core String class some day?
 *
 * 2010-08-31 ms
 */
class TextLib extends String {

	protected $text, $lenght, $char, $letter, $space, $word, $r_word, $sen, $r_sen, $para,
		$r_para, $beautified;


	public function __construct($text = null) {
		$this->text = $text;
	}

	/**
	 * Return an abbreviated string, with characters in the middle of the
	 * excessively long string replaced by $ending.
	 *
	 * @param string $text The original string.
	 * @param integer $length The length at which to abbreviate.
	 * @return string The abbreviated string, if longer than $length.
	 */
	public static function abbreviate($text, $length = 20, $ending = '...') {
		return (mb_strlen($text) > $length)
			? rtrim(mb_substr($text, 0, round(($length - 3) / 2))) . $ending . ltrim(mb_substr($text, (($length - 3) / 2) * -1))
			: $text;
	}


/* other */

	public function convertToOrd($str = null, $separator = '-') {
		/*
		if (!class_exists('UnicodeLib')) {
			App::uses('UnicodeLib', 'Tools.Lib');
		}
		*/
		if ($str === null) {
			$str = $this->text;
		}
		$chars = preg_split('//', $str, -1);
		$res = array();
		foreach ($chars as $char) {
			//$res[] = UnicodeLib::ord($char);
			$res[] = ord($char);
		}
		return implode($separator, $res);
	}

	public static function convertToOrdTable($str, $maxCols = 20) {
		$res = '<table>';
		$r = array('chr'=>array(), 'ord'=>array());
		$chars = preg_split('//', $str, -1);
		$count = 0;
		foreach ($chars as $key => $char) {
			if ($maxCols && $maxCols < $count || $key === count($chars)-1) {
				$res .= '<tr><th>'.implode('</th><th>', $r['chr']).'</th>';
				$res .= '</tr>';
				$res .= '<tr>';
				$res .= '<td>'.implode('</th><th>', $r['ord']).'</td></tr>';
				$count = 0;
				$r = array('chr'=>array(), 'ord'=>array());
			}
			$count++;
			//$res[] = UnicodeLib::ord($char);
			$r['ord'][] = ord($char);
			$r['chr'][] = $char;
		}

		$res .= '</table>';
		return $res;
	}

	/**
	 * Explode a string of given tags into an array.
	 */
	public function explodeTags($tags) {
		// This regexp allows the following types of user input:
		// this, "somecompany, llc", "and ""this"" w,o.rks", foo bar
		$regexp = '%(?:^|,\ *)("(?>[^"]*)(?>""[^"]* )*"|(?: [^",]*))%x';
		preg_match_all($regexp, $tags, $matches);
		$typed_tags = array_unique($matches[1]);

		$tags = array();
		foreach ($typed_tags as $tag) {
		// If a user has escaped a term (to demonstrate that it is a group,
		// or includes a comma or quote character), we remove the escape
		// formatting so to save the term into the database as the user intends.
		$tag = trim(str_replace('""', '"', preg_replace('/^"(.*)"$/', '\1', $tag)));
		if ($tag) {
			$tags[] = $tag;
		}
		}

		return $tags;
	}


	/**
	 * Implode an array of tags into a string.
	 */
	public function implodeTags($tags) {
		$encoded_tags = array();
		foreach ($tags as $tag) {
		// Commas and quotes in tag names are special cases, so encode them.
		if (strpos($tag, ',') !== FALSE || strpos($tag, '"') !== FALSE) {
			$tag = '"'. str_replace('"', '""', $tag) .'"';
		}

		$encoded_tags[] = $tag;
		}
		return implode(', ', $encoded_tags);
	}



	/**
	 * Prevents [widow words](http://www.shauninman.com/archive/2006/08/22/widont_wordpress_plugin)
	 * by inserting a non-breaking space between the last two words.
	 *
	 * echo Text::widont($text);
	 *
	 * @param string text to remove widows from
	 * @return string
	 */
	public function widont($str = null) {
		if ($str === null) {
			$str = $this->text;
		}
		$str = rtrim($str);
		$space = strrpos($str, ' ');

		if ($space !== FALSE) {
			$str = substr($str, 0, $space).'&nbsp;'.substr($str, $space + 1);
		}

		return $str;
	}


/* text object specific */

	/**
	 * @param options
	 * - min_char, max_char, case_sensititive, ...
	 * 2010-10-09 ms
	 */
	public function words($options = array()) {
		if (true || !$this->xr_word) {
			$text = str_replace(array(PHP_EOL, NL, TB), ' ', $this->text);

			$pieces = explode(' ', $text);
			$pieces = array_unique($pieces);

			# strip chars like . or ,
			foreach ($pieces as $key => $piece) {
				if (empty($options['case_sensitive'])) {
					$piece = mb_strtolower($piece);
				}
				$search = array(',', '.', ';', ':', '#', '', '(', ')', '{', '}', '[', ']', '$', '%', '"', '!', '?', '<', '>', '=', '/');
				$search = array_merge($search, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0));
				$piece = str_replace($search, '', $piece);
				$piece = trim($piece);

				if (empty($piece) || !empty($options['min_char']) && mb_strlen($piece) < $options['min_char'] || !empty($options['max_char']) && mb_strlen($piece) > $options['max_char']) {
					unset($pieces[$key]);
				} else {
					$pieces[$key] = $piece;
				}
			}
			$pieces = array_unique($pieces);
			//$this->xr_word = $pieces;
		}
		return $pieces;
	}

	/**
	 * Limit the number of words in a string.
	 *
	 * <code>
	 *		// Returns "This is a..."
	 *		echo TextExt::maxWords('This is a sentence.', 3);
	 *
	 *		// Limit the number of words and append a custom ending
	 *		echo Str::words('This is a sentence.', 3, '---');
	 * </code>
	 *
	 * @param string  $value
	 * @param int     $words
	 * @param array $options
	 * - ellipsis
	 * - html
	 * @return string
	 */
	public static function maxWords($value, $words = 100, $options = array()) {
		$default = array(
			'ellipsis' => '...'
		);
		if (!empty($options['html']) && Configure::read('App.encoding') === 'UTF-8') {
			$default['ellipsis'] = "\xe2\x80\xa6";
		}
		$options = array_merge($default, $options);

		if (trim($value) === '') {
			return '';
		}
		preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);

		$end = $options['ellipsis'];
		if (mb_strlen($value) === mb_strlen($matches[0])) {
			$end = '';
		}
		return rtrim($matches[0]) . $end;
	}

	/**
	 * High ASCII to Entities
	 *
	 * Converts High ascii text and MS Word special characters to character entities
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function ascii_to_entities($str) {
		$count = 1;
		$out = '';
		$temp = array();

		for ($i = 0, $s = strlen($str); $i < $s; $i++) {
			$ordinal = ord($str[$i]);

			if ($ordinal < 128) {
				/*
				If the $temp array has a value but we have moved on, then it seems only
				fair that we output that entity and restart $temp before continuing. -Paul
				*/
				if (count($temp) == 1) {
					$out .= '&#' . array_shift($temp) . ';';
					$count = 1;
				}

				$out .= $str[$i];
			} else {
				if (count($temp) == 0) {
					$count = ($ordinal < 224) ? 2 : 3;
				}

				$temp[] = $ordinal;

				if (count($temp) == $count) {
					$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] %
						64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);

					$out .= '&#' . $number . ';';
					$count = 1;
					$temp = array();
				}
			}
		}
		return $out;
	}

	// ------------------------------------------------------------------------

	/**
	 * Entities to ASCII
	 *
	 * Converts character entities back to ASCII
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	public function entities_to_ascii($str, $all = true) {
		if (preg_match_all('/\&#(\d+)\;/', $str, $matches)) {
			for ($i = 0, $s = count($matches['0']); $i < $s; $i++) {
				$digits = $matches['1'][$i];

				$out = '';

				if ($digits < 128) {
					$out .= chr($digits);

				} elseif ($digits < 2048) {
					$out .= chr(192 + (($digits - ($digits % 64)) / 64));
					$out .= chr(128 + ($digits % 64));
				} else {
					$out .= chr(224 + (($digits - ($digits % 4096)) / 4096));
					$out .= chr(128 + ((($digits % 4096) - ($digits % 64)) / 64));
					$out .= chr(128 + ($digits % 64));
				}

				$str = str_replace($matches['0'][$i], $out, $str);
			}
		}

		if ($all) {
			$str = str_replace(array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;", "&#45;"),
				array("&", "<", ">", "\"", "'", "-"), $str);
		}

		return $str;
	}


	/**
	 * Reduce Double Slashes
	 *
	 * Converts double slashes in a string to a single slash,
	 * except those found in http://
	 *
	 * http://www.some-site.com//index.php
	 *
	 * becomes:
	 *
	 * http://www.some-site.com/index.php
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function reduce_double_slashes($str) {
		return preg_replace("#([^:])//+#", "\\1/", $str);
	}

	// ------------------------------------------------------------------------

	/**
	 * Reduce Multiples
	 *
	 * Reduces multiple instances of a particular character. Example:
	 *
	 * Fred, Bill,, Joe, Jimmy
	 *
	 * becomes:
	 *
	 * Fred, Bill, Joe, Jimmy
	 *
	 * @access	public
	 * @param	string
	 * @param	string	the character you wish to reduce
	 * @param	bool	TRUE/FALSE - whether to trim the character from the beginning/end
	 * @return	string
	 */
	public function reduce_multiples($str, $character = ',', $trim = false) {
		$str = preg_replace('#' . preg_quote($character, '#') . '{2,}#', $character, $str);

		if ($trim === true) {
			$str = trim($str, $character);
		}

		return $str;
	}

}
