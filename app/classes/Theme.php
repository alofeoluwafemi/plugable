<?php

/**
 * Class to handle application theme
 * system
 */
namespace Plugable\Classes;

class Theme
{
    /**
     * Default frontend view
     * set in config
     * @var string
     */
    public $defaultTheme;

    public $theme;

    /**
     * Path to view to be rendered
     * in respect to the theme.
     * Were dot notates backslashes
     * @var string
     */
    private $viewPath;

    /**
     * Variables injected with the
     * view to be rendered
     * @var mixed
     */
    private $variables;

    public function __construct($app)
    {
        $this->app          = $app;
        $this->defaultTheme = "frontend";
    }

    public function render($path,$variable)
    {

    }

    /**
     * Set either frontend,
     * backend or customized
     * @param $theme
     * @return $this
     */
    public function setTheme($theme)
    {
        $this->theme    = $theme;

        $this->setThemePart();
    }

    /**
     * Detect theme whether frontend
     * or backend. Get theme name
     * from config & generate theme
     * path with these information
     * @return $this
     */
    public function setThemePart()
    {
        $theme              = onlyWhenAvailable($this->theme,$this->defaultTheme);
        $path               = $this->app->config->get('theme.path');
        $type               = $this->app->config->get('theme.template.'.$theme);

//        $this->app->config->set('theme.active',$path.$theme.$type);
        $this->app->config->configuration['theme']['active']    = $path.$theme.$type;

        return $this;
    }

}