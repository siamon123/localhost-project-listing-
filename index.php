<?php
//Change to Your Localhost root Directory Path
$rootDir = '/Users/siamon/Sites/';

$folderCount = $fileCount = 0;
//Hide Folders
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
                  foreach(glob($rootDir.'*', GLOB_ONLYDIR) as $dir):

                    $url = basename($dir);

                    if (!in_array($url, $not_allowed)):
              ?>

                    <div class="panel">
                      <div class="panel-heading">
                       <a href="<?php echo $url;?>">
                         <span class="glyphicon glyphicon-fire"></span>
                         <?php echo $url;?>
                      </a>
                      <a class="pull-right"data-toggle="collapse" data-parent="#accordion" href="#<?php echo $url;?>">
                        <span class="glyphicon glyphicon-circle-arrow-down"></span>
                      </a>
                      </div>
                      <div id="<?php echo basename($dir);?>" class="panel-collapse collapse">
                      <div class="list-group">

                     <?php
                      if ($handle = opendir($dir)):
                           while (false !== ($entry = readdir($handle))) {
                               if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {
                                   if (is_dir($entry)) {
                      ?>
                                 <a href="<?php echo basename($dir)?>"/"<?php echo $entry;?>" class="list-group-item folder">
                                    <span class="glyphicon glyphicon-folder-close"></span>
                                     Folder => <?php echo $entry;?>
                                  </a>
                                <?php
                                  $folderCount++;
                                   } else {
                                ?>
                                <a href="<?php echo basename($dir);?>/<?php echo $entry;?>" class="list-group-item file">
                                 <span class="glyphicon glyphicon-file"></span>
                                  File => <?php echo $entry; ?>
                                  </a>
                                <?php
                                       $fileCount++;
                                   }
                               }
                           }
                          ?>
                          <div class="panel-footer">
                           Total Folder : <?php echo $folderCount; ?>
                           Total File : <?php echo $fileCount; ?>
                           <?php
                            closedir($handle);
                            endif;
                          ?>
                       </div>
                     </div>
                   </div>
                 </div>

         <?php endif; ?>
         <?php endforeach;?>
        </div>
      </div>
    </div>
  </body>
</html>
