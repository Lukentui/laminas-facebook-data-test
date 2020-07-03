<?php
return [
    'service_manager' => [
        'factories' => [
            \Facebook\V1\Rest\AssociatedData\AssociatedDataResource::class => \Facebook\V1\Rest\AssociatedData\AssociatedDataResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'facebook.rest.associated-data' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/associated-data[/:associated_data_id]',
                    'defaults' => [
                        'controller' => 'Facebook\\V1\\Rest\\AssociatedData\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'facebook.rest.associated-data',
        ],
    ],
    'api-tools-rest' => [
        'Facebook\\V1\\Rest\\AssociatedData\\Controller' => [
            'listener' => \Facebook\V1\Rest\AssociatedData\AssociatedDataResource::class,
            'route_name' => 'facebook.rest.associated-data',
            'route_identifier_name' => 'associated_data_id',
            'collection_name' => 'associated_data',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Facebook\V1\Rest\AssociatedData\AssociatedDataEntity::class,
            'collection_class' => \Facebook\V1\Rest\AssociatedData\AssociatedDataCollection::class,
            'service_name' => 'AssociatedData',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Facebook\\V1\\Rest\\AssociatedData\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Facebook\\V1\\Rest\\AssociatedData\\Controller' => [
                0 => 'application/vnd.facebook.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Facebook\\V1\\Rest\\AssociatedData\\Controller' => [
                0 => 'application/vnd.facebook.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Facebook\V1\Rest\AssociatedData\AssociatedDataEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'facebook.rest.associated-data',
                'route_identifier_name' => 'associated_data_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Facebook\V1\Rest\AssociatedData\AssociatedDataCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'facebook.rest.associated-data',
                'route_identifier_name' => 'associated_data_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [],
    'input_filter_specs' => [
        'Facebook\\V1\\Rest\\AssociatedData\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'access_token',
                'description' => 'Access token from Facebook api',
                'field_type' => 'string',
                'error_message' => 'Access key required',
            ],
        ],
    ],
];
