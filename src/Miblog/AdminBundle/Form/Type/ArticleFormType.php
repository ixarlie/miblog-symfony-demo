<?php

namespace Miblog\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleFormType extends AbstractType {

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Miblog\AdminBundle\Form\Model\ArticleForm',
        );
    }

    public function buildForm(FormBuilder $builder, array $options) {
        $builder->add('article', new ArticleType());
        $builder->add('commatags', 'text', array(
            'label' => 'Etiquetas'
        ));
        $builder->add('confirmtags', 'checkbox', array(
            'label' => 'Crear etiquetas desconocidas',
        ));
    }

    public function getName() {
        return 'articleform';
    }

}
?>
