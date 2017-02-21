<?php
/**
 * User: youcef_l
 * Date: 21/02/2017
 * Time: 16:45
 */
declare(strict_types = 1);


namespace ActorTest\Controller;


use Actor\Controller\ActorController;
use Actor\Form\AddActorForm;
use Actor\Service\ActorService;
use Zend\Router\Http\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ActorControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../config/application.config.php'
        );

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $actorServiceMock = $this->getMockBuilder(ActorService::class)
                                 ->disableOriginalConstructor()
                                 ->getMock();
        $actorFormMock   = $this->getMockBuilder(AddActorForm::class)
                                ->disableOriginalConstructor()
                                ->getMock();

        $controller = new ActorController($actorServiceMock, $actorFormMock);
        $routeMatch = new RouteMatch(array('controller' => 'Actor'));
        $routeMatch->setParam('action','index');

        $this->assertEquals(200, $controller->getResponse()->getStatusCode());
    }

    public function testInvalidRouteDoesNotCrash()
    {
        $this->dispatch('/actor/ajout','GET');
        $this->assertResponseStatusCode(404);
    }
}
