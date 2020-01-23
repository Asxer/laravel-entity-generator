namespace App\Repositories;

use Illuminate\Support\Arr;
use RonasIT\Support\Repositories\BaseRepository;
use App\Models\{{$entity}};
{{--
    Laravel inserts two spaces between @property and type, so we are forced
    to use hack here to preserve one space
--}}
@php
echo <<<PHPDOC
/**
 * @property {$entity} \$model
 */

PHPDOC;
@endphp
class {{$entity}}Repository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel({{$entity}}::class);
    }
@if(!empty($fields['json']))

    public function update($where, $data) {
@foreach($fields['json'] as $field)
        if (Arr::has($data, '{{$field}}')) {
            $data['{{$field}}'] = json_encode($data['{{$field}}']);
        }

@endforeach
        return parent::update($where, $data);
    }
@endif
}
