<?php

namespace Application\Library\View\Http;

use Zend\Mvc\View\Http\InjectTemplateListener as ZendInjectTemplateListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Zend\View\Model\ModelInterface as ViewModel;

class InjectTemplateListener extends ZendInjectTemplateListener {

    public function injectTemplate(MvcEvent $e)
    {
        $model = $e->getResult();
        if (!$model instanceof ViewModel) {
            return;
        }

        $template = $model->getTemplate();
        if (!empty($template)) {
            return;
        }

        $routeMatch = $e->getRouteMatch();
        $controller = $e->getTarget();
        if (is_object($controller)) {
            $controller = get_class($controller);
        }
        if (!$controller) {
            $controller = $routeMatch->getParam('controller', '');
        }

        $module = $this->deriveModuleNamespace($controller);

        $controllerSubNs = '';
        if ($namespace = $routeMatch->getParam(ModuleRouteListener::MODULE_NAMESPACE)) {
            $controllerSubNs = $this->deriveControllerSubNamespace($namespace);
        }

        $controller = $this->deriveControllerClass($controller);
        
        //$template   = $this->inflectName($controllerSubNs);
        $template   = $controllerSubNs;

        if (!empty($template)) {
            $template .= '/';
        }
        //$template  .= $this->inflectName($controller);
        $template  .= $controller;

        $model->setTemplate($template);
    }
    
}

?>
