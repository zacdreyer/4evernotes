## Redirects

Redirect to root location
```
header("Location: /");
exit;
```

Redirect to URL
```
header("Location: http://<url>");
exit;
```

Redirect to URL with 301 HTTP Status
```
header("Location: http://<url>", TRUE, 301);
exit;
```