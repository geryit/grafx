# grafxwp

**do everytime you reboot**
```sh
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
