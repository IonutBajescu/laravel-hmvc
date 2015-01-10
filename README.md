# Laravel HVMC - Modules

The HMVC design pattern it's a modular pattern and can be(and is) used in the same time with the old MVC pattern.
Basically, your Laravel 5 application structure will look like this:
```
app
├── Console
├── Exceptions
├── Framework
├── Http
├── Models
├── Modules
│   ├── Blog
│   │   └── module.json
│   └── Forum
│       └── module.json
├── Providers
├── Services
└── User.php
```

I'll write more about this topic on my blog, the Laravel-HMVC it's in developing phrase.