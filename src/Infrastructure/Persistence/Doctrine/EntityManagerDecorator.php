<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine;

use App\Domain\Manager\EntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface as DoctrineEntityManagerInterface;

class EntityManagerDecorator implements EntityManagerInterface
{
    /**
     * @var DoctrineEntityManagerInterface
     */
    private $wrapped;

    public function __construct(DoctrineEntityManagerInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public function persist(object $entity): void
    {
        $this->wrapped->persist($entity);
    }

    public function flush(): void
    {
        $this->wrapped->flush();
    }
}
