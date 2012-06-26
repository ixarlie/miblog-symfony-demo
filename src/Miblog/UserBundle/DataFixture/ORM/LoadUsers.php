<?php

namespace Miblog\MiblogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Miblog\MiblogBundle\Entity\User;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $nombres = array('Adán', 'Adolfo', 'Agustin', 'Albert', 'Alberto', 'Alejandro',
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
    private $apellidos = array('García', 'Fernández', 'González', 'Rodríguez', 'López', 'Martínez',
        'Sánchez', 'Pérez', 'Martín', 'Gómez', 'Jiménez', 'Ruiz', 'Hernández',
        'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero', 'Alonso', 'Gutiérrez',
        'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Gil', 'Ramos', 'Serrano',
        'Blanco', 'Ramírez', 'Molina', 'Suárez', 'Ortega', 'Delgado', 'Morales',
        'Castro', 'Rubio', 'Ortíz', 'Marín', 'Sanz', 'Iglesias', 'Núñez',
        'Garrido', 'Cortés', 'Medina', 'Santos', 'Lozano', 'Cano', 'Castillo',
        'Gerrero', 'Prieto');
    private $container;

    public function getOrder() {
        return 201;
    }

    public function load(ObjectManager $manager) {
        //Superuser
        $superUser = new User();
        $superUser->setUsername('ixarlie');
        $superUser->setUsernameCanonical($this->container->get('fos_user.util.username_canonicalizer')->canonicalize(trim('ixarlie')));
        $superUser->setEmail('carlos@idetia.es');
        $superUser->setEmailCanonical($this->container->get('fos_user.util.email_canonicalizer')->canonicalize(trim('carlos@idetia.es')));
        $superUser->setBirthDay(new \DateTime("1985-12-01"));
        $superUser->setFirstName('Carlos');
        $superUser->setLastName('Dominguez');
        $superUser->setEnabled(true);
        $superUser->setLocked(false);

        $encoder = $this->container->get('security.encoder_factory')->getEncoder($superUser);
        $superUser->setPassword($encoder->encodePassword('pass', $superUser->getSalt()));

        $superUser->setRole('ROLE_ADMIN');
        $this->addReference('superuser', $superUser);
        $manager->persist($superUser);

        //Creando resto de usuarios
        foreach (range(1, 5) as $i) {
            $user = new User();
            $user->setFirstName($this->nombres[rand(0, count($this->nombres) - 1)]);
            $user->setUsername(trim($user->getFirstName()).'us');
            $user->setUsernameCanonical($this->container->get('fos_user.util.username_canonicalizer')->canonicalize(trim($user->getUsername())));
            $user->setEmail('usr'.$i.'@mail.es');
            $user->setEmailCanonical($this->container->get('fos_user.util.email_canonicalizer')->canonicalize(trim('usr'.$i.'@mail.es')));
            $user->setBirthDay(new \DateTime("1986-".$i."-".$i));
            $user->setLastName($this->apellidos[rand(0, count($this->apellidos) - 1)]);
            $user->setEnabled(true);
            $user->setLocked(false);

            $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
            $user->setPassword($encoder->encodePassword('pass', $user->getSalt()));
            
            if ($user->getAge() > 30) {
                $user->setRole("ROLE_ADMIN");
            } else {
                $user->setRole("ROLE_USER");
            }
            $this->addReference('user' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

}

?>
