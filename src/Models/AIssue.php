<?php

namespace AuroraWebSoftware\AAuth\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\OrganizationNode
 *
 * @property int $id
 * @property int $organization_scope_id
 * @property string $name
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string $path
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read int $assigned_node_count
 * @property-read bool $deletable
 * @property-read OrganizationScope $organization_scope
 * @method static Builder|AIssue newModelQuery()
 * @method static Builder|AIssue newQuery()
 * @method static Builder|AIssue query()
 * @method static Builder|AIssue whereCreatedAt($value)
 * @method static Builder|AIssue whereId($value)
 * @method static Builder|AIssue whereModelId($value)
 * @method static Builder|AIssue whereModelType($value)
 * @method static Builder|AIssue whereName($value)
 * @method static Builder|AIssue whereOrganizationScopeId($value)
 * @method static Builder|AIssue whereParentId($value)
 * @method static Builder|AIssue wherePath($value)
 * @method static Builder|AIssue whereUpdatedAt($value)
 * @method static AIssue find($value)
 * @mixin \Eloquent
 */
class AIssue extends Model
{
    use HasFactory;

    public $guarded = [];

}
