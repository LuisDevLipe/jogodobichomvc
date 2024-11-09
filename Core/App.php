<?php
namespace Core;

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $slug = '';
    protected $params = [];
    public function __construct()
    {

        $url = $this->parseUrl();
        $url = $url ? $url : [$this->controller];
        // dd($url);
        if (file_exists(filename: '../App/Controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../App/Controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists(object_or_class: $this->controller, method: $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values(array: $url) : [];

        call_user_func_array(callback: [$this->controller, $this->method], args: $this->params);
    }

    protected function parseUrl(): array|bool
    {
        $url = explode(
            separator: '/',
            string: filter_var(
                value: trim(
                    string: $_SERVER['REQUEST_URI'],
                    characters: '/'
                ),
                filter: FILTER_SANITIZE_URL
            )
        );

        // parse_str(string: ltrim(string: substr(string: $url[array_key_last(array:$url)], offset: stripos(haystack: $url[array_key_last(array:$url)], needle: '?')), characters: "?"), result: $query_string);
        $url[array_key_last(array: $url)] = explode(
        separator: '?',
        string: $url[array_key_last(array: $url)]
        )[0];
        array_shift($url);

        if (empty($url)) {
            return false;
        }
        return $url;
        // return [
        //     'url' => $url,
        //     'query_string' => $query_string,
        // ];
    }
}
