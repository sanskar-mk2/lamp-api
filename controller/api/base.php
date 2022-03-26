<?php
class BaseController {
    public function __call($name, $arguments)
    {
        $this->sendOutput("", array("HTTP/1.1 404 NOT FOUND"));
    }

    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $uri = explode("/", $uri);
        return $uri;
    }

    protected function get_query_string_params() {
        return parse_str($_SERVER["QUERY_STRING"], $query);
    }

    protected function send_output($data, $http_headers=array()) {
        header_remove("Set-Cookie");
        if (is_array($http_headers) && count($http_headers)) {
            foreach ($http_headers as $http_header) {
                header($http_header);
            }
        }
        echo $data;
        exit;
    }
}