if ! test -f .env; then
cat <<END > .env
DBUSER=ddss_user
DBNAME=ddss_db
PSQLPASS=abadacas1312
PSQLUSERPASS=Z3kr37p4ss
END
fi

docker-compose down --volumes
docker-compose up --build
