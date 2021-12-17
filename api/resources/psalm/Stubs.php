<?php

namespace {
    // Docker image of psalm doesn't have "symfony/polyfill-intl-idn" or "ext-intl" so have to stub it
    class Locale {
        public static function getPrimaryLanguage($locale): ?string {}
    }
}

namespace Illuminate\Translation {
    class Translator {
        /** @psalm-mutation-free */
        public function get(string $key, array $replace = [], string $locale = null, $fallback = true): string {}
    }
}

namespace Illuminate\Foundation\Http {
    class FormRequest {
        /** @psalm-suppress PropertyNotSetInConstructor */
        protected \Illuminate\Contracts\Container\Container $container;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected \Illuminate\Routing\Redirector $redirector;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected string $redirect;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected string $redirectRoute;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected string $redirectAction;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected string $errorBag;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected bool $stopOnFirstFailure;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected \Illuminate\Contracts\Validation\Validator $validator;
    }
}

namespace Illuminate\Foundation\Exceptions {
    class Handler {
        /** @var array<class-string> */
        protected $dontReport;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected \Illuminate\Contracts\Container\Container $container;
    }
}

namespace Illuminate\Http {

    use App\Models\Trainer\Customer;

    class Request {
        /** @psalm-suppress PropertyNotSetInConstructor */
        protected $locale;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected array $convertedFiles;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected \Closure $userResolver;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected \Closure $routeResolver;

        public function user(string $guard = null): ?Customer {}

        public function get(string $key, $default = null) {}
    }
}

namespace Illuminate\Database\Migrations {
    class Migration {
        /** @readonly */
        public bool $dataOnly;


    }
}

namespace Symfony\Component\HttpFoundation {
    class Request {
        /** @psalm-suppress PropertyNotSetInConstructor */
        protected $json;

        /** @psalm-suppress PropertyNotSetInConstructor */
        protected $session;
    }
}

namespace Money {
    /**
     * @extends \IteratorAggregate<Currency>
     */
    interface Currencies extends \IteratorAggregate {}
}

namespace Carbon {
    /** @psalm-immutable  */
    class CarbonImmutable extends DateTimeImmutable implements CarbonInterface {}
}

namespace Carbon\Traits {
    trait Timestamp {
        /**
         * @psalm-pure
         * @return static
         */
        public static function createFromTimestamp($timestamp, $tz = null) {}
        /**
         * @psalm-pure
         * @return static
         */
        public static function createFromTimestampUTC($timestamp) {}
    }
}

namespace Symfony\Component\HttpFoundation {

    use Symfony\Component\HttpFoundation\File\UploadedFile;

    class FileBag {
        public function get(string $key, UploadedFile $default = null): ?UploadedFile {}
    }
}

namespace Illuminate\Foundation\Exceptions {
    class Handler
    {
        /**
         * @psalm-suppress PropertyNotSetInConstructor
         * @var \Illuminate\Contracts\Container\Container
         */
        protected $container;

        /**
         * @psalm-suppress PropertyNotSetInConstructor
         * @var array<class-string>
         */
        protected $dontReport = [];
    }
}

namespace Illuminate\Encryption {
    class Encrypter {
        /** @psalm-pure */
        public function encrypt($value, $serialize = true): string {}

        /** @psalm-pure */
        public function decryptString($value, $serialize = true): string {}
    }
}

namespace Illuminate\Config {
    class Repository {
        /** @psalm-pure */
        public function get($key, $default = null) {}
    }
}
