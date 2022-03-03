<?php

namespace App\Helpers;

class Constants {
    const TYPES = [
        ["id" => "particulier", "value" => "Particulier"],
        ["id" => "entreprise", "value" => "Entreprise"],
    ];

    const ROLES = [
        ["id" => "collaborateur", "value" => "Collaborateur"],
        ["id" => "client", "value" => "Client"],
        ["id" => "prestataire", "value" => "Prestataire"],
        ["id" => "fournisseur", "value" => "Fournisseur"],
    ];
}