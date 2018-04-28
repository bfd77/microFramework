<?php
/**
 * @author Bendrikov Fedor <bendrikov.f@roistat.com>
 */

namespace App;

class Renderer
{
    /**
     * @param string $templateName
     * @param array $params
     * @return string
     */
    public function render(string $templateName, array $params = []) {
        $templatePath = __DIR__ . '/../../views/' . $templateName . '.phtml';
        extract($params);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

}