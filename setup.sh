#!/usr/bin/env bash

## This script will create a folder called "phplist-dev"
## and check out various repositories in there.
## after that it will initialise the Docker setup and start it
##

rm -rf phplist-dev
[[ -d phplist-dev ]] && {
  echo Error removing previous folder, please remove manually and try again
  exit;
}
mkdir phplist-dev
cd phplist-dev
git clone https://github.com/phplist/phplist3
mkdir phpListPlugins
mkdir phpListThemes

cd phpListThemes 
git clone https://github.com/phpList/phplist-ui-bootlist.git
cd ..
cd phpListPlugins

## add here any other plugins that you want to check out 
## below is the full list of plugins from 
## https://resources.phplist.com/plugins/start

git clone https://github.com/bramley/phplist-plugin-addons.git
git clone https://github.com/bramley/phplist-plugin-amazonses.git
git clone https://github.com/michield/phplist-plugin-attributeselect.git
git clone https://github.com/bramley/phplist-plugin-autoresponder.git
git clone https://github.com/bramley/phplist-plugin-botbouncer.git
git clone https://github.com/bramley/phplist-plugin-bounces.git
git clone https://github.com/michield/phplist-plugin-campaignslicer.git
git clone https://github.com/bramley/phplist-plugin-statistics.git
git clone https://github.com/bramley/phplist-plugin-campaigns.git
git clone https://github.com/bramley/phplist-plugin-captcha.git
git clone https://github.com/bramley/phplist-plugin-ckeditor.git
git clone https://github.com/bramley/phplist-plugin-common.git
git clone https://github.com/arnoldle/phplist-plugin-conditionalPlaceholderPlugin.git
git clone https://github.com/bramley/phplist-plugin-contentareas.git
git clone https://github.com/bradallenfisher/phplist-plugin-cosign.git
git clone https://github.com/urapoh/phplist-plugin-customheader.git
git clone https://github.com/michield/phplist-plugin-dateplaceholder.git
git clone https://github.com/michield/phplist-plugin-domainthrottlemap.git
git clone https://github.com/michield/phplist-plugin-embedremoteimages.git
git clone https://github.com/michield/phplist-plugin-fckeditor.git
git clone https://github.com/bramley/phplist-plugin-hcaptcha.git
git clone https://github.com/bramley/phplist-plugin-housekeeping.git
git clone https://github.com/bramley/phplist-plugin-imap.git
git clone https://github.com/arnoldle/phplist-plugin-inlineImagePlugin.git
git clone https://github.com/phpList/phplist-plugin-invite.git
git clone https://github.com/michield/phplist-plugin-listcleaner.git
git clone https://github.com/arnoldle/phplist-plugin-listNamePrefixPlugin.git
git clone https://github.com/bramley/phplist-plugin-mailgun.git
git clone https://github.com/bramley/phplist-plugin-attachment.git
git clone https://github.com/phpList/phplist-plugin-disposablemailblock.git
git clone https://github.com/bramley/phplist-plugin-recaptcha.git
git clone https://github.com/bramley/phplist-plugin-recaptchav3.git
git clone https://github.com/phpList/phplist-plugin-restapi.git
git clone https://github.com/bramley/phplist-plugin-rssfeed.git
git clone https://github.com/michield/phplist-plugin-rssmanager.git
git clone https://github.com/bramley/phplist-plugin-segment.git
git clone https://github.com/bramley/phplist-plugin-sendgrid.git
git clone https://github.com/bramley/phplist-plugin-smtp2go.git
git clone https://github.com/arnoldle/phplist-plugin-subjectLinePlaceholdersPlugin.git
git clone https://github.com/arnoldle/phplist-plugin-subjectPrefixPlugin.git
git clone https://github.com/bramley/phplist-plugin-subscribers.git
git clone https://github.com/bramley/phplist-plugin-timezone.git
git clone https://github.com/bramley/phplist-plugin-tinymce.git
git clone https://github.com/bramley/phplist-plugin-viewbrowser.git
git clone https://github.com/michield/phplist-plugin-subscribeexample.git
git clone https://github.com/phpList/phplist-plugin-simplesaml.git
git clone https://github.com/michield/phplist-plugin-develop.git

cd ..
git clone https://github.com/phpList/phplist-docker.git
cp phplist-docker/.env-dist phplist-docker/.env
echo >> phplist-docker/.env
echo CODE_PATH=$(pwd)/phplist3/ >> phplist-docker/.env
echo THEME_DEV_PATH=$(pwd)/phpListThemes >> phplist-docker/.env
echo PLUGIN_DEV_PATH=$(pwd)/phpListPlugins >> phplist-docker/.env
cp phplist-docker/config-dev.php phplist3/config.php

cd phplist-docker
docker-compose -f phplist-dev.yml up

