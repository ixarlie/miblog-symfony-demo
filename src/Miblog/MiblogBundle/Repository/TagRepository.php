<?php

namespace Miblog\MiblogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class TagRepository extends EntityRepository
{
    
    public function findArticlesByTag($slug) 
    {
        $dql = 'SELECT a FROM MiblogBundle:Article a
                JOIN a.tags t
                WHERE t.slug = :slug';
        
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(array(
                'slug' => $slug,
                ));

        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
        
    }
    
    /**
     * Comprueba si existe un tag y lo devuelve
     * @param type $tag
     * @return type MiblogBundle\Entity\Tag
     */
    public function existsTag($tag){
        return $this->getEntityManager()
                ->getRepository('MiblogBundle:Tag')
                ->findOneBy(array(
                    'label' => $tag,
                ));
    }
    
//    private function getAllTagnames()
//    {
//        $rsm = new ResultSetMapping();
//        $rsm->addEntityResult('Miblog\MiblogBundle\Entity\Tag', 't');
//        $rsm->addFieldResult('t', 't_label', 'label');
//        
//        $sql = 'SELECT t.label as t_label FROM tags t';
//        $rs = $this->getEntityManager()
//                ->createNativeQuery($sql, $rsm)
//                ->getArrayResult();
//        $arr = array();
//        foreach($rs as $tag) {
//            $arr[] = $tag['label'];
//        }
//        return $arr;
//    }
    
    public function findTagByName($tagname) {
        $tag = $this->findOneBy(array('label' => $tagname));

        if (empty($tag)) {
            throw new HttpException(404, "El tag " . $tagname . " no existe.");
        }

        return $tag;
        
    }
    
}

?>
