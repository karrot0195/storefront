<?php
class RouterHelper {
    static function getPath($path, $params=[]) {
        if (count($params)) {
            $arr = [];
            foreach ($params as $k => $v) {
                $arr[] = $k . '=' . $v;
            }
            $path .= '?' . implode('&', $arr);
        }
        return home_url($path);
    }
}