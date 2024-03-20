<?php

namespace AuroraWebSoftware\AIssue\Tests\Models;

use AuroraWebSoftware\AIssue\Contracts\IssueActorModelContract;
use AuroraWebSoftware\AIssue\Traits\AIssueActor;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use AuroraWebSoftware\Connective\Traits\Connective;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property int $id
 */
class User extends Model implements ConnectiveContract, IssueActorModelContract
{
    use AIssueActor;
    use Connective;

    protected $guarded = [];

    public function getIssueActorName(): string
    {
        return $this->name;
    }

    public static function supportedConnectionTypes(): array
    {
        return [];
    }

    public function getIssueReminderConfig(): array
    {
        return ['channel' => 'email', 'email' => 'example@ex.com'];
    }

    /**
     * @return Collection<IssueActorModelContract>
     *
     * @phpstan-ignore-next-line
     */
    public static function searchIssueActor(string $searchTerm): Collection
    {
        return User::query()->where('name', 'like', '%'.$searchTerm.'%')->get();
    }

    public static function getModelType(): string
    {
        return self::class;
    }

    public function getModelId(): int
    {
        return $this->id;
    }
}
