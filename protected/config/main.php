<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'PBB KAB.SIMALUNGUN',
	'theme'=>'classic',
	// preloading 'log' component
	'preload'=>array('log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'timeZone' => 'Asia/Jakarta',
	'defaultController'=>'maplaporan',
	'modules' => array(
		'administrator' => array(
			'defaultController' => 'default'
		),
		'mobile' => array(
			'defaultController' => 'default'
		),

		'api',
		'gii'=>array(
                        'class'=>'system.gii.GiiModule',
                        'password'=>'123456',
                        // If removed, Gii defaults to localhost only. Edit car$
                        'ipFilters'=>array('127.0.0.1','::1'),
                ),
	),
	// application components
	'components'=>array(
		'curl' =>array(
		   'class' => 'ext.curl.Curl'
		),
		 'ePdf' => array(
			'class'         => 'ext.yii-pdf.EYiiPdf',
			'params'        => array(
				'mpdf'     => array(
					'librarySourcePath' => 'application.vendors.mpdf.*',
					'constants'         => array(
						'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
					),
					'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
					/*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
						'mode'              => '', //  This parameter specifies the mode of the new document.
						'format'            => 'A4', // format A4, A5, ...
						'default_font_size' => 0, // Sets the default document font size in points (pt)
						'default_font'      => '', // Sets the default font-family for the new document.
						'mgl'               => 15, // margin_left. Sets the page margins for the new document.
						'mgr'               => 15, // margin_right
						'mgt'               => 16, // margin_top
						'mgb'               => 16, // margin_bottom
						'mgh'               => 9, // margin_header
						'mgf'               => 9, // margin_footer
						'orientation'       => 'P', // landscape or portrait orientation
					)*/
				),
				'HTML2PDF' => array(
					'librarySourcePath' => 'application.vendors.html2pdf.*',
					'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
					/*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
						'orientation' => 'P', // landscape or portrait orientation
						'format'      => 'A4', // format A4, A5, ...
						'language'    => 'en', // language: fr, en, it ...
						'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
						'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
						'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
					)*/
				)
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            //'class'=>'WebUser',
		),
		 'simpleImage'=>array(
                        'class' => 'ext.simpleimages.CSimpleImage',
                ),

		
		
		'request'=>array(
          'enableCsrfValidation'=>false,
        ),
		
			// 'dbOracle'=>array(
   //            'class'=>'ext.oci8Pdo.OciDbConnection',

   //            'connectionString' => 'oci:dbname=//192.168.1.212:1521/SIMPBB;charset=AL32UTF8;',
   //            'username' => 'pendapatan',
			//   'password' => 'pendapatan',
   //            'enableProfiling' => true,
   //            'enableParamLogging' => true,
   //      ),
		'dbOracle'=>array(
              'class'=>'ext.oci8Pdo.OciDbConnection',

              'connectionString' => 'oci:dbname=//localhost:1521/orcl;charset=AL32UTF8;',
              'username' => 'fadil',
			  'password' => 'fadil',
              'enableProfiling' => true,
              'enableParamLogging' => true,
        ),
		// uncomment the following to use a MySQL database
		'db' => include dirname (__FILE__).'/db.php',
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	// 'params'=>require(dirname(__FILE__).'/params.php'),
);
