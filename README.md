# grafxwp
test
**do everytime you reboot**
```sh

grafx && git pull
brew update && brew upgrade && brew cleanup && brew prune
npm i -g
ncu -a
npm update

#new tab
=======
grafx-start
or
grafx && npm i && grunt && grunt watch


#download uploads and plugins and download dump (sync with remote)
#check mysql.json file before
#BE CAREFUL, YOU WILL LOSE EVERYTHING ON YOUR LOCAL (except theme)
grunt download_wpcontent
grunt sync_local_db
```

**deploy your changes**
```sh
#new tab
grunt deploy
```

**logs**
`tail -f /private/var/log/apache2/grafxwp.log`
http://grafx.geryit.com
