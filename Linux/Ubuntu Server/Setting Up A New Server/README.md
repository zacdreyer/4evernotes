## Setting Up A New Server
**Update & Upgrade OS**
```
screen
apt -o Acquire::http::AllowRedirect=false update
apt -o Acquire::http::AllowRedirect=false upgrade -y
sysctl vm.swappiness=10
swapoff -a && swapon -a
```

**Add SUDO User**
```
adduser d3vdigital
usermod -aG sudo d3vdigital
```

**Change SSH port**
```
nano /etc/ssh/sshd_config
> Edit: # Port 2512
service sshd restart
```

**Disable root SSH**
```
nano /etc/ssh/sshd_config
> Edit: PermitRootLogin no
> Edit: PermitEmptyPasswords no
> Edit: AllowUsers d3vdigital
service sshd restart
```

**Deny all inbound traffic with ufw firewall**
```
apt-get -y install ufw
ufw disable
ufw reset
ufw status verbose
> Status: inactive
ufw default deny incoming
ufw default allow outgoing
ufw deny OpenSSH
ufw deny ftp
ufw deny in smtp
ufw allow out smtp
ufw allow 2512/tcp
ufw enable
ufw status verbose
service ufw restart
sudo apt remove iptables-persistent
apt install iptables-persistent
netfilter-persistent save
shutdown -r now
```
- [https://www.digitalocean.com/community/tutorials/how-to-setup-a-firewall-with-ufw-on-an-ubuntu-and-debian-cloud-server](url)
- [https://www.digitalocean.com/community/tutorials/ufw-essentials-common-firewall-rules-and-commands](url)

**Configure environment variables**
```
export DEBIAN_FRONTEND=noninteractive
export PERL_MM_USE_DEFAULT=1
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8
locale-gen en_US.UTF-8
apt-get -y install locales
dpkg-reconfigure locales
echo "export LC_CTYPE=en_US.UTF-8" >> /root/.bashrc
echo "export LC_ALL=en_US.UTF-8" >> /root/.bashrc
echo "export LC_CTYPE=en_US.UTF-8" >> /home/d3vdigital/.bashrc
echo "export LC_ALL=en_US.UTF-8" >> /home/d3vdigital/.bashrc
rm /etc/localtime
ln -sf /usr/share/zoneinfo/Africa/Johannesburg /etc/localtime
locale-gen en_US.UTF-8
```

**Install & setup NTP server**
```
apt-get -y install ntp ntpdate
service ntp stop
ntpdate pool.ntp.org
service ntp start
```

**Setup tmux & interface**
```
apt-get -y install tmux
apt autoremove
```

**Setup default terminal**
```
echo "export PS1='\[\033[1;34m\][\u@\h:\w]\\\$\\[\033[0m\]'" >> /root/.bashrc
echo "export PS1='\[\033[1;34m\][\u@\h:\w]\\\$\\[\033[0m\]'" >> /home/d3vdigital/.bashrc
```

OR

**Setup bashit terminal**
```
git clone --depth=1 https://github.com/Bash-it/bash-it.git ~/.bash_it
~/.bash_it/install.sh
source /root/.bashrc
nano .bash_profile
> Paste:
if [ -f ~/.bashrc ]; then
  . ~/.bashrc
fi
```

**Install fail2ban**
```
apt-get update
apt-get install -y fail2ban sendmail sendmail-bin iptables-persistent
awk '{ printf "# "; print; }' /etc/fail2ban/jail.conf | sudo tee /etc/fail2ban/jail.local
nano /etc/fail2ban/jail.local


Add / Edit
[DEFAULT]
ignoreip = 127.0.0.1/8 172.30.224.216
bantime = 3600
destemail = admin@example.com
sendername = Server Fail2Ban
sender = fail2ban@server
mta = sendmail
action = %(action_mwl)s
findtime = 600
maxretry = 3


[ssh]
enabled = true
port     = 2512
filter   = sshd
logpath  = /var/log/auth.log
maxretry = 6


service fail2ban restart
```
- Config: [https://www.digitalocean.com/community/tutorials/how-to-protect-ssh-with-fail2ban-on-ubuntu-14-04](url)
- Config: [https://www.linode.com/docs/security/using-fail2ban-for-security/](url)

**Install Antivirus**
```
apt-get update
apt-get install -y clamav
ps -aux | grep 'freshclam'
freshclam
crontab -e
> Paste:  
0 1 * * * freshclam
0 2 * * * clamscan -r --remove /root/
30 2 * * * clamscan -r --remove /home/d3vdigital
```

**Harden network**
```
nano /etc/sysctl.conf
> Change config: 
# IP Spoofing protection
net.ipv4.conf.all.rp_filter = 1
net.ipv4.conf.default.rp_filter = 1


# Ignore ICMP broadcast requests
net.ipv4.icmp_echo_ignore_broadcasts = 1


# Disable source packet routing
net.ipv4.conf.all.accept_source_route = 0
net.ipv6.conf.all.accept_source_route = 0 
net.ipv4.conf.default.accept_source_route = 0
net.ipv6.conf.default.accept_source_route = 0


# Ignore send redirects
net.ipv4.conf.all.send_redirects = 0
net.ipv4.conf.default.send_redirects = 0


# Block SYN attacks
net.ipv4.tcp_syncookies = 1
net.ipv4.tcp_max_syn_backlog = 2048
net.ipv4.tcp_synack_retries = 2
net.ipv4.tcp_syn_retries = 5


# Log Martians
net.ipv4.conf.all.log_martians = 1
net.ipv4.icmp_ignore_bogus_error_responses = 1


# Ignore ICMP redirects
net.ipv4.conf.all.accept_redirects = 0
net.ipv6.conf.all.accept_redirects = 0
net.ipv4.conf.default.accept_redirects = 0 
net.ipv6.conf.default.accept_redirects = 0


# Ignore Directed pings
net.ipv4.icmp_echo_ignore_all = 1


sysctl -p
```

**Intrusion Detection**
```
apt-get install -y psad
nano /etc/psad/psad.conf
> Change Config
* EMAIL_ADDRESSES - change this to your email address.
* HOSTNAME - this is set during install - but double check and change to a FQDN if needed.
* ENABLE_AUTO_IDS - set this to Y if you would like PSAD to take action - read configuration instructions before setting this to Y.
* ENABLE_AUTO_IDS_EMAILS - set this to Y if you would like to receive email notifications of intrusions that are detected.
psad -R
psad --sig-update
psad -H
psad --Status
```

**Last few thinga**
```
apt-get install -y sendmail curl build-essential zip tar gzip curl g++ make software-properties-common python3-pip python3-software-properties python3-dev git  libxml2-dev htop libgmp3-dev libgmp3-dev sshpass libperl-dev libfile-find-rule-perl libmysqlclient-dev lftp htop glances rsync


cpan CPAN 
cpan -i App:cpanminus
cpanm -n CPAN::DistnameInfo Build Moose YAML File::Find::Rule Backticks List::MoreUtils::XS List::MoreUtils DateTime Time::HiRes URL::Encode LWP::Simple Archive::Zip Math::GMP UUID::Generator::PurePerl Locale::Maketext::Lexicon Module::Signature Net::NfDump Net::Flow Text::Aspell Parallel::ForkManager Text::Balanced Net::Syslogd List::MoreUtils LWP::Protocol::https Net::IMAP::Simple Email::Simple Net::POP3 Net::IMAP::Simple::SSL Digest::MD5 Digest::HMAC_MD5 MIME::Base64 Net::Ping  Net::Ping Date::Parse Math::Round Email::Simple Net::IMAP::Simple Net::IMAP::Simple::SSL Net::POP3 Net::POP3::SSLWrapper IO::Socket::IP IO::Socket::SSL Digest::HMAC_MD5 MIME::Base64  Net::Ping Date::Parse Math::Round Net::FTP File::Rsync Net::NfDump NetAddr::IP Crypt::CBC MIME::Base64 Digest::MD5 Sort::Key Cache::Cache LWP::Simple::Cookies LWP::UserAgent LWP::Simple::Post HTTP::Cookies JSON::Parse Digest::MD5 Net::FTP Sort::Key Crypt::Blowfish  Net::SNMP Net::SNMP::Interfaces Time::Piece Module::Info


sudo update-alternatives --install /usr/bin/python python /usr/bin/python3 10
```

**Configure lftp**
```
For Local: nano ~/.lftp/rc or ~/.lfptrc
For Global: nano /etc/lftp.conf
> Add
set ssl:verify-certificate no
set ssl:check-hostname no
set ftp:list-options -a
set ftps:initial-prot ''
set ftp:ssl-protect-data true
set ftp:ssl-allow true
set ftp:ssl-force false
```

**Add DNS Servers**
```
nano /etc/resolv.conf 
Add >>
nameserver 1.1.1.1
nameserver 8.8.8.8
nameserver 8.8.4.4


cd /etc/netplan
[edit the .yaml file]
Add >>
1.1.1.1, 8.8.8.8, 8.8.4.4,
EG >>
nameservers:
   addresses: [1.1.1.1, 8.8.8.8, 8.8.4.4]


netplan apply
```
