$factory->define(App\Models\{{$entity}}::class, function (Faker\Generator $faker) {
    return [
@foreach($fields as $field)
        '{{$field['name']}}' => {!! \Asxer\Support\Generators\FactoryGenerator::getFactoryFieldsContent($field) !!},
@endforeach
    ];
});
