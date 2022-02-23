<?php

namespace App\Form;

use App\Entity\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                "label" => "Nom complet",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex : Jean Dupont / Ma Société"
                ]
            ])
            ->add('type', ChoiceType::class, [
                "label" => "Type (*)",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "radio",
                ],
                "choices" => [
                    "Particulier" => "Particulier",
                    "Entreprise" => "Entreprise"
                ],
                "expanded" => true
            ])
            ->add('role', ChoiceType::class, [
                "label" => "Type (*)",
                "label_attr" => ["class" => "label"],
                "choices" => [
                    "Collaborateur" => "Collaborateur",
                    "Client" => "Client",
                    "Prestataire" => "Prestataire",
                    "Fournisseur" => "Fournisseur"
                ],
                "expanded" => true
            ])
            ->add('address', TextType::class, [
                "label" => "Adresse (*)",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex : 1 rue lambda 75000 Paris (France)"
                ]
            ])
            ->add('country', CountryType::class, [
                "label" => "Pays (?)",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                ],
                'preferred_choices' => ['FR'],
            ])
            ->add('phone', TelType::class, [
                "label" => "Numéro de téléphone (*)",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex : 01 23 45 67 89"
                ]
            ])
            ->add('email', EmailType::class, [
                "label" => "Adresse e-mail (*)",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex : jean.dupont@site.com"
                ]
            ])
            ->add('website', UrlType::class, [
                "label" => "Site web",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex : jean-dupont.com"
                ]
            ])
            ->add('submit', SubmitType::class, [
                "label" => "Valider",
                "attr" => [
                    "class" => "button is-link",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            "csrf_protection" => true,
            "csrf_field_name" => "_token",
            "csrf_token_id" => "contact"
        ]);
    }
}
