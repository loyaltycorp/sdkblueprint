<?php
declare(strict_types=1);

namespace Tests\LoyaltyCorp\SdkBlueprint\Sdk\Managers;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\ApiManagerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Managers\ApiManager;
use LoyaltyCorp\SdkBlueprint\Sdk\Repository;
use Tests\LoyaltyCorp\SdkBlueprint\Stubs\Entities\EntityStub;
use Tests\LoyaltyCorp\SdkBlueprint\Stubs\Entities\UserStub;
use Tests\LoyaltyCorp\SdkBlueprint\Stubs\Handlers\RequestHandlerStub;
use Tests\LoyaltyCorp\SdkBlueprint\Stubs\Repositories\UserRepositoryStub;
use Tests\LoyaltyCorp\SdkBlueprint\TestCase;

/**
 * @covers \LoyaltyCorp\SdkBlueprint\Sdk\Managers\ApiManager
 */
class ApiManagerTest extends TestCase
{
    /**
     * Test that find will return the expected entity.
     *
     * @return void
     */
    public function testFind(): void
    {
        $entity = new EntityStub(['entityId' => \uniqid('id', false)]);

        $found = $this->getManager($entity)->find(EntityStub::class, $entity->getEntityId());

        self::assertInstanceOf(EntityStub::class, $found);
        self::assertSame($entity->getEntityId(), $found->getEntityId());
    }

    /**
     * Test that api manager finds and returns array of entities with excepted number of items in it.
     *
     * @return void
     */
    public function testFindAll(): void
    {
        $entities = $this->getManager()->findAll(EntityStub::class);

        self::assertCount(1, $entities);
        self::assertInstanceOf(EntityStub::class, $entities[0]);
    }

    /**
     * Test that api manager will create an entity successfully.
     *
     * @return void
     */
    public function testCreate(): void
    {
        $entity = new EntityStub(['entityId' => \uniqid('id', false)]);

        $created = $this->getManager($entity)->create($entity);

        self::assertInstanceOf(EntityStub::class, $created);
        self::assertSame($entity->getEntityId(), $created->getEntityId());
    }

    /**
     * Test that api manager will delete an entity successfully.
     *
     * @return void
     */
    public function testDelete(): void
    {
        $success = $this->getManager()->delete(new EntityStub(['entityId' => \uniqid('id', false)]));

        self::assertTrue($success);
    }

    /**
     * Test that api manager will update an entity successfully.
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $entity = new EntityStub(['entityId' => \uniqid('id', false)]);

        $updated = $this->getManager()->update($entity);

        self::assertSame($entity, $updated);
    }

    /**
     * Test that api manager will return default entity repository when queried.
     *
     * @return void
     */
    public function testGetDefaultRepository(): void
    {
        // default repository
        self::assertInstanceOf(
            Repository::class,
            $this->getManager()->getRepository(EntityStub::class)
        );
    }

    /**
     * Test that api manager will return custom entity repository when queried.
     *
     * @return void
     */
    public function testGetCustomRepository(): void
    {
        // default repository
        self::assertInstanceOf(
            UserRepositoryStub::class,
            $this->getManager(new UserStub())->getRepository(UserStub::class)
        );
    }

    /**
     * Get api manage instance.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface|null $entity
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\ApiManagerInterface
     */
    private function getManager(?EntityInterface $entity = null): ApiManagerInterface
    {
        return new ApiManager(new RequestHandlerStub($entity));
    }
}
