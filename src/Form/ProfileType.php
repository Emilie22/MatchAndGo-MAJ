<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\IsTrue;

            // FORMULAIRE DE CREATION ET MODIFICATION DE PROFIL //

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', TextType::class, array('label' => 'Prénom'))
            ->add('lastname', TextType::class, array('label' => 'Nom'))
            ->add('gender', ChoiceType::class, array(
                'label' => 'Genre',
                'choices' =>array(
                    'Choisir le genre' =>null,
                    'Femme' => 'Femme',
                    'Homme' => 'Homme')))
            ->add('city', TextType::class, array('label' => 'Ville'))
            ->add('birthday', DateType::class, array(
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'))

            ->add('phone', TextType::class, array('label' => 'Numéro de téléphone'))
            ->add('picture', FileType::class, array(
                'data_class'=> null, 
                'label' => 'Choisis ta photo de profil', 'required' => false))
            ->add('description', TextareaType::class, array('label' => 'Parle-nous un peu de toi ! (Tes hobbies, ta personnalité, ta profession...)'))
            ->add('countries', TextType::class, array('label' => 'Quels pays as-tu visités ?'))
            ->add('facebook', TextType::class, array('label' => 'Lien vers ton profil facebook',
                'required' => false))
            ->add('instagram', TextType::class, array('label' => 'Ton compte Instagram',
                'required' => false))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}