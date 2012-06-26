<?php

namespace Miblog\MiblogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function findTagByName($tagname) {
        $tag = $this->findOneBy(array('label' => $tagname));

        if (empty($tag)) {
            throw new HttpException(404, "El tag " . $tagname . " no existe.");
        }

        return $tag;
        
    }
    
}

?>
