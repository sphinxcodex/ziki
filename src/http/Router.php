<?php
namespace Ziki\Http;
class Router
{
    protected $request;
    protected $matches;
    protected $supportedHttpMethods = ['get', 'post', 'put', 'patch', 'delete'];
	protected $wild_cards = ['int' => '/^[0-9]+$/', 'any' => '/^[0-9A-Za-z]+$/'];

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
        $method = strtolower($method);
        list($route, $callable) = $args;
        if (!in_array($method, $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }
        $this->matches = $this->_match_wild_cards($route);
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
    /**
	 * Match wild cards
	 *
	 * Check if any wild cards are supplied.
	 *
	 * This will return false if there is a mis-match anywhere in the route, 
	 * or it will return an array with the key => values being the user supplied variable names.
	 *
	 * If no variable names are supplied an empty array will be returned.
	 *
	 * TODO - Support for custom regex
	 *
	 * @param string $route The user-supplied route (with wild cards) to match against
	 *
	 * @return mixed
	 */
    private function _match_wild_cards($route) {
        $params = array();
        $exp_request = explode('/', $this->request->requestUri);
        $exp_route = explode('/', $route);
        
        if (count($exp_request) == count($exp_route)) {
           foreach ($exp_route as $key => $value) {
              if ($value == $exp_request[$key]) {
                 continue;   // So far the routes are matching
              }
              elseif ($value[0] == '(' && substr($value, -1) == ')') {
                 $strip = str_replace(array('(', ')'), '', $value);
                 $exp = explode(':', $strip);
     
                 if (array_key_exists($exp[0], $this->wild_cards)) {
                    $pattern = $this->wild_cards[$exp[0]];
                    
                    if (preg_match($pattern, $exp_request[$key])) {
                       if (isset($exp[1])) {
                          $params[$exp[1]] = $exp_request[$key];
                       }
     
                       continue;   // We have a matching pattern
                    }
                 }
              }
     
              return false;  // There is a mis-match
           }
     
           return $params;   // All segments match
        }
     
        return false;  // Catch anything else
     }
     private function invalidMethodHandler()
     {
         error("405 Method Not Allowed");
     }
     private function defaultRequestHandler()
     {
         echo "{$this->request->serverProtocol} 404 Route Not Found";
     }
    /**
     * Resolves a route
     */
    function resolve()
    {
        // var_dump($this->matches);
        
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
