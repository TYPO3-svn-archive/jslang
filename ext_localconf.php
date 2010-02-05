<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

t3lib_div::requireOnce(t3lib_extMgm::extPath('jslang').'class.tx_jslang.php');

// Registers hooks
$TYPO3_CONF_VARS['BE']['AJAX']['tx_jslang::loadLL'] = 'EXT:jslang/class.tx_jslang.php:tx_jslang->loadLL';


?>