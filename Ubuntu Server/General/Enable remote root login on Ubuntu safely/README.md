## Enable remote root login on Ubuntu safely
Edit /etc/ssh/sshd_config and add / edit
```
PasswordAuthentication no
PermitRootLogin without-password
```
then restart sshd with sudo service ssh restart


Create the .ssh directory in root's home if it doesn't exist and make sure it has strict permissions:

```
sudo -i mkdir -p .ssh
sudo -i chmod 700 .ssh
```

Append your public key to .ssh/authorized_keys of root, and make sure the file has strict permissions
```
sudo -i nano .ssh/authorized_keys
sudo -i chmod 600 .ssh/authorized_keys
```


With this setup you should be able to login as root using your private key.

If you have previously enabled the root account, make sure to disable it now:

```
sudo passwd -l root
```
