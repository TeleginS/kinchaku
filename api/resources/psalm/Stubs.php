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

namespace Cloudflare\API\Endpoints {

    class CustomHostnames
    {
        /**
         * @return object{
         *   success: bool,
         *   errors: array,
         *   message: array,
         *   result_info: object{total_count: int},
         *   result: array<object{
         *     id: string,
         *     hostname: string,
         *     status: string,
         *     type: string,
         *   }>
         * }
         */
        public function listHostnames(
            string $zoneID,
            string $hostname = '',
            string $hostnameID = '',
            int $page = 1,
            int $perPage = 20,
            string $order = '',
            string $direction = '',
            int $ssl = 0
        ): \stdClass {}
    }

    class DNS
    {
        /**
         * @return object{
         *  success: bool,
         *   errors: array,
         *   messages: array,
         *   result_info: object{total_count: int},
         *   result: array<object{
         *    id: string,
         *    type: 'A'|'AAAA'|'CNAME',
         *    name: string,
         *    ttl: int,
         *    zone_id: string,
         *    zone_name: string,
         *    data: object,
         *   }>
         * }
         */
        public function listRecords(
            string $zoneID,
            string $type = '',
            string $name = '',
            string $content = '',
            int $page = 1,
            int $perPage = 20,
            string $order = '',
            string $direction = '',
            string $match = 'all'
        ): \stdClass {}
    }
}

namespace Stripe {
    /**
     * @property null|object{brand: string, exp_month: int, exp_year: int, last4: string} $card
     */
    class PaymentMethod {}
}

namespace Doctrine\ORM {
    use Doctrine\Persistence\ObjectRepository;
    use Doctrine\Common\Collections\Selectable;

    /**
     * An EntityRepository serves as a repository for entities with generic as well as
     * business specific methods for retrieving entities.
     *
     * This class is designed for inheritance and users can subclass this class to
     * write their own repositories with business-specific methods to locate entities.
     *
     * @template T
     * @template-implements Selectable<int,T>
     * @template-implements ObjectRepository<T>
     */
    class EntityRepository
    {
        /** @var Mapping\ClassMetadata<T> */
        protected $_class;

        /**
         * @param Mapping\ClassMetadata<T> $class
         */
        public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $class) {}

        /**
         * @return QueryBuilder<T>
         */
        public function createQueryBuilder($alias, $indexBy = null) {}
    }

    /** @template T */
    class QueryBuilder {
        /**
         * @param EntityManagerInterface<T> $em
         */
        public function __construct(EntityManagerInterface $em) {}
    }

}

namespace Doctrine\ORM\Tools\Pagination {
    use Doctrine\ORM\Query;
    use Doctrine\ORM\QueryBuilder;
    use Countable;
    use IteratorAggregate;

    /**
     * @template T
     * @implements IteratorAggregate<T>
     */
    class Paginator implements IteratorAggregate, Countable
    {
        /**
         * @param Query|QueryBuilder<T> $query
         * @param bool $fetchJoinCollection
         */
        public function __construct($query, $fetchJoinCollection = true) { }
    }
}
