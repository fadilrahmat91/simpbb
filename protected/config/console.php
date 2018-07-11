<?php

// This is the configuration for yiic console application.
return array(
 'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
 'name'=>'My Console Application',

     // autoloading model and component classes
 'import'=>array(
  'application.models.*',
  // 'application.components.*',
 ),

     // application components
 'components'=>array(

	'db'=>include dirname (__FILE__).'/db.php',

 ),
);