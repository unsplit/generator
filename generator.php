<?php

// Full path from url
//$dir = dirname($_SERVER["HTTP_REFERER"]) . "/";

// Get all the files from inside the components folder
$com = '../unsplit/src/components';
$components = scandir($com);

// Get all the files from inside the functions folder
$funct = '../unsplit/src/functions';
$functions = scandir($funct);

// Get all the plugins from inside the plugins folder
$plug = '../unsplit/src/plugins/';
$plugins = scandir($plug);

// Set the header to Javascript
header('Content-Type: application/javascript');

// Get the keys from URL
$keys = array_keys($_GET)[0];

if($keys !== null) {

// Seperate them via commas
$files = explode(",", $keys);

// Loop through each key
foreach ($files as $file) {

  // If the file is the core output it
  if($file == "core") {
    $core = file_get_contents('../unsplit/src/core.js');
    echo $core;
  } else {
    // If the file is not, then add the .js extension
    $full = $file . ".js";
  }

  // Loop through each component
  foreach ($components as $component) {

    // If the components has been found
    if($full === $component) {
       // Output the module
       $module = file_get_contents($com . DIRECTORY_SEPARATOR . $component);
       echo $module;
    }

  }

  // Loop through each function
  foreach ($functions as $func) {
   
    // If the function has been found
    if($full === $func) {
       // Output the module
       $module = file_get_contents($funct . DIRECTORY_SEPARATOR . $func);
       echo $module;
    }

  }

  // Loop through each plugin
  foreach ($plugins as $external) {
   
    // If the plugins has been found
    if($full === $external) {
       // Output the module
       $module = file_get_contents($plug . DIRECTORY_SEPARATOR . $external);
       echo $module;
    }

  }

}
} else {

    echo "you need to specify some files";

}

?>
