<?php

namespace Asxer\Support\Generators;

use Asxer\Support\Exceptions\ClassNotExistsException;
use Asxer\Support\Events\SuccessCreateMessage;

class RepositoryGenerator extends EntityGenerator
{
    public function generate()
    {
        if (!$this->classExists('models', $this->model)) {
            $this->throwFailureException(
                ClassNotExistsException::class,
                "Cannot create {$this->model} Model cause {$this->model} Model does not exists.",
                "Create a {$this->model} Model by himself or run command 'php artisan make:entity {$this->model} --only-model'."
            );
        }

        $repositoryContent = $this->getStub('repository', [
            'entity' => $this->model,
            'fields' => $this->getFields()
        ]);

        $this->saveClass('repositories', "{$this->model}Repository", $repositoryContent);

        event(new SuccessCreateMessage("Created a new Repository: {$this->model}Repository"));
    }

    protected function getFields()
    {
        return [
            'json' => $this->fields['json']
        ];
    }
}
