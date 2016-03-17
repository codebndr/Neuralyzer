<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserDatabaseTest extends KernelTestCase
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
		$container = self::$kernel->getContainer();
		$em = $container->get('doctrine')->getManager();
		$userRepo = $em->getRepository('AppBundle:User');
		$userRepo->createQueryBuilder('u')
			->delete()
			->getQuery()
			->execute();
	}

	public function testEmptyDatabase()
	{
		$this->clearDatabase();

		$users = $this->em
			->getRepository('AppBundle:User')
			->findAll();

		$this->assertCount(0, $users);
	}

	public function testNonEmptyDatabase()
	{
		$this->clearDatabase();

		$user = new User();
		$user->setUsername('FooBar');
		$user->setEmail('foobar@bar.com');
		$user->setPassword('foobar123');
		$user->setTier(1);
		$user->setTotalFlashCount(10);
		$user->setSuccessfulFlashCount(9);
		$user->setFailedFlashCount(1);

		$this->em->persist($user);
		$this->em->flush();

		$users = $this->em
			->getRepository('AppBundle:User')
			->findAll();

		$this->assertCount(1, $users);
		$this->assertEquals('FooBar', $users[0]->getUsername());
		$this->assertEquals('foobar@bar.com', $users[0]->getEmail());
		$this->assertNotEquals('foobar123', $users[0]->getPassword());
		$this->assertEquals(1, $users[0]->getTier());
		$this->assertEquals(10, $users[0]->getTotalFlashCount());
		$this->assertEquals(9, $users[0]->getSuccessfulFlashCount());
		$this->assertEquals(1, $users[0]->getFailedFlashCount());
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
