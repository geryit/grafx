# grafxwp

**Put this to your `.bash_profile` and restart terminal**
```
ssh-add -l | grep "The agent has no identities" > /dev/null
 if [ $status -eq 0 ]
     ssh-add
 end
```

download wordpress and rename as `grafxwp` and clone theme from github into `/themes` folder

download and put `wp-config.php` to root : https://docs.google.com/document/d/1edPNPgUdQ29FvidVPfqduC2tdQ1k9bN60YNfcmqBtVg/edit

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

install nvm:
```
brew install nvm
nvm install 9
nvm use 9
nvm alias default 9
```
install node-sass : `yarn global add node-gyp`



**create db `grafx` on local**

**create `.mysql.json` with this content (change with your settings):**
get from https://docs.google.com/document/d/1Tj_PlnNeTqbhlyiQ93JJdl2-ZamkOrVp6YqUK9Y-aWI/edit


go http://grafxwp/?pasam99=1 > settings > permalinks > select plain > save > select post name > save


**do everytime you reboot**
```sh
brew services start mysql
grafx
git pull
nvm use 9
yarn
yarn grunt full-import
yarn grunt ; yarn grunt watch


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
yarn grunt download_wpcontent
yarn grunt sync_local_db
```

**deploy your changes**
```sh
yarn grunt full-import # import mysql dump & wp-content folder from remote server
#new tab
yarn grunt deploy
```

**logs**
`tail -f /private/var/log/apache2/grafxwp.log`
http://grafx.geryit.com

**mod_pagespeed debug**
https://grafx.geryit.com/?PageSpeedFilters=%20debug
https://grafx.geryit.com/?ModPagespeed=off
