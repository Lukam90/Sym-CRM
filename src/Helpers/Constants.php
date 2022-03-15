<?php

namespace App\Helpers;

class Constants 
{
    const CONTACT_TYPES = [
        ["id" => "particulier", "value" => "Particulier"],
        ["id" => "entreprise", "value" => "Entreprise"],
    ];

    const EVENT_TYPES = [
        ["id" => "reunion", "value" => "Réunion"],
        ["id" => "tache", "value" => "Tâche"],
    ];

    const CONTACT_ROLES = [
        ["id" => "collaborateur", "value" => "Collaborateur"],
        ["id" => "client", "value" => "Client"],
        ["id" => "prestataire", "value" => "Prestataire"],
        ["id" => "fournisseur", "value" => "Fournisseur"],
    ];

    CONST USER_ROLES = ["Administrateur", "Manager", "Membre"];

    const USER_COLORS = [
        "Super Admin" => "red",
        self::USER_ROLES[0] => "orange",
        self::USER_ROLES[1] => "green",
        self::USER_ROLES[2] => "black",
    ];
}