<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during api for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    # 1xx informational response
    100 => 'Continue',
    101 => 'Switching Protocols',
    102 => 'Processing',
    
    # 2xx success
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    207 => 'Multi-Status',
    
    # 3xx redirection
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => '(Unused)',
    307 => 'Temporary Redirect',
    308 => 'Permanent Redirect',
    
    # 4xx client errors
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    418 => 'I\'m a teapot',
    419 => 'Authentication Timeout',
    420 => 'Enhance Your Calm',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    424 => 'Method Failure',
    425 => 'Unordered Collection',
    426 => 'Upgrade Required',
    428 => 'Precondition Required',
    429 => 'Too Many Requests',
    431 => 'Request Header Fields Too Large',
    444 => 'No Response',
    449 => 'Retry With',
    450 => 'Blocked by Windows Parental Controls',
    451 => 'Unavailable For Legal Reasons',
    494 => 'Request Header Too Large',
    495 => 'Cert Error',
    496 => 'No Cert',
    497 => 'HTTP to HTTPS',
    499 => 'Client Closed Request',
    
    # 5xx server errors
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates',
    507 => 'Insufficient Storage',
    508 => 'Loop Detected',
    509 => 'Bandwidth Limit Exceeded',
    510 => 'Not Extended',
    511 => 'Network Authentication Required',
    598 => 'Network read timeout error',
    599 => 'Network connect timeout error',
            
    //# 1xx informational response
    'continue' => 'continue',
    'switching_protocols' => 'switching protocols',
    'processing' => 'processing',
    'early_hints' => 'early hints',

    //# 2xx success
    'ok' => 'ok',
    'created' => 'created',
    'accepted' => 'accepted',
    'non_authoriatative_information' => 'non authoriatative information',
    'no_content' => 'no content',
    'reset_content' => 'reset content',
    'partial_content' => 'partial content',
    'multi_status' => 'multi status',
    'already_reported' => 'already reported',
    'im_used' => 'im used',

    //# 3xx redirection
    'multiple_choices' => 'multiple choices',
    'moved_permanently' => 'moved permanently',
    'found' => 'found',
    'see_other' => 'see other',
    'not_modified' => 'not modified',
    'use_proxy' => 'use proxy',
    'switch_proxy' => 'switch proxy',
    'temporary_redirect' => 'temporary redirect',
    'permanent_redirect' => 'permanent redirect',

    //# 4xx client errors
    'bad_request' => 'bad request',
    'unauthorized' => 'unauthorized',
    'payment_required' => 'payment required',
    'forbidden' => 'forbidden',
    'not_found' => 'not found',
    'method_not_allowed' => 'method not allowed',
    'not_acceptable' => 'not acceptable',
    'proxy_authentication_required' => 'proxy authentication required',
    'request_timeout' => 'request timeout',
    'conflict' => 'conflict',
    'gone' => 'gone',
    'length_required' => 'length required',
    'precondition_failed' => 'precondition failed',
    'payload_too_large' => 'payload too large',
    'uri_too_long' => 'uri too long',
    'unsupported_media_type' => 'unsupported media type',
    'range_not_satisfiable' => 'range not satisfiable',
    'expectation_failed' => 'expectation failed',
    'im_a_teapot' => 'im a teapot',
    'misdirected_request' => 'misdirected request',
    'unprocessable_entity' => 'unprocessable entity',
    'locked' => 'locked',
    'failed_dependency' => 'failed dependency',
    'too_early' => 'too early',
    'upgrade_required' => 'upgrade required',
    'precondition_required' => 'precondition required',
    'too_many_requestes' => 'too many requestes',
    'request_header_fields_too_large' => 'request header fields too large',
    'unavailable_for_legal_reasons' => 'unavailable for legal reasons',

    //# 5xx server errors
    'internal_server_error' => 'internal server error',
    'not_implemented' => 'not implemented',
    'bad_gateway' => 'bad gateway',
    'service_unavailable' => 'service unavailable',
    'gateway_timeout' => 'gateway timeout',
    'http_version_not_supported' => 'http version not supported',
    'variant_also_negotiates' => 'variant also negotiates',
    'insufficient_storage' => 'insufficient storage',
    'loop_detected' => 'loop detected',
    'not_extended' => 'not extended',
    'network_authentication_required' => 'network authentication required',
];
