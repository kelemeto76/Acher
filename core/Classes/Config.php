<?php
namespace Core\Classes;

class Config
{
    private static $loaded = array();
    private static $folder = null;
    
    public static function setFolder($path)
    {
        self::$folder = $path;
    }

    public static function getFolder()
    {
        return self::$folder;
    }
	
    public static function load($name = null)
    {
        $file_path =  self::getFolder() . $name . '.php';

        if (! file_exists($file_path))
        {
            throw new \Exception(Lang::get('general.non_existent_unreadable_file', $file_path));
        }
        return include $file_path;
    }

    public static function get($file_name = null)
    {
        if(empty($file_name))
        {
            throw new \Exception(Lang::get('general.empty_file_name', 'config'));
        }
        
        if(array_key_exists($file_name, self::$loaded))
        {
            return self::$loaded[$file_name];
        }
        else
        {
            $file_data = self::load($file_name);
            return self::$loaded[$file_name] = $file_data;
        }
    }
}