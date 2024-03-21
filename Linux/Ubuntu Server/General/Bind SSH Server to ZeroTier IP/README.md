## Bind SSH Server to ZeroTier IP
Install ZeroTier
```
curl -s https://install.zerotier.com | sudo bash
```

Join ZeroTier Network
```
zerotier-cli join <ID>
```

Go to https://my.zerotier.com/network/<ID> and allow the new host into the network.

Bind SSH Daemon to VPN IP
```
nano /etc/ssh/sshd_config
> Add: ListenAddress <HOST_VPN_IP>
service sshd restart
```

The above may cause issues if your ZeroTier starts after the SSHD as the interface is unavailable. In this case, do not listen on a specific IP but rather use your UFW to limit access to the ZeroTier Subnet. This will prevent the SSHD from crashing at startup.

Only Allow SSH Access from your ZeroTier IP or Subnet
```
ufw delete allow OpenSSH
ufw allow from <HOST_VPN_SUBNET> to any port 22
netfilter-persistent save
service ufw restart
```
