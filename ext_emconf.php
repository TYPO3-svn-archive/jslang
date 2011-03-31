<?php

########################################################################
# Extension Manager/Repository config file for ext "jslang".
#
# Auto generated 31-03-2011 12:43
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Javascript Localization Support',
	'description' => 'Provides ExtJS javascript localization support through the TYPO3.jslang.getLL function. For labels to be availiable through javascript locallang files need to be loaded through the tx_jslang->addLL function',
	'category' => 'be',
	'author' => 'Morten Tranberg Hansen',
	'author_email' => 'mth@cs.au.dk',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.4',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.7-0.0.0',
			'typo3' => '4.3dev-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:6:{s:9:"ChangeLog";s:4:"b562";s:10:"README.txt";s:4:"d41d";s:19:"class.tx_jslang.php";s:4:"aefa";s:12:"ext_icon.gif";s:4:"e03d";s:17:"ext_localconf.php";s:4:"06e6";s:14:"doc/manual.sxw";s:4:"302b";}',
	'suggests' => array(
	),
);

?>