## Measuring PHP page load time

Top of Page
```
<?php
$time = microtime(); 
$time = explode(' ', $time); 
$time = $time[1] + $time[0]; 
$start = $time; 
?>
```


Bottom of Page
```
<?php
$time = microtime(); 
$time = explode(' ', $time); 
$time = $time[1] + $time[0]; 
$finish = $time; 
$total_time = round(($finish - $start), 4); 
echo 'Page generated in '.$total_time.' seconds.'; 
?>
```
