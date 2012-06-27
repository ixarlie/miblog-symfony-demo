<?php

namespace Miblog\MiblogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    
    public function findByUser($idUser) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('Miblog\MiblogBundle\Entity\Article', 'a');
        $rsm->addFieldResult('a', 'a_id', 'id');
        $rsm->addFieldResult('a', 'a_title', 'title');
        $rsm->addFieldResult('a', 'a_slug', 'slug');
        $rsm->addFieldResult('a', 'a_content', 'content');
        $rsm->addFieldResult('a', 'a_created_at', 'createdAt');
        $rsm->addFieldResult('a', 'a_updated_at', 'updatedAt');
        $rsm->addFieldResult('a', 'a_user', 'user');
        $rsm->addFieldResult('a', 'a_comments', 'comments');

        $sql = 'SELECT a.id as a_id, a.title as a_title, a.slug as a_slug,
            a.content as a_content, a.created_at as a_created_at,
            a.updated_at as a_updated_at,
            
            FROM articles a
            LEFT JOIN users u ON u.id = c.user_id 
            WHERE u.id = :id';

        // Crea la query y establece los parámetros
        $query = $this->getEntityManager()
                ->createNativeQuery($sql, $rsm)
                ->setParameters(array(
            'id' => $idUser,
                ));

        $query->setHint(\Doctrine\ORM\Query::HINT_FORCE_PARTIAL_LOAD, true);

        return $query->getResult();
        
    }
    
}
?>
