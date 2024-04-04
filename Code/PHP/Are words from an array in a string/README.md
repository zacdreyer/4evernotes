## Are words from an array in a string

Case Insensitive
```
function is_in_string($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) {
            return true;
        }
    }
    return false;
}
```
