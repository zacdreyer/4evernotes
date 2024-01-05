## Install & Use Imapsync
1 - Install Prerequisites
```
sudo apt-get -y install git rcs make makepasswd cpanminus libauthen-ntlm-perl libclass-load-perl libcrypt-ssleay-perl liburi-perl libdata-uniqid-perl libdigest-hmac-perl libdist-checkconflicts-perl libfile-copy-recursive-perl libio-compress-perl libio-socket-inet6-perl libio-socket-ssl-perl libio-tee-perl libmail-imapclient-perl libmodule-scandeps-perl libnet-ssleay-perl libpar-packer-perl libreadonly-perl libsys-meminfo-perl libterm-readkey-perl libtest-fatal-perl libtest-mock-guard-perl libtest-pod-perl libtest-requires-perl libtest-simple-perl libunicode-string-perl apt-file

cpanm Mail::IMAPClient JSON::WebToken Test::MockObject Unicode::String Data::Uniqid Crypt::OpenSSL::RSA JSON::WebToken::Crypt::RSA LWP::UserAgent Regexp::Common Test::NoWarnings Test::Deep CGI Encode::IMAPUTF7 File::Tail Proc::ProcessTable

```



2 - Install Imapsync
```
git clone https://github.com/imapsync/imapsync.git

cd imapsync
mkdir -p dist
sudo make install

./imapsync

cp imapsync /usr/bin/
cd ..
rm -rf ./imapsync
```



3 - Transfer Emails with Imapsync
```
imapsync --host1 imap.source.example.com  \
         --user1 user@example.com         \
         --password1 S0urcePassw0rd       \
         --ssl1                           \
         --host2 imap.dest.example.com    \
         --user2 user@example.com         \
         --password2 Dest1nat10NPassw0rd  \
         --ssl2
```


Sources:<br/>
https://tecadmin.net/use-imapsync-on-ubuntu/<br/>
https://imapsync.lamiral.info/<br/>
https://github.com/imapsync/imapsync