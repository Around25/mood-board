<?php
namespace Application\File;
use Zend\Filter\File\Rename as RenameFilter;
use Application\Validator\File\Extension;
/**
 * File Upload class for handling file uploads with ease
 */
class Upload
{
    protected $options = array();

    public function __construct($options)
    {
        $default = array(
            'unique_prefix' => true,
            'path' => '',
            'overwrite' => true,
            'destination' => null,
            'extensions' => null
        );

        $options = array_merge($default, $options);
        $this->setOptions($options);
    }

    public function process($file)
    {
        if ($file instanceof \Zend\Stdlib\Parameters){
            $file = $file->toArray();
        }
        // Make sure a proper array of files has been provided
        if (!is_array($file)){
            throw new \Exception('Invalid files array provided');
        }
        $destination = $this->options['destination'];
        // Make sure there is a destination set for the files
        if (empty($destination)) {
            throw new \Exception('Invalid file destination specified');
        }

        if (!is_writable($destination.$this->options['path'])){
            throw new \Exception('Unable to write to destination');
        }

        if(!empty($this->options['extensions'])){
            if(!$this->isValid($file['name'])){
                throw new \Exception('Invalid file type!');
            }
        }

        $name = $this->options['path'];
        if ($this->options['unique_prefix']){
            $name = uniqid($name, true);
        }
        $name .= '_' . $file['name'];
        $rename = new RenameFilter(array(
            'source' => $file['tmp_name'],
            'target' => $destination . $name,
            'overwrite' => $this->options['overwrite']
        ));
        
        if(!$rename->filter($file['tmp_name'])){
            error_log('error on uploading file: ' . print_r($file, true));
            throw new \Exception('There was an error while uploading file.');
        }
        return $name;
    }

    /**
     * Uses file extension to validate
     * @param $name
     * @return bool
     */
    private function isValid($name)
    {
        $validator = new Extension(array(
                'extension'=>$this->options['extensions']
            )
        );
        return $validator->isValid($name);
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }
}
