<?php
namespace Application;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Application\Library\View\Http\InjectTemplateListener;
use Zend\Http\Request;
use Application\Model\Domain\Project;
use Zend\ServiceManager\AbstractPluginManager;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface, ViewHelperProviderInterface
{
    protected $_objectManager;

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__
                ),
            ),
        );
    }

    public function getConfig()
    {
        $moduleConfig = include __DIR__ . '/config/module.config.php';
        $layoutConfig = include __DIR__ . '/config/layout.config.php';
        $formelementsConfig = include __DIR__ . '/config/formelements.config.php';
        $config = array_merge($moduleConfig, $layoutConfig,$formelementsConfig);
        return $config;
    }

    public function onBootstrap(MvcEvent $e)
    {
        # cos tu jest nie tak

        $app = $e->getApplication();
        $serviceManager = $app->getServiceManager();
        $eventManager = $serviceManager->get('Application')->getEventManager();
        $sharedEvents = $eventManager->getSharedManager();
        
        /*Wstrzykniecie cookie do layout*/
        if($_COOKIE){
            $cookie = $_COOKIE['ProjectId'];
        }else{
            $cookie = NULL;
        }

        $e->getViewModel()->setVariable('Cookie', $cookie);

        $injectTemplateListener = new InjectTemplateListener();
        $sharedEvents->attach('Application', MvcEvent::EVENT_DISPATCH, array($injectTemplateListener, 'injectTemplate'), -81);

        // wstrzyknięcie LayoutConfig do Layoutu
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $config = $serviceManager->get('Configuration');
        $viewModel->config = $config['layout'];


    }

    public function getServiceConfig() {
        return array(
            'initializers' => array(
            ),
            'factories' => array(
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
        );
    }
}
