Moodle oneclick docker development environment. It uses a bash script to stand up the environment for you, so just run the script and you are ready to go.

# How to use:
clone the repository.

Run the script oneclick.sh (just go to your shell, cd to the directory moodle_docker and run ./oneclick.sh).

The script will ask you different options to select and also to type the moodle branch to be used, just go with the flow, at the end it will standup up the docker for you.

It also allows you to use docker management console portainer. Try using that, it will make your docker life easier.

## If you have an existing data:
(moodledata and db dump) you want to use in your docker.

Using your existing data is easy as well. Go to, moodle_docker/docker/data/filedir

Paste your directories inside filedir in this folder, and just run the oneclick.sh

If you have your own code base, put your code base inside the folder moodle_docker/docker/data/moodle

copy the config.php to the following file inside moodle_docker/docker/data/moodle

Come back to moodle_docker, and run docker-compose up

Then go to the database, and import your dump in the databsae moodle_db.


## Environment details:
Ubuntu 20.4
PHP 7.4
MYSQL 5
APACHE

## Some feature:
Cron runs every minute

Uses the production php configuration (e.g fileupload limit to 8gb)

Shared code base using volume, so that you can change your code base anytime.

Moodledata is not shared, to make the performance better with caching. You can use shared moodledata, its already there in docker-compose, just change the commented lines.

Self-signed ssl certifica - coming soon.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
