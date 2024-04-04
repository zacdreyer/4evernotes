## Hard Refresh Page

Straight
```
location.reload(true);
```

With Timer
```
var reload_ms = 1000;
setTimeout(function() {
    location.reload(true);
}, reload_ms);
```
