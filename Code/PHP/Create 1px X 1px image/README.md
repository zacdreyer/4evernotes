## Create 1px X 1px image

```
//Return 1 x 1 transparent image
if (ob_get_contents() || ob_get_length()){ 
    ob_end_clean();
}
header('Content-type: image/gif');
echo base64_decode('R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
die();
```
