<?php

namespace Encore\Admin\Helpers\Controllers;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function index()
    {
      // return $this->saveallroutes();
        return Admin::content(function (Content $content) {
            $model = $this->getModel()->setRoutes($this->getRoutes());

            $content->body(Admin::grid($model, function (Grid $grid) {
                $colors = [
                    'GET'    => 'green',
                    'HEAD'   => 'gray',
                    'POST'   => 'blue',
                    'PUT'    => 'yellow',
                    'DELETE' => 'red',
                    'PATCH'  => 'aqua',
                    'OPTIONS'=> 'light-blue',
                ];

                $grid->method()->map(function ($method) use ($colors) {
                    return "<span class=\"label bg-{$colors[$method]}\">$method</span>";
                })->implode('&nbsp;');

                $grid->uri()->display(function ($uri) {
                    return preg_replace('/\{.+?\}/', '<code>$0</span>', $uri);
                })->sortable();

                $grid->name();
                $grid->action()->display(function ($uri) {
                    return preg_replace('/@.+/', '<code>$0</code>', $uri);
                });
                $grid->middleware()->badge('yellow');

                $grid->disablePagination();
                $grid->disableRowSelector();
                $grid->disableActions();
                $grid->disableCreation();
                $grid->disableExport();

                $grid->filter(function ($filter) {
                    $filter->disableIdFilter();
                    $filter->equal('action');
                    $filter->equal('uri');
                });
            }));
        });
    }

    protected function getModel()
    {
        return new class() extends Model {
            protected $routes;

            protected $where = [];

            public function setRoutes($routes)
            {
                $this->routes = $routes;

                return $this;
            }

            public function where($column, $condition)
            {
                $this->where[$column] = trim($condition);

                return $this;
            }

            public function orderBy()
            {
                return $this;
            }

            public function get()
            {
                $this->routes = collect($this->routes)->filter(function ($route) {
                    foreach ($this->where as $column => $condition) {
                        if (!Str::contains($route[$column], $condition)) {
                            return false;
                        }
                    }

                    return true;
                })->all();

                $instance = $this->newModelInstance();

                return $instance->newCollection(array_map(function ($item) use ($instance) {
                    return $instance->newFromBuilder($item);
                }, $this->routes));
            }
        };
    }

    public function getRoutes()
    {
        $routes = app('router')->getRoutes();

        $routes = collect($routes)->map(function ($route) {
            return $this->getRouteInformation($route);
        })->all();

        if ($sort = request('_sort')) {
            $routes = $this->sortRoutes($sort, $routes);
        }

        return array_filter($routes);
    }

    private function saveallroutes(){
       $routes= $this->getRoutes();
       //print_r($routes);
       $index=0;
       foreach($routes as $item){
           $method=implode(',',$item['method']);
          $uri= substr($item['uri'],5);
          $name= $item['name'];
          $new_arr=array("name"=>''.$name.'',"slug"=>''.$name.'',"http_method"=>''.$method.'',"http_path"=>''.$uri.'');
// 
         // DB::insert('insert into admin_permissions ( name, slug, http_method, http_path, company_id) values ('.$name.','.$name.''.$method.''.$uri.',0)');
 if($name!="null" && $name!="")
          DB::table('admin_permissions')->insert($new_arr);
           $index++;
       }
        return "done";
    }
    /**
     * Get the route information for a given route.
     *
     * @param \Illuminate\Routing\Route $route
     *
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        return [
            'host'       => $route->domain(),
            'method'     => $route->methods(),
            'uri'        => $route->uri(),
            'name'       => $route->getName(),
            'action'     => $route->getActionName(),
            'middleware' => $this->getRouteMiddleware($route),
        ];
    }

    /**
     * Sort the routes by a given element.
     *
     * @param string $sort
     * @param array  $routes
     *
     * @return array
     */
    protected function sortRoutes($sort, $routes)
    {
        return Arr::sort($routes, function ($route) use ($sort) {
            return $route[$sort];
        });
    }

    /**
     * Get before filters.
     *
     * @param \Illuminate\Routing\Route $route
     *
     * @return string
     */
    protected function getRouteMiddleware($route)
    {
        return collect($route->gatherMiddleware())->map(function ($middleware) {
            return $middleware instanceof \Closure ? 'Closure' : $middleware;
        });
    }
}
