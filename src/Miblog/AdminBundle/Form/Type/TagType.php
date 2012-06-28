<?php

namespace Miblog\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TagType extends AbstractType {

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Miblog\MiblogBundle\Entity\Tag',
        );
    }

    public function buildForm(FormBuilder $builder, array $options) {
        $builder->add('label');
    }

    public function getName() {
        return 'tag';
    }

}
?>
