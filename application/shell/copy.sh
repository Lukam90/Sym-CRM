#!/bin/sh

date=`date +"%H.%M"`
target="$HOME/Téléchargements/Copies/CP-CRM-$date"

cp -r config $target
cp -r document $target
cp -r migrations $target
cp -r public $target
cp -r shell $target
cp -r src $target
cp -r templates $target
cp -r tests $target

echo "Copie vers CRM - $date"