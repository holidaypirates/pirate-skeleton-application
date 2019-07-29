# EnvironmentProvider Variables

Below is an explanation of each environment variable is used to configure this application.

### `APPLICATION_VERSION_TAG`
The version deployed. It will be showed in the api ping endpoint.

### `ENVIRONMENT`
This env var is used to inform which stage on Bugsnag an exception happened.  
Possible values are `staging`, `production`, `development`.  
More info on : `src/PirateApplication/EnvironmentProvider.php`

### `AWS_ECR_URI`
This is the URI for the AWS ECR where the images will be sent to and pulled from.

### `ERROR_REPORTING_LEVEL`
The level of logging that will be considered an error on bugsnag.

### `LOG_REQUESTS`
Boolean if should log each request into the logger or not.

### `BUGSNAG_API_KEY`
This env var is API key for Bugsnag.  
When ommited, Monolog won't add the Bugsnag handler thus not sending Bugsnag any exception.

### `LOG_FILE`
This env var is the path for the log file for the Monolog stream handler.  
When ommited, Monolog won't add the File Stream handler thus not logging any exception on any log file.

### `CACHE_ADAPTER`
The kind of adapter that will be used for the cache handler.
Possible options are :
- `void`
- `redis`

> If you decide to use `redis` then you must provide the folowing env vars for the redis connection:
> - `CACHE_REDIS_SCHEME`
> - `CACHE_REDIS_HOST`
> - `CACHE_REDIS_PORT`

### `CACHE_RESPONSE_TTL`
The TTL of the cache of the responses. It will be used both in the response's header and the body cache. 
