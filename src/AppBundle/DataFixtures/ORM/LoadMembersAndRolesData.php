<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Member;
use AppBundle\Entity\Role;

class LoadMembersAndRolesData implements FixtureInterface
{
    /**
     * Musician's roles.
     *
     * @var array
     */
    private $roles = array(
        'Singer',
        'Guitarist',
        'Bassist',
        'Drummer',
        'Keyboardist',
    );

    /**
     * Band's members.
     *
     * @var array
     */
    private $members = array(
        'Denis' => array('Singer', 'Guitarist'),
        'Bodo' => array('Guitarist', 'Keyboardist'),
        'Jack' => array('Drummer'),
        'Giaco' => array('Bassist'),
    );

    public function load(ObjectManager $manager)
    {
        $roles = array();

        foreach ($this->roles as $role_name) {
            $role = new Role();
            $role->setName($role_name);
            $manager->persist($role);
            $roles[$role_name] = $role;
        }

        foreach ($this->members as $member_name => $roles_name) {
            $member = new Member();
            $member->setName($member_name);

            foreach ($roles_name as $role_name) {
                $member->addRole($roles[$role_name]);
            }

            $manager->persist($member);
        }

        $manager->flush();
    }
}
