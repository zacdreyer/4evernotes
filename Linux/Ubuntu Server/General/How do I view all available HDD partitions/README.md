## How to view all available HDD partitions

```
sudo lsblk -o NAME,FSTYPE,SIZE,MOUNTPOINT,LABEL
```

It is showing:
- The name of the drive and the partitions it has.
- The type of file system.
- The size the whole drive has and the size each partition has.
- The mount point and if available, the label for them.