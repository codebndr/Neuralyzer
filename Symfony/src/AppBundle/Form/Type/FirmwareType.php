<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 */
class FirmwareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hexFileUrl', TextType::class)
            ->add('boardUploadConfig', TextType::class)
            ->add('buttonName', TextType::class)
            ->add('iFrameWidth', TextType::class)
            ->add('iFrameHeight', TextType::class)
            ->add('serialPortAutoDetect', TextType::class)
            ->add('iFrameBackground', TextType::class)
            ->add('iPProgrammer', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FirmwareConfig',
        ));
    }
}
