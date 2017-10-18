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

Get the image of the first thread OP on /a/

```php
FourChan::board('v')->getThreads()[0]->getPosts()[0]->getImageUrl();
```

## Development

This wrapper is still in development and currently not ready for use, if you wish to contribute check out [the contributing guide](CONTRIBUTING.md)

Todo's:

* Get threads per page
* Get catalog (thread + replies show on indexes)
* Get Archived threads
* Get thumbnails from an OP/post

## Note

All of fake responses have been grabbed from live threads on 4chan, they do not necessarily represent my viewws, or of anyone who has worked on this project.



