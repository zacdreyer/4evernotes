## Structured print array function

Web Compatible
```
function print_array($array, $level = 0, $leveltree = '')
{
    $leveltxt = '';
    if ($level > 0){
        $leveltxt = '|';
        $leveltree .= '&nbsp;&nbsp;';
        for($i = 0; $i < $level; $i++){ $leveltxt .= '-'; $leveltree .= '&nbsp;'; }
    }
    
    if(is_array($array)){
        foreach($array AS $key=>$value){
            if(is_array($value)){ 
                echo $leveltree.$leveltxt."[".$key."] = array() <br/>"; 
                print_array($value, $level+1, $leveltree); 
            } else { 
                echo $leveltree.$leveltxt."[".$key."] = ".$value." <br/>"; 
            }
        }
    } else { echo "Not an array"; }
}
```

CLI Compatible
```
function cli_print_array($array, $level = 0, $leveltree = '')
{
    $leveltxt = '';
    if ($level > 0){
        $leveltxt = '|';
        $leveltree .= '  ';
        for($i = 0; $i < $level; $i++){ $leveltxt .= '-'; $leveltree .= ' '; }
    }
    
    if(is_array($array)){
        foreach($array AS $key=>$value){
            if(is_array($value)){ 
                echo $leveltree.$leveltxt."[".$key."] = array() ".PHP_EOL; 
                cli_print_array($value, $level+1, $leveltree); 
            } else { 
                echo $leveltree.$leveltxt."[".$key."] = ".$value." ".PHP_EOL; 
            }
        }
    } else { echo "Not an array"; }
}
```
