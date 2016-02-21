<?php
namespace Application\Validator\File;

use Zend\Validator\File\Extension as FileExtension;

class Extension extends FileExtension
{
    /**
     * Returns true if and only if the file extension of $value is included in the
     * set extension list
     *
     * @param  string  $value Real file to check for extension
     * @return boolean
     */
    public function isValid($value)
    {
        $file = basename($value);
        $info=array();
        $info['extension'] = substr($file, strrpos($file, '.') + 1);

        $extensions = $this->getExtension();
        if ($this->getCase() && (in_array($info['extension'], $extensions))) {
            return true;
        } elseif (!$this->getCase()) {
            foreach ($extensions as $extension) {
                if (strtolower($extension) == strtolower($info['extension'])) {
                    return true;
                }
            }
        }

        return false;
    }
}