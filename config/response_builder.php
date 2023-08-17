<?php
declare(strict_types=1);

use App\Utility\Api\ApiCodes;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Laravel API Response Builder - configuration file
 *
 * See docs/config.md for detailed documentation
 *
 * @author    Marcin Orlowski <mail (#) marcinOrlowski (.) com>
 * @copyright 2016-2023 Marcin Orlowski
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/MarcinOrlowski/laravel-api-response-builder
 *
 * @noinspection PhpCSValidationInspection
 * phpcs:disable Squiz.PHP.CommentedOutCode.Found
 */

return [
	/*
	|-------------------------------------------------------------------------------------------------------------------
	| Code range settings
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'min_code'          => 100,
	'max_code'          => 1024,

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| Error code to message mapping
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'map'               => [
		//# 1xx informational response
		ApiCodes::CONTINUE                         => 'api.continue',
		ApiCodes::SWITCHING_PROTOCOLS              => 'api.switching_protocols',
		ApiCodes::PROCESSING                       => 'api.processing',
		ApiCodes::EARLY_HINTS                      => 'api.early_hints',

		//# 2xx success
		ApiCodes::OK                               => 'api.ok',
		ApiCodes::CREATED                          => 'api.created',
		ApiCodes::ACCEPTED                         => 'api.accepted',
		ApiCodes::NON_AUTHORITATIVE_INFORMATION    => 'api.non_authoriatative_information',
		ApiCodes::NO_CONTENT                       => 'api.no_content',
		ApiCodes::RESET_CONTENT                    => 'api.reset_content',
		ApiCodes::PARTIAL_CONTENT                  => 'api.partial_content',
		ApiCodes::MULTI_STATUS                     => 'api.multi_status',
		ApiCodes::ALREADY_REPORTED                 => 'api.already_reported',
		ApiCodes::IM_USED                          => 'api.im_used',

		//# 3xx redirection
		ApiCodes::MULTIPLE_CHOICES                 => 'api.multiple_choices',
		ApiCodes::MOVED_PERMANENTLY                => 'api.moved_permanently',
		ApiCodes::FOUND                            => 'api.found',
		ApiCodes::SEE_OTHER                        => 'api.see_other',
		ApiCodes::NOT_MODIFIED                     => 'api.not_modified',
		ApiCodes::USE_PROXY                        => 'api.use_proxy',
		ApiCodes::SWITCH_PROXY                     => 'api.switch_proxy',
		ApiCodes::TEMPORARY_REDIRECT               => 'api.temporary_redirect',
		ApiCodes::PERMANENT_REDIRECT               => 'api.permanent_redirect',

		//# 4xx client errors
		ApiCodes::BAD_REQUEST                      => 'api.bad_request',
		ApiCodes::UNAUTHORIZED                     => 'api.unauthorized',
		ApiCodes::PAYMENT_REQUIRED                 => 'api.payment_required',
		ApiCodes::FORBIDDEN                        => 'api.forbidden',
		ApiCodes::NOT_FOUND                        => 'api.not_found',
		ApiCodes::METHOD_NOT_ALLOWED               => 'api.method_not_allowed',
		ApiCodes::NOT_ACCEPTABLE                   => 'api.not_acceptable',
		ApiCodes::PROXY_AUTHENTICATION_REQUIRED    => 'api.proxy_authentication_required',
		ApiCodes::REQUEST_TIMEOUT                  => 'api.request_timeout',
		ApiCodes::CONFLICT                         => 'api.conflict',
		ApiCodes::GONE                             => 'api.gone',
		ApiCodes::LENGTH_REQUIRED                  => 'api.length_required',
		ApiCodes::PRECONDITION_FAILED              => 'api.precondition_failed',
		ApiCodes::PAYLOAD_TOO_LARGE                => 'api.payload_too_large',
		ApiCodes::URI_TOO_LONG                     => 'api.uri_too_long',
		ApiCodes::UNSUPPORTED_MEDIA_TYPE           => 'api.unsupported_media_type',
		ApiCodes::RANGE_NOT_SATISFIABLE            => 'api.range_not_satisfiable',
		ApiCodes::EXPECTATION_FAILED               => 'api.expectation_failed',
		ApiCodes::IM_A_TEAPOT                      => 'api.im_a_teapot',
		ApiCodes::MISDIRECTED_REQUEST              => 'api.misdirected_request',
		ApiCodes::UNPROCESSABLE_ENTITY             => 'api.unprocessable_entity',
		ApiCodes::LOCKED                           => 'api.locked',
		ApiCodes::FAILED_DEPENDENCY                => 'api.failed_dependency',
		ApiCodes::TOO_EARLY                        => 'api.too_early',
		ApiCodes::UPGRADE_REQUIRED                 => 'api.upgrade_required',
		ApiCodes::PRECONDITION_REQUIRED            => 'api.precondition_required',
		ApiCodes::TOO_MANY_REQUESTS                => 'api.too_many_requestes',
		ApiCodes::REQUEST_HEADER_FIELDS_TOO_LARGE  => 'api.request_header_fields_too_large',
		ApiCodes::UNAVAILABLE_FOR_LEGAL_REASONS    => 'api.unavailable_for_legal_reasons',

		//# 5xx server errors
		ApiCodes::INTERNAL_SERVER_ERROR            => 'api.internal_server_error',
		ApiCodes::NOT_IMPLEMENTED                  => 'api.not_implemented',
		ApiCodes::BAD_GATEWAY                      => 'api.bad_gateway',
		ApiCodes::SERVICE_UNAVAILABLE              => 'api.service_unavailable',
		ApiCodes::GATEWAY_TIMEOUT                  => 'api.gateway_timeout',
		ApiCodes::HTTP_VERSION_NOT_SUPPORTED       => 'api.http_version_not_supported',
		ApiCodes::VARIANT_ALSO_NEGOTIATES          => 'api.variant_also_negotiates',
		ApiCodes::INSUFFICIENT_STORAGE             => 'api.insufficient_storage',
		ApiCodes::LOOP_DETECTED                    => 'api.loop_detected',
		ApiCodes::NOT_EXTENDED                     => 'api.not_extended',
		ApiCodes::NETWORK_AUTHENTICATION_REQUIRED  => 'api.network_authentication_required',
	],

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| Response Builder data converter
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'converter'         => [
		'primitives' => [
			/*
			|-----------------------------------------------------------------------------------------------------------
			| Configuration for primitives used when such data is passed directly as payload (i.e. `success(15)`;)
			|-----------------------------------------------------------------------------------------------------------
			*/
			'array'   => [
				'key' => 'values',
			],
			'boolean' => [
				'key' => 'value',
			],
			'double'  => [
				'key' => 'value',
			],
			'integer' => [
				'key' => 'value',
			],
			'string'  => [
				'key' => 'value',
			],
		],

		/*
		|-----------------------------------------------------------------------------------------------------------
		| Object converters configuration for supported classes
		|-----------------------------------------------------------------------------------------------------------
		*/
		'classes'    => [
			\Illuminate\Database\Eloquent\Model::class          => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ToArrayConverter::class,
				'key'     => 'item',
				'pri'     => 0,
			],
			\Illuminate\Support\Collection::class               => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ToArrayConverter::class,
				'key'     => 'items',
				'pri'     => 0,
			],
			\Illuminate\Database\Eloquent\Collection::class     => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ToArrayConverter::class,
				'key'     => 'items',
				'pri'     => 0,
			],
			\Illuminate\Http\Resources\Json\JsonResource::class => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ToArrayConverter::class,
				'key'     => 'item',
				'pri'     => 0,
			],

			/*
			|-----------------------------------------------------------------------------------------------------------
			| Paginators converts to objects already, so we do not array wrapping here, hence setting `key` to null
			|-----------------------------------------------------------------------------------------------------------
			*/
			\Illuminate\Pagination\LengthAwarePaginator::class  => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ArrayableConverter::class,
				'key'     => null,
				'pri'     => 0,
			],
			\Illuminate\Pagination\Paginator::class             => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ArrayableConverter::class,
				'key'     => null,
				'pri'     => 0,
			],

			/*
			|-----------------------------------------------------------------------------------------------------------
			| Generic converters should have lower pri to allow dedicated ones to kick in first when class matches
			|-----------------------------------------------------------------------------------------------------------
			*/
			\JsonSerializable::class                            => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\JsonSerializableConverter::class,
				'key'     => 'item',
				'pri'     => -10,
			],
			\Illuminate\Contracts\Support\Arrayable::class      => [
				'handler' => \MarcinOrlowski\ResponseBuilder\Converters\ArrayableConverter::class,
				'key'     => 'items',
				'pri'     => -10,
			],
		],

	],

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| Exception handler error codes
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'exception_handler' => [
		/*
		 * The following keys are supported for each handler specified.
		 *   `handler`
		 *   `pri`
		 *   `config`
		 *
		 * The following keys are supported in "config" entry for each handler specified:
		 *   `api_code`   : (int) mandatory api_code to be used for given exception
		 *   `http_code`  : (int) optional HTTP code. If not specified, exception's HTTP status code will be used.
		 *   `msg_key`    : (string) optional localization string key (ie. 'app.my_error_string') which will be used
		 *                  if exception's message is empty. If `msg_key` is not provided, ExceptionHandler will
		 *                  fall back to built-in message, with message key built as "http_XXX" where XXX is
		 *                  HTTP code used to handle given the exception.
		 *   `msg_enforce`: (boolean) if `true`, then fallback message (either one specified with `msg_key`, or
		 *                  built-in one will **always** be used, ignoring exception's message string completely.
		 *                  If set to `false` (default) then it will enforce either built-in message (if no
		 *                  `msg_key` is set, or message referenced by `msg_key` completely ignoring exception
		 *                  message ($ex->getMessage()).
		 */

		\Illuminate\Validation\ValidationException::class => [
			'handler' => \MarcinOrlowski\ResponseBuilder\ExceptionHandlers\ValidationExceptionHandler::class,
			'pri'     => -100,
			'config'  => [
		        'api_code'  => ApiCodes::BAD_REQUEST,
		        'http_code' => ApiCodes::UNPROCESSABLE_ENTITY,
			],
		],

		\Symfony\Component\HttpKernel\Exception\HttpException::class => [
			'handler' => \MarcinOrlowski\ResponseBuilder\ExceptionHandlers\HttpExceptionHandler::class,
			'pri'     => -100,
			'config'  => [
		        HttpException::class => [
			        // used by unauthenticated() to obtain api and http code for the exception
			        HttpResponse::HTTP_UNAUTHORIZED         => [
				        'api_code' => ApiCodes::UNAUTHORIZED,
			        ],
			        // Required by ValidationException handler
			        HttpResponse::HTTP_UNPROCESSABLE_ENTITY => [
				        'api_code' => ApiCodes::BAD_REQUEST,
			        ],
			        // default handler is mandatory and MUST have both `api_code` and `http_code` set.
			        'default'                               => [
				        'api_code'  => ApiCodes::NOT_ACCEPTABLE,
				        'http_code' => ApiCodes::BAD_REQUEST,
			        ],
		        ],
			],

			/*
			|-----------------------------------------------------------------------------------------------------------
			| This is final exception handler. If ex is not dealt with yet this is its last stop.
			| Default handler is mandatory and MUST have both `api_code` and `http_code` set.
			|-----------------------------------------------------------------------------------------------------------
			*/
			'default' => [
				'handler' => \MarcinOrlowski\ResponseBuilder\ExceptionHandlers\HttpExceptionHandler::class,
				'pri'     => -127,
				'config'  => [
			        'api_code'  => ApiCodes::SERVICE_UNAVAILABLE,
			        'http_code' => ApiCodes::INTERNAL_SERVER_ERROR,
				],
			],
		],
	],

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| data-to-json encoding options
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'encoding_options'  => JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE,

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| If set to TRUE, 'data' element will always be JSON object (even empty, never NULL)
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'data_always_object' => false,

	/*
	|-------------------------------------------------------------------------------------------------------------------
	| Debug config
	|-------------------------------------------------------------------------------------------------------------------
	*/
	'debug'             => [
		'debug_key'         => 'debug',
		'exception_handler' => [
			'trace_key'     => 'trace',
			'trace_enabled' => env('APP_DEBUG', false),
		],

		// Controls debugging features of payload converter class.
		'converter'         => [
			// Set to true to figure out what converter is used for given data payload and why.
			'debug_enabled' => env('RB_CONVERTER_DEBUG', false),
		],
	],

];
