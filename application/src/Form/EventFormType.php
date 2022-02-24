<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                "label" => "Titre (*)",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "input width-20",
                    "placeholder" => "Ex: RDV Client avec Jean Dupont"
                ]
            ])
            ->add('type', ChoiceType::class, [
                "label" => "Type (*)",
                "label_attr" => ["class" => "label"],
                "choices" => [
                    "Réunion" => "Réunion",
                    "Tâche" => "Tâche"
                ],
            ])
            ->add('date', DateType::class, [
                "label" => "Date (*)",
                "label_attr" => ["class" => "label"],
                "widget" => "single_text",
                "attr" => ["class" => "input width-20"],
            ])
            ->add('time', TimeType::class, [
                "label" => "Heure (*)",
                "label_attr" => ["class" => "label"],
                "widget" => "single_text",
                "attr" => ["class" => "input width-20"],
            ])
            ->add('description', TextareaType::class, [
                "label" => "Description",
                "label_attr" => ["class" => "label"],
                "attr" => [
                    "class" => "textarea",
                    "rows" => 5,
                ],
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
            'data_class' => Event::class,
        ]);
    }
}
