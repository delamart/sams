<?php

class LogLib {

    const LVL_ERROR = 1;
    const LVL_WARNING = 2;
    const LVL_INFO = 4;
    const LVL_DEBUG = 8;

	private static $instances = array();

	public static function log($type,$level,$text) {
        if(isset(self::$instances[$type]))
        {
            $i = self::$instances[$type];
        }
        else
        {
            $i = new LogLib($type);
            self::$instances[$type] = $i;
        }
		return $i->l($level,$text);
	}

    private $file;

	public function __construct($type) {
		$this->file = ConfigLib::g('directory/log') . DIRECTORY_SEPARATOR . $type . '.log';
	}
	
	public function l($level,$text)
    {
        switch($level)
        {
            case self::LVL_ERROR: $level = 'ERROR'; break;
            case self::LVL_WARNING: $level = 'WARNING'; break;
            case self::LVL_DEBUG: $level = 'DEBUG'; break;
            case self::LVL_INFO:
            default:  $level = 'INFO'; break;
        }

        $text = sprintf("%s:\t%s\t%s\r\n",date('Ymd H:i:s'),$level,rtrim($text));
		return file_put_contents($this->file,$text, FILE_APPEND);
	}
		
}
