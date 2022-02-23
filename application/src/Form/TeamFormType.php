<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex : Equipe Jaune"
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
            'data_class' => Team::class,
            "csrf_protection" => true,
            "csrf_field_name" => "_token",
            "csrf_token_id" => "team"
        ]);
    }
}
