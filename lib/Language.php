<?php
class Language {
    private $db;
    private $currentLanguage;
    private $availableLanguages;
    
    public function __construct() {
        $this->db = new Database();
        $this->availableLanguages = $this->getAvailableLanguages();
        $this->currentLanguage = $this->determineLanguage();
    }
    
    /**
     * Get all available languages from database
     */
    private function getAvailableLanguages() {
        $this->db->query('SELECT code, name, is_default FROM languages WHERE is_active = TRUE');
        $languages = $this->db->resultSet();
        
        $result = [];
        foreach ($languages as $lang) {
            $result[$lang->code] = [
                'name' => $lang->name,
                'is_default' => $lang->is_default
            ];
        }
        
        return $result;
    }
    
    /**
     * Determine the current language based on session, cookie, or browser preference
     */
    private function determineLanguage() {
        // Check if language is set in URL parameter
        if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $this->availableLanguages)) {
            $lang = $_GET['lang'];
            $_SESSION['current_language'] = $lang;
            setcookie('language', $lang, time() + (365 * 24 * 60 * 60), '/');
            return $lang;
        }
        
        // Check if language is set in session
        if (isset($_SESSION['current_language']) && array_key_exists($_SESSION['current_language'], $this->availableLanguages)) {
            return $_SESSION['current_language'];
        }
        
        // Check if language is set in cookie
        if (isset($_COOKIE['language']) && array_key_exists($_COOKIE['language'], $this->availableLanguages)) {
            $_SESSION['current_language'] = $_COOKIE['language'];
            return $_COOKIE['language'];
        }
        
        // Try to detect browser language
        $browserLang = $this->getBrowserLanguage();
        if ($browserLang && array_key_exists($browserLang, $this->availableLanguages)) {
            $_SESSION['current_language'] = $browserLang;
            setcookie('language', $browserLang, time() + (365 * 24 * 60 * 60), '/');
            return $browserLang;
        }
        
        // Get default language from available languages
        foreach ($this->availableLanguages as $code => $data) {
            if ($data['is_default']) {
                $_SESSION['current_language'] = $code;
                setcookie('language', $code, time() + (365 * 24 * 60 * 60), '/');
                return $code;
            }
        }
        
        // Fallback to first available language
        if (!empty($this->availableLanguages)) {
            $codes = array_keys($this->availableLanguages);
            $firstLang = reset($codes);
            $_SESSION['current_language'] = $firstLang;
            setcookie('language', $firstLang, time() + (365 * 24 * 60 * 60), '/');
            return $firstLang;
        }
        
        // Ultimate fallback
        return 'tr';
    }
    
    /**
     * Detect browser language preference
     */
    private function getBrowserLanguage() {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $browserLangs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
            $browserLang = substr($browserLangs[0], 0, 2);
            return $browserLang;
        }
        return null;
    }
    
    /**
     * Get current language code
     */
    public function getLanguage() {
        return $this->currentLanguage;
    }
    
    /**
     * Get all available languages
     */
    public function getAvailableLanguagesList() {
        return $this->availableLanguages;
    }
    
    /**
     * Get translation for a specific key
     * This will be expanded later with a proper translation system
     */
    public function getTranslation($key, $default = '') {
        // For now, return the key or default value
        // Later we'll implement a proper translation database table
        return $default ?: $key;
    }
    
    /**
     * Change the current language
     */
    public function setLanguage($langCode) {
        if (array_key_exists($langCode, $this->availableLanguages)) {
            $_SESSION['current_language'] = $langCode;
            setcookie('language', $langCode, time() + (365 * 24 * 60 * 60), '/');
            $this->currentLanguage = $langCode;
            return true;
        }
        return false;
    }
}
?>