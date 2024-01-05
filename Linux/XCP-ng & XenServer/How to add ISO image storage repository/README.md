## How to add ISO image storage repository
Create initial directory, this can me anything. We are using /var/opt/ISO_IMAGES for this example.
```
mkdir /var/opt/ISO_IMAGES
```


Copy your ISO images to /var/opt/ISO_IMAGES or download them directly with wget command

Now, its time to create/register our new storage repository with XenServer:
```
xe sr-create name-label=ISO_IMAGES_LOCAL type=iso device-config:location=/var/opt/ISO_IMAGES device-config:legacy_mode=true content-type=iso
```


The output of the above command will be UUID of the new XenServer storage repository eg. 970317f9-3187-b5e0-1ea5-16666fdf3348

The new storage repository was created. To list your XenServer storage repository run:
```
# xe sr-list
...
uuid ( RO)                : 970317f9-3187-b5e0-1ea5-16666fdf3348
          name-label ( RW): ISO_IMAGES_LOCAL
    name-description ( RW): 
                host ( RO): xenserver
                type ( RO): iso
        content-type ( RO): iso
```

OR
```
# xe pbd-list sr-uuid=970317f9-3187-b5e0-1ea5-16666fdf3348
uuid ( RO)                  : 86ffd533-5f3e-012a-280f-964e6a2b8c55
             host-uuid ( RO): b9ecac0f-79ac-45f9-afd5-2228bf53df06
               sr-uuid ( RO): 970317f9-3187-b5e0-1ea5-16666fdf3348
         device-config (MRO): location: /var/opt/ISO_IMAGES; legacy_mode: true
    currently-attached ( RO): true
```
