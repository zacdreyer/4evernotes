## Install & Use Network Traffic Monitoring Tools
iftop


Iftop measures the data flowing through individual socket connections Install

```
sudo apt-get install iftop
```


Run

```
sudo iftop -n
```

---

ntop


ntop measures the data flowing through individual socket connections Install (preferred)

```
sudo apt-get install ntopng
sudo ufw allow 3000/tcp
```


Run

```
http://<server-dns>:3000
```

---

nload


Nload is a commandline tool that allows users to monitor the incoming and outgoing traffic separately. It also draws out a graph to indicate the same, the scale of which can be adjusted. Easy and simple to use, and does not support many options. Install

```
sudo apt-get install nload
```


Run

```
nload
```

---

bmon


Bmon (Bandwidth Monitor) is a tool similar to nload that shows the traffic load over all the network interfaces on the system. The output also consists of a graph and a section with packet level details. Install

```
$ sudo apt-get install bmon
```


Run

```
bmon
```

---

speedometer


A small and simple tool that just draws out good looking graphs of incoming and outgoing traffic through a given interface. Install

```
$ sudo apt-get install speedometer
```


Run

```
speedometer -r eth0 -t eth0
```

---

nethogs


Nethogs is a small 'net top' tool that shows the bandwidth used by individual processes and sorts the list putting the most intensive processes on top. In the event of a sudden bandwidth spike, quickly open nethogs and find the process responsible. Nethogs reports the PID, user and the path of the program Install

```
sudo apt-get install libncurses5-dev libpcap-dev
git clone --depth 1 https://github.com/raboof/nethogs.git
cd nethogs
make
```

Run

```
$HOME/nethogs/src/nethogs
```
