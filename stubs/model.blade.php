namespace App\Models;

use Asxer\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class {{$entity}} extends Model
{
    use ModelTrait;

    protected $fillable = [
@foreach($fields as $field)
        '{{$field}}',
@endforeach
    ];

    protected $hidden = ['pivot'];
@foreach($relations as $relation)

    @include(config('entity-generator.stubs.relation'), $relation)
@endforeach
@if(!empty($casts))

    protected $casts = [
@foreach($casts as $fieldName => $cast)
        '{{$fieldName}}' => '{{$cast}}',
@endforeach
    ];
@endif
}
