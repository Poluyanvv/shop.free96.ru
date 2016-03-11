<?php
/**
 * Created by PhpStorm.
 * User: Валерий
 * Date: 23.02.2016
 * Time: 12:58
 */
class View {

    private $__values;
    private $__extension = '.php';
    private $__layout;
    private $__template;

    public function __construct($pattern)
    {
        $this->__values = array();
        $this->setLayout($pattern);
    }

    public function __set($varName, $value)
    {
        $this->__values[$varName] = $value;
    }

    public function __get($varName)
    {
        if (!empty($this->__values[$varName]))
            return $this->__values[$varName];
        else
            return null;
    }

    /*
     * подключение основного шаблока
     */
    public function render($file) {
        /* $file - текущее представление */
        $__template = Application::getTemplatesDir() . DIRECTORY_SEPARATOR . $file . $this->__extension;
        if (file_exists($__template)){
            $this->__template = $__template;
        }
        extract($this->__values);
        if (file_exists($this->__layout)) {
            ob_start();
            include($this->__layout);
            ob_end_flush();
        } else {
            throw new Exception('Ошибка подключение базового шаблона');
        }
    }

    /*
     * подключение блоков на странице
     */
    public function block($templateName)
    {
        extract($this->__values);
        $file =   Application::getTemplatesDir() . DIRECTORY_SEPARATOR .$templateName . $this->__extension;
        if (file_exists($file)){
            include($file);
        } else {
            throw new Exception ("Ошибка подключение шаблона блока!");
        }
    }

    /*
     * включение основного контента
     */
    public function content()
    {
        extract($this->__values);
        include($this->__template);
    }

    public function clear()
    {
        $this->__values = array();
    }

    /*
     * установка базового шаблона
     */
    public function setLayout($templatePath)
    {
        $__layout = Application::getTemplatesDir(). DIRECTORY_SEPARATOR . $templatePath . $this->__extension;
        if (file_exists($__layout)){
            $this->__layout = $__layout;
        }
        else {
            throw new Exception ("Ошибка установления базового шаблона!");
        }
    }
    /*
     * получение основного шаблона
     */
    public function getLayout()
    {
        return $this->__layout;
    }
}