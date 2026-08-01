<?php

// This file is auto-generated and is for apps only. Bundles SHOULD NOT rely on its content.

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Config\Loader\ParamConfigurator as Param;

/**
 * This class provides array-shapes for configuring the services and bundles of an application.
 *
 * Services declared with the config() method below are autowired and autoconfigured by default.
 *
 * This is for apps only. Bundles SHOULD NOT use it.
 *
 * Example:
 *
 *     ```php
 *     // config/services.php
 *     namespace Symfony\Component\DependencyInjection\Loader\Configurator;
 *
 *     return App::config([
 *         'services' => [
 *             'App\\' => [
 *                 'resource' => '../src/',
 *             ],
 *         ],
 *     ]);
 *     ```
 *
 * @psalm-type ImportsConfig = list<string|array{
 *     resource: string,
 *     type?: string|null,
 *     ignore_errors?: bool|'not_found',
 * }>
 * @psalm-type ParametersConfig = array<string, scalar|\UnitEnum|array<scalar|\UnitEnum|array<mixed>|Param|null>|Param|null>
 * @psalm-type ArgumentsType = list<mixed>|array<string, mixed>
 * @psalm-type CallType = array<string, ArgumentsType>|array{0:string, 1?:ArgumentsType, 2?:bool}|array{method:string, arguments?:ArgumentsType, returns_clone?:bool}
 * @psalm-type TagsType = list<string|array<string, array<string, mixed>>> // arrays inside the list must have only one element, with the tag name as the key
 * @psalm-type CallbackType = string|array{0:string|ReferenceConfigurator,1:string}|\Closure|ReferenceConfigurator
 * @psalm-type DeprecationType = array{package: string, version: string, message?: string}
 * @psalm-type DefaultsType = array{
 *     public?: bool,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 * }
 * @psalm-type InstanceofType = array{
 *     shared?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     properties?: array<string, mixed>,
 *     configurator?: CallbackType,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 * }
 * @psalm-type DefinitionType = array{
 *     class?: string,
 *     file?: string,
 *     parent?: string,
 *     shared?: bool,
 *     synthetic?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     abstract?: bool,
 *     deprecated?: DeprecationType,
 *     factory?: CallbackType,
 *     configurator?: CallbackType,
 *     arguments?: ArgumentsType,
 *     properties?: array<string, mixed>,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     decorates?: string,
 *     decorates_tag?: string,
 *     decoration_inner_name?: string,
 *     decoration_priority?: int,
 *     decoration_on_invalid?: 'exception'|'ignore'|null,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 *     from_callable?: CallbackType,
 * }
 * @psalm-type AliasType = string|array{
 *     alias: string,
 *     public?: bool,
 *     deprecated?: DeprecationType,
 * }
 * @psalm-type PrototypeType = array{
 *     resource: string,
 *     namespace?: string,
 *     exclude?: string|list<string>,
 *     parent?: string,
 *     shared?: bool,
 *     lazy?: bool|string,
 *     public?: bool,
 *     abstract?: bool,
 *     deprecated?: DeprecationType,
 *     factory?: CallbackType,
 *     arguments?: ArgumentsType,
 *     properties?: array<string, mixed>,
 *     configurator?: CallbackType,
 *     calls?: list<CallType>,
 *     tags?: TagsType,
 *     resource_tags?: TagsType,
 *     autowire?: bool,
 *     autoconfigure?: bool,
 *     bind?: array<string, mixed>,
 *     constructor?: string,
 * }
 * @psalm-type StackType = array{
 *     stack: list<DefinitionType|AliasType|PrototypeType|array<class-string, ArgumentsType|null>>,
 *     public?: bool,
 *     deprecated?: DeprecationType,
 *     decorates?: string,
 *     decorates_tag?: string,
 *     decoration_inner_name?: string,
 *     decoration_priority?: int,
 *     decoration_on_invalid?: 'exception'|'ignore'|null,
 * }
 * @psalm-type ServicesConfig = array{
 *     _defaults?: DefaultsType,
 *     _instanceof?: array<class-string, InstanceofType>,
 *     ...<string, DefinitionType|AliasType|PrototypeType|StackType|ArgumentsType|null>
 * }
 * @psalm-type ExtensionType = array<string, mixed>
 * @psalm-type FrameworkConfig = array{
 *     secret?: scalar|Param|null,
 *     http_method_override?: bool|Param, // Set true to enable support for the '_method' request parameter to determine the intended HTTP method on POST requests. // Default: false
 *     allowed_http_method_override?: null|list<string|Param>,
 *     trust_x_sendfile_type_header?: scalar|Param|null, // Set true to enable support for xsendfile in binary file responses. // Default: "%env(bool:default::SYMFONY_TRUST_X_SENDFILE_TYPE_HEADER)%"
 *     ide?: scalar|Param|null, // Default: "%env(default::SYMFONY_IDE)%"
 *     test?: bool|Param,
 *     default_locale?: scalar|Param|null, // Default: "en"
 *     set_locale_from_accept_language?: bool|Param, // Whether to use the Accept-Language HTTP header to set the Request locale (only when the "_locale" request attribute is not passed). // Default: false
 *     set_content_language_from_locale?: bool|Param, // Whether to set the Content-Language HTTP header on the Response using the Request locale. // Default: false
 *     enabled_locales?: list<scalar|Param|null>,
 *     trusted_hosts?: Param|string|list<scalar|Param|null>,
 *     trusted_proxies?: mixed, // Default: ["%env(default::SYMFONY_TRUSTED_PROXIES)%"]
 *     trusted_headers?: Param|string|list<scalar|Param|null>,
 *     error_controller?: scalar|Param|null, // Default: "error_controller"
 *     handle_all_throwables?: bool|Param, // HttpKernel will handle all kinds of \Throwable. // Default: true
 *     csrf_protection?: bool|array{
 *         enabled?: scalar|Param|null, // Default: null
 *         stateless_token_ids?: list<scalar|Param|null>,
 *         check_header?: scalar|Param|null, // Whether to check the CSRF token in a header in addition to a cookie when using stateless protection. // Default: false
 *         cookie_name?: scalar|Param|null, // The name of the cookie to use when using stateless protection. // Default: "csrf-token"
 *     },
 *     form?: bool|array{ // Form configuration
 *         enabled?: bool|Param, // Default: false
 *         csrf_protection?: bool|array{
 *             enabled?: scalar|Param|null, // Default: null
 *             token_id?: scalar|Param|null, // Default: null
 *             field_name?: scalar|Param|null, // Default: "_token"
 *             field_attr?: array<string, scalar|Param|null>,
 *         },
 *     },
 *     http_cache?: bool|array{ // HTTP cache configuration
 *         enabled?: bool|Param, // Default: false
 *         debug?: bool|Param, // Default: "%kernel.debug%"
 *         trace_level?: "none"|"short"|"full"|Param,
 *         trace_header?: scalar|Param|null,
 *         default_ttl?: int|Param,
 *         private_headers?: list<scalar|Param|null>,
 *         skip_response_headers?: list<scalar|Param|null>,
 *         allow_reload?: bool|Param,
 *         allow_revalidate?: bool|Param,
 *         stale_while_revalidate?: int|Param,
 *         stale_if_error?: int|Param,
 *         terminate_on_cache_hit?: bool|Param, // Deprecated: Setting the "framework.http_cache.terminate_on_cache_hit.terminate_on_cache_hit" configuration option is deprecated. It will be removed in version 9.0.
 *     },
 *     esi?: bool|array{ // ESI configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     ssi?: bool|array{ // SSI configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     fragments?: bool|array{ // Fragments configuration
 *         enabled?: bool|Param, // Default: false
 *         hinclude_default_template?: scalar|Param|null, // Default: null
 *         path?: scalar|Param|null, // Default: "/_fragment"
 *     },
 *     profiler?: bool|array{ // Profiler configuration
 *         enabled?: bool|Param, // Default: false
 *         collect?: bool|Param, // Default: true
 *         collect_parameter?: scalar|Param|null, // The name of the parameter to use to enable or disable collection on a per request basis. // Default: null
 *         only_exceptions?: bool|Param, // Default: false
 *         only_main_requests?: bool|Param, // Default: false
 *         dsn?: scalar|Param|null, // Default: "file:%kernel.cache_dir%/profiler"
 *         collect_serializer_data?: true|Param, // Deprecated: Setting the "framework.profiler.collect_serializer_data.collect_serializer_data" configuration option is deprecated. It will be removed in version 9.0. // Default: true
 *     },
 *     workflows?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         workflows?: array<string, array{ // Default: []
 *             audit_trail?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *             },
 *             type?: "workflow"|"state_machine"|Param, // Default: "state_machine"
 *             marking_store?: array{
 *                 type?: "method"|Param,
 *                 property?: scalar|Param|null,
 *                 service?: scalar|Param|null,
 *             },
 *             supports?: Param|string|list<scalar|Param|null>,
 *             definition_validators?: list<scalar|Param|null>,
 *             support_strategy?: scalar|Param|null,
 *             initial_marking?: \BackedEnum|Param|string|list<scalar|Param|null>,
 *             events_to_dispatch?: null|list<string|Param>,
 *             places?: Param|string|list<array{ // Default: []
 *                 name?: scalar|Param|null,
 *                 metadata?: array<string, mixed>,
 *             }>,
 *             transitions?: list<array{ // Default: []
 *                 name?: string|Param,
 *                 guard?: string|Param, // An expression to block the transition.
 *                 from?: \BackedEnum|Param|string|list<array{ // Default: []
 *                     place?: string|Param,
 *                     weight?: int|Param, // Default: 1
 *                 }>,
 *                 to?: \BackedEnum|Param|string|list<array{ // Default: []
 *                     place?: string|Param,
 *                     weight?: int|Param, // Default: 1
 *                 }>,
 *                 weight?: int|Param, // Default: 1
 *                 metadata?: array<string, mixed>,
 *             }>,
 *             metadata?: array<string, mixed>,
 *         }>,
 *     },
 *     router?: bool|array{ // Router configuration
 *         enabled?: bool|Param, // Default: false
 *         resource?: scalar|Param|null,
 *         type?: scalar|Param|null,
 *         default_uri?: scalar|Param|null, // The default URI used to generate URLs in a non-HTTP context. // Default: null
 *         http_port?: scalar|Param|null, // Default: 80
 *         https_port?: scalar|Param|null, // Default: 443
 *         strict_requirements?: scalar|Param|null, // set to true to throw an exception when a parameter does not match the requirements set to false to disable exceptions when a parameter does not match the requirements (and return null instead) set to null to disable parameter checks against requirements 'true' is the preferred configuration in development mode, while 'false' or 'null' might be preferred in production // Default: true
 *         utf8?: bool|Param, // Default: true
 *     },
 *     session?: bool|array{ // Session configuration
 *         enabled?: bool|Param, // Default: false
 *         storage_factory_id?: scalar|Param|null, // Default: "session.storage.factory.native"
 *         handler_id?: scalar|Param|null, // Defaults to using the native session handler, or to the native *file* session handler if "save_path" is not null.
 *         name?: scalar|Param|null,
 *         cookie_lifetime?: scalar|Param|null,
 *         cookie_path?: scalar|Param|null,
 *         cookie_domain?: scalar|Param|null,
 *         cookie_secure?: true|false|"auto"|Param, // Default: "auto"
 *         cookie_httponly?: bool|Param, // Default: true
 *         cookie_samesite?: null|"lax"|"strict"|"none"|Param, // Default: "lax"
 *         use_cookies?: bool|Param,
 *         gc_divisor?: scalar|Param|null,
 *         gc_probability?: scalar|Param|null,
 *         gc_maxlifetime?: scalar|Param|null,
 *         save_path?: scalar|Param|null, // Defaults to "%kernel.cache_dir%/sessions" if the "handler_id" option is not null.
 *         metadata_update_threshold?: int|Param, // Seconds to wait between 2 session metadata updates. // Default: 0
 *     },
 *     request?: bool|array{ // Request configuration
 *         enabled?: bool|Param, // Default: false
 *         formats?: array<string, Param|string|list<scalar|Param|null>>,
 *     },
 *     assets?: bool|array{ // Assets configuration
 *         enabled?: bool|Param, // Default: true
 *         strict_mode?: bool|Param, // Throw an exception if an entry is missing from the manifest.json. // Default: false
 *         version_strategy?: scalar|Param|null, // Default: null
 *         version?: scalar|Param|null, // Default: null
 *         version_format?: scalar|Param|null, // Default: "%%s?%%s"
 *         json_manifest_path?: scalar|Param|null, // Default: null
 *         base_path?: scalar|Param|null, // Default: ""
 *         base_urls?: Param|string|list<scalar|Param|null>,
 *         packages?: array<string, array{ // Default: []
 *             strict_mode?: bool|Param, // Throw an exception if an entry is missing from the manifest.json. // Default: false
 *             version_strategy?: scalar|Param|null, // Default: null
 *             version?: scalar|Param|null,
 *             version_format?: scalar|Param|null, // Default: null
 *             json_manifest_path?: scalar|Param|null, // Default: null
 *             base_path?: scalar|Param|null, // Default: ""
 *             base_urls?: Param|string|list<scalar|Param|null>,
 *         }>,
 *     },
 *     asset_mapper?: bool|array{ // Asset Mapper configuration
 *         enabled?: bool|Param, // Default: true
 *         paths?: Param|string|array<string, scalar|Param|null>,
 *         excluded_patterns?: list<scalar|Param|null>,
 *         exclude_dotfiles?: bool|Param, // If true, any files starting with "." will be excluded from the asset mapper. // Default: true
 *         server?: bool|Param, // If true, a "dev server" will return the assets from the public directory (true in "debug" mode only by default). // Default: true
 *         public_prefix?: scalar|Param|null, // The public path where the assets will be written to (and served from when "server" is true). // Default: "/assets/"
 *         missing_import_mode?: "strict"|"warn"|"ignore"|Param, // Behavior if an asset cannot be found when imported from JavaScript or CSS files - e.g. "import './non-existent.js'". "strict" means an exception is thrown, "warn" means a warning is logged, "ignore" means the import is left as-is. // Default: "warn"
 *         extensions?: array<string, scalar|Param|null>,
 *         importmap_path?: scalar|Param|null, // The path of the importmap.php file. // Default: "%kernel.project_dir%/importmap.php"
 *         importmap_polyfill?: scalar|Param|null, // The importmap name that will be used to load the polyfill. Set to false to disable. // Default: "es-module-shims"
 *         importmap_script_attributes?: array<string, scalar|Param|null>,
 *         vendor_dir?: scalar|Param|null, // The directory to store JavaScript vendors. // Default: "%kernel.project_dir%/assets/vendor"
 *         precompress?: bool|array{ // Precompress assets with Brotli, Zstandard and gzip.
 *             enabled?: bool|Param, // Default: false
 *             formats?: list<scalar|Param|null>,
 *             extensions?: list<scalar|Param|null>,
 *         },
 *     },
 *     translator?: bool|array{ // Translator configuration
 *         enabled?: bool|Param, // Default: false
 *         fallbacks?: Param|string|list<scalar|Param|null>,
 *         logging?: bool|Param, // Default: false
 *         formatter?: scalar|Param|null, // Default: "translator.formatter.default"
 *         cache_dir?: scalar|Param|null, // Default: "%kernel.cache_dir%/translations"
 *         default_path?: scalar|Param|null, // The default path used to load translations. // Default: "%kernel.project_dir%/translations"
 *         paths?: list<scalar|Param|null>,
 *         pseudo_localization?: bool|array{
 *             enabled?: bool|Param, // Default: false
 *             accents?: bool|Param, // Default: true
 *             expansion_factor?: float|Param, // Default: 1.0
 *             brackets?: bool|Param, // Default: true
 *             parse_html?: bool|Param, // Default: false
 *             localizable_html_attributes?: list<scalar|Param|null>,
 *         },
 *         providers?: array<string, array{ // Default: []
 *             dsn?: scalar|Param|null,
 *             domains?: list<scalar|Param|null>,
 *             locales?: list<scalar|Param|null>,
 *         }>,
 *         globals?: array<string, Param|string|array{ // Default: []
 *             value?: mixed,
 *             message?: string|Param,
 *             parameters?: array<string, scalar|Param|null>,
 *             domain?: string|Param,
 *         }>,
 *     },
 *     validation?: bool|array{ // Validation configuration
 *         enabled?: bool|Param, // Default: false
 *         enable_attributes?: bool|Param, // Default: true
 *         static_method?: Param|string|list<scalar|Param|null>,
 *         translation_domain?: scalar|Param|null, // Default: "validators"
 *         email_validation_mode?: "html5"|"html5-allow-no-tld"|"strict"|Param, // Default: "html5"
 *         mapping?: array{
 *             paths?: list<scalar|Param|null>,
 *         },
 *         not_compromised_password?: bool|array{
 *             enabled?: bool|Param, // When disabled, compromised passwords will be accepted as valid. // Default: true
 *             endpoint?: scalar|Param|null, // API endpoint for the NotCompromisedPassword Validator. // Default: null
 *         },
 *         disable_translation?: bool|Param, // Default: false
 *         property_metadata_existence_check?: bool|Param, // When enabled, validateProperty() and validatePropertyValue() throw an exception if no metadata is found for the given property. // Default: false
 *         auto_mapping?: array<string, array{ // Default: []
 *             services?: list<scalar|Param|null>,
 *         }>,
 *     },
 *     serializer?: bool|array{ // Serializer configuration
 *         enabled?: bool|Param, // Default: true
 *         enable_attributes?: bool|Param, // Default: true
 *         name_converter?: scalar|Param|null,
 *         circular_reference_handler?: scalar|Param|null,
 *         max_depth_handler?: scalar|Param|null,
 *         mapping?: array{
 *             paths?: list<scalar|Param|null>,
 *         },
 *         default_context?: array<string, mixed>,
 *         named_serializers?: array<string, array{ // Default: []
 *             name_converter?: scalar|Param|null,
 *             default_context?: array<string, mixed>,
 *             include_built_in_normalizers?: bool|Param, // Whether to include the built-in normalizers // Default: true
 *             include_built_in_encoders?: bool|Param, // Whether to include the built-in encoders // Default: true
 *         }>,
 *     },
 *     property_access?: bool|array{ // Property access configuration
 *         enabled?: bool|Param, // Default: true
 *         magic_call?: bool|Param, // Default: false
 *         magic_get?: bool|Param, // Default: true
 *         magic_set?: bool|Param, // Default: true
 *         throw_exception_on_invalid_index?: bool|Param, // Default: false
 *         throw_exception_on_invalid_property_path?: bool|Param, // Default: true
 *     },
 *     type_info?: bool|array{ // Type info configuration
 *         enabled?: bool|Param, // Default: true
 *         aliases?: array<string, scalar|Param|null>,
 *     },
 *     property_info?: bool|array{ // Property info configuration
 *         enabled?: bool|Param, // Default: true
 *         with_constructor_extractor?: bool|Param, // Registers the constructor extractor. // Default: true
 *     },
 *     cache?: array{ // Cache configuration
 *         prefix_seed?: scalar|Param|null, // Used to namespace cache keys when using several apps with the same shared backend. // Default: "_%kernel.project_dir%.%kernel.container_class%"
 *         app?: scalar|Param|null, // App related cache pools configuration. // Default: "cache.adapter.filesystem"
 *         system?: scalar|Param|null, // System related cache pools configuration. // Default: "cache.adapter.system"
 *         directory?: scalar|Param|null, // Default: "%kernel.share_dir%/pools/app"
 *         default_psr6_provider?: scalar|Param|null,
 *         default_redis_provider?: scalar|Param|null, // Default: "redis://localhost"
 *         default_valkey_provider?: scalar|Param|null, // Default: "valkey://localhost"
 *         default_memcached_provider?: scalar|Param|null, // Default: "memcached://localhost"
 *         default_doctrine_dbal_provider?: scalar|Param|null, // Default: "database_connection"
 *         default_pdo_provider?: scalar|Param|null, // Default: null
 *         pools?: array<string, array{ // Default: []
 *             adapters?: Param|string|list<scalar|Param|null>,
 *             tags?: scalar|Param|null, // Default: null
 *             public?: bool|Param, // Default: false
 *             default_lifetime?: scalar|Param|null, // Default lifetime of the pool.
 *             provider?: scalar|Param|null, // Overwrite the setting from the default provider for this adapter.
 *             early_expiration_message_bus?: scalar|Param|null,
 *             clearer?: scalar|Param|null,
 *             marshaller?: scalar|Param|null, // The marshaller service to use for this pool.
 *         }>,
 *     },
 *     php_errors?: array{ // PHP errors handling configuration
 *         log?: mixed, // Use the application logger instead of the PHP logger for logging PHP errors. // Default: true
 *         throw?: bool|Param, // Throw PHP errors as \ErrorException instances. // Default: true
 *     },
 *     exceptions?: array<string, array{ // Default: []
 *         log_level?: scalar|Param|null, // The level of log message. Null to let Symfony decide. // Default: null
 *         status_code?: scalar|Param|null, // The status code of the response. Null or 0 to let Symfony decide. // Default: null
 *         log_channel?: scalar|Param|null, // The channel of log message. Null to let Symfony decide. // Default: null
 *     }>,
 *     web_link?: bool|array{ // Web links configuration
 *         enabled?: bool|Param, // Default: true
 *     },
 *     lock?: Param|bool|string|array{ // Lock configuration
 *         enabled?: bool|Param, // Default: false
 *         resources?: Param|string|array<string, Param|string|list<scalar|Param|null>>,
 *     },
 *     semaphore?: Param|bool|string|array{ // Semaphore configuration
 *         enabled?: bool|Param, // Default: false
 *         resources?: Param|string|array<string, scalar|Param|null>,
 *     },
 *     messenger?: bool|array{ // Messenger configuration
 *         enabled?: bool|Param, // Default: false
 *         routing?: array<string, Param|string|list<scalar|Param|null>>,
 *         serializer?: array{
 *             default_serializer?: scalar|Param|null, // Service id to use as the default serializer for the transports. // Default: "messenger.transport.native_php_serializer"
 *             symfony_serializer?: array{
 *                 format?: scalar|Param|null, // Serialization format for the messenger.transport.symfony_serializer service (which is not the serializer used by default). // Default: "json"
 *                 context?: array<string, mixed>,
 *             },
 *         },
 *         transports?: array<string, Param|string|array{ // Default: []
 *             dsn?: scalar|Param|null,
 *             serializer?: scalar|Param|null, // Service id of a custom serializer to use. // Default: null
 *             options?: array<string, mixed>,
 *             failure_transport?: scalar|Param|null, // Transport name to send failed messages to (after all retries have failed). // Default: null
 *             retry_strategy?: Param|string|array{
 *                 service?: scalar|Param|null, // Service id to override the retry strategy entirely. // Default: null
 *                 max_retries?: int|Param, // Default: 3
 *                 delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *                 multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: this delay = (delay * (multiple ^ retries)). // Default: 2
 *                 max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *                 jitter?: float|Param, // Randomness to apply to the delay (between 0 and 1). // Default: 0.1
 *             },
 *             rate_limiter?: scalar|Param|null, // Rate limiter name to use when processing messages. // Default: null
 *         }>,
 *         failure_transport?: scalar|Param|null, // Transport name to send failed messages to (after all retries have failed). // Default: null
 *         stop_worker_on_signals?: Param|int|string|list<scalar|Param|null>,
 *         default_bus?: scalar|Param|null, // Default: null
 *         buses?: array<string, array{ // Default: {"messenger.bus.default":{"default_middleware":{"enabled":true,"allow_no_handlers":false,"allow_no_senders":true},"middleware":[]}}
 *             default_middleware?: Param|bool|string|array{
 *                 enabled?: bool|Param, // Default: true
 *                 allow_no_handlers?: bool|Param, // Default: false
 *                 allow_no_senders?: bool|Param, // Default: true
 *             },
 *             middleware?: Param|string|list<Param|string|array{ // Default: []
 *                 id?: scalar|Param|null,
 *                 arguments?: list<mixed>,
 *             }>,
 *         }>,
 *     },
 *     scheduler?: bool|array{ // Scheduler configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     disallow_search_engine_index?: bool|Param, // Enabled by default when debug is enabled. // Default: true
 *     http_client?: bool|array{ // HTTP Client configuration
 *         enabled?: bool|Param, // Default: true
 *         max_host_connections?: int|Param, // The maximum number of connections to a single host.
 *         default_options?: array{
 *             headers?: array<string, mixed>,
 *             vars?: array<string, mixed>,
 *             max_redirects?: int|Param, // The maximum number of redirects to follow.
 *             http_version?: scalar|Param|null, // The default HTTP version, typically 1.1 or 2.0, leave to null for the best version.
 *             resolve?: array<string, scalar|Param|null>,
 *             proxy?: scalar|Param|null, // The URL of the proxy to pass requests through or null for automatic detection.
 *             no_proxy?: scalar|Param|null, // A comma separated list of hosts that do not require a proxy to be reached.
 *             timeout?: float|Param, // The idle timeout, defaults to the "default_socket_timeout" ini parameter.
 *             max_duration?: float|Param, // The maximum execution time for the request+response as a whole.
 *             bindto?: scalar|Param|null, // A network interface name, IP address, a host name or a UNIX socket to bind to.
 *             verify_peer?: bool|Param, // Indicates if the peer should be verified in a TLS context.
 *             verify_host?: bool|Param, // Indicates if the host should exist as a certificate common name.
 *             cafile?: scalar|Param|null, // A certificate authority file.
 *             capath?: scalar|Param|null, // A directory that contains multiple certificate authority files.
 *             local_cert?: scalar|Param|null, // A PEM formatted certificate file.
 *             local_pk?: scalar|Param|null, // A private key file.
 *             passphrase?: scalar|Param|null, // The passphrase used to encrypt the "local_pk" file.
 *             ciphers?: scalar|Param|null, // A list of TLS ciphers separated by colons, commas or spaces (e.g. "RC3-SHA:TLS13-AES-128-GCM-SHA256"...)
 *             peer_fingerprint?: array{ // Associative array: hashing algorithm => hash(es).
 *                 sha1?: mixed,
 *                 pin-sha256?: mixed,
 *                 md5?: mixed,
 *             },
 *             crypto_method?: scalar|Param|null, // The minimum version of TLS to accept; must be one of STREAM_CRYPTO_METHOD_TLSv*_CLIENT constants.
 *             extra?: array<string, mixed>,
 *             rate_limiter?: scalar|Param|null, // Rate limiter name to use for throttling requests. // Default: null
 *             caching?: bool|array{ // Caching configuration.
 *                 enabled?: bool|Param, // Default: false
 *                 cache_pool?: string|Param, // The taggable cache pool to use for storing the responses. // Default: "cache.http_client"
 *                 shared?: bool|Param, // Indicates whether the cache is shared (public) or private. // Default: true
 *                 max_ttl?: int|Param, // The maximum TTL (in seconds) allowed for cached responses. // Default: 86400
 *             },
 *             retry_failed?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *                 retry_strategy?: scalar|Param|null, // service id to override the retry strategy. // Default: null
 *                 http_codes?: Param|int|string|array<string, array{ // Default: []
 *                     code?: int|Param,
 *                     methods?: Param|string|list<string|Param>,
 *                 }>,
 *                 max_retries?: int|Param, // Default: 3
 *                 delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *                 multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: delay * (multiple ^ retries). // Default: 2
 *                 max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *                 jitter?: float|Param, // Randomness in percent (between 0 and 1) to apply to the delay. // Default: 0.1
 *             },
 *         },
 *         mock_response_factory?: scalar|Param|null, // `true` to always return empty 200 responses, or the id of the service to use to generate mock responses - which should be either an invokable or an iterable.
 *         scoped_clients?: array<string, Param|string|array{ // Default: []
 *             scope?: scalar|Param|null, // The regular expression that the request URL must match before adding the other options. When none is provided, the base URI is used instead.
 *             base_uri?: scalar|Param|null, // The URI to resolve relative URLs, following rules in RFC 3985, section 2.
 *             auth_basic?: scalar|Param|null, // An HTTP Basic authentication "username:password".
 *             auth_bearer?: scalar|Param|null, // A token enabling HTTP Bearer authorization.
 *             auth_ntlm?: scalar|Param|null, // A "username:password" pair to use Microsoft NTLM authentication (requires the cURL extension).
 *             query?: array<string, scalar|Param|null>,
 *             headers?: array<string, mixed>,
 *             max_redirects?: int|Param, // The maximum number of redirects to follow.
 *             http_version?: scalar|Param|null, // The default HTTP version, typically 1.1 or 2.0, leave to null for the best version.
 *             resolve?: array<string, scalar|Param|null>,
 *             proxy?: scalar|Param|null, // The URL of the proxy to pass requests through or null for automatic detection.
 *             no_proxy?: scalar|Param|null, // A comma separated list of hosts that do not require a proxy to be reached.
 *             timeout?: float|Param, // The idle timeout, defaults to the "default_socket_timeout" ini parameter.
 *             max_duration?: float|Param, // The maximum execution time for the request+response as a whole.
 *             bindto?: scalar|Param|null, // A network interface name, IP address, a host name or a UNIX socket to bind to.
 *             verify_peer?: bool|Param, // Indicates if the peer should be verified in a TLS context.
 *             verify_host?: bool|Param, // Indicates if the host should exist as a certificate common name.
 *             cafile?: scalar|Param|null, // A certificate authority file.
 *             capath?: scalar|Param|null, // A directory that contains multiple certificate authority files.
 *             local_cert?: scalar|Param|null, // A PEM formatted certificate file.
 *             local_pk?: scalar|Param|null, // A private key file.
 *             passphrase?: scalar|Param|null, // The passphrase used to encrypt the "local_pk" file.
 *             ciphers?: scalar|Param|null, // A list of TLS ciphers separated by colons, commas or spaces (e.g. "RC3-SHA:TLS13-AES-128-GCM-SHA256"...).
 *             peer_fingerprint?: array{ // Associative array: hashing algorithm => hash(es).
 *                 sha1?: mixed,
 *                 pin-sha256?: mixed,
 *                 md5?: mixed,
 *             },
 *             crypto_method?: scalar|Param|null, // The minimum version of TLS to accept; must be one of STREAM_CRYPTO_METHOD_TLSv*_CLIENT constants.
 *             mock_response_factory?: scalar|Param|null, // `true` to always return empty 200 responses, `false` to disable mocking, or the id of the service to use to generate mock responses (invokable or iterable).
 *             extra?: array<string, mixed>,
 *             rate_limiter?: scalar|Param|null, // Rate limiter name to use for throttling requests. // Default: null
 *             caching?: bool|array{ // Caching configuration.
 *                 enabled?: bool|Param, // Default: false
 *                 cache_pool?: string|Param, // The taggable cache pool to use for storing the responses. // Default: "cache.http_client"
 *                 shared?: bool|Param, // Indicates whether the cache is shared (public) or private. // Default: true
 *                 max_ttl?: int|Param, // The maximum TTL (in seconds) allowed for cached responses. // Default: 86400
 *             },
 *             retry_failed?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *                 retry_strategy?: scalar|Param|null, // service id to override the retry strategy. // Default: null
 *                 http_codes?: Param|int|string|array<string, array{ // Default: []
 *                     code?: int|Param,
 *                     methods?: Param|string|list<string|Param>,
 *                 }>,
 *                 max_retries?: int|Param, // Default: 3
 *                 delay?: int|Param, // Time in ms to delay (or the initial value when multiplier is used). // Default: 1000
 *                 multiplier?: float|Param, // If greater than 1, delay will grow exponentially for each retry: delay * (multiple ^ retries). // Default: 2
 *                 max_delay?: int|Param, // Max time in ms that a retry should ever be delayed (0 = infinite). // Default: 0
 *                 jitter?: float|Param, // Randomness in percent (between 0 and 1) to apply to the delay. // Default: 0.1
 *             },
 *         }>,
 *     },
 *     mailer?: bool|array{ // Mailer configuration
 *         enabled?: bool|Param, // Default: false
 *         message_bus?: scalar|Param|null, // The message bus to use. Defaults to the default bus if the Messenger component is installed. // Default: null
 *         dsn?: scalar|Param|null, // Default: null
 *         transports?: array<string, scalar|Param|null>,
 *         envelope?: array{ // Mailer Envelope configuration
 *             sender?: scalar|Param|null,
 *             recipients?: Param|string|list<scalar|Param|null>,
 *             allowed_recipients?: Param|string|list<scalar|Param|null>,
 *         },
 *         headers?: array<string, Param|string|array{ // Default: []
 *             value?: mixed,
 *         }>,
 *         dkim_signer?: bool|array{ // DKIM signer configuration
 *             enabled?: bool|Param, // Default: false
 *             key?: scalar|Param|null, // Key content, or path to key (in PEM format with the `file://` prefix) // Default: ""
 *             domain?: scalar|Param|null, // Default: ""
 *             select?: scalar|Param|null, // Default: ""
 *             passphrase?: scalar|Param|null, // The private key passphrase // Default: ""
 *             options?: array<string, mixed>,
 *         },
 *         smime_signer?: bool|array{ // S/MIME signer configuration
 *             enabled?: bool|Param, // Default: false
 *             key?: scalar|Param|null, // Path to key (in PEM format) // Default: ""
 *             certificate?: scalar|Param|null, // Path to certificate (in PEM format without the `file://` prefix) // Default: ""
 *             passphrase?: scalar|Param|null, // The private key passphrase // Default: null
 *             extra_certificates?: scalar|Param|null, // Default: null
 *             sign_options?: int|Param, // Default: null
 *         },
 *         smime_encrypter?: bool|array{ // S/MIME encrypter configuration
 *             enabled?: bool|Param, // Default: false
 *             repository?: scalar|Param|null, // S/MIME certificate repository service. This service shall implement the `Symfony\Component\Mailer\EventListener\SmimeCertificateRepositoryInterface`. // Default: ""
 *             cipher?: int|Param, // A set of algorithms used to encrypt the message // Default: null
 *         },
 *     },
 *     secrets?: bool|array{
 *         enabled?: bool|Param, // Default: true
 *         vault_directory?: scalar|Param|null, // Default: "%kernel.project_dir%/config/secrets/%kernel.runtime_environment%"
 *         local_dotenv_file?: scalar|Param|null, // Default: "%kernel.project_dir%/.env.%kernel.environment%.local"
 *         decryption_env_var?: scalar|Param|null, // Default: "base64:default::SYMFONY_DECRYPTION_SECRET"
 *     },
 *     notifier?: bool|array{ // Notifier configuration
 *         enabled?: bool|Param, // Default: false
 *         message_bus?: scalar|Param|null, // The message bus to use. Defaults to the default bus if the Messenger component is installed. // Default: null
 *         chatter_transports?: array<string, scalar|Param|null>,
 *         texter_transports?: array<string, scalar|Param|null>,
 *         notification_on_failed_messages?: bool|Param, // Default: false
 *         channel_policy?: array<string, Param|string|list<scalar|Param|null>>,
 *         admin_recipients?: list<array{ // Default: []
 *             email?: scalar|Param|null,
 *             phone?: scalar|Param|null, // Default: ""
 *         }>,
 *     },
 *     rate_limiter?: bool|array{ // Rate limiter configuration
 *         enabled?: bool|Param, // Default: false
 *         limiters?: array<string, array{ // Default: []
 *             lock_factory?: scalar|Param|null, // The service ID of the lock factory used by this limiter (or null to disable locking). // Default: "auto"
 *             cache_pool?: scalar|Param|null, // The cache pool to use for storing the current limiter state. // Default: "cache.rate_limiter"
 *             storage_service?: scalar|Param|null, // The service ID of a custom storage implementation, this precedes any configured "cache_pool". // Default: null
 *             policy?: "fixed_window"|"token_bucket"|"sliding_window"|"compound"|"no_limit"|Param, // The algorithm to be used by this limiter.
 *             limiters?: Param|string|list<scalar|Param|null>,
 *             limit?: int|Param, // The maximum allowed hits in a fixed interval or burst.
 *             interval?: scalar|Param|null, // Configures the fixed interval if "policy" is set to "fixed_window" or "sliding_window". The value must be a number followed by "second", "minute", "hour", "day", "week" or "month" (or their plural equivalent).
 *             rate?: array{ // Configures the fill rate if "policy" is set to "token_bucket".
 *                 interval?: scalar|Param|null, // Configures the rate interval. The value must be a number followed by "second", "minute", "hour", "day", "week" or "month" (or their plural equivalent).
 *                 amount?: int|Param, // Amount of tokens to add each interval. // Default: 1
 *             },
 *             anchor_at?: scalar|Param|null, // Aligns the "fixed_window" policy to a calendar (e.g. "2024-01-05 00:00:00 UTC" combined with `interval: 1 month` resets the counter on the 5th of each month). UTC if not specified. // Default: null
 *         }>,
 *     },
 *     uid?: bool|array{ // Uid configuration
 *         enabled?: bool|Param, // Default: false
 *         default_uuid_version?: 7|6|4|1|Param, // Default: 7
 *         name_based_uuid_version?: 5|3|Param, // Default: 5
 *         name_based_uuid_namespace?: scalar|Param|null,
 *         time_based_uuid_version?: 7|6|1|Param, // Default: 7
 *         time_based_uuid_node?: scalar|Param|null,
 *         uuid47_secret?: scalar|Param|null, // A high-entropy secret used by the "uuid47_transformer" service. Defaults to "kernel.secret". // Default: null
 *     },
 *     html_sanitizer?: bool|array{ // HtmlSanitizer configuration
 *         enabled?: bool|Param, // Default: false
 *         sanitizers?: array<string, array{ // Default: []
 *             default_action?: "drop"|"block"|"allow"|Param, // Defines how the sanitizer must behave by default.
 *             allow_safe_elements?: bool|Param, // Allows "safe" elements and attributes. // Default: false
 *             allow_static_elements?: bool|Param, // Allows all static elements and attributes from the W3C Sanitizer API standard. // Default: false
 *             allow_elements?: array<string, mixed>,
 *             block_elements?: Param|string|list<string|Param>,
 *             drop_elements?: Param|string|list<string|Param>,
 *             allow_attributes?: array<string, mixed>,
 *             drop_attributes?: array<string, mixed>,
 *             force_attributes?: array<string, array<string, string|Param>>,
 *             force_https_urls?: bool|Param, // Transforms URLs using the HTTP scheme to use the HTTPS scheme instead. // Default: false
 *             allowed_link_schemes?: Param|string|list<string|Param>,
 *             allowed_link_hosts?: Param|null|string|list<string|Param>,
 *             allow_relative_links?: bool|Param, // Allows relative URLs to be used in links href attributes. // Default: false
 *             allowed_media_schemes?: Param|string|list<string|Param>,
 *             allowed_media_hosts?: Param|null|string|list<string|Param>,
 *             allow_relative_medias?: bool|Param, // Allows relative URLs to be used in media source attributes (img, audio, video, ...). // Default: false
 *             with_attribute_sanitizers?: Param|string|list<string|Param>,
 *             without_attribute_sanitizers?: Param|string|list<string|Param>,
 *             max_input_length?: int|Param, // The maximum length allowed for the sanitized input. // Default: 0
 *         }>,
 *     },
 *     webhook?: bool|array{ // Webhook configuration
 *         enabled?: bool|Param, // Default: false
 *         message_bus?: scalar|Param|null, // The message bus to use. // Default: "messenger.default_bus"
 *         event_header_name?: scalar|Param|null, // Default: "Webhook-Event"
 *         id_header_name?: scalar|Param|null, // Default: "Webhook-Id"
 *         signature_header_name?: scalar|Param|null, // Default: "Webhook-Signature"
 *         signing_algorithm?: scalar|Param|null, // Default: "sha256"
 *         routing?: array<string, array{ // Default: []
 *             service?: scalar|Param|null,
 *             secret?: scalar|Param|null, // Default: ""
 *         }>,
 *     },
 *     remote-event?: bool|array{ // RemoteEvent configuration
 *         enabled?: bool|Param, // Default: false
 *     },
 *     json_streamer?: bool|array{ // JSON streamer configuration
 *         enabled?: bool|Param, // Default: false
 *         default_options?: array{
 *             include_null_properties?: bool|Param, // Encode the properties with null value // Default: false
 *             ...<string, mixed>
 *         },
 *     },
 * }
 * @psalm-type StimulusConfig = array{
 *     controller_paths?: list<scalar|Param|null>,
 *     controllers_json?: scalar|Param|null, // Default: "%kernel.project_dir%/assets/controllers.json"
 * }
 * @psalm-type TwigConfig = array{
 *     form_themes?: list<scalar|Param|null>,
 *     globals?: array<string, array{ // Default: []
 *         id?: scalar|Param|null,
 *         type?: scalar|Param|null,
 *         value?: mixed,
 *     }>,
 *     autoescape_service?: scalar|Param|null, // Default: null
 *     autoescape_service_method?: scalar|Param|null, // Default: null
 *     cache?: scalar|Param|null, // Default: true
 *     charset?: scalar|Param|null, // Default: "%kernel.charset%"
 *     debug?: bool|Param, // Default: "%kernel.debug%"
 *     strict_variables?: bool|Param, // Default: "%kernel.debug%"
 *     auto_reload?: scalar|Param|null,
 *     optimizations?: int|Param,
 *     default_path?: scalar|Param|null, // The default path used to load templates. // Default: "%kernel.project_dir%/templates"
 *     file_name_pattern?: Param|string|list<scalar|Param|null>,
 *     paths?: array<string, mixed>,
 *     date?: array{ // The default format options used by the date filter.
 *         format?: scalar|Param|null, // Default: "F j, Y H:i"
 *         interval_format?: scalar|Param|null, // Default: "%d days"
 *         timezone?: scalar|Param|null, // The timezone used when formatting dates, when set to null, the timezone returned by date_default_timezone_get() is used. // Default: null
 *     },
 *     number_format?: array{ // The default format options for the number_format filter.
 *         decimals?: int|Param, // Default: 0
 *         decimal_point?: scalar|Param|null, // Default: "."
 *         thousands_separator?: scalar|Param|null, // Default: ","
 *     },
 *     mailer?: array{
 *         html_to_text_converter?: scalar|Param|null, // A service implementing the "Symfony\Component\Mime\HtmlToTextConverter\HtmlToTextConverterInterface". // Default: null
 *     },
 * }
 * @psalm-type UxIconsConfig = array{
 *     icon_dir?: scalar|Param|null, // The local directory where icons are stored. // Default: "%kernel.project_dir%/assets/icons"
 *     default_icon_attributes?: array<string, scalar|Param|null>,
 *     icon_sets?: array<string, array{ // the icon set prefix (e.g. "acme") // Default: []
 *         path?: scalar|Param|null, // The local icon set directory path. (cannot be used with 'alias')
 *         alias?: scalar|Param|null, // The remote icon set identifier. (cannot be used with 'path')
 *         icon_attributes?: array<string, scalar|Param|null>,
 *         suffixes?: array<string, array{ // The suffix name (e.g. "solid", "20-solid") // Default: []
 *             icon_attributes?: array<string, scalar|Param|null>,
 *         }>,
 *     }>,
 *     aliases?: array<string, string|Param>,
 *     iconify?: bool|array{ // Configuration for the remote icon service.
 *         enabled?: bool|Param, // Default: true
 *         on_demand?: bool|Param, // Whether to download icons "on demand". // Default: true
 *         auto_lock?: bool|Param, // Persist "on demand" icons to the local icon directory (see "icon_dir"). Recommended in dev only. Requires "on_demand" to be enabled. // Default: false
 *         endpoint?: scalar|Param|null, // The endpoint for the Iconify icons API. // Default: "https://api.iconify.design"
 *     },
 *     ignore_not_found?: bool|Param, // Ignore error when an icon is not found. Set to 'true' to fail silently. // Default: false
 * }
 * @psalm-type TwigComponentConfig = array{
 *     defaults?: array<string, Param|string|array{ // Default: []
 *         template_directory?: scalar|Param|null, // Default: "components"
 *         name_prefix?: scalar|Param|null, // Default: ""
 *     }>,
 *     anonymous_template_directory?: scalar|Param|null, // Defaults to `components`
 *     profiler?: bool|array{ // Enables the profiler for Twig Component
 *         enabled?: bool|Param, // Default: "%kernel.debug%"
 *         collect_components?: bool|Param, // Collect components instances // Default: true
 *     },
 * }
 * @psalm-type PwaConfig = array{
 *     asset_compiler?: bool|Param, // When true, the assets will be compiled when the command "asset-map:compile" is run. // Default: true
 *     early_hints?: bool|array{ // Early Hints (HTTP 103) configuration. Requires a compatible server (FrankenPHP, Caddy).
 *         enabled?: bool|Param, // Default: false
 *         preload_manifest?: bool|Param, // Preload the PWA manifest file. // Default: true
 *         preload_serviceworker?: bool|Param, // Preload the service worker script. Disabled by default as SW registration is usually deferred. // Default: false
 *         preconnect_workbox_cdn?: bool|Param, // Preconnect to Workbox CDN when using CDN mode. // Default: true
 *     },
 *     favicons?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         default?: array{ // The favicon source and parameters. When used with "dark", this favicon will become the light version.
 *             src?: scalar|Param|null, // The path to the icon. Can be served by Asset Mapper, an absolute path or a Symfony UX Icon (if the bundle is installed).
 *             background_color?: scalar|Param|null, // The background color of the application. If this value is not defined and that of the Manifest section is, the value of the latter will be used. // Default: null
 *             border_radius?: int|Param, // The border radius of the icon. // Default: null
 *             image_scale?: int|Param, // The scale of the icon. // Default: null
 *             svg_attr?: array<string, mixed>,
 *         },
 *         dark?: array{ // The favicon source and parameters for the dark theme. Should only be used with "default".
 *             src?: scalar|Param|null, // The path to the icon. Can be served by Asset Mapper, an absolute path or a Symfony UX Icon (if the bundle is installed).
 *             background_color?: scalar|Param|null, // The background color of the application. If this value is not defined and that of the Manifest section is, the value of the latter will be used. // Default: null
 *             border_radius?: int|Param, // The border radius of the icon. // Default: null
 *             image_scale?: int|Param, // The scale of the icon. // Default: null
 *             svg_attr?: array<string, mixed>,
 *         },
 *         src?: scalar|Param|null, // Deprecated: The "src" configuration key is deprecated. Use the "default.src" configuration key instead. // The source of the favicon. Shall be a SVG or large PNG. // Default: null
 *         src_dark?: scalar|Param|null, // Deprecated: The "src_dark" configuration key is deprecated. Use the "dark.src" configuration key instead. // The source of the favicon in dark mode. Shall be a SVG or large PNG. // Default: null
 *         background_color?: scalar|Param|null, // Deprecated: The "background_color" configuration key is deprecated. Use the "default.background_color" configuration key instead. // The background color of the icon. // Default: null
 *         background_color_dark?: scalar|Param|null, // Deprecated: The "background_color_dark" configuration key is deprecated. Use the "dark.background_color" configuration key instead. // The background color of the icon in dark mode. // Default: null
 *         safari_pinned_tab_color?: scalar|Param|null, // The color of the Safari pinned tab. Requires "use_silhouette" to be set to "true". // Default: null
 *         tile_color?: scalar|Param|null, // The color of the tile for Windows 8+. // Default: null
 *         border_radius?: int|Param, // Deprecated: The "border_radius" configuration key is deprecated. Use the "default.border_radius" or "dark.border_radius" configuration key instead. // The border radius of the icon. // Default: null
 *         image_scale?: int|Param, // Deprecated: The "image_scale" configuration key is deprecated. Use the "default.image_scale" or "dark.image_scale" configuration key instead. // The scale of the icon. // Default: null
 *         low_resolution?: bool|Param, // Include low resolution icons. // Default: false
 *         use_silhouette?: bool|Param|null, // Use only the silhouette of the icon. Applicable for macOS Safari and Windows 8+. Requires potrace to be installed. // Default: null
 *         use_start_image?: bool|Param, // Use the icon as a start image for the iOS splash screen. // Default: true
 *         svg_color?: scalar|Param|null, // When the asset is a SVG file, replaces the currentColor attribute with this color. // Default: "#000"
 *         monochrome?: bool|Param, // Use a monochrome icon. // Default: false
 *         potrace?: scalar|Param|null, // The path to the potrace binary. // Default: "potrace"
 *     },
 *     image_processor?: scalar|Param|null, // The image processor to use to generate the icons of different sizes. // Default: null
 *     logger?: scalar|Param|null, // The logger service to use. If not set, the default logger will be used. // Default: null
 *     manifest?: bool|array{
 *         enabled?: bool|Param, // Default: false
 *         public_url?: scalar|Param|null, // The public URL of the manifest file. // Default: "/site.webmanifest"
 *         use_credentials?: bool|Param, // Indicates whether the manifest should be fetched with credentials. // Default: true
 *         background_color?: scalar|Param|null, // The background color of the application. It should match the background-color CSS property in the sites stylesheet for a smooth transition between launching the web application and loading the site's content.
 *         categories?: list<scalar|Param|null>,
 *         description?: scalar|Param|null, // The description of the application.
 *         display?: scalar|Param|null, // The display mode of the application.
 *         display_override?: list<scalar|Param|null>,
 *         id?: scalar|Param|null, // A string that represents the identity of the web application.
 *         orientation?: scalar|Param|null, // The orientation of the application.
 *         dir?: scalar|Param|null, // The direction of the application.
 *         lang?: scalar|Param|null, // The language of the application.
 *         name?: scalar|Param|null, // The name of the application.
 *         short_name?: scalar|Param|null, // The short name of the application.
 *         scope?: scalar|Param|null, // The scope of the application.
 *         start_url?: Param|string|array{ // The start URL of the application.
 *             path?: scalar|Param|null, // The URL or route name.
 *             path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *             params?: list<mixed>,
 *         },
 *         theme_color?: scalar|Param|null, // The theme color of the application. If a dark theme color is specified, the theme color will be used for the light theme.
 *         dark_theme_color?: scalar|Param|null, // The dark theme color of the application.
 *         edge_side_panel?: array{ // Specifies whether or not your app supports the side panel view in Microsoft Edge.
 *             preferred_width?: int|Param, // Specifies the preferred width of the side panel view in Microsoft Edge.
 *         },
 *         iarc_rating_id?: scalar|Param|null, // Specifies the International Age Rating Coalition (IARC) rating ID for the app. See https://www.globalratings.com/how-iarc-works.aspx for more information.
 *         scope_extensions?: list<array{ // Default: []
 *             type?: scalar|Param|null, // Specifies the type of scope extension. This is currently always origin (default), but future extensions may add other types. // Default: "origin"
 *             origin?: scalar|Param|null, // Specifies the origin pattern to associate with.
 *         }>,
 *         handle_links?: scalar|Param|null, // Specifies the default link handling for the web app.
 *         note_taking?: array{ // The note-taking capabilities of the application.
 *             note_taking_url?: Param|string|array{ // The URL to the note-taking service.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *         },
 *         icons?: list<Param|string|array{ // Default: []
 *             src?: scalar|Param|null, // The path to the icon. Can be served by Asset Mapper, an absolute path or a Symfony UX Icon (if the bundle is installed).
 *             sizes?: list<int|Param>,
 *             background_color?: scalar|Param|null, // The background color of the application. If this value is not defined and that of the Manifest section is, the value of the latter will be used. // Default: null
 *             border_radius?: int|Param, // The border radius of the icon. // Default: null
 *             image_scale?: int|Param, // The scale of the icon. // Default: null
 *             type?: scalar|Param|null, // The icon mime type.
 *             format?: scalar|Param|null, // The icon format. When set, the "type" option is ignored and the image will be converted.
 *             purpose?: scalar|Param|null, // The purpose of the icon.
 *             svg_attr?: array<string, mixed>,
 *         }>,
 *         screenshots?: list<Param|string|array{ // Default: []
 *             src?: scalar|Param|null, // The path to the screenshot. Can be served by Asset Mapper.
 *             height?: scalar|Param|null, // Default: null
 *             width?: scalar|Param|null, // Default: null
 *             form_factor?: scalar|Param|null, // The form factor of the screenshot. Will guess the form factor if not set.
 *             label?: scalar|Param|null, // The label of the screenshot.
 *             platform?: scalar|Param|null, // The platform of the screenshot.
 *             format?: scalar|Param|null, // The format of the screenshot. Will convert the file if set.
 *             reference?: scalar|Param|null, // The URL of the screenshot. Only for reference and not used by the bundle. // Default: null
 *         }>,
 *         file_handlers?: list<array{ // Default: []
 *             action?: Param|string|array{ // The action to take.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             accept?: array<string, list<scalar|Param|null>>,
 *         }>,
 *         launch_handler?: array{ // The launch handler of the application.
 *             client_mode?: list<scalar|Param|null>,
 *         },
 *         protocol_handlers?: list<array{ // Default: []
 *             protocol?: scalar|Param|null, // The protocol of the handler.
 *             placeholder?: scalar|Param|null, // The placeholder of the handler. Will be replaced by "xxx=%s". // Default: null
 *             url?: Param|string|array{ // The URL of the handler.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *         }>,
 *         prefer_related_applications?: bool|Param, // prefer related native applications (instead of this application) // Default: false
 *         related_applications?: list<array{ // Default: []
 *             platform?: scalar|Param|null, // The platform of the application.
 *             url?: Param|string|array{ // The URL of the application.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             id?: scalar|Param|null, // The ID of the application.
 *         }>,
 *         shortcuts?: list<array{ // Default: []
 *             name?: scalar|Param|null, // The name of the shortcut.
 *             short_name?: scalar|Param|null, // The short name of the shortcut.
 *             description?: scalar|Param|null, // The description of the shortcut.
 *             url?: Param|string|array{ // The URL of the shortcut.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             icons?: list<Param|string|array{ // Default: []
 *                 src?: scalar|Param|null, // The path to the icon. Can be served by Asset Mapper, an absolute path or a Symfony UX Icon (if the bundle is installed).
 *                 sizes?: list<int|Param>,
 *                 background_color?: scalar|Param|null, // The background color of the application. If this value is not defined and that of the Manifest section is, the value of the latter will be used. // Default: null
 *                 border_radius?: int|Param, // The border radius of the icon. // Default: null
 *                 image_scale?: int|Param, // The scale of the icon. // Default: null
 *                 type?: scalar|Param|null, // The icon mime type.
 *                 format?: scalar|Param|null, // The icon format. When set, the "type" option is ignored and the image will be converted.
 *                 purpose?: scalar|Param|null, // The purpose of the icon.
 *                 svg_attr?: array<string, mixed>,
 *             }>,
 *         }>,
 *         share_target?: array{ // The share target of the application.
 *             action?: Param|string|array{ // The action of the share target.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             method?: scalar|Param|null, // The method of the share target.
 *             enctype?: scalar|Param|null, // The enctype of the share target. Ignored if method is GET.
 *             params?: array{ // The parameters of the share target.
 *                 title?: scalar|Param|null, // The title of the share target.
 *                 text?: scalar|Param|null, // The text of the share target.
 *                 url?: scalar|Param|null, // The URL of the share target.
 *                 files?: list<array{ // Default: []
 *                     name?: scalar|Param|null, // The name of the file parameter.
 *                     accept?: list<scalar|Param|null>,
 *                 }>,
 *             },
 *         },
 *         widgets?: list<array{ // Default: []
 *             name?: scalar|Param|null, // The title of the widget, presented to users.
 *             short_name?: scalar|Param|null, // An alternative short version of the name.
 *             description?: scalar|Param|null, // The description of the widget.
 *             icons?: list<Param|string|array{ // Default: []
 *                 src?: scalar|Param|null, // The path to the icon. Can be served by Asset Mapper, an absolute path or a Symfony UX Icon (if the bundle is installed).
 *                 sizes?: list<int|Param>,
 *                 background_color?: scalar|Param|null, // The background color of the application. If this value is not defined and that of the Manifest section is, the value of the latter will be used. // Default: null
 *                 border_radius?: int|Param, // The border radius of the icon. // Default: null
 *                 image_scale?: int|Param, // The scale of the icon. // Default: null
 *                 type?: scalar|Param|null, // The icon mime type.
 *                 format?: scalar|Param|null, // The icon format. When set, the "type" option is ignored and the image will be converted.
 *                 purpose?: scalar|Param|null, // The purpose of the icon.
 *                 svg_attr?: array<string, mixed>,
 *             }>,
 *             screenshots?: list<Param|string|array{ // Default: []
 *                 src?: scalar|Param|null, // The path to the screenshot. Can be served by Asset Mapper.
 *                 height?: scalar|Param|null, // Default: null
 *                 width?: scalar|Param|null, // Default: null
 *                 form_factor?: scalar|Param|null, // The form factor of the screenshot. Will guess the form factor if not set.
 *                 label?: scalar|Param|null, // The label of the screenshot.
 *                 platform?: scalar|Param|null, // The platform of the screenshot.
 *                 format?: scalar|Param|null, // The format of the screenshot. Will convert the file if set.
 *                 reference?: scalar|Param|null, // The URL of the screenshot. Only for reference and not used by the bundle. // Default: null
 *             }>,
 *             tag?: scalar|Param|null, // A string used to reference the widget in the PWA service worker.
 *             template?: scalar|Param|null, // The template to use to display the widget in the operating system widgets dashboard. Note: this property is currently only informational and not used. See ms_ac_template below.
 *             ms_ac_template?: Param|string|array{ // The URL of the custom Adaptive Cards template to use to display the widget in the operating system widgets dashboard.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             data?: Param|string|array{ // The URL where the data to fill the template with can be found. If present, this URL is required to return valid JSON.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             type?: scalar|Param|null, // The MIME type for the widget data.
 *             auth?: bool|Param, // A boolean indicating if the widget requires authentication.
 *             update?: int|Param, // The frequency, in seconds, at which the widget will be updated. Code in your service worker must perform the updating; the widget is not updated automatically. See Access widget instances at runtime.
 *             multiple?: bool|Param, // A boolean indicating whether to allow multiple instances of the widget. Defaults to true. // Default: true
 *         }>,
 *     },
 *     path_type_reference?: int|Param, // Deprecated: The "path_type_reference" configuration key is deprecated. Use the "path_type_reference" of URL nodes instead. // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *     resource_hints?: bool|array{ // Resource Hints configuration for preconnect, dns-prefetch, and preload.
 *         enabled?: bool|Param, // Default: false
 *         auto_preconnect?: bool|Param, // Automatically add preconnect hints for detected external origins (Workbox CDN, Google Fonts). // Default: true
 *         preconnect?: list<scalar|Param|null>,
 *         dns_prefetch?: list<scalar|Param|null>,
 *         preload?: list<array{ // Default: []
 *             href?: scalar|Param|null, // The URL or path to preload.
 *             as?: "script"|"style"|"font"|"image"|"fetch"|"document"|"audio"|"video"|"track"|"worker"|Param, // The resource type.
 *             type?: scalar|Param|null, // The MIME type of the resource. // Default: null
 *             crossorigin?: "anonymous"|"use-credentials"|Param, // The crossorigin attribute value. Required for fonts. // Default: null
 *             fetchpriority?: "high"|"low"|"auto"|Param, // The fetch priority hint. // Default: null
 *             media?: scalar|Param|null, // Media query for responsive preloading. // Default: null
 *         }>,
 *     },
 *     serviceworker?: Param|bool|string|array{
 *         enabled?: bool|Param, // Default: false
 *         src?: scalar|Param|null, // The path to the service worker source file. Can be served by Asset Mapper.
 *         dest?: scalar|Param|null, // The public URL to the service worker. // Default: "/sw.js"
 *         skip_waiting?: bool|Param, // Whether to skip waiting for the service worker to be activated. // Default: false
 *         scope?: scalar|Param|null, // The scope of the service worker. // Default: "/"
 *         use_cache?: bool|Param, // Whether the service worker should use the cache. // Default: true
 *         workbox?: bool|array{ // The configuration of the workbox.
 *             enabled?: bool|Param, // Default: true
 *             use_cdn?: bool|Param, // Deprecated: The "use_cdn" option is deprecated and will be removed in 2.0.0. use "config.use_cdn" instead. // Whether to use the local workbox or the CDN. // Default: false
 *             google_fonts?: bool|array{
 *                 enabled?: bool|Param, // Default: true
 *                 cache_prefix?: scalar|Param|null, // The cache prefix for the Google fonts. // Default: null
 *                 max_age?: scalar|Param|null, // The maximum age of the Google fonts cache (in seconds). // Default: null
 *                 max_entries?: int|Param, // The maximum number of entries in the Google fonts cache. // Default: null
 *             },
 *             cache_manifest?: bool|Param, // Whether to cache the manifest file. // Default: true
 *             version?: scalar|Param|null, // Deprecated: The "version" option is deprecated and will be removed in 2.0.0. use "config.version" instead. // The version of workbox. When using local files, the version shall be "7.0.0." // Default: "7.3.0"
 *             workbox_public_url?: scalar|Param|null, // Deprecated: The "workbox_public_url" option is deprecated and will be removed in 2.0.0. use "config.workbox_public_url" instead. // The public path to the local workbox. Only used if use_cdn is false. // Default: "/workbox"
 *             idb_public_url?: scalar|Param|null, // The public path to the local IndexDB. Only used if use_cdn is false. // Default: "/idb"
 *             workbox_import_placeholder?: scalar|Param|null, // Deprecated: The "workbox_import_placeholder" option is deprecated and will be removed in 2.0.0. No replacement. // The placeholder for the workbox import. Will be replaced by the workbox import. // Default: "//WORKBOX_IMPORT_PLACEHOLDER"
 *             standard_rules_placeholder?: scalar|Param|null, // Deprecated: The "standard_rules_placeholder" option is deprecated and will be removed in 2.0.0. No replacement. // The placeholder for the standard rules. Will be replaced by caching strategies. // Default: "//STANDARD_RULES_PLACEHOLDER"
 *             offline_fallback_placeholder?: scalar|Param|null, // Deprecated: The "offline_fallback_placeholder" option is deprecated and will be removed in 2.0.0. No replacement. // The placeholder for the offline fallback. Will be replaced by the URL. // Default: "//OFFLINE_FALLBACK_PLACEHOLDER"
 *             widgets_placeholder?: scalar|Param|null, // Deprecated: The "widgets_placeholder" option is deprecated and will be removed in 2.0.0. No replacement. // The placeholder for the widgets. Will be replaced by the widgets management events. // Default: "//WIDGETS_PLACEHOLDER"
 *             clear_cache?: bool|Param, // Whether to clear the cache during the service worker activation. // Default: true
 *             navigation_preload?: bool|Param, // Whether to enable navigation preload. This speeds up navigation requests by making the network request in parallel with service worker boot-up. Note: Do not enable if you are precaching HTML pages (e.g., with offline_fallback or warm_cache_urls), as it would be redundant. // Default: false
 *             config?: array{
 *                 debug?: bool|Param, // Controls workbox debug logging. Set to false to disable debug mode and logging. // Default: true
 *                 version?: scalar|Param|null, // The version of workbox. When using local files, the version shall be "7.0.0." // Default: "7.3.0"
 *                 use_cdn?: bool|Param, // Whether to use the local workbox or the CDN. // Default: false
 *                 workbox_public_url?: scalar|Param|null, // The public path to the local workbox. Only used if use_cdn is false. // Default: "/workbox"
 *             },
 *             offline_fallback?: array{
 *                 cache_name?: scalar|Param|null, // The name of the offline cache. // Default: "offline"
 *                 page?: Param|string|array{ // The URL of the offline page fallback.
 *                     path?: scalar|Param|null, // The URL or route name.
 *                     path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                     params?: list<mixed>,
 *                 },
 *                 image?: Param|string|array{ // The URL of the offline image fallback.
 *                     path?: scalar|Param|null, // The URL or route name.
 *                     path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                     params?: list<mixed>,
 *                 },
 *                 font?: Param|string|array{ // The URL of the offline font fallback.
 *                     path?: scalar|Param|null, // The URL or route name.
 *                     path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                     params?: list<mixed>,
 *                 },
 *             },
 *             image_cache?: bool|array{
 *                 enabled?: bool|Param, // Default: true
 *                 cache_name?: scalar|Param|null, // The name of the image cache. // Default: "images"
 *                 regex?: scalar|Param|null, // The regex to match the images. // Default: "/\\.(ico|png|jpe?g|gif|svg|webp|bmp)$/"
 *                 max_entries?: int|Param, // The maximum number of entries in the image cache. // Default: 60
 *                 max_age?: scalar|Param|null, // The maximum number of seconds before the image cache is invalidated. // Default: 31536000
 *             },
 *             asset_cache?: bool|array{
 *                 enabled?: bool|Param, // Default: true
 *                 cache_name?: scalar|Param|null, // The name of the asset cache. // Default: "assets"
 *                 regex?: scalar|Param|null, // The regex to match the assets. // Default: "/\\.(css|js|json|xml|txt|map|ico|png|jpe?g|gif|svg|webp|bmp)$/"
 *                 max_age?: scalar|Param|null, // The maximum number of seconds before the asset cache is invalidated. // Default: 31536000
 *             },
 *             font_cache?: bool|array{
 *                 enabled?: bool|Param, // Default: true
 *                 cache_name?: scalar|Param|null, // The name of the font cache. // Default: "fonts"
 *                 regex?: scalar|Param|null, // The regex to match the fonts. // Default: "/\\.(ttf|eot|otf|woff2)$/"
 *                 max_entries?: int|Param, // The maximum number of entries in the image cache. // Default: 60
 *                 max_age?: int|Param, // The maximum number of seconds before the font cache is invalidated. // Default: 31536000
 *             },
 *             resource_caches?: list<array{ // Default: []
 *                 match_callback?: scalar|Param|null, // The regex or callback function to match the URLs.
 *                 cache_name?: scalar|Param|null, // The name of the page cache.
 *                 network_timeout?: int|Param, // The network timeout in seconds before cache is called (for "NetworkFirst" and "NetworkOnly" strategies). // Default: 3
 *                 strategy?: scalar|Param|null, // The caching strategy. Only "NetworkFirst", "CacheFirst" and "StaleWhileRevalidate" are supported. StaleWhileRevalidate provides instant page loads with background updates. // Default: "StaleWhileRevalidate"
 *                 max_entries?: scalar|Param|null, // The maximum number of entries in the cache (for "CacheFirst" and "NetworkFirst" strategy only). // Default: null
 *                 max_age?: scalar|Param|null, // The maximum number of seconds before the cache is invalidated (for "CacheFirst" and "NetWorkFirst" strategy only). // Default: null
 *                 broadcast?: bool|Param, // Whether to broadcast the cache update events (for "StaleWhileRevalidate" strategy only). Enables client notification when content is updated. // Default: true
 *                 range_requests?: bool|Param, // Whether to support range requests (for "CacheFirst" strategy only). // Default: false
 *                 cacheable_response_headers?: list<scalar|Param|null>,
 *                 cacheable_response_statuses?: list<int|Param>,
 *                 broadcast_headers?: bool|list<scalar|Param|null>,
 *                 preload_urls?: list<Param|string|array{ // Default: []
 *                     path?: scalar|Param|null, // The URL of the shortcut.
 *                     params?: list<mixed>,
 *                 }>,
 *             }>,
 *             background_sync?: list<array{ // Default: []
 *                 queue_name?: scalar|Param|null, // The name of the queue.
 *                 match_callback?: scalar|Param|null, // The regex or callback function to match the URLs.
 *                 error_on_4xx?: bool|Param, // Whether to retry the request on 4xx errors. // Default: true
 *                 error_on_5xx?: bool|Param, // Whether to retry the request on 5xx errors. // Default: true
 *                 expected_status_codes?: list<int|Param>,
 *                 expect_redirect?: bool|Param, // Whether to expect a redirect (JS response type should be "opaqueredirect" or the "redirected" property is "true"). // Default: false
 *                 method?: scalar|Param|null, // The HTTP method. // Default: "POST"
 *                 broadcast_channel?: scalar|Param|null, // The broadcast channel. Set null to disable. // Default: null
 *                 max_retention_time?: int|Param, // The maximum retention time in minutes. // Default: 1440
 *                 force_sync_fallback?: bool|Param, // If `true`, instead of attempting to use background sync events, always attempt to replay queued request at service worker startup. Most folks will not need this, unless you explicitly target a runtime like Electron that exposes the interfaces for background sync, but does not have a working implementation. // Default: false
 *             }>,
 *             background_fetch?: bool|array{
 *                 enabled?: bool|Param, // Default: false
 *                 db_name?: scalar|Param|null, // The IndexDB name where downloads are stored // Default: "bgfetch-completed"
 *                 progress_url?: Param|string|array{ // The URL of the progress page.
 *                     path?: scalar|Param|null, // The URL or route name.
 *                     path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                     params?: list<mixed>,
 *                 },
 *                 success_url?: Param|string|array{ // The URL of the success page.
 *                     path?: scalar|Param|null, // The URL or route name.
 *                     path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                     params?: list<mixed>,
 *                 },
 *                 success_message?: scalar|Param|null, // The message to display on success. This message is translated. // Default: null
 *                 failure_message?: scalar|Param|null, // The message to display on success. This message is translated. // Default: null
 *             },
 *             image_cache_name?: scalar|Param|null, // Deprecated: The "image_cache_name" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.image_cache.cache_name" instead. // The name of the image cache. // Default: "images"
 *             font_cache_name?: scalar|Param|null, // Deprecated: The "font_cache_name" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.font_cache.cache_name" instead. // The name of the font cache. // Default: "fonts"
 *             page_cache_name?: scalar|Param|null, // Deprecated: The "page_cache_name" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.resource_caches[].cache_name" instead. // The name of the page cache. // Default: "pages"
 *             asset_cache_name?: scalar|Param|null, // Deprecated: The "asset_cache_name" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.asset_cache.cache_name" instead. // The name of the asset cache. // Default: "assets"
 *             page_fallback?: Param|string|array{ // The URL of the offline page fallback.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             image_fallback?: Param|string|array{ // The URL of the offline image fallback.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             font_fallback?: Param|string|array{ // The URL of the offline font fallback.
 *                 path?: scalar|Param|null, // The URL or route name.
 *                 path_type_reference?: int|Param, // The path type reference to generate paths/URLs. See https://symfony.com/doc/current/routing.html#generating-urls-in-controllers for more information. // Default: 1
 *                 params?: list<mixed>,
 *             },
 *             image_regex?: scalar|Param|null, // Deprecated: The "image_regex" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.image_cache.regex" instead. // The regex to match the images. // Default: "/\\.(ico|png|jpe?g|gif|svg|webp|bmp)$/"
 *             static_regex?: scalar|Param|null, // Deprecated: The "static_regex" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.asset_cache.regex" instead. // The regex to match the static files. // Default: "/\\.(css|js|json|xml|txt|map)$/"
 *             font_regex?: scalar|Param|null, // Deprecated: The "font_regex" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.font_cache.regex" instead. // The regex to match the static files. // Default: "/\\.(ttf|eot|otf|woff2)$/"
 *             max_image_cache_entries?: int|Param, // Deprecated: The "max_image_cache_entries" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.image_cache.max_entries" instead. // The maximum number of entries in the image cache. // Default: 60
 *             max_image_age?: int|Param, // Deprecated: The "max_image_age" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.image_cache.max_age" instead. // The maximum number of seconds before the image cache is invalidated. // Default: 31536000
 *             max_font_cache_entries?: int|Param, // Deprecated: The "max_font_cache_entries" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.font_cache.max_entries" instead. // The maximum number of entries in the font cache. // Default: 30
 *             max_font_age?: int|Param, // Deprecated: The "max_font_age" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.font_cache.max_age" instead. // The maximum number of seconds before the font cache is invalidated. // Default: 31536000
 *             network_timeout_seconds?: int|Param, // Deprecated: The "network_timeout_seconds" option is deprecated and will be removed in 2.0.0. Please use "pwa.serviceworker.workbox.resource_caches[].network_timeout" instead. // The network timeout in seconds before cache is called (for warm cache URLs only). // Default: 3
 *             warm_cache_urls?: list<Param|string|array{ // Default: []
 *                 path?: scalar|Param|null, // The URL of the shortcut.
 *                 params?: list<mixed>,
 *             }>,
 *         },
 *     },
 *     speculation_rules?: bool|array{ // Speculation Rules API configuration for prefetching and prerendering pages.
 *         enabled?: bool|Param, // Default: false
 *         prefetch?: list<array{ // Default: []
 *             source?: "list"|"document"|Param, // The source type: "list" for explicit URLs, "document" for link matching. // Default: "document"
 *             urls?: list<Param|string|array{ // Default: []
 *                 path?: scalar|Param|null, // The URL path or route name.
 *                 params?: list<mixed>,
 *             }>,
 *             selector_matches?: scalar|Param|null, // For "document" source: CSS selector to match links. // Default: null
 *             href_matches?: scalar|Param|null, // For "document" source: URL pattern to match href attributes. // Default: null
 *             eagerness?: "immediate"|"eager"|"moderate"|"conservative"|Param, // Eagerness level: "immediate" (viewport), "eager" (hover 200ms), "moderate" (hover 100ms), "conservative" (mousedown/touchstart). // Default: "moderate"
 *             referrer_policy?: scalar|Param|null, // Referrer policy for the speculative request. // Default: null
 *         }>,
 *         prerender?: list<array{ // Default: []
 *             source?: "list"|"document"|Param, // The source type: "list" for explicit URLs, "document" for link matching. // Default: "document"
 *             urls?: list<Param|string|array{ // Default: []
 *                 path?: scalar|Param|null, // The URL path or route name.
 *                 params?: list<mixed>,
 *             }>,
 *             selector_matches?: scalar|Param|null, // For "document" source: CSS selector to match links. // Default: null
 *             href_matches?: scalar|Param|null, // For "document" source: URL pattern to match href attributes. // Default: null
 *             eagerness?: "immediate"|"eager"|"moderate"|"conservative"|Param, // Eagerness level. For prerender, "conservative" is recommended. // Default: "conservative"
 *             referrer_policy?: scalar|Param|null, // Referrer policy for the speculative request. // Default: null
 *         }>,
 *     },
 *     web_client?: scalar|Param|null, // The Panther Client for generating screenshots. If not set, the default client will be used. // Default: null
 *     user_agent?: scalar|Param|null, // The user agent to use when generating screenshots. When this user agent is detected, the Symfony profiler and debug toolbar will be automatically disabled to ensure screenshots look like production. // Default: "PWAScreenshotBot"
 * }
 * @psalm-type KnpMenuConfig = array{
 *     providers?: array{
 *         builder_alias?: bool|Param, // Default: true
 *     },
 *     twig?: array{
 *         template?: scalar|Param|null, // Default: "@KnpMenu/menu.html.twig"
 *     },
 *     templating?: bool|Param, // Default: false
 *     default_renderer?: scalar|Param|null, // Default: "twig"
 * }
 * @psalm-type SurvosFwConfig = array{
 *     name?: scalar|Param|null, // The app name when initializing Framework7 // Default: "FwApp"
 *     theme?: scalar|Param|null, // Default: "pagestack"
 *     enabled?: bool|Param, // Default: true
 *     debug?: bool|Param, // Default: true
 *     projects?: list<array{ // Default: []
 *         code?: scalar|Param|null, // configuration code for database, etc. // Default: "dummy"
 *         logo?: scalar|Param|null, // Default: "dummy/60x90.png"
 *         name?: scalar|Param|null, // Default: "DummyProject"
 *         tabs?: list<scalar|Param|null>,
 *         database?: scalar|Param|null, // indexDb database name // Default: "MyDatabase"
 *         stores?: list<array{ // Default: []
 *             name?: scalar|Param|null, // the store name
 *             schema?: scalar|Param|null, // the index definition
 *             url?: scalar|Param|null, // the API to use to load if empty. json-ld iterates through pages
 *             limit?: int|Param, // Default: 100
 *         }>,
 *         members?: list<array{ // Default: []
 *             email?: scalar|Param|null, // Default: null
 *             role?: scalar|Param|null, // Default: null
 *         }>,
 *     }>,
 * }
 * @psalm-type SurvosJsTwigConfig = array{
 *     debug?: bool|Param, // Default: false
 *     version?: scalar|Param|null, // Default: 1
 *     db?: scalar|Param|null, // Default: "db"
 *     routing?: array{
 *         routes_to_expose?: list<scalar|Param|null>,
 *     },
 *     stores?: list<array{ // Default: []
 *         batch?: int|Param, // batch size when loading api // Default: null
 *         name?: scalar|Param|null, // the store name
 *         schema?: scalar|Param|null, // the index definition
 *         url?: scalar|Param|null, // the API to use to load if empty. json-ld iterates through pages
 *         response_key?: scalar|Param|null, // key if API returns an object response, e.g. dummyjson returns {'products': [...]}
 *     }>,
 * }
 * @psalm-type ConfigType = array{
 *     imports?: ImportsConfig,
 *     parameters?: ParametersConfig,
 *     services?: ServicesConfig,
 *     framework?: FrameworkConfig,
 *     stimulus?: StimulusConfig,
 *     twig?: TwigConfig,
 *     ux_icons?: UxIconsConfig,
 *     twig_component?: TwigComponentConfig,
 *     pwa?: PwaConfig,
 *     knp_menu?: KnpMenuConfig,
 *     survos_fw?: SurvosFwConfig,
 *     survos_js_twig?: SurvosJsTwigConfig,
 *     "when@dev"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         framework?: FrameworkConfig,
 *         stimulus?: StimulusConfig,
 *         twig?: TwigConfig,
 *         ux_icons?: UxIconsConfig,
 *         twig_component?: TwigComponentConfig,
 *         pwa?: PwaConfig,
 *         knp_menu?: KnpMenuConfig,
 *         survos_fw?: SurvosFwConfig,
 *         survos_js_twig?: SurvosJsTwigConfig,
 *     },
 *     "when@prod"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         framework?: FrameworkConfig,
 *         stimulus?: StimulusConfig,
 *         twig?: TwigConfig,
 *         ux_icons?: UxIconsConfig,
 *         twig_component?: TwigComponentConfig,
 *         pwa?: PwaConfig,
 *         knp_menu?: KnpMenuConfig,
 *         survos_fw?: SurvosFwConfig,
 *         survos_js_twig?: SurvosJsTwigConfig,
 *     },
 *     "when@test"?: array{
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         framework?: FrameworkConfig,
 *         stimulus?: StimulusConfig,
 *         twig?: TwigConfig,
 *         ux_icons?: UxIconsConfig,
 *         twig_component?: TwigComponentConfig,
 *         pwa?: PwaConfig,
 *         knp_menu?: KnpMenuConfig,
 *         survos_fw?: SurvosFwConfig,
 *         survos_js_twig?: SurvosJsTwigConfig,
 *     },
 *     ...<string, ExtensionType|array{ // extra keys must follow the when@%env% pattern or match an extension alias
 *         imports?: ImportsConfig,
 *         parameters?: ParametersConfig,
 *         services?: ServicesConfig,
 *         ...<string, ExtensionType>,
 *     }>
 * }
 */
final class App
{
    /**
     * @param ConfigType $config
     *
     * @psalm-return ConfigType
     */
    public static function config(array $config): array
    {
        /** @var ConfigType $config */
        $config = AppReference::config($config);

        return $config;
    }
}

namespace Symfony\Component\Routing\Loader\Configurator;

/**
 * This class provides array-shapes for configuring the routes of an application.
 *
 * Example:
 *
 *     ```php
 *     // config/routes.php
 *     namespace Symfony\Component\Routing\Loader\Configurator;
 *
 *     return Routes::config([
 *         'controllers' => [
 *             'resource' => 'routing.controllers',
 *         ],
 *     ]);
 *     ```
 *
 * @psalm-type RouteConfig = array{
 *     path: string|array<string,string>,
 *     controller?: string,
 *     methods?: string|list<string>,
 *     requirements?: array<string,string>,
 *     defaults?: array<string,mixed>,
 *     options?: array<string,mixed>,
 *     host?: string|array<string,string>,
 *     schemes?: string|list<string>,
 *     condition?: string,
 *     locale?: string,
 *     format?: string,
 *     utf8?: bool,
 *     stateless?: bool,
 * }
 * @psalm-type ImportConfig = array{
 *     resource: string,
 *     type?: string,
 *     exclude?: string|list<string>,
 *     prefix?: string|array<string,string>,
 *     name_prefix?: string,
 *     trailing_slash_on_root?: bool,
 *     controller?: string,
 *     methods?: string|list<string>,
 *     requirements?: array<string,string>,
 *     defaults?: array<string,mixed>,
 *     options?: array<string,mixed>,
 *     host?: string|array<string,string>,
 *     schemes?: string|list<string>,
 *     condition?: string,
 *     locale?: string,
 *     format?: string,
 *     utf8?: bool,
 *     stateless?: bool,
 * }
 * @psalm-type AliasConfig = array{
 *     alias: string,
 *     deprecated?: array{package:string, version:string, message?:string},
 * }
 * @psalm-type RoutesConfig = array{
 *     "when@dev"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     "when@prod"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     "when@test"?: array<string, RouteConfig|ImportConfig|AliasConfig>,
 *     ...<string, RouteConfig|ImportConfig|AliasConfig>
 * }
 */
final class Routes
{
    /**
     * @param RoutesConfig $config
     *
     * @psalm-return RoutesConfig
     */
    public static function config(array $config): array
    {
        return $config;
    }
}
