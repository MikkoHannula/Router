<?php

namespace App;

class TemplateEngine {
    public static function render($view, $data = [] ) {
        extract($data);

        $content = __DIR__ ."/View/$view.php";
        include __DIR__ ."/View/layout.php";

    }
}