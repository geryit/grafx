# grafxwp

**Put this to your `.bash_profile` and restart terminal**
```
ssh-add -l | grep "The agent has no identities" > /dev/null
 if [ $status -eq 0 ]
     ssh-add
 end
```

download wordpress and rename as `grafxwp` and clone theme from github into `/themes` folder

download and put `wp-config.php` to root : https://gist.github.com/geryit/ff9dd3f6037f6be49d7c0723fb65e085

add this to `httpd-vhosts.conf`:
```apache
<Directory "/Users/goksel/Sites/grafxwp">
Allow From All
AllowOverride All
Options +Indexes
Require all granted
</Directory>

<VirtualHost *:80>
    ServerName "grafxwp"
    ServerAlias "grafxwp.*.*.*.*.xip.io"
    DocumentRoot "/Users/goksel/Sites/grafxwp"
</VirtualHost>

```

`hosts` file should have: `127.0.0.1	localhost grafxwp`

install node-sass : `npm install -g node-gyp`



**create db `grafx` on local**

**create `.mysql.json` with this content (change with your settings):**
```
{
  "remote": {
    "site_url": "grafx.co",
    "dbname": "grafx",
    "dbuser": "root",
    "dbpass": "tmlxvqv5",
    "dbhost": "127.0.0.1",
    "host": "54.80.56.240",
    "username": "ubuntu",
    "save_path": "/home/ubuntu/grafxwp/wp-content/themes/grafx/.db",
    "save_url": "https://grafx.co/wp-content/themes/grafx/.db"
  },
  "local": {
    "site_url": "grafxwp",
    "dbname": "grafx",
    "dbuser": "root",
    "dbpass": "",
    "dbhost": "127.0.0.1",
    "wpcontent_dir": "~/Sites/grafxwp/wp-content/",
    "dump_dir": "./.db"
  }
}
```

go http://grafxwp/?pasam99=1 > settings > permalinks > select plain > save > select post name > save


**do everytime you reboot**
```sh
brew services start mysql
grafx
git pull
npm i
grunt full-import
grunt ; grunt watch


#these are optional
brew update && brew upgrade && brew cleanup && brew prune
node -v #node version should be > 6
npm i -g npm grunt npm-check
npm-check -u -g
npm-check -u
brew install wget
mkdir .db #need this to store db dump in local
create .mysql file


#download uploads and plugins and download dump (sync with remote)
#check mysql.json file before
#BE CAREFUL, YOU WILL LOSE EVERYTHING ON YOUR LOCAL (except theme)
grunt download_wpcontent
grunt sync_local_db
```

**deploy your changes**
```sh
grunt full-import # import mysql dump & wp-content folder from remote server
#new tab
grunt deploy
```

**logs**
`tail -f /private/var/log/apache2/grafxwp.log`
http://grafx.geryit.com

**mod_pagespeed debug**
https://grafx.geryit.com/?PageSpeedFilters=%20debug
https://grafx.geryit.com/?ModPagespeed=off
