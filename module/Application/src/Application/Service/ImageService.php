<?php
namespace Application\Service;

use Application\Db\Entity\User;
use Application\Db\Entity\Image;

class ImageService extends AbstractService
{

    /**
     * @param int $id
     * @return Image
     */
    public function getById($id)
    {
        try{
            $item = $this->getRepository('Application\Db\Entity\Image')->find($id);
        } catch (\Exception $e){
            var_dump($e->getMessage());exit;
        }

        return $this->checkObject($item);
    }

    /**
     * @param string $name
     * @return Image
     */
    public function getByName($name)
    {
        $result = $this->getRepository('Application\Db\Entity\Image')->findBy(array('name' => $name));
        return isset($result[0]) ? $this->checkObject($result[0]) : false;
    }

    /**
     * Set user's board
     *
     * @param Image $image
     * @param User $user
     *
     * @return bool
     */
    public function addImageSUser(Image $image, User $user)
    {
        try{
            $this->beginTransaction();
            $image->setUser($user);
            $this->save($image);
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
            $image = new Image();
            $image->setName($name);
            $this->save($image);
            $this->commit();
            return $image;
        } catch (\Exception $e) {
            $this->rollback();
            var_dump($e->getMessage());exit;
        }
    }
}