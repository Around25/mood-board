<?php
namespace Application\Service;

use Application\Db\Entity\Board;
use Application\Db\Entity\User;

class BoardService extends AbstractService
{

    /**
     * @param int $id
     * @return Board
     */
    public function getById($id)
    {
        try{
            $item = $this->getRepository('Application\Db\Entity\Board')->find($id);
        } catch (\Exception $e){
            var_dump($e->getMessage());exit;
        }

        return $this->checkObject($item);
    }

    /**
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function getByName($name)
    {

        $result = $this->getRepository('Application\Db\Entity\Board')->findBy(array('name' => $name));
        return isset($result[0]) ? $this->checkObject($result[0]) : false;
    }

    /**
     * @param Board $board
     * @param User $user
     * @return bool
     */
    public function checkUserOnBoard(Board $board, User $user)
    {
        $boardUsers = $board->getUsers();
        foreach ($boardUsers as $boardUser){
            if ($user === $boardUser){
                return true;
            }
        }
        return false;
    }

    /**
     * Create board
     *
     * @param string $name
     *
     * @return Board
     */
    public function create($name)
    {

        try{
            $this->beginTransaction();
            $board = new Board();
            $board->setName($name);
            $this->save($board);
            $this->commit();
            return $board;
        } catch (\Exception $e) {
            $this->rollback();
            var_dump($e->getMessage());exit;
        }
        
    }

}