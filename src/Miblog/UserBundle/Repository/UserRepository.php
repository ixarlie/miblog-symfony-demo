<?php

class UserRepository extends EntityRepository {

    public function getUserProfile($username) {
        // ResultSetMapping, para realizar consultas nativas
        $rsm = new ResultSetMapping();

        $rsm->addEntityResult('Miblog\UserBundle\Entity\User', 'u');
        $rsm->addFieldResult('u', 'u_id', 'id');
        $rsm->addFieldResult('u', 'u_username_canonical', 'usernameCanonical');
        $rsm->addFieldResult('u', 'u_first_name', 'firstName');
        $rsm->addFieldResult('u', 'u_last_name', 'lastName');
        $rsm->addFieldResult('u', 'u_birthday', 'birthday');
        /*
         * Los MetaResult se utilizan para cuando queremos poner un campo calculado
         * como un count, un sum, o cualquiera que no sea un campo propio de la base
         * de datos.
         */
        //$rsm->addMetaResult('u', 'u_user_ranking', 'user_ranking');

        // Select
        $sql = '
                SELECT
                    u.id as u_id, u.username_canonical as u_username_canonical, 
                    u.first_name as u_first_name, u.last_name as u_last_name,
                    u.birthday as u_birthday
                FROM users u
                -- Contenidos del usuario
                -- LEFT JOIN pp_contents c ON c.owner_id = u.id
                WHERE u.username_canonical = :username
                ';

        // Crea la query y establece los parámetros
        $query = $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->setParameters(array(
                'username' => $username,
            ));   
        
        try {
            $result = $query->getArrayResult();
            if (1 === count($result)) {
                return $result[0];
            }
            
            return null;
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getUserByUsername($username) {
        $user = $this->findOneBy(array('usernameCanonical' => $username));
        /*
         * Para traernos todos los comentarios por ejemplo de un usuario, hariamos
         * simplemente getComment. Con esto ya tendriamos el objeto rellenado en 
         * ese atributo
         */
        //$user->getComment();
        if (empty($user)) {
            throw new HttpException(404, "El usuario " . $username . " no existe.");
        }

        return $user;
    }

}

?>
