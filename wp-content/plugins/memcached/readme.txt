=== Memcached Object Cache ===
Contributors: ryan, sivel
Tags: cache, memcached
Requires at least: 3.0
Stable tag: 2.0.1

Use memcached and the PECL memcache extension to provide a backing store for the WordPress object cache.

== Description ==
Memcached Object Cache provides a persistent backend for the WordPress object cache. A memcached server and the PECL memcache extension are required.

== Installation ==
1. Install [memcached](http://danga.com/memcached) on at least one server. Note the connection info. The default is `127.0.0.1:11211`.

1. Install the [PECL memcache extension](http://pecl.php.net/package/memcache) 

1. Copy object-cache.php to wp-content



