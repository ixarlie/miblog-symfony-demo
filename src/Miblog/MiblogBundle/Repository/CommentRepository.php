<?php

namespace Miblog\MiblogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function findByArticle($articleId) {
         return $this->getEntityManager()
                    ->createQuery('SELECT p FROM 				
					Desymfony\DesymfonyBundle\Entity\Ponente p
					ORDER BY p.nombre ASC')
                    ->getResult();
        
        
    }
    
}

?>
