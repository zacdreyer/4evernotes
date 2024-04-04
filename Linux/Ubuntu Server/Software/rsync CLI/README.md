## rsync CLI
Requires SSH keys

Rsync folders across from remote server on non-standard SSH port
```
rsync -azvrhP --stats -e 'ssh -p2512' root@remotehost:/remote/path /local/path
```

Rsync folders across from remote server on standard SSH port
```
rsync -azvrhP --stats -e 'ssh' root@remotehost:/remote/path /local/path
```

Rsync folders across to remote server on non-standard SSH port
```
rsync -azvrhP --stats -e 'ssh -p2512' /local/path root@remotehost:/remote/path
```

Rsync folders across to remote server on standard SSH port
```
rsync -azvrhP --stats -e 'ssh' /local/path root@remotehost:/remote/path
```

Rsync folders locally
```
rsync -azvrhP --stats /src/path/ /dest/path/
```

https://www.tecmint.com/rsync-local-remote-file-synchronization-commands/