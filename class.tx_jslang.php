<?php 
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Morten Tranberg Hansen (mth at cs dot au dot dk)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Javascript localization helper class.
 *
 * @author Morten Tranberg Hansen <mth at cs dot au dot dk>
 * @date   December 16 2009
 */

class tx_jslang implements t3lib_Singleton {

	/**
	 * AJAX call from javascript clients to load a locallang file.
	 * The file to be loaded is found in the file parameter and 
	 * the result is returned in json format.
	 *
	 * @param	array		$parameters: Parameters (not used)
	 * @param	TYPO3AJAX	$ajaxObj: The calling parent AJAX object
	 * @return	void
	 */
	public static function loadLL(array $params = array(), TYPO3AJAX &$ajaxObj) {
		global $LANG;
		$file= t3lib_div::_GET('file');
		$LL = t3lib_div::readLLfile($file, $LANG->lang, $LANG->charSet);
		$ajaxObj->setContent($LL);
		$ajaxObj->addContent('lang',$LANG->lang);
		$ajaxObj->setContentFormat('json');
	}

	/**
	 * Loads a locallang file and adds it to the document header using ExtJS.
	 * The labels will then be available in the frontend through 'TYPO3.lang' 
	 * or 'TYPO3.lang.<suffix>' if $suffix is set.
	 *
	 * @param	template $doc: The template object that the language labels are added to.
	 * @param	string $file: The locallang file to add.
	 * @param	string $suffix: Optional suffix.
	 * @return	void
	 */
	public static function addLL(template $doc, $file, $prefix = '') {
		global $LANG;

		$labels = '';
		$key = 'TYPO3.LOCAL_LANG';

		if (!empty($prefix)) {
			$key .= '.'.$prefix;
			$labels = '
if(TYPO3.LOCAL_LANG==undefined) {
  TYPO3.LOCAL_LANG = {};
}
';
		}

		$LL = t3lib_div::readLLfile($file, $LANG->lang, $LANG->charSet);
		$labels .= $key . " = " . json_encode($LL) . ";";


		$doc->JScodeArray[$key] = $labels;
		$doc->JScodeArray['jslang'] = "
Ext.namespace('TYPO3');
TYPO3.lang = '".$LANG->lang."';
TYPO3.getLL = function(label, prefix) {

if(TYPO3.LOCAL_LANG==undefined) {
  return 'ERROR: TYPO3.LOCAL_LANG undefined';
}

if(prefix) {
  local_lang = TYPO3.LOCAL_LANG[prefix];
  if(local_lang==undefined) {
    return 'ERROR: TYPO3.LOCAL_LANG['+prefix+'] undefined';
  }
} else {
  local_lang = TYPO3.LOCAL_LANG;
}

if(local_lang[TYPO3.lang]!=undefined && local_lang[TYPO3.lang][label]) {
  return local_lang[TYPO3.lang][label];
} else if(local_lang['default']!=undefined && local_lang['default'][label]) {
  return local_lang['default'][label];
} else {
  return 'ERROR: label ' + label + ' not found';
}

}
";

	}

}

if (defined('TYPO3_MODE') && isset($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jslang/class.tx_jslang.php'])) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jslang/class.tx_jslang.php']);
}

?>