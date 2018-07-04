<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Started;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'started' => [//route name
                //Literal type: Directed route, Segment type: Route with params
                'type'    => Literal::class,//route type
                'options' => [
                    'route'    => '/started',//set route
                    'defaults' => [
                        'controller' => Controller\IndexController::class,//set controller
                        'action'     => 'index',//set action
                    ],
                ],
                'may_terminate'=>true,
                //set child routes
                'child_routes'=>[
                    'sub_route'=>[
                        'type'=>Segment::class,
                        'options'=>[
                            //set route for example /login/21
                            'route'=>'[/:action][/:id]',
                            'defaults'=>[
                                'controller'=> "User",
                            ],
                            //set constraints for route
                            'constraints'=>[
                                'action'=>'[a-zA-Z0-9]*',//action with character and number, * for not neccessary having
                                'id'=>'[0-9]*',//id with only number, * for not neccesary having
                            ],

                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            //Controller\UserController::class => InvokableFactory::class,

        ],
        'invokables'=>[
            'UserController' => Controller\UserController::class,
        ],
        'aliases'=>[
            'User'=>'UserController',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
