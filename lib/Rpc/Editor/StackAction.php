<?php

namespace Phpactor\Rpc\Editor;

use Phpactor\Rpc\Action;

class StackAction implements Action
{
    /**
     * @var array
     */
    private $actions;

    private function __construct(array $actions)
    {
        foreach ($actions as $action) {
            $this->add($action);
        }
    }

    public static function fromActions(array $actions)
    {
        return new self($actions);
    }

    public function name(): string
    {
        return 'collection';
    }

    public function parameters(): array
    {
        $actions = [];

        foreach ($this->actions as $action) {
            $actions[] = [
                'name' => $action->name(),
                'parameters' => $action->parameters()
            ];
        }

        return [
            'actions' => $actions
        ];
    }

    private function add(Action $action)
    {
        $this->actions[] = $action;
    }
}
