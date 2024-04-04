## Renaming multiple files via CLI

Simple search and replace
```
rename "s/SEARCH/REPLACE/g"  *
```

Add Prefix
```
rename 's/^/MyPrefix_/‘ *
```

Remove Prefix
```
rename 's/^Prefix //‘ *
```

Add Suffix
```
rename 's/$/_MySuffix/‘ *
```

Change File Extension
```
rename 's/\.pdf$/.doc/' *
```

Options
```
       -s, --symlink
              Do not rename a symlink but its target.


       -v, --verbose
              Show which files were renamed, if any.


       -n, --no-act
              Do not make any changes; add --verbose to see what would be
              made.


       -o, --no-overwrite
              Do not overwrite existing files.  When --symlink is active, do
              not overwrite symlinks pointing to existing targets.


       -i, --interactive
              Ask before overwriting existing files.


       -V, --version
              Display version information and exit.


       -h, --help
              Display help text and exit.
```
