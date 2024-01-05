## Install NeoVIM
Go to the following URL to get the latest build:
```
https://github.com/neovim/neovim/releases/latest
```

Installation
```
apt-get install -y software-properties-common python3-software-properties
apt-add-repository ppa:neovim-ppa/stable
apt-get update
apt-get install -y neovim python-dev python-pip python3-dev python3-pip python3-setuptools
easy_install3 pip
pip3 install --upgrade neovim
update-alternatives --install /usr/bin/vi vi /usr/bin/nvim 60
update-alternatives --config vi
update-alternatives --install /usr/bin/vim vim /usr/bin/nvim 60
update-alternatives --config vim
update-alternatives --install /usr/bin/editor editor /usr/bin/nvim 60
update-alternatives --config editor


mkdir ~/.config
mkdir ~/.config/nvim
cd ~/.config/nvim
git clone https://github.com/zacdreyer/nvim-init.git ./
nvim
```

