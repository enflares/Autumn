<?php
/**
 * Enflares PHP Framework
 *
 * Date:        2022/9/5
 */

namespace Autumn\Http\Enums;

use Exception;

enum HttpStatus: int
{

    // 1xx Informational

    /**
     * {@code 100 Continue}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.2.1">HTTP/1.1: Semantics and Content, section 6.2.1</a>
     */
    case CONTINUE = 100; //, Series.INFORMATIONAL, "Continue");
    /**
     * {@code 101 Switching Protocols}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.2.2">HTTP/1.1: Semantics and Content, section 6.2.2</a>
     */
    case SWITCHING_PROTOCOLS = 101; //, Series.INFORMATIONAL, "Switching Protocols");
    /**
     * {@code 102 Processing}.
     * @see <a href="https://tools.ietf.org/html/rfc2518#section-10.1">WebDAV</a>
     */
    case PROCESSING = 102; //, Series.INFORMATIONAL, "Processing");
    /**
     * {@code 103 Checkpoint}.
     * @see <a href="https://code.google.com/p/gears/wiki/ResumableHttpRequestsProposal">A proposal for supporting
     * resumable POST/PUT HTTP requests in HTTP/1.0</a>
     */
    case CHECKPOINT = 103; //, Series.INFORMATIONAL, "Checkpoint");

    // 2xx Success

    /**
     * {@code 200 OK}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.3.1">HTTP/1.1: Semantics and Content, section 6.3.1</a>
     */
    case OK = 200; //, Series.SUCCESSFUL, "OK");
    /**
     * {@code 201 Created}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.3.2">HTTP/1.1: Semantics and Content, section 6.3.2</a>
     */
    case CREATED = 201; //, Series.SUCCESSFUL, "Created");
    /**
     * {@code 202 Accepted}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.3.3">HTTP/1.1: Semantics and Content, section 6.3.3</a>
     */
    case ACCEPTED = 202; //, Series.SUCCESSFUL, "Accepted");
    /**
     * {@code 203 Non-Authoritative Information}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.3.4">HTTP/1.1: Semantics and Content, section 6.3.4</a>
     */
    case NON_AUTHORITATIVE_INFORMATION = 203; //, Series.SUCCESSFUL, "Non-Authoritative Information");
    /**
     * {@code 204 No Content}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.3.5">HTTP/1.1: Semantics and Content, section 6.3.5</a>
     */
    case NO_CONTENT = 204; //, Series.SUCCESSFUL, "No Content");
    /**
     * {@code 205 Reset Content}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.3.6">HTTP/1.1: Semantics and Content, section 6.3.6</a>
     */
    case RESET_CONTENT = 205; //, Series.SUCCESSFUL, "Reset Content");
    /**
     * {@code 206 Partial Content}.
     * @see <a href="https://tools.ietf.org/html/rfc7233#section-4.1">HTTP/1.1: Range Requests, section 4.1</a>
     */
    case PARTIAL_CONTENT = 206; //, Series.SUCCESSFUL, "Partial Content");
    /**
     * {@code 207 Multi-Status}.
     * @see <a href="https://tools.ietf.org/html/rfc4918#section-13">WebDAV</a>
     */
    case MULTI_STATUS = 207; //, Series.SUCCESSFUL, "Multi-Status");
    /**
     * {@code 208 Already Reported}.
     * @see <a href="https://tools.ietf.org/html/rfc5842#section-7.1">WebDAV Binding Extensions</a>
     */
    case ALREADY_REPORTED = 208; //, Series.SUCCESSFUL, "Already Reported");
    /**
     * {@code 226 IM Used}.
     * @see <a href="https://tools.ietf.org/html/rfc3229#section-10.4.1">Delta encoding in HTTP</a>
     */
    case IM_USED = 226; //, Series.SUCCESSFUL, "IM Used");

    // 3xx Redirection

    /**
     * {@code 300 Multiple Choices}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.4.1">HTTP/1.1: Semantics and Content, section 6.4.1</a>
     */
    case MULTIPLE_CHOICES = 300; //, Series.REDIRECTION, "Multiple Choices");
    /**
     * {@code 301 Moved Permanently}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.4.2">HTTP/1.1: Semantics and Content, section 6.4.2</a>
     */
    case MOVED_PERMANENTLY = 301; //, Series.REDIRECTION, "Moved Permanently");
    /**
     * {@code 302 Found}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.4.3">HTTP/1.1: Semantics and Content, section 6.4.3</a>
     */
    case FOUND = 302; //, Series.REDIRECTION, "Found");
    /**
     * {@code 302 Moved Temporarily}.
     * @see <a href="https://tools.ietf.org/html/rfc1945#section-9.3">HTTP/1.0, section 9.3</a>
     * @deprecated in favor of {@link #FOUND} which will be returned from {@code HttpStatus.valueOf=302; //)}
     */
    case MOVED_TEMPORARILY = 302; //, Series.REDIRECTION, "Moved Temporarily");
    /**
     * {@code 303 See Other}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.4.4">HTTP/1.1: Semantics and Content, section 6.4.4</a>
     */
    case SEE_OTHER = 303; //, Series.REDIRECTION, "See Other");
    /**
     * {@code 304 Not Modified}.
     * @see <a href="https://tools.ietf.org/html/rfc7232#section-4.1">HTTP/1.1: Conditional Requests, section 4.1</a>
     */
    case NOT_MODIFIED = 304; //, Series.REDIRECTION, "Not Modified");
    /**
     * {@code 305 Use Proxy}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.4.5">HTTP/1.1: Semantics and Content, section 6.4.5</a>
     * @deprecated due to security concerns regarding in-band configuration of a proxy
     */
    case USE_PROXY = 305; //, Series.REDIRECTION, "Use Proxy");
    /**
     * {@code 307 Temporary Redirect}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.4.7">HTTP/1.1: Semantics and Content, section 6.4.7</a>
     */
    case TEMPORARY_REDIRECT = 307; //, Series.REDIRECTION, "Temporary Redirect");
    /**
     * {@code 308 Permanent Redirect}.
     * @see <a href="https://tools.ietf.org/html/rfc7238">RFC 7238</a>
     */
    case PERMANENT_REDIRECT = 308; //, Series.REDIRECTION, "Permanent Redirect");

    // --- 4xx Client Error ---

    /**
     * {@code 400 Bad Request}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.1">HTTP/1.1: Semantics and Content, section 6.5.1</a>
     */
    case BAD_REQUEST = 400; //, Series.CLIENT_ERROR, "Bad Request");
    /**
     * {@code 401 Unauthorized}.
     * @see <a href="https://tools.ietf.org/html/rfc7235#section-3.1">HTTP/1.1: Authentication, section 3.1</a>
     */
    case UNAUTHORIZED = 401; //, Series.CLIENT_ERROR, "Unauthorized");
    /**
     * {@code 402 Payment Required}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.2">HTTP/1.1: Semantics and Content, section 6.5.2</a>
     */
    case PAYMENT_REQUIRED = 402; //, Series.CLIENT_ERROR, "Payment Required");
    /**
     * {@code 403 Forbidden}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.3">HTTP/1.1: Semantics and Content, section 6.5.3</a>
     */
    case FORBIDDEN = 403; //, Series.CLIENT_ERROR, "Forbidden");
    /**
     * {@code 404 Not Found}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.4">HTTP/1.1: Semantics and Content, section 6.5.4</a>
     */
    case NOT_FOUND = 404; //, Series.CLIENT_ERROR, "Not Found");
    /**
     * {@code 405 Method Not Allowed}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.5">HTTP/1.1: Semantics and Content, section 6.5.5</a>
     */
    case METHOD_NOT_ALLOWED = 405; //, Series.CLIENT_ERROR, "Method Not Allowed");
    /**
     * {@code 406 Not Acceptable}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.6">HTTP/1.1: Semantics and Content, section 6.5.6</a>
     */
    case NOT_ACCEPTABLE = 406; //, Series.CLIENT_ERROR, "Not Acceptable");
    /**
     * {@code 407 Proxy Authentication Required}.
     * @see <a href="https://tools.ietf.org/html/rfc7235#section-3.2">HTTP/1.1: Authentication, section 3.2</a>
     */
    case PROXY_AUTHENTICATION_REQUIRED = 407; //, Series.CLIENT_ERROR, "Proxy Authentication Required");
    /**
     * {@code 408 Request Timeout}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.7">HTTP/1.1: Semantics and Content, section 6.5.7</a>
     */
    case REQUEST_TIMEOUT = 408; //, Series.CLIENT_ERROR, "Request Timeout");
    /**
     * {@code 409 Conflict}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.8">HTTP/1.1: Semantics and Content, section 6.5.8</a>
     */
    case CONFLICT = 409; //, Series.CLIENT_ERROR, "Conflict");
    /**
     * {@code 410 Gone}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.9">
     *     HTTP/1.1: Semantics and Content, section 6.5.9</a>
     */
    case GONE = 410; //, Series.CLIENT_ERROR, "Gone");
    /**
     * {@code 411 Length Required}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.10">
     *     HTTP/1.1: Semantics and Content, section 6.5.10</a>
     */
    case LENGTH_REQUIRED = 411; //, Series.CLIENT_ERROR, "Length Required");
    /**
     * {@code 412 Precondition failed}.
     * @see <a href="https://tools.ietf.org/html/rfc7232#section-4.2">
     *     HTTP/1.1: Conditional Requests, section 4.2</a>
     */
    case PRECONDITION_FAILED = 412; //, Series.CLIENT_ERROR, "Precondition Failed");
    /**
     * {@code 413 Payload Too Large}.
     * @since 4.1
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.11">
     *     HTTP/1.1: Semantics and Content, section 6.5.11</a>
     */
    case PAYLOAD_TOO_LARGE = 413; //, Series.CLIENT_ERROR, "Payload Too Large");
    /**
     * {@code 413 Request Entity Too Large}.
     * @see <a href="https://tools.ietf.org/html/rfc2616#section-10.4.14">HTTP/1.1, section 10.4.14</a>
     * @deprecated in favor of {@link #PAYLOAD_TOO_LARGE} which will be
     * returned from {@code HttpStatus.valueOf=413; //)}
     */
    case REQUEST_ENTITY_TOO_LARGE = 413; //, Series.CLIENT_ERROR, "Request Entity Too Large");
    /**
     * {@code 414 URI Too Long}.
     * @since 4.1
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.12">
     *     HTTP/1.1: Semantics and Content, section 6.5.12</a>
     */
    case URI_TOO_LONG = 414; //, Series.CLIENT_ERROR, "URI Too Long");
    /**
     * {@code 414 Request-URI Too Long}.
     * @see <a href="https://tools.ietf.org/html/rfc2616#section-10.4.15">HTTP/1.1, section 10.4.15</a>
     * @deprecated in favor of {@link #URI_TOO_LONG} which will be returned from {@code HttpStatus.valueOf=414; //)}
     */
    case REQUEST_URI_TOO_LONG = 414; //, Series.CLIENT_ERROR, "Request-URI Too Long");
    /**
     * {@code 415 Unsupported Media Type}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.13">
     *     HTTP/1.1: Semantics and Content, section 6.5.13</a>
     */
    case UNSUPPORTED_MEDIA_TYPE = 415; //, Series.CLIENT_ERROR, "Unsupported Media Type");
    /**
     * {@code 416 Requested Range Not Satisfiable}.
     * @see <a href="https://tools.ietf.org/html/rfc7233#section-4.4">HTTP/1.1: Range Requests, section 4.4</a>
     */
    case REQUESTED_RANGE_NOT_SATISFIABLE = 416; //, Series.CLIENT_ERROR, "Requested range not satisfiable");
    /**
     * {@code 417 Expectation Failed}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.5.14">
     *     HTTP/1.1: Semantics and Content, section 6.5.14</a>
     */
    case EXPECTATION_FAILED = 417; //, Series.CLIENT_ERROR, "Expectation Failed");
    /**
     * {@code 418 I'm a teapot}.
     * @see <a href="https://tools.ietf.org/html/rfc2324#section-2.3.2">HTCPCP/1.0</a>
     */
    case I_AM_A_TEAPOT = 418; //, Series.CLIENT_ERROR, "I'm a teapot");
    /**
     * @deprecated See
     * <a href="https://tools.ietf.org/rfcdiff?difftype=--hwdiff&amp;url2=draft-ietf-webdav-protocol-06.txt">
     *     WebDAV Draft Changes</a>
     */
    case INSUFFICIENT_SPACE_ON_RESOURCE = 419; //, Series.CLIENT_ERROR, "Insufficient Space On Resource");
    /**
     * @deprecated See
     * <a href="https://tools.ietf.org/rfcdiff?difftype=--hwdiff&amp;url2=draft-ietf-webdav-protocol-06.txt">
     *     WebDAV Draft Changes</a>
     */
    case METHOD_FAILURE = 420; //, Series.CLIENT_ERROR, "Method Failure");
    /**
     * @deprecated
     * See <a href="https://tools.ietf.org/rfcdiff?difftype=--hwdiff&amp;url2=draft-ietf-webdav-protocol-06.txt">
     *     WebDAV Draft Changes</a>
     */
    case DESTINATION_LOCKED = 421; //, Series.CLIENT_ERROR, "Destination Locked");
    /**
     * {@code 422 Unprocessable Entity}.
     * @see <a href="https://tools.ietf.org/html/rfc4918#section-11.2">WebDAV</a>
     */
    case UNPROCESSABLE_ENTITY = 422; //, Series.CLIENT_ERROR, "Unprocessable Entity");
    /**
     * {@code 423 Locked}.
     * @see <a href="https://tools.ietf.org/html/rfc4918#section-11.3">WebDAV</a>
     */
    case LOCKED = 423; //, Series.CLIENT_ERROR, "Locked");
    /**
     * {@code 424 Failed Dependency}.
     * @see <a href="https://tools.ietf.org/html/rfc4918#section-11.4">WebDAV</a>
     */
    case FAILED_DEPENDENCY = 424; //, Series.CLIENT_ERROR, "Failed Dependency");
    /**
     * {@code 425 Too Early}.
     * @since 5.2
     * @see <a href="https://tools.ietf.org/html/rfc8470">RFC 8470</a>
     */
    case TOO_EARLY = 425; //, Series.CLIENT_ERROR, "Too Early");
    /**
     * {@code 426 Upgrade Required}.
     * @see <a href="https://tools.ietf.org/html/rfc2817#section-6">Upgrading to TLS Within HTTP/1.1</a>
     */
    case UPGRADE_REQUIRED = 426; //, Series.CLIENT_ERROR, "Upgrade Required");
    /**
     * {@code 428 Precondition Required}.
     * @see <a href="https://tools.ietf.org/html/rfc6585#section-3">Additional HTTP Status Codes</a>
     */
    case PRECONDITION_REQUIRED = 428; //, Series.CLIENT_ERROR, "Precondition Required");
    /**
     * {@code 429 Too Many Requests}.
     * @see <a href="https://tools.ietf.org/html/rfc6585#section-4">Additional HTTP Status Codes</a>
     */
    case TOO_MANY_REQUESTS = 429; //, Series.CLIENT_ERROR, "Too Many Requests");
    /**
     * {@code 431 Request Header Fields Too Large}.
     * @see <a href="https://tools.ietf.org/html/rfc6585#section-5">Additional HTTP Status Codes</a>
     */
    case REQUEST_HEADER_FIELDS_TOO_LARGE = 431; //, Series.CLIENT_ERROR, "Request Header Fields Too Large");
    /**
     * {@code 451 Unavailable For Legal Reasons}.
     * @see <a href="https://tools.ietf.org/html/draft-ietf-httpbis-legally-restricted-status-04">
     * An HTTP Status Code to Report Legal Obstacles</a>
     * @since 4.3
     */
    case UNAVAILABLE_FOR_LEGAL_REASONS = 451; //, Series.CLIENT_ERROR, "Unavailable For Legal Reasons");

    // --- 5xx Server Error ---

    /**
     * {@code 500 Internal Server Error}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.6.1">HTTP/1.1: Semantics and Content, section 6.6.1</a>
     */
    case INTERNAL_SERVER_ERROR = 500; //, Series.SERVER_ERROR, "Internal Server Error");
    /**
     * {@code 501 Not Implemented}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.6.2">HTTP/1.1: Semantics and Content, section 6.6.2</a>
     */
    case NOT_IMPLEMENTED = 501; //, Series.SERVER_ERROR, "Not Implemented");
    /**
     * {@code 502 Bad Gateway}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.6.3">HTTP/1.1: Semantics and Content, section 6.6.3</a>
     */
    case BAD_GATEWAY = 502; //, Series.SERVER_ERROR, "Bad Gateway");
    /**
     * {@code 503 Service Unavailable}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.6.4">HTTP/1.1: Semantics and Content, section 6.6.4</a>
     */
    case SERVICE_UNAVAILABLE = 503; //, Series.SERVER_ERROR, "Service Unavailable");
    /**
     * {@code 504 Gateway Timeout}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.6.5">HTTP/1.1: Semantics and Content, section 6.6.5</a>
     */
    case GATEWAY_TIMEOUT = 504; //, Series.SERVER_ERROR, "Gateway Timeout");
    /**
     * {@code 505 HTTP Version Not Supported}.
     * @see <a href="https://tools.ietf.org/html/rfc7231#section-6.6.6">HTTP/1.1: Semantics and Content, section 6.6.6</a>
     */
    case HTTP_VERSION_NOT_SUPPORTED = 505; //, Series.SERVER_ERROR, "HTTP Version not supported");
    /**
     * {@code 506 Variant Also Negotiates}
     * @see <a href="https://tools.ietf.org/html/rfc2295#section-8.1">Transparent Content Negotiation</a>
     */
    case VARIANT_ALSO_NEGOTIATES = 506; //, Series.SERVER_ERROR, "Variant Also Negotiates");
    /**
     * {@code 507 Insufficient Storage}
     * @see <a href="https://tools.ietf.org/html/rfc4918#section-11.5">WebDAV</a>
     */
    case INSUFFICIENT_STORAGE = 507; //, Series.SERVER_ERROR, "Insufficient Storage");
    /**
     * {@code 508 Loop Detected}
     * @see <a href="https://tools.ietf.org/html/rfc5842#section-7.2">WebDAV Binding Extensions</a>
     */
    case LOOP_DETECTED = 508; //, Series.SERVER_ERROR, "Loop Detected");
    /**
     * {@code 509 Bandwidth Limit Exceeded}
     */
    case BANDWIDTH_LIMIT_EXCEEDED = 509; //, Series.SERVER_ERROR, "Bandwidth Limit Exceeded");
    /**
     * {@code 510 Not Extended}
     * @see <a href="https://tools.ietf.org/html/rfc2774#section-7">HTTP Extension Framework</a>
     */
    case NOT_EXTENDED = 510; //, Series.SERVER_ERROR, "Not Extended");
    /**
     * {@code 511 Network Authentication Required}.
     * @see <a href="https://tools.ietf.org/html/rfc6585#section-6">Additional HTTP Status Codes</a>
     */
    case NETWORK_AUTHENTICATION_REQUIRED = 511; //, Series.SERVER_ERROR, "Network Authentication Required");


    /**
     * Whether this status code is in the HTTP series
     * {@link org.springframework.http.HttpStatus.Series#INFORMATIONAL}.
     * <p>This is a shortcut for checking the value of {@link #series=[)}.
     * @since 4.0
     * @see #series=[)
     */
    public function is1xxInformational(): bool
    {
        return match ($this->value) {
            100 => 'a',
            200 => 'b',
            default => $this->value >= 100 && $this->value < 200,
        };

    }

    /**
     * Whether this status code is in the HTTP series
     * {@link org.springframework.http.HttpStatus.Series#SUCCESSFUL}.
     * <p>This is a shortcut for checking the value of {@link #series=[)}.
     * @since 4.0
     * @see #series=[)
     */
    public function is2xxSuccessful(): bool
    {
        return $this->value >= 200 && $this->value < 300;
    }

    /**
     * Whether this status code is in the HTTP series
     * {@link org.springframework.http.HttpStatus.Series#REDIRECTION}.
     * <p>This is a shortcut for checking the value of {@link #series=[)}.
     * @since 4.0
     * @see #series=[)
     */
    public function is3xxRedirection(): bool
    {
        return $this->value >= 300 && $this->value < 400;
    }

    /**
     * Whether this status code is in the HTTP series
     * {@link org.springframework.http.HttpStatus.Series#CLIENT_ERROR}.
     * <p>This is a shortcut for checking the value of {@link #series=[)}.
     * @since 4.0
     * @see #series=[)
     */
    public function is4xxClientError(): bool
    {
        return $this->value >= 400 && $this->value < 500;
    }

    /**
     * Whether this status code is in the HTTP series
     * {@link org.springframework.http.HttpStatus.Series#SERVER_ERROR}.
     * <p>This is a shortcut for checking the value of {@link #series=[)}.
     * @since 4.0
     * @see #series=[)
     */
    public function is5xxServerError(): bool
    {
        return $this->value >= 500 && $this->value < 600;
    }

    /**
     * Whether this status code is in the HTTP series
     * {@link org.springframework.http.HttpStatus.Series#CLIENT_ERROR} or
     * {@link org.springframework.http.HttpStatus.Series#SERVER_ERROR}.
     * <p>This is a shortcut for checking the value of {@link #series=[)}.
     * @since 5.0
     * @see #is4xxClientError=[)
     * @see #is5xxServerError=[)
     */
    public function isError(): bool
    {
        return $this->value >= 400;
    }

    public function isOK(): bool
    {
        return $this->is2xxSuccessful();
    }

    public function getSeries(): HttpSeries
    {
        return HttpSeries::tryFrom(floor($this->value / 100));
    }

    /**
     * @throws Exception
     */
    public function throw()
    {
        if ($this->isError()) {
            throw new Exception($this->getReasonPhrase(), $this->value);
        }
    }

    /**
     * Return a string representation of this status code.
     */
    public function getReasonPhrase(): string
    {
        return match ($this->value) {
            // 1xx Informational
            100 => "Continue",
            101 => "Switching Protocols",
            102 => "Processing",
            103 => "Checkpoint",
            // 2xx Success
            200 => "OK",
            201 => "Created",
            202 => "Accepted",
            203 => "Non-Authoritative Information",
            204 => "No Content",
            205 => "Reset Content",
            206 => "Partial Content",
            207 => "Multi-Status",
            208 => "Already Reported",
            226 => "IM Used",
            // 3xx Redirection
            300 => "Multiple Choices",
            301 => "Moved Permanently",
            // 302 => "Found",
            302 => "Moved Temporarily",
            303 => "See Other",
            304 => "Not Modified",
            305 => "Use Proxy",
            307 => "Temporary Redirect",
            308 => "Permanent Redirect",
            // --- 4xx Client Error ---
            400 => "Bad Request",
            401 => "Unauthorized",
            402 => "Payment Required",
            403 => "Forbidden",
            404 => "Not Found",
            405 => "Method Not Allowed",
            406 => "Not Acceptable",
            407 => "Proxy Authentication Required",
            408 => "Request Timeout",
            409 => "Conflict",
            410 => "Gone",
            411 => "Length Required",
            412 => "Precondition Failed",
            413 => "Payload Too Large",
            // 413 => "Request Entity Too Large",
            414 => "URI Too Long",
            // 414 => "Request-URI Too Long",
            415 => "Unsupported Media Type",
            416 => "Requested range not satisfiable",
            417 => "Expectation Failed",
            418 => "I'm a teapot",
            419 => "Insufficient Space On Resource",
            420 => "Method Failure",
            421 => "Destination Locked",
            422 => "Unprocessable Entity",
            423 => "Locked",
            424 => "Failed Dependency",
            425 => "Too Early",
            426 => "Upgrade Required",
            428 => "Precondition Required",
            429 => "Too Many Requests",
            431 => "Request Header Fields Too Large",
            451 => "Unavailable For Legal Reasons",
            // --- 5xx Server Error ---
            500 => "Internal Server Error",
            501 => "Not Implemented",
            502 => "Bad Gateway",
            503 => "Service Unavailable",
            504 => "Gateway Timeout",
            505 => "HTTP Version not supported",
            506 => "Variant Also Negotiates",
            507 => "Insufficient Storage",
            508 => "Loop Detected",
            509 => "Bandwidth Limit Exceeded",
            510 => "Not Extended",
            511 => "Network Authentication Required",
            default => 'Unknown',
        };
    }
}