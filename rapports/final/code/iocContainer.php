<?php

// Bind de foo à la classe FooBar à l'aide d'une fonction anonyme
App::bind('foo', function($app)
{
    return new FooBar;
});

// $value sera un objet de type FooBar
$value = App::make('foo');
