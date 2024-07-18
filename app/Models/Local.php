<?php

namespace App\Models;

// use http\Exception\InvalidArgumentException;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/*
   Esta classe 'Local' representa um model do Laravel que interage com a tabela 'locals' na bd.
   Ela implementa a interface 'HasMedia' para facilitar a gestão de mídia associada.

   Utiliza traits que oferecem funcionalidades adicionais:
   - HasFactory: para suporte a factories de testes.
   - InteractsWithMedia: para manipulação de arquivos de mídia.
*/

class Local extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'locals'; // Define o nome da tabela associada ao model.

    protected $primaryKey = 'id'; // Define a chave primária do model.

    /*
        Os atributos que podem ser preenchidos em massa ao criar ou atualizar um model.
    */

    protected $fillable = [
        'name',
        'description',
        'coordinates',
        'type',
        'districts_id',
        'regions_id',
    ];

    /*
        Constante que define os tipos de locais permitidos.
    */

    public const LOCALTYPES = [
        'beach',
        'fluvial',
        'cascade'
    ];

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'locals_has_attributes',  'locals_id', 'attributes_id');  // Define a relação muitos para muitos com o model 'Attribute' usando a tabela intermediária 'locals_has_attributes'.
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'districts_id', 'id'); // Define a relação de pertencimento com o modelo 'District' usando 'districts_id'.
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'regions_id', 'id');
    }

    //Puts an exception if we use a different type.

    public function setTypeAttribute($value)
    {
        if (!in_array($value, self::LOCALTYPES)) {
            throw new InvalidArgumentException("Invalid type: $value");
        }  // Define um setter para o atributo 'type' que lança uma exceção se o valor não for um tipo válido.

        $this->attributes['type'] = $value;  // Define o valor do atributo 'type'.
    }

}
