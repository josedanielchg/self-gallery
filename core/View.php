<?php

namespace app\core;

class View
{
     public function renderView($view, array $params)
     {
          $layoutName = Application::$app->controller->layouts['main'];
          $complementsLayout = Application::$app->controller->layouts['complements'];
          
          $viewContent = $this->renderContent($view, $params['variables']);
          $mainLayoutContent = $this->renderLayout($layoutName, $params['variables']);

          $bindContent = str_replace('{{ content }}', $viewContent, $mainLayoutContent);
          $bindContent = $this->replaceLayouts($bindContent, $complementsLayout);

          if(isset( $params['scripts']))
               $bindContent = $this->addJsScrips($bindContent, $params['scripts']);

          return $bindContent = $this->replaceVariables($bindContent, $params['variables']);
     }

     public function renderContent($view, array $params):string
     { 
          //This loop will allow to use the variables in params to execute any logic within the view
          foreach ($params as $key => $value) {
               $$key = $value;
          }
          ob_start();
          include_once Application::$ROOT_DIR."/views/$view.php";
          return ob_get_clean();
     }

     public function renderLayout($layoutName, array $params):string
     {
          //This loop will allow to use the variables in params to execute any logic within the layout
          foreach ($params as $key => $value) {
               $$key = $value;
          }
          ob_start();
          include_once Application::$ROOT_DIR."/views/layouts/$layoutName.php";
          return ob_get_clean();
     }

     public function replaceLayouts(string $html, array $layouts):string
     {
          //This loop will allow to replace all the layouts defined as {{layout->name }} in the view
          foreach ($layouts as $key) {
               if(substr_count($html, '{{ layout->'. $key. ' }}')) {
                    ob_start();
                    include_once Application::$ROOT_DIR."/views/layouts/$key.php";
                    $complement = ob_get_clean();
                    $html =  str_replace( '{{ layout->'. $key. ' }}', $complement,  $html);
               }
          }
          return $html;
     }

     public function replaceVariables(string $html, array $params):string
     {
          //This loop will allow to replace all the variables defined as {{ $nameVariable }} in the view
          foreach ($params as $key => $value) {
               if(is_string($value))
                    $html =  str_replace( '{{ $'. $key. ' }}', $value,  $html);
          }
          return $html;
     }

     public function addJsScrips(string $html, array $scriptFiles):string
     {
          $scriptTags = "";
          //This loop will allow creating all the <script> tags that the view needs
          foreach ($scriptFiles as $key => $value)
          {
               if($value === 'module-type')
                    $scriptTags .= "<script src='js/$key' type='module'></script>";
               else
                    $scriptTags .= "<script src='js/$key'></script>";
          } 
          
          $html = str_replace('{{ scripts->js }}', $scriptTags, $html);
          return $html;
     }
}