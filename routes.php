<?php
$router->get('', 'WorkController@index');
$router->get('works', 'WorkController@index');
$router->post('works', 'WorkController@store');
$router->get('works/delete', 'WorkController@delete');
$router->get('works/edit', 'WorkController@edit');
$router->post('works/edit', 'WorkController@update');
$router->get('works/calendar', 'WorkController@calendar');
