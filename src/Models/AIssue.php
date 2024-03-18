<?php

namespace AuroraWebSoftware\AIssue\Models;

use AuroraWebSoftware\ACalendar\Contracts\EventableModelContract;
use AuroraWebSoftware\ACalendar\Enums\Type;
use AuroraWebSoftware\ACalendar\Exceptions\EventParameterValidationException;
use AuroraWebSoftware\ACalendar\Models\Event;
use AuroraWebSoftware\ACalendar\Traits\HasEvents;
use AuroraWebSoftware\AIssue\Contracts\IssueActorModelContract;
use AuroraWebSoftware\ArFlow\Contacts\StateableModelContract;
use AuroraWebSoftware\ArFlow\Traits\HasState;
use AuroraWebSoftware\Connective\Collections\ConnectiveCollection;
use AuroraWebSoftware\Connective\Contracts\ConnectiveContract;
use AuroraWebSoftware\Connective\Exceptions\ConnectionTypeException;
use AuroraWebSoftware\Connective\Exceptions\ConnectionTypeNotSupportedException;
use AuroraWebSoftware\Connective\Traits\Connective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $summary
 * @property ?string $description
 */
class AIssue extends Model implements ConnectiveContract, EventableModelContract, StateableModelContract
{
    use Connective;
    use HasEvents;
    use HasState {
        HasState::getId insteadof Connective;
    }

    public $guarded = [];

    protected $table = 'aissue_issues';

    public static function supportedConnectionTypes(): array
    {
        return ['issue_owner_model', 'issue_reporter', 'issue_responsible', 'issue_observer'];
    }

    public static function getModelType(): string
    {
        return self::class;
    }

    public function getModelId(): int
    {
        return $this->id;
    }

    public function getEventTitle(): ?string
    {
        return $this->summary;
    }

    public static function supportedWorkflows(): array
    {
        return ['simple'];
    }

    public function getDueDate(): ?\Carbon\Carbon
    {
        return $this->event('due_date')->first()?->start;
    }

    /**
     * @throws EventParameterValidationException
     */
    public function setDueDate(Carbon $dueDate, bool $includeTime = false): Event
    {
        return $this->updateOrCreateEvent(
            key: 'due_date',
            type: $includeTime ? Type::DATETIME_POINT : Type::DATE_POINT,
            start: $dueDate,
        );
    }

    public function removeDueDate(): void
    {
        $this->deleteEvent('due_date');
    }

    public function getReporter(): ?IssueActorModelContract
    {
        return $this->connectives('issue_reporter')->first() ?? null;
    }

    /**
     * @throws ConnectionTypeNotSupportedException
     * @throws ConnectionTypeException
     */
    public function setReporter(IssueActorModelContract $issueActorModel): void
    {
        if ($this->connections('issue_reporter')) {
            $this->connections('issue_reporter')
                ->each(fn (Model $connection) => $connection->delete());
        }

        $this->connectTo($issueActorModel, 'issue_reporter');
    }

    public function removeReporter(): void
    {
        if ($this->connections('issue_reporter')) {
            $this->connections('issue_reporter')
                ->each(fn (Model $connection) => $connection->delete());
        }
    }

    public function getResponsible(): ?IssueActorModelContract
    {
        return $this->connectives('issue_responsible')->first();
    }

    /**
     * @throws ConnectionTypeNotSupportedException
     * @throws ConnectionTypeException
     */
    public function setResponsible(IssueActorModelContract $issueActorModel): void
    {
        if ($this->connections('issue_responsible')) {
            $this->connections('issue_responsible')
                ->each(fn (Model $connection) => $connection->delete());
        }

        $this->connectTo($issueActorModel, 'issue_responsible');
    }

    public function removeResponsible(): void
    {
        if ($this->connections('issue_responsible')) {
            $this->connections('issue_responsible')
                ->each(fn (Model $connection) => $connection->delete());
        }
    }

    /**
     * @return ConnectiveCollection<IssueActorModelContract>
     */
    public function getObservers(): ConnectiveCollection
    {
        return $this->connectives('issue_observer');
    }

    /**
     * @throws ConnectionTypeNotSupportedException
     * @throws ConnectionTypeException
     */
    public function addObserver(IssueActorModelContract $issueActorModel): void
    {
        $add = true;

        foreach ($this->getObservers() as $observer) {
            if ($observer->getId() === $issueActorModel->getId()) {
                $add = false;
                break;
            }
        }

        if ($add) {
            $this->connectTo($issueActorModel, 'issue_observer');
        }
    }

    public function removeObserver(IssueActorModelContract $issueActorModel): void
    {
        foreach ($this->getObservers() as $observer) {
            if ($observer->getId() === $issueActorModel->getId()) {
                $observer->delete();
                break;
            }
        }
    }

    public function removeAllObservers(): void
    {
        foreach ($this->getObservers() as $observer) {
            $observer->delete();
        }
    }
}
