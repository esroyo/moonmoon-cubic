# moonmoon-cubic
A grid like theme for [moonmoon](http://moonmoon.org) feed agregator.

Requirements
------------
* This repo is based on [moonmoon current git version](https://github.com/mauricesvay/moonmoon). It won't work with stable version (v8.12).

Usage
----------
Work from your moonmoon base directory.
If you don't have a copy, get it now:

```sh
git clone https://github.com/mauricesvay/moonmoon
cd moonmoon
```

Pull this repo in:

```sh
git pull https://github.com/esroyo/moonmoon-cubic.git
```

Modify `index.php` so it defaults to `cubic` theme.

```sh
sed -i s/default/cubic/ index.php
```

You are ready to go.
