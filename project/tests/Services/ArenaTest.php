<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Services\Arena;

class ArenaTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public function testFight2()
    {
        $knight = $this->em->getRepository('App:Knight')->find(1);
        $knight2 = $this->em->getRepository('App:Knight')->find(2);

        $result = (new Arena())->fight($knight, $knight2);

        $this->assertEquals($result, -1);
    }
}
