<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Service\DefaultService;
use AppBundle\Repository\DepartmentsRepository;
use AppBundle\Entity\Departments;
use AppBundle\Entity\Employees;
use Doctrine\ORM\EntityManager;

class DefaultServiceTest extends KernelTestCase
{

    /**
     *
     * @var DefaultService
     */
    protected $defaultService;

    /**
     *
     * @var DepartmentsRepository
     */
    protected $departmentsRepository;

    /**
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        self::bootKernel();
        
        // employees.repository:
        
        $this->defaultService = static::$kernel->getContainer()->get('default_service');
        $this->departmentsRepository = static::$kernel->getContainer()->get('departments.repository');
        
        $this->entityManager = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    public function testCopyEntityWithoutProxy()
    {
        $oldDepartment = $this->departmentsRepository->find(110);
        
        $department = $this->defaultService->copyEntity($oldDepartment);
        
        if ($department instanceof Departments) {
            $this->assertNull($department->getId(), "class department " . get_class($department) . " id: " . $department->getId());
            $employees = $department->getEmployees();
            foreach ($employees->toArray(0) as $emp) {
                if ($emp instanceof Employees) {
                    $this->assertNull($emp->getId(), "class employee " . get_class($emp) . ", id employee " . $emp->getId());
                }
            }
        }
    }

    public function testCopyEntityWithProxy()
    {
        $oldDepartment = $this->entityManager->getReference(Departments::class, 110);
        
        $department = $this->defaultService->copyEntity($oldDepartment);
        
        if ($department instanceof Departments) {
            $this->assertNull($department->getId(), "class department " . get_class($department) . " id: " . $department->getId());
            $employees = $department->getEmployees();
            foreach ($employees->toArray(0) as $emp) {
                if ($emp instanceof Employees) {
                    $this->assertNull($emp->getId(), "class employee " . get_class($emp) . ", id employee " . $emp->getId());
                }
            }
        }
    }
}
