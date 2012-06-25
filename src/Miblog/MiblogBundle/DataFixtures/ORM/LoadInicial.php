<?php

namespace Desymfony\Desymfony\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Miblog\MiblogBundle\Entity\User,
    Miblog\MiblogBundle\Entity\Article,
    Miblog\MiblogBundle\Entity\Comment,
    Miblog\MiblogBundle\Entity\Tag;

class LoadInicial extends AbstractFixture {
    
    protected $manager;
    private   $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load($manager)
    {
        $this->manager = $manager;
        
        $nombres = array('Adán', 'Adolfo', 'Agustin', 'Albert', 'Alberto', 'Alejandro',
                         'Andrés', 'Antonio', 'Ariel', 'Benjamin', 'Bernardo', 'Carles',
                         'Carlos', 'Cayetano', 'César', 'Cristian', 'Daniel', 'David',
                         'Diego', 'Dimas', 'Eduardo', 'Eneko', 'Esteban', 'Fernando',
                         'Francisco', 'Gonzalo', 'Gregorio', 'Guillermo', 'Haritz', 'Iago',
                         'Ignacio', 'Iker', 'Isaïes', 'Isis', 'Iván', 'Jacob', 'Javier',
                         'Joan', 'Jordi', 'Jorge', 'Jose', 'Juan', 'Kevin', 'Luis', 'Marc',
                         'Marta', 'Miguel', 'Moisés', 'Oriol', 'Oscar', 'Pablo', 'Pedro',
                         'Pere', 'Rafael', 'Raúl', 'Rebeca', 'Rosa', 'Rubén', 'Salvador',
                         'Santiago', 'Sergio', 'Susana', 'Verónica', 'Vicente', 'Víctor',
                         'Victoria', 'Vidal');
        
        /* Los 50 apellidos más comunes en España según el Instituto de Estadística */
        $apellidos = array('García', 'Fernández', 'González', 'Rodríguez', 'López', 'Martínez',
                           'Sánchez', 'Pérez', 'Martín', 'Gómez', 'Jiménez', 'Ruiz', 'Hernández',
                           'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero', 'Alonso', 'Gutiérrez',
                           'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Gil', 'Ramos', 'Serrano',
                           'Blanco', 'Ramírez', 'Molina', 'Suárez', 'Ortega', 'Delgado', 'Morales',
                           'Castro', 'Rubio', 'Ortíz', 'Marín', 'Sanz', 'Iglesias', 'Núñez',
                           'Garrido', 'Cortés', 'Medina', 'Santos', 'Lozano', 'Cano', 'Castillo',
                           'Gerrero', 'Prieto');
        
        //CARGA DATOS DE USUARIOS
        $factory = $this->container->get('security.encoder_factory');
        //super usuario
        $superuser = new User();
        $superuser->setNickname('ixarlie');
        $superuser->setName('Carlos');
        $superuser->setSurname('Dominguez');
        $superuser->setAge(26);
        $superuser->setEmail('carlos@idetia.es');
        $superuser->setRole('ROLE_ADMIN');
        $codificador = $factory->getEncoder($superusuario);
        $password = $codificador->encodePassword('usuario'.$i, $usuario->getSalt());
        $superuser->setPassword($password);
        
        foreach (range(1, 5) as $i) {
            $usuario = new User();
            $usuario->setName($nombres[rand(0, count($nombres)-1)]);
            $usuario->setSurname(
                $apellidos[rand(0, count($apellidos)-1)].
                ' '.
                $apellidos[rand(0, count($apellidos)-1)]
            );
            
            $usuario->setAge(rand(18,99));
            $usuario->setEmail('usuario'.$i.'@desymfony.com');
            $codificador = $factory->getEncoder($usuario);
            $password = $codificador->encodePassword('usuario'.$i, $usuario->getSalt());
            $usuario->setPassword($password);
            if($usuario->getAge() > 30)
            {
                $usuario->setRole("ROLE_ADMIN");
            } else {
                $usuario->setRole("ROLE_USER");
            }
            $manager->persist($usuario);
        }
        $manager->flush();
              
        //Creando tags
        $tag1 = new Tag();
        $tag1->setLabel('symfony');
        $manager->persist($tag1);
        $tag2 = new Tag();
        $tag2->setLabel('java');
        $manager->persist($tag2);
        $tag3 = new Tag();
        $tag3->setLabel('php');
        $manager->persist($tag3);
        $tag4 = new Tag();
        $tag4->setLabel('delphi');
        $manager->persist($tag4);
        $manager->flush();
        
        //Creando articulo
        $articulo = new Article();
        $articulo->setTitle('Introducción a Symfony');
        $articulo->setCreatedAt(new \DateTime());
        $articulo->setUpdatedAt(new \DateTime());
        $articulo->setUser($superuser);
        $articulo->setContent('Esto sera una breve introducción a Symfony, en' .
                ' breve verás más cositas por aquí');
        
        //Creando comentarios
        $comentario = new Comment();
        $comentario->setUser($superuser);
        $comentario->setMessage('Ya podéis comentar el artículo');
        $comentario->setCreatedAt(new \DateTime());
        $comentario->setArticle($articulo);
        $manager->persist($comentario);
        $manager->flush();
        
        array_push($articulo->getComments(),$comentario);
        array_push($articulo->getTags(), $tag1);
        
        $manager->persist($articulo);
        $manager->flush();
    }
    
    
}



?>
