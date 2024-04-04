## Replace and Replace All
Replace first occurrence only
```
str = ‘I like like pie’;

str = str.replace(‘like’, ‘really’); //Output: I really like pie

OR

str = str.replace(/like/, ‘really’); //Output: I really like pie
```

Replace all occurrences
```
str = ‘I like like LIKE love pie’;

//Case Sensitive:
str = str.replace(/like/g, ‘really’); //Output: I really really LIKE love pie


//Case Insensitive:
str = str.replace(/like/gi, ‘really’); //Output: I really really really love pie
```
