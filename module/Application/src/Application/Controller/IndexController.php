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
use Application\File\Upload;

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
        $firsUserImages = $users[0]->getImages();
        return new ViewModel();
    }
    
    public function setUserAction()
    {
        $name = $this->getParameter('name');
        $boardService = $this->getService('Application\Service\BoardService');
        $container = new Container('board');
        $board = $boardService->getById($container->boardId);
        $result['succes'] = false;
        if(empty($board)) {
            $result['url'] = 'board/' . $this->getBoardNewName();
            return new JsonModel($result);
        }
        if (empty($name)) {
            $result['url'] = 'board/' . $container->board->getName();
            return new JsonModel($result);
        }
        try {
            $userService = $this->getService('Application\Service\userService');
            $user = $userService->create($name);
            $userService->setUserSBoard($user, $board);
            $container->userId = $user->getId();
            $result['succes'] = true;
            return new JsonModel($result);
            
        } catch (\Exception $e) {
            $result['error'] = $e->getMessage();
            return new JsonModel($result);
        }
    }
    
    public function uploadAction() {

        $container = new Container('board');
        if(empty($container->boardId)) {
            $result['url'] = 'board/' . $this->getBoardNewName();
            return new JsonModel($result);
        }
        $result['succes'] = false;
        if (empty($container->userId)) {
            $result['url'] = 'board/' . $container->board->getName();
            return new JsonModel($result);
        }
        
        $file = $this->getRequest()->getFiles('file');
        $result = array();
        
        $extensions = 'jpg,jpeg,gif,png';

        $upload = new Upload(array(
            'extensions' => $extensions,
            'path' => 'uploads/',
            'destination' => PUBLIC_PATH.'/'
        ));
        try {
            $path = $upload->process($file);
            
            $imageService = $this->getService('Application\Service\ImageService');
            $userService = $this->getService('Application\Service\UserService');
            $image = $imageService->create($path);
            $user = $userService->getById($container->userId);
            $imageService->addImageSUser($image, $user);
            
            $result['success'] = true;
            $result['path'] = $path;
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
        }
        return new JsonModel($result);
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
