<?php
namespace Ziki\Http;

class Router
{
    private $request;
    protected $action;
    private $supportedHttpMethods = array('get', 'post', 'put', 'patch', 'delete');

    public function __construct()
    {
        $this->request = new Request;
    }
    function __call($name, $args)
    {
        $this->handle($name, $args);
    }
    static function __callStatic($name, $args) 
    {
        (new self)->handle($name, $args);
    }  
    private function handle($method, $args)
    {
        list($route, $callable) = $args;
        if (!in_array(strtoupper($method), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }
        $this->{strtolower($method)}[$this->formatRoute($route)] = $callable;
    }  
    /**
     * Removes trailing forward slashes from the right of the route.
     * @param route (string)
     */
    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') {
                return '/';
            }
        return $result;
    }
    private function invalidMethodHandler()
    {
        error("405 Method Not Allowed");
    }
    private function defaultRequestHandler()
    {
        error("{$this->request->serverProtocol} 404 Route Not Found");
    }
    /**
     * Resolves a route
     */
    function resolve()
    {
        $method = strtolower($this->request->requestMethod);
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $callable = $this->{$method}[$formatedRoute] ?? null;
        if (is_null($callable)) {
            $this->defaultRequestHandler();
            return;
        }
        echo call_user_func_array($callable, array($this->request));
    }
    function __destruct()
    {
        $this->resolve();
    }
}
