# API Documentation

## Viewing the documentation
In order to see the documentation you have two options:

- Run this project and go to `http://pirate-app.local/docs/`
- Go to http://editor.swagger.io/ and copy&paste the contents of the `docs/API/V1/schema.json` file into the editor.


## Updating the documentation
In order to update the static API documentation, run:

```bash
$ composer update-docs
```
Or if you don't have PHP+Composer on your host machine:
```bash
$ docker run --rm -v ${PWD}:/local openapitools/openapi-generator-cli generate -i /local/docs/API/V1/schema.json -g html2 -o /local/public/docs
```
