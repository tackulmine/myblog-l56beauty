<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(App\Post::class, function ($faker) {
    $images = ['about-bg.jpg', 'contact-bg.jpg', 'home-bg.jpg', 'post-bg.jpg'];
    $title = $faker->sentence(mt_rand(3, 10));
    return [
        'title' => $title,
        'subtitle' => str_limit($faker->sentence(mt_rand(10, 20)), 252),
        'page_image' => $images[mt_rand(0, 3)],
        'content_raw' => join("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
        'meta_description' => "Meta for $title",
        'is_draft' => false,
    ];
});
