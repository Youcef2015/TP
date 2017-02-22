<?php
/**
 * User: youcef_l
 * Date: 22/02/2017
 * Time: 10:39
 */
declare(strict_types = 1);


namespace ActorTest\Service;


use Actor\Entity\Actor;
use Actor\Repository\ActorRepository;
use Actor\Service\ActorService;
use Doctrine\ORM\EntityManager;

class ActorServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testDelete_When_I_have_AnException()
    {
        $entityManagerMock    = $this->getMockBuilder(EntityManager::class)
                                     ->disableOriginalConstructor()
                                     ->getMock();

        $actorRepositoryMock  = $this->getMockBuilder(ActorRepository::class)
                                     ->disableOriginalConstructor()
                                     ->getMock();

        $actor = $actorRepositoryMock->method('find')->will($this->returnValue(null));

        $actorService = new ActorService($entityManagerMock, $actorRepositoryMock);

        $this->expectException(\Exception::class);
        $actorService->delete($actor);
    }
}
