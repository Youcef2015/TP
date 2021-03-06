<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:31
 */
declare(strict_types = 1);


namespace Blog\Controller;


use Blog\Model\PostRepositoryInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function indexAction()
    {
        return new ViewModel(
            [
                'posts' => $this->postRepository->findAllPosts(),
            ]
        );
    }
}
