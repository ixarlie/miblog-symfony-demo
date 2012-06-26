<?php

namespace Miblog\MiblogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository {

    public function findByArticle($idArticle) {

        /*
         * Le decimos en el mapeado, que campo de la bd se corresponde con
         * el objeto.
         */
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('Miblog\MiblogBundle\Entity\Comment', 'c');
        $rsm->addFieldResult('c', 'c_id', 'id');
        $rsm->addFieldResult('c', 'c_message', 'message');

        /*
         * Creamos la SQL. Tambien podriamos poner aqui la DQL. Los parametros
         * se ponen con dos puntos.
         */
        $sql = 'SELECT c.id as c_id, c.message as c_message FROM comments c
            LEFT JOIN articles a ON a.id = c.article_id 
            WHERE a.id = :id';

        // Crea la query y establece los parámetros
        $query = $this->getEntityManager()
                ->createNativeQuery($sql, $rsm)
                ->setParameters(array(
            'id' => $idArticle,
                ));

        $query->setHint(\Doctrine\ORM\Query::HINT_FORCE_PARTIAL_LOAD, true);

        //Devuelve los resultados
        return $query->getResult();
    }
    
    public function findByUser($idUser) {
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('Miblog\MiblogBundle\Entity\Comment', 'c');
        $rsm->addFieldResult('c', 'c_id', 'id');
        $rsm->addFieldResult('c', 'c_message', 'message');

        $sql = 'SELECT c.id as c_id, c.message as c_message FROM comments c
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
