
<?php

    function incrementFile($filename): int
{

    if (file_exists($filename)) {
        $fp = fopen($filename, "r+") or die("Failed to open the file.");
        flock($fp, LOCK_EX);
        $count = fread($fp, filesize($filename)) + 1;
        ftruncate($fp, 0);
        fseek($fp, 0);
        fwrite($fp, $count);
        flock($fp, LOCK_UN);
        fclose($fp);
    }
    else {
        $count = 1;
        file_put_contents($filename, $count);
    }
    return $count;
}


function convertCount($count)  {
  $str = (string)$count; 
  $goal = 7 - strlen($str); 
  
  for ($i = 0; $i < $goal; $i++) {
    $str = "0" . $str;
  }

  for ($i = 0; $i < strlen($str); $i++) {
    $files = glob("images/*.*");
    $num = $files[$str[$i]];
	echo '<img src="'.$num.'" alt="random image">'."&nbsp;&nbsp;";
  }
}

echo convertCount(incrementFile("views.txt"));
?>

