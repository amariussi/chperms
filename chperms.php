<?php
// ************************************************************************************************************************************
// This script was developed by Forthalia for its own use and is made available to others as is
// By downloading or using this script there is an implicit waiver of responsibility to Forthalia made by who downloads it or uses it.
// It is not allowed to modify, resell or redistribute woithout prior authorisation
// ************************************************************************************************************************************

// define('chmod_debug_mode', TRUE);
define('chmod_debug_mode', FALSE);

if(isset($_REQUEST['verbose']) && $_REQUEST['verbose']==true)
	$chmod_debug_mode = $_REQUEST['verbose'];
else if(isset($_REQUEST['verbose']) && $_REQUEST['verbose']==false)
	$chmod_debug_mode = $_REQUEST['verbose'];
else if(!defined(chmod_debug_mode))
	$chmod_debug_mode = FALSE;
else
	$chmod_debug_mode = chmod_debug_mode;


if($chmod_debug_mode == TRUE)
  $script_time_start = microtime(true);
function chmod_file_folder($dir) { 
    global $perms, $chmod_debug_mode; 
             
    $dh=@opendir($dir); 
     
    if ($dh) { 
        while (false !==($file = readdir($dh))) { 
            if($file != "." && $file != ".." && !in_array($file, $perms['exclude_folders']) && !in_array($file, $perms['exclude_files'])) { 
                $fullpath = $dir .'/'. $file; 
                if(!is_dir($fullpath)) { 
                    $cmod_result = chmod($fullpath, $perms['file_perms']); 
if($chmod_debug_mode == TRUE)
  echo "($cmod_result) Changed permissions to: " . $fullpath . " with : " . $perms['file_perms'] . "<br>";
                }else { 
                    $cmod_result = chmod($fullpath, $perms['dir_perms']); 
if($chmod_debug_mode == TRUE)
  echo "($cmod_result) Changed permissions to: " . $fullpath . " with : " . $perms['dir_perms'] . "<br>";
                    chmod_file_folder($fullpath); 
                } 
            } 
        } 
        closedir($dh); 
    } 
} 

$change_folders = array();
$change_folders[]=array('change_dir' => '.',
                        'file_perms' => 0755,
                        'dir_perms'  => 0755,
                        'exclude_folders' => array('cache', 'custom', 'data', 'modules', 'themes', 'upload'),
                        'exclude_files' => array('config_override.php')
                       );
$change_folders[]=array('change_dir' => 'cache',
                        'file_perms' => 0775,
                        'dir_perms'  => 0775,
                        'exclude_folders' => array(),
                        'exclude_files' => array()
                       );
$change_folders[]=array('change_dir' => 'custom',
                        'file_perms' => 0775,
                        'dir_perms'  => 0775,
                        'exclude_folders' => array(),
                        'exclude_files' => array()
                       );
$change_folders[]=array('change_dir' => 'data',
                        'file_perms' => 0775,
                        'dir_perms'  => 0775,
                        'exclude_folders' => array(),
                        'exclude_files' => array()
                       );
$change_folders[]=array('change_dir' => 'modules',
                        'file_perms' => 0775,
                        'dir_perms'  => 0775,
                        'exclude_folders' => array(),
                        'exclude_files' => array()
                       );
$change_folders[]=array('change_dir' => 'themes',
                        'file_perms' => 0775,
                        'dir_perms'  => 0775,
                        'exclude_folders' => array(),
                        'exclude_files' => array()
                       );
$change_folders[]=array('change_dir' => 'upload',
                        'file_perms' => 0775,
                        'dir_perms'  => 0775,
                        'exclude_folders' => array(),
                        'exclude_files' => array()
                       );

foreach ($change_folders as $this_folder)
  {
    if(isset($perms))
      unset($perms);
    $perms = array();
if($chmod_debug_mode == TRUE)
  echo "Setting: " . $this_folder['change_dir'] . "<br>";
   $perms['file_perms'] = $this_folder['file_perms']; // chmod value for files don't enclose value in quotes. 
if($chmod_debug_mode == TRUE)
  echo "---> Original File permissions: " . $this_folder['file_perms'] . " perms File permissions: " . $perms['file_perms'] . "<br>";
    $perms['dir_perms'] = $this_folder['dir_perms']; // chmod value for folders don't enclose value in quotes. 
if($chmod_debug_mode == TRUE)
  echo "---> Original Dir permissions: " . $this_folder['dir_perms'] . " perms Dir permissions: " . $perms['dir_perms'] . "<br>";
    $perms['exclude_folders'] = $this_folder['exclude_folders']; // list of folders to exclude 
    $perms['exclude_files'] = $this_folder['exclude_files']; // list of files to exclude
    chmod_file_folder($this_folder['change_dir']);
$cmod_result = chmod($this_folder['change_dir'], $this_folder['dir_perms']);
if($chmod_debug_mode == TRUE)
  echo "($cmod_result) Changed permissions to: " . $this_folder['change_dir'] . " with : " . $perms['dir_perms'] . "<br>";
  } 

if(file_exists('config_override.php'))
  chmod('config_override.php', 0775);
if($chmod_debug_mode == TRUE)
  $script_time_total = microtime(true) - $script_time_start;
if($chmod_debug_mode == TRUE)
  echo $script_time_total;
?>
