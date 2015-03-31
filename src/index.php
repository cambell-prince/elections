<?php
use Slim\Slim;
use Slim\Middleware;
use Api\Election;

require_once ('Config.php');


/**
 *
 * @param string $filePath
 * @param array $vars
 */
function renderView($filePath, $vars)
{
    extract($vars); // Extract the vars to local namespace
    // ob_start();
    // Including the file will render it directly. Templates are mostly html
    include ($filePath);
    // $contents = ob_get_contents();
    // ob_end_clean();
    // return $contents;
}

function getScripts()
{
    $it = new RecursiveDirectoryIterator('app');
    $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::SELF_FIRST);

    $scripts = array();
    foreach ($it as $file) {
        if ($file->isFile()) {
            $ext = $file->getExtension();
            $isMin = (strpos($file->getPathname(), '-min') !== false);
            if (! $isMin && $ext == 'js') {
                $scripts[] = '/' . $file->getPathname();
            }
        }
    }
    return $scripts;
}

/*
function main()
{
    if (USE_BOOT && ! isset($_GET['skipboot'])) {
        if (file_exists('boot.php')) {
            require_once ('boot.php');
            Boot::ensureMongoLoaded();
        }
    }
    $vars = array();
    if (! USE_LIBS) {
        $vars['scripts'] = getScripts();
    } else {
        $vars['scripts'][] = '/assets/elections-min.js';
    }
    $vars['version'] = VERSION . ' ' . BUILD_DATE;
    renderView('app/app.html.php', $vars);
}

main();
*/

class JsonMiddleware extends Middleware
{
    private $_urlPattern;

    public function __construct($urlPattern) {
        $this->_urlPattern = $urlPattern;
    }

    public function call()
    {
        // Get reference to application
        $app = $this->app;

        // Run inner middleware and application
        $this->next->call();

        $routeName = $app->router()->getCurrentRoute()->getPattern();
        if (strstr($routeName, $this->_urlPattern) !== false) {
            // Set the content type header to json
            $response = $app->response();
            if ($response->getBody()) {
                $body = $response->getBody();
                $body = '{"result":' . $body . '}';
                $response->setBody($body);
            }
            $response->header("Content-Type", "application/json");
        }

    }
}

function apiMiddleWare(\Slim\Route $route) {
//    var_dump($route);
//    $route->setMiddleware(new JsonMiddleware());
}

$app = new Slim();
$app->add(new JsonMiddleware('/api/'));
$app->get('/hello/:name', function($name) {
    echo "Hello, $name";
});
$app->get('/', function() {
    renderView('views/voting.html.php', []);
});
$app->get('/admin', function() {
    $vars = array();
    if (! USE_LIBS) {
        $vars['scripts'] = getScripts();
    } else {
        $vars['scripts'][] = '/assets/elections-min.js';
    }
    $vars['version'] = VERSION . ' ' . BUILD_DATE;
    renderView('app/app.html.php', $vars);
});
$app->group('/api', 'apiMiddleWare', function() use ($app) {
    $app->get('/election/:id', function($id) {
        echo json_encode(Election::read($id));
    });
    $app->get('/election', function() use ($app) {
        echo json_encode(Election::readAll());
    });
    $app->get('/election/:id/ballots', function($id) use ($app) {
        echo json_encode(Election::readBallots($id));
    });
    $app->post('/election/:id/ballots/:n', function($id, $n) use ($app) {
        echo json_encode(Election::createBallots($id, $n));
    });
    $app->post('/election/:id', function($id) use ($app) {
        $body = $app->request()->getBody();
        $data = json_decode($body, true);
        echo json_encode(Election::update($data, $id));
    });
    $app->post('/election', function() use ($app) {
        $body = $app->request()->getBody();
        $data = json_decode($body, true);
        echo json_encode(Election::update($data));
    });
    $app->delete('/election/:id', function($id) {
        echo json_encode(Election::delete($id));
    });
});

$app->run();

?>