#!/bin/bash

echo "Would you like to use docker management console (Portainer)?"
echo "1. Yes 2. No"
read console
case $console in
"1")
echo "Please enter the password you want to use for portainer:"
read portainerpass
echo "Your portainer username is: admin and password: $portainerpass"
rm -r /tmp/portainer_password
echo -n $portainerpass > /tmp/portainer_password
docker volume create portainer_data
docker run -d --restart=always -p 9000:9000 -v /var/run/docker.sock:/var/run/docker.sock -v /tmp/portainer_password:/tmp/portainer_password portainer/portainer --admin-password-file /tmp/portainer_password
;;
"2")
echo "You can use docker using command line then."
;;
*)
echo "Sorry, invalid input."
exit 1
;;
esac

echo "Which moodle code base you want to use?"
echo "1. From moodle git repository."
echo "2. From a private gitlab repository."
read repo
case $repo in
"1")
echo echo "Enter the branch name (e.g. MOODLE_39_STABLE)"
read moodlebranch
git clone -b $moodlebranch https://github.com/moodle/moodle.git ./docker/data/moodle
;;
"2")
echo "Enter the repository for gitlab (Just the repo not with tree and without https://)"
read gitlaburl
echo "Enter the branch name"
read gitlabbranch
echo "Enter the gitlab username"
read gitlabuser
echo "Enter the gitlab password for that user"
read gitlabpassword
gitlabpull="https://"
gitlabpull+=$gitlabuser
gitlabpull+=":"
gitlabpull+=$gitlabpassword
gitlabpull+="@"
gitlabpull+=$gitlaburl
echo $gitlabpull
git clone -b $gitlabbranch $gitlabpull ./docker/data/moodle
;;
*)
echo "Sorry, invalid input."
exit 1
;;
esac

echo "Did you have the code base downloaded properly?"
echo "1. Yes 2. No"
read codebase
case $codebase in
"1")
cp ./docker/data/config.php ./docker/data/moodle
#use the following if you want to use shared moodledata folder
mkdir ./docker/data/moodledata
chmod -R 777 ./docker/data/moodledata
mkdir ./docker/data/dbdata
docker-compose up
;;
"2")
echo "Check the git repo and re-run the script, make sure you delete any invalid code base in /docker/data/"
exit 1
;;
*)
echo "Sorry, invalid input."
exit 1
;;
esac
