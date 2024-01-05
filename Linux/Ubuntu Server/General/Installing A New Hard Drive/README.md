## Installing A New Hard Drive
To determine the path that your system has assigned to the new hard drive, open a terminal and run:

```
sudo lshw -C disk
```

This should produce output similar to this sample:

```
  *-disk
       description: ATA Disk
       product: IC25N040ATCS04-0
       vendor: Hitachi
       physical id: 0
       bus info: ide@0.0
       logical name: /dev/sdb
       version: CA4OA71A
       serial: CSH405DCLSHK6B
       size: 37GB
       capacity: 37GB
```

---

Partition The Disk


Initiate fdisk with the following command:

```
sudo fdisk /dev/sdb 
```

2) Fdisk will display the following menu:

```
Command (m for help): m <enter>
  Command action
   a   toggle a bootable flag
   b   edit bsd disklabel
   c   toggle the dos compatibility flag
   d   delete a partition
   l   list known partition types
   m   print this menu
   n   add a new partition
   o   create a new empty DOS partition table
   p   print the partition table
   q   quit without saving changes
   s   create a new empty Sun disklabel
   t   change a partition's system id
   u   change display/entry units
   v   verify the partition table
   w   write table to disk and exit
   x   extra functionality (experts only)

  Command (m for help):
```

3) We want to add a new partition. Type "n" and press enter.

```
 Command action
   e   extended
   p   primary partition (1-4)
```

4) We want a primary partition. Enter "p" and enter.

```
Partition number (1-4):
```

5) Since this will be the only partition on the drive, number 1. Enter "1" and enter.

```
Command (m for help):
```

If it asks about the first cylinder, just type "1" and enter. (We are making 1 partition to use the whole disk, so it should start at the beginning.)

6) Now that the partition is entered, choose option "w" to write the partition table to the disk. Type "w" and enter.

```
The partition table has been altered!
```

7) If all went well, you now have a properly partitioned hard drive that's ready to be formatted. Since this is the first partition, Linux will recognize it as /dev/sdb1, while the disk that the partition is on is still /dev/sdb.

---


Using parted


Refer back to the logical name you noted from earlier. For illustration, I'll use /dev/sdb, and assume that you want a single partition on the disk, occupying all the free space.

1) Start parted as follows:

```
sudo parted /dev/sdb
```

2) Create a new GPT disklabel (aka partition table):

```
(parted) mklabel gpt
```

3) Set the default unit to TB:

(parted) unit TB

4) Create one partition occupying all the space on the drive. For a 4TB drive:

```
(parted) mkpart
Partition name?  []? primary
File system type?  [ext2]? ext4
Start? 0
End? 4
```

5) Check that the results are correct:

```
(parted) print
```

There should be one partition occupying the entire drive.

6) Save and quit "parted":

```
(parted) quit
```

---


Command Line Formatting


To format the new partition as ext4 file system (best for use under Ubuntu):

```
sudo mkfs -t ext4 /dev/sdb1
```

To format the new partition as fat32 file system (best for use under Ubuntu & Windows):

```
sudo mkfs -t fat32 /dev/sdb1
```

As always, substitute "/dev/sdb1" with your own partition's path.


---


Create A Mount Point


Now that the drive is partitioned and formatted, you need to choose a mount point. This will be the location from which you will access the drive in the future. I would recommend using a mount point with "/media", as it is the default used by Ubuntu. For this example, we'll use the path "/media/mynewdrive"

```
sudo mkdir /media/mynewdrive
```

Now we are ready to mount the drive to the mount point.

  
---


Mount The Drive

```
sudo nano -Bw /etc/fstab
```

Note: https://help.ubuntu.com/community/Fstab#Editing_fstab

Add this line to the end (for ext3 file system):

```
/dev/sdb1    /media/mynewdrive   ext4    defaults     0        2
```

For manual mounting, use the following command:

```
sudo mount /dev/sdb1 /media/mynewdrive 
```