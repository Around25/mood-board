<?php
namespace Application\Service;

use Application\Db\Entity\Board;
use Application\Db\Entity\User;

class UserService extends AbstractService
{

    /**
     * @param int $id
     * @return User
     */
    public function getById($id)
    {
        try{
            $item = $this->getRepository('Application\Db\Entity\User')->find($id);
        } catch (\Exception $e){
            var_dump($e->getMessage());exit;
        }

        return $this->checkObject($item);
    }

    /**
     * @param string $name
     * @return User
     */
    public function getByName($name)
    {
        $result = $this->getRepository('Application\Db\Entity\User')->findBy(array('name' => $name));
        return isset($result[0]) ? $this->checkObject($result[0]) : false;
    }

    /**
     * Set user's board
     * 
     * @param User $user
     * @param Board $board
     * 
     * @return bool
     */
    public function setUserSBoard(User $user, Board $board)
    {
        try{
            $this->beginTransaction();
            $user->setBoard($board);
            $this->save($user);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            var_dump($e->getMessage());exit;
        }
    }

    /**
     * create user
     *
     * @param string $name
     *
     * @return User
     */
    public function create($name)
    {
        try{
            $this->beginTransaction();
            $user = new User();
            $user->setName($name);
            $this->save($user);
            $this->commit();
            return $user;
        } catch (\Exception $e) {
            $this->rollback();
            var_dump($e->getMessage());exit;
        }
    }
}