<?php

namespace Miblog\MiblogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    
    public function findArticlesByTag($label) 
    {
        $dql = 'SELECT a FROM MiblogBundle:Article a
                JOIN a.tags t
                WHERE t.label = :label';
        
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
                'label' => $label,
                ));

        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
        
    }
    
    public function findTagByName($tagname) {
        $tag = $this->findOneBy(array('label' => $tagname));

        if (empty($tag)) {
            throw new HttpException(404, "El tag " . $tagname . " no existe.");
        }

        return $tag;
        
    }
    
}

?>
