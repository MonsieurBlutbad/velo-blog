<?php
/**
 * Created by PhpStorm.
 * User: BK
 * Date: 01.06.18
 * Time: 15:50
 */
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ImageType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'    => 'Titel',
                'required' => false
            ])
            ->add('caption', TextType::class, [
                'label'    => 'Caption',
                'required' => false
            ])
            ->add('file', VichFileType::class, [
                'label'    => 'Datei'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Image'
        ));
    }
}