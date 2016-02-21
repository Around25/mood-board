<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    /**
     * get parameter
     *
     * @param string $paramName
     * @return mixed
     */
    public function getParameter($paramName)
    {
        return $this->getEvent()->getRouteMatch()->getParam($paramName);
    }

    /**
     * @param string $service
     * @return object service
     */
    public function getService($service)
    {
        return $this->getServiceLocator()->get($service);
    }
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function boardAction()
    {
        $name = $this->getParameter('name');
        if (empty($name)){
            return $this->redirect()->toRoute('board', array('name' => $this->getBoardNewName()));
        }
        $boardService = $this->getService('Application\Service\BoardService');
        
        //get board
        
        $board = $boardService->getByName($name);
        if(empty($board)){
            $board = $boardService->create($name);
        }
        
        //set board in session container
        $container = new Container('board');

        
        if(empty($container->boardId) || ($container->boardId !== $board->getId())){
            $container->boardId = $board->getId();
        }
        
        //get user form container
        $user = $container->user;
        if (empty($user)){
            //show user form;
        } else if (!$boardService->checkUserOnBoard($board, $user)) {
            //add user on board
        }
        
        $users = $board->getUsers();
        return new ViewModel();
    }
    
    public function setUserAction()
    {
        $name = $this->getParameter('name');
        $boardService = $this->getService('Application\Service\BoardService');
        $container = new Container('board');
        $board = $boardService->getById($container->boardId);
        if(empty($board)) {
            return new JsonModel(array(
                'url' => 'board/' . $this->getBoardNewName(),
                'success' => false,
            ));
        }
        if (empty($name)) {
            return new JsonModel(array(
                'url' => 'board/'.$container->board->getName(),
                'success' => false,
            ));
        }
        try {
            $userService = $this->getService('Application\Service\userService');
            $user = $userService->create($name);
            $userService->setUserSBoard($user, $board);
            $container->userId = $user->getId();
            return new JsonModel(array(
                'success' => true,
            ));
        } catch (\Exception $e) {
            return new JsonModel(array(
                'err' => $e->getMessage(),
                'success' => false,
            ));
        }
        
        
        
        
    }

    /**
     * generate md5 random name
     * 
     * @return string
     */
    private function getBoardNewName()
    {
        return substr(md5(rand(1000, 9999999)), 0, 20);
    }
}
