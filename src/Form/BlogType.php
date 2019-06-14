<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Blog;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\BlogType;
                        
                        // FORMULAIRE D'AJOUT D'ARTICLES DE BLOG //

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
     {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('content', TextareaType::class, array('label' => 'Contenu'))
            ->add('author', TextType::class, array('label' => 'Auteur'))
            ->add('picture_blog', FileType::class, array('label' => 'Image'), ['required' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
