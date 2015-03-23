<?php

class TranslateLib {
	
	private static $instance;
	
	public static function getInstance($lang = null) {
		if(!self::$instance) { self::$instance = new TranslateLib($lang); }
		return self::$instance;
	}
	
	public static function translateText($text, $lang = null) {
		$i = self::getInstance();
		return $i->translate($text, $lang);
	}
	
	private $locale = 'en_US';
	private $translations = array();
	
	private function __construct($lang) {
		
		$this->locale = $lang ? $lang : ConfigLib::g('i18n/locale');
		
		$file = ConfigLib::g('directory/locale') . DIRECTORY_SEPARATOR . $this->locale . DIRECTORY_SEPARATOR . 'php/translations.php';	
		
		if(file_exists($file)) {
			require_once($file);
			$name = "translations_{$this->locale}";
			$this->translations = $$name;
		}
		else {
			throw new Exception("Cannot load locale file $file.");
		}
		
	}
	
	public function translate($text)
    {
        if (isset($this->translations[$text]))
        {
            return $this->translations[$text];
        }
        else
        {
            LogLib::log('translate',LogLib::LVL_ERROR,sprintf('Translation for "%s" missing in locale "%s"',$text,$this->locale));
            return $text;
        }
	}
		
}
