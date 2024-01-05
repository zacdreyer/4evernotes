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
