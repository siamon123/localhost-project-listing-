<?php
$output ='';
$rootDir = '/Applications/XAMPP/htdocs/';
$folderCount = $fileCount = 0;
$not_allowed = array('.', '..', 'css','img','phpMyAdmin','DS_Store');
?>
<!doctype html>
<html lang="en-US">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Localhost</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 </head>
  <body>
    <div class="page">
      <div class="container">

        <div class="panel-group" id="accordion">

          <?php

                   foreach(glob($rootDir.'*', GLOB_ONLYDIR) as $dir)
                   {
                     $url = basename($dir);

                     if (!in_array($url, $not_allowed)) {


                     $output  ="<div class=\"panel\">";
                     $output .="<div class=\"panel-heading\">";
                     $output .="<a href=\"$url\">";
                     $output .= "<span class=\"glyphicon glyphicon-fire\"></span>";
                     $output .= $url;
                     $output .= "</a>";
                     $output .= "<a class=\"pull-right\"data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#$url\"> <span class=\"glyphicon glyphicon-circle-arrow-down\"></span> </a>";
                     $output .= "</a>";
                     $output .="</div>";
                     $output .="<div id=".basename($dir)." class=\"panel-collapse collapse\">";
                     $output .="<div class=\"list-group\">";
                     if ($handle = opendir($dir)) {
                            while (false !== ($entry = readdir($handle))) {
                                if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
                                    if (is_dir($entry)) {

                                      $output .= "<a href=".basename($dir)."/".$entry." class=\"list-group-item folder\">";
                                      $output .= "<span class=\"glyphicon glyphicon-folder-close\"></span>";
                                      $output .="Folder => ".$entry;
                                      $output .="</a>";
                                        $folderCount++;
                                    } else {
                                      $output .= "<a href=".basename($dir)."/".$entry." class=\"list-group-item file\">";
                                      $output .= "<span class=\"glyphicon glyphicon-file\"></span>";
                                      $output .="File => ".$entry;
                                      $output .="</a>";
                                        $fileCount++;
                                    }
                                }
                            }
                            $output .="<div class=\"panel-footer\">";
                            $output .=  "Total Folder : ". $folderCount;
                            $output .=" ";
                            $output .=  "Total File : ". $fileCount;
                            closedir($handle);
                        }

                      $output .="</div>";
                      $output .="</div>";
                      $output .="</div>";
                      $output .="</div>";
                      print_r($output);
                    }
                  }
            ?>
        </div>
      </div>
    </div>
  </body>
</html>
