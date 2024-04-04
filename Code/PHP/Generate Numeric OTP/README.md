## Generate Numeric OTP

```
public static function generateNumericOTP($length = 10, $seed = "")
{
    if(!is_numeric($seed)){
        $seed = random_int(random_int(0, 2512), random_int(2512, mt_getrandmax()));
    }

    $token = '';
    $limit = 25;
    $seedplace = round($limit / random_int(1, $limit-1));
    for($i = 0; $i <= $limit; ++$i){
        $min = random_int(903, 2512);
        $max = random_int(2512, mt_getrandmax());
        $token .= random_int($min, $max);
        if($i == $seedplace){
            $token .= $seed;
        }
    }

    $uid = '';
    $count = 0;
    $max_count = 25;
    for($i = 0; $i < $length; ++$i) {
        do {
            $start = (random_int(0, strlen($token)-$length))-$length;
            if($start < 0){ $start = $start * -1; }
            $val = substr($token, $start, 1);

            $last = substr($uid, strlen($uid)-1, 1);
            if( $last == $val || $last == $val-1 || $last == $val+1){
                if(random_int(0, 1) == 0 && $val > 2){
                    $val -= 2;
                } elseif($val >= 8) {
                    $val -= 2;
                } else {
                    $val += 2;
                }
            }

            ++$count;
            if($count == $max_count){
                break;
            }
        } while(stristr((string)$uid, (string)$val) == true);

        $uid .= $val;
    }

    if(preg_match("/0/",$uid)){
        $uid = self::generateNumericOTP($length, $seed);
    }

    return $uid;
}
```

