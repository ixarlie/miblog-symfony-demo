<?php

namespace Miblog\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArticleType extends AbstractType {

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Miblog\MiblogBundle\Entity\Article',
        );
    }

    public function buildForm(FormBuilder $builder, array $options) {
        $builder->add('title');
        $builder->add('content', 'textarea');
    }

    public function getName() {
        return 'article';
    }

}

?>
