<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MembersControllerTest extends WebTestCase
{
    private $members = array(
        'Denis' => array('Singer', 'Guitarist'),
        'Bodo' => array('Guitarist', 'Keyboardist'),
        'Jack' => array('Drummer'),
        'Giaco' => array('Bassist'),
    );

    /**
     * @test
     */
    public function allMembers()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('app_members_getall');
        $client->request('GET', $url);

        $response = $client->getResponse();
        $content = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertCount(4, $content);

        $members_name = array_keys($this->members);
        $members = array();

        foreach ($content as $member) {
            $roles = array();
            foreach ($member->roles as $role) {
                $roles[] = $role->name;
            }
            $members[$member->name] = $roles;
        }

        $this->assertArraySubset($members, $this->members);
    }
}
