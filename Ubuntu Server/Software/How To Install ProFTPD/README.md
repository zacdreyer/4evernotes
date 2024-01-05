## How To Install ProFTPD
Install required packages
```
apt install -y proftpd-basic
```

Configure
```
groupadd -g 2512 ftpusers

cd /etc/proftpd
nano proftpd.conf
systemctl restart proftpd
systemctl status proftpd

nano /etc/proftpd/conf.d/jailed-users.conf
#Add Global
DefaultRoot ~ !ftpusers

nano /etc/shells
#Add
/bin/false

nano /etc/ssh/sshd_config
#Add
DenyGroups ftpusers

systemctl restart sshd
```

Securing
```
apt install openssl -y
openssl req -x509 -newkey rsa:1024 -keyout /etc/ssl/private/proftpd.key -out /etc/ssl/certs/proftpd.crt -nodes -days 26280
chmod 600 /etc/ssl/private/proftpd.key
chmod 600 /etc/ssl/certs/proftpd.crt

nano /etc/proftpd/p    roftpd.conf
#Uncomment / Add
Include /etc/proftpd/tls

nano /etc/proftpd/tls.conf
#Uncomment / Add
TLSEngine on
TLSLog /var/log/ptoftpd/tls.log
TLSProtocol SSLv23
TLSRSACertificateFile /etc/ssl/certs/proftpd.crt
TLSRSACertificateKeyFile /etc/ssl/private/proftpd.key
TLSVerifyClient off
TLSRequired on
TLSOptions NoSessionReuseRequired

systemctl restart proftpd
```

Add users
```
useradd -m <username>
passwd <username>
usermod -s /bin/false <username>
usermod -G ftpusers <username>

systemctl restart proftpd
```

NAT:
http://www.proftpd.org/docs/howto/NAT.html

Passive Ports:
http://www.proftpd.org/docs/directives/linked/config_ref_PassivePorts.html

