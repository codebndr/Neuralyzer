<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Tier;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TierDatabaseTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function clearDatabase()
    {
        $tiers = $this->em
            ->getRepository('AppBundle:Tier')
            ->findAll();

        foreach ($tiers as $tier) {
            $this->em->remove($tier);
        }
        $this->em->flush();
    }

    public function testEmptyDatabase()
    {
        $this->clearDatabase();

        $tiers = $this->em
            ->getRepository('AppBundle:Tier')
            ->findAll();

        $this->assertCount(0, $tiers);
    }

    public function testNonEmptyDatabase()
    {
        $this->clearDatabase();

        $tier = new Tier();
        $tier->setTierName('A Foo Bar');
        $tier->setPrice(19.99);
        $tier->setDescription('Lorem');
        $tier->setTierImage('img/test');
        $tier->setSuccessfulFlashCount(1);

        $this->em->persist($tier);
        $this->em->flush();

        $tiers = $this->em
            ->getRepository('AppBundle:Tier')
            ->findAll();

        $this->assertCount(1, $tiers);
        $this->assertEquals('A Foo Bar', $tiers[0]->getTierName());
        $this->assertEquals(1, $tiers[0]->getSuccessfulFlashCount());
        $this->assertEquals('Lorem', $tiers[0]->getDescription());
        $this->assertEquals('img/test', $tiers[0]->getTierImage());
        $this->assertEquals(19.99, $tiers[0]->getPrice());

        $this->clearDatabase();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
    }
}
