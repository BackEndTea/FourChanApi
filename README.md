# FourChanApi 

[![Build Status](https://travis-ci.org/BackEndTea/FourChanApi.png)](https://travis-ci.org/BackEndTea/FourChanApi)
[![Code Climate](https://codeclimate.com/github/BackEndTea/FourChanApi.png)](https://codeclimate.com/github/BackEndTea/FourChanApi)
[![Code Climate](https://codeclimate.com/github/BackEndTea/FourChanApi/badges/issue_count.svg)](https://codeclimate.com/github/BackEndTea/FourChanApi)
[![Code Climate](https://codeclimate.com/github/BackEndTea/FourChanApi/coverage.svg)](https://codeclimate.com/github/BackEndTea/FourChanApi/coverage)

A PHP api wrapper for the 4chan api.

Please see https://github.com/4chan/4chan-API for usage rules.

## Usage

Get a list off all the Thread #'s of /v/
````php
use FourChan\FourChan;

FourChan::board('v')->getThreads();
````

Grab all the images of the first thread we find on /v/
```php
use FourChan\FourChan;

$posts = FourChan::board('v')->getThreads()[0]->getPosts();

foreach($posts as $post) {
    if ($post->hasimage() {
        echo $post->getImageUrl();
    }
}
```

Any function related to getting image information throws a ``` FourChan\Util\NoImageException``` when there is no image. So another way would be:
```php

$posts = FourChan::board('a')->getThreads()[0]->getPosts();

foreach($posts as $post) {
    try{
        echo $post->getImageUrl();
    } catch(NoImageException $e) {
        //do nothing
    }
}
```

Get the information of a thread
```php
$thread = FourChan::board('a')->getThreads()[0];

// true or false
$thread->isStick();
//true or false
$thread->isClosed();
//true or false
$thread->isArchived();
//Subject or '' if no subject is set.
$thread->getSubject();
//# of OP
$thread->getID();
```
Get the information of a post
```php
$post = FourChan::board('a')->getThreads()[0]->getPosts()[0];
//Comment of the post, including escaped html.
$post->getFullComment();
//# of the post
$post->getID();

```

If you need more functionality, either make it yourself and shoot me a PR, or create an issue on [Github](https://github.com/BackEndTea/FourChanApi) and hope me or someone else does it for you.

## Contributing

Features, bug fixes etc are welcome, please check the [Contributing.md](CONTRIBUTING.md) for more info

## Note

All of fake responses have been grabbed from live threads on 4chan, they do not necessarily represent my views, or of anyone who has worked on this project.
