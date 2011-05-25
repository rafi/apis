# Service APIs for Kohana

The following services are supported:

- Twitter
- Blogger
- *Want to add one? Fork and send a pull request!*

To enable an individual API, add it to your `Kohana::modules` call:

    Kohana::modules(array(
        'twitter' => MODPATH.'apis/twitter',
        'blogger' => MODPATH.'apis/blogger',
    ));

Some services also have live demos and debuggers. To use them, install the [demo module](http://github.com/shadowhand/demo) and enable it:

    Kohana::modules(array(
        'demo'      => MODPATH.'demo',
        'twitter'   => MODPATH.'apis/twitter',
        // ...
    ));

Now the Twitter demo should be available at `http://example.com/demos/twitter`, if the base URL to your Kohana installation is `http://example.com/`.
