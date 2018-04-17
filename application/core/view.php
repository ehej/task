<?php

class View
{

    public function __construct($params)
    {
        if (!empty($params)) {
            foreach ($params as $key => $param) {
                $this->{$key} = $param;
            }
        }
    }

    public $template_view = 'layout.php'; // здесь можно указать общий вид по умолчанию.

    /*
      $content_file - виды отображающие контент страниц;
      $template_file - общий для всех страниц шаблон;
      $data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
     */

    function generate($content_view, $template_view = false, $data = null)
    {
        $basePath = 'application/views/';

        if (is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }

        /*
          динамически подключаем общий шаблон (вид),
          внутри которого будет встраиваться вид
          для отображения контента конкретной страницы.
         */
        if ($template_view) {
            $path = $basePath . $template_view . '.php';
            $content_view = $basePath . $content_view . '.php';
        } else {
            $path = $basePath . $content_view . '.php';
        }
        //var_dump($path); die();
//        var_dump($content_view); die();
        require $path;
    }

    public function renderContent($path, $contnent_view = false)
    {
        ob_start();
        ob_implicit_flush(false);
        require_once $path;
        $out = ob_get_clean();
        return $out;
    }

}