<?php

namespace App\Form;

use App\Entity\Concept;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\ConceptType;

                // FORMULAIRE DE MODIF DE LA PAGE CONCEPT //

class ConceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleConcept', TextType::class, array('label' => 'Titre'))
            ->add('contentConcept', TextareaType::class, array('label' => 'Description'))
            ->add('pictureConcept', FileType::class, array('data_class'=> null, 
                'label' => 'Photo',
                'required' => true));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concept::class,
        ]);
    }
}
