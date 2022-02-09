date=`date +"%H.%M"`
name="application"
target="$HOME/Téléchargements/Copies/CP-CRM-$date"

cp -r $name/config $target
cp -r $name/migrations $target
cp -r $name/public $target
cp -r $name/src $target
cp -r $name/templates $target

echo "Copie vers CRM - $date"